<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Currency;
use App\Models\CompanyData;
use App\Models\ClientData;
use App\Models\Transaction;
use App\Models\TransactionToAccept;
use Illuminate\Support\Carbon;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
      try {
        $user = Auth::user();
        $transactions =Transaction::where('contractor_id',$user['id'])->orWhere('customer_id',$user['id'])->get();
        return view("/frontend/transaction/index")
          ->with('transactions', $transactions);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function create()
    {
      try {
        $currencies = DB::table('currencies')->get();
        $viewPath = '/frontend/transaction/create';
        if (Auth::user()->canAddTransaction() == false) {
            $viewPath = '/frontend/transaction/complete-data';
        }
        return View($viewPath)
          ->with('currencies', $currencies);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "create", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function store(Request $request)
    {
      $request->validate([
          'personal-code2' => ['required'],
          'Name' => ['required'],
          'TransactionType' => ['required'],
          'FromDate' => ['required'],
          'ToDate' => ['required'],
          'CommissionPayer' => ['required'],
          'BankName' => ['required'],
          'CurrencyName' => ['required'],
          'Amount' => ['required'],
          'Description' => ['required']
      ]);
        try {
          $user =  User::where('personal_code',$request['personal-code2'])->first();
          if ($user == null) {
            $currencies = DB::table('currencies')->get();
            $viewPath = '/frontend/transaction/create';
            return View($viewPath)
              ->with('currencies', $currencies);
          }
          $usercontractor = Auth::user();
          $currency =  Currency::where('symbol',$request['CurrencyName'])->first();
          $carbon = Carbon::now();
          $mytime = $carbon->format('Y-m-d H:i:s');
          $data = array(
            'customer_id' => $user['id'],
            'contractor_id' => $usercontractor['id'],
            'bank_name' => $request['BankName'],
            'currency_id' => $currency['id'],
            'name' => $request['Name'],
            'transaction_code' => $request['personal-code2'],
            'commission_payer' => $request['CommissionPayer'],
            'from_date' => $request['FromDate'],
            'to_date' => $request['ToDate'],
            'amount' => $request['Amount'],
            'date_of_order' => $mytime,
            'payment' => 0.00,
            'status' => 'Ready',
            'token' => $request['_token'],
            'transaction_type' => $request['TransactionType'],
            'description' => $request['Description']
          );
          Transaction::create($data);
          return view("/frontend/transaction/index");
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Transaction", "store", $ex->getMessage(), $request->ip());
            return view("/frontend/home/index");
        }
    }

    public function getContractor(Request $request)
    {
      try {
        $personalCode = $request->post('personal_code');
        $client = User::where('personal_code', $personalCode)->first();
        return view('/frontend/transaction/_client-data')->with('client', $client);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function edit($id)
    {
      try {
        $transaction = Transaction::find($id);
        $currencies = DB::table('currencies')->get();
        $banks = DB::table('client_bank_accounts')->get();
        $usercontractor = User::where('id',$transaction['contractor_id'])->first();
          $usercontractordata = CompanyData::where('user_id',$usercontractor['id'])->first();

        $usercustomer = User::where('id',$transaction['customer_id'])->first();
          $usercustomerdata = ClientData::where('user_id',$usercustomer['id'])->first();
        return view('/frontend/transaction/edit')
            ->with('transaction', $transaction)
            ->with('currencies', $currencies)
            ->with('banks', $banks)
            ->with('usercontractor', $usercontractor)
            ->with('usercustomer', $usercustomer)
            ->with('usercontractordata', $usercontractordata)
            ->with('usercustomerdata', $usercustomerdata);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }

    public function update($id, Request $request)
    {
        try {
            $success = 1;
            $transaction = Transaction::find($id);
            $request->validate([
                'Name' => ['required'],
                'TransactionType' => ['required'],
                'FromDate' => ['required'],
                'ToDate' => ['required'],
                'CommissionPayer' => ['required'],
                'BankName' => ['required'],
                'CurrencyName' => ['required'],
                'Payment' => ['required'],
                'Amount' => ['required'],
                'description' => ['required']
            ]);

            $currency =  Currency::where('symbol',$request['CurrencyName'])->first();
            $user = Auth::user();
            if ($user['id'] == $transaction['customer_id'] ) {
              $data = array(
                'customer_id' => $transaction['customer_id'],
                'contractor_id' => $transaction['contractor_id'],
                'customer_accept' => 1,
                'contractor_accept' => 0,
                'bank_name' => $request['BankName'],
                'currency_id' => $currency['id'],
                'name' => $request['Name'],
                'commission_payer' => $request['CommissionPayer'],
                'from_date' => $request['FromDate'],
                'to_date' => $request['ToDate'],
                'amount' => $request['Amount'],
                'payment' => $request['Payment'],
                'transaction_type' => $request['TransactionType'],
                'description' => $request['description'],
                'status' => 'ApprovalRequired',
                'transaction_code' => $transaction['transaction_code'],
                'date_of_order' => $transaction['date_of_order'],
                'token' => $transaction['token']
              );
            }
            elseif ($user['id'] == $transaction['contractor_id']) {
              $data = array(
                'customer_id' => $transaction['customer_id'],
                'contractor_id' => $transaction['contractor_id'],
                'customer_accept' => 0,
                'contractor_accept' => 1,
                'bank_name' => $request['BankName'],
                'currency_id' => $currency['id'],
                'name' => $request['Name'],
                'commission_payer' => $request['CommissionPayer'],
                'from_date' => $request['FromDate'],
                'to_date' => $request['ToDate'],
                'amount' => $request['Amount'],
                'payment' => $request['Payment'],
                'transaction_type' => $request['TransactionType'],
                'description' => $request['description'],
                'status' => 'ApprovalRequired',
                'transaction_code' => $transaction['transaction_code'],
                'date_of_order' => $transaction['date_of_order'],
                'token' => $transaction['token']
              );
            }

            TransactionToAccept::create($data);
            $user = Auth::user();
            $transactions =Transaction::where('contractor_id',$user['id'])->orWhere('customer_id',$user['id'])->get();
            return view("/frontend/transaction/index")
              ->with('transactions', $transactions);
        }
    catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Transaction', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return view("/frontend/home/index");
        }
    }

    public function templist()
    {
      try {
        $currentuser = Auth::user();
        $transactions =TransactionToAccept::where('contractor_id',$currentuser['id'])->orWhere('customer_id',$currentuser['id'])->get();
        return view("/frontend/transaction/templist")
          ->with('transactions', $transactions)
          ->with('currentuser', $currentuser);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "templist", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }
    }
    public function confirm(Request $request)
    {
      try {
        $user = Auth::user();
        $changes =TransactionToAccept::where('id',$request['id'])->first();

        if ($user['id'] == $changes['customer_id'] && $changes['customer_accept'] == 0) {
          $changes['customer_accept'] = 1;
          $changes->update();
        }
        elseif ($user['id'] == $changes['contractor_id'] && $changes['contractor_accept'] == 0) {
          $changes['contractor_accept'] = 1;
          $changes->update();
        }
        $transaction =  Transaction::where('transaction_code',$changes['transaction_code'])->first();
        $changes =TransactionToAccept::where('id',$request['id'])->first();

        if ($changes['contractor_accept'] == 1 && $changes['customer_accept'] == 1) {
          if ($changes['payment'] >= $changes['amount']) {
            $data = array(
              'customer_id' => $changes['customer_id'],
              'contractor_id' => $changes['contractor_id'],
              'bank_name' => $changes['bank_name'],
              'currency_id' => $changes['currency_id'],
              'name' => $changes['name'],
              'transaction_code' => $changes['transaction_code'],
              'commission_payer' => $changes['commission_payer'],
              'from_date' => $changes['from_date'],
              'to_date' => $changes['to_date'],
              'amount' => $changes['amount'],
              'date_of_order' => $changes['date_of_order'],
              'payment' => $changes['payment'],
              'status' => 'Completed',
              'token' => $changes['token'],
              'transaction_type' => $changes['transaction_type'],
              'description' => $changes['description']
            );
          }
          else {
            $data = array(
              'customer_id' => $changes['customer_id'],
              'contractor_id' => $changes['contractor_id'],
              'bank_name' => $changes['bank_name'],
              'currency_id' => $changes['currency_id'],
              'name' => $changes['name'],
              'transaction_code' => $changes['transaction_code'],
              'commission_payer' => $changes['commission_payer'],
              'from_date' => $changes['from_date'],
              'to_date' => $changes['to_date'],
              'amount' => $changes['amount'],
              'date_of_order' => $changes['date_of_order'],
              'payment' => $changes['payment'],
              'status' => 'Ready',
              'token' => $changes['token'],
              'transaction_type' => $changes['transaction_type'],
              'description' => $changes['description']
            );
          }
          $transaction->update($data);
          $changes->delete();
        }
        $user = Auth::user();
        $transactions =Transaction::where('contractor_id',$user['id'])->orWhere('customer_id',$user['id'])->get();
        return view("/frontend/transaction/index")
          ->with('transactions', $transactions);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "confirm", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }

    public function preview($id)
    {
      try {
        $transaction =  TransactionToAccept::where('id',$id)->first();
        return view("/frontend/transaction/preview")
        ->with('transaction', $transaction);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view("/frontend/home/index");
              }

    }
    // Nie wiem co się stało z tą funkcją poniżej. Jeśli zrobimy do niej ścieżke i ją wywołamy to pobierze nam ona plik TransactionPDF.blade.php
    // niezależnie od tego co jest w niej zapisanie i nizezależnie czy tem plik dalej istnieje. Straciłem pół dnia na ustaleniu dlaczego
    // i nie mam pojęcia co się dzieje.
/*
    public function generatepdf($id)
    {

    }
*/

// Tutaj loadView() nie chce znaleźć ściżki do pliku, nieważne jak bym ją podał. Nie wiem już co robić żeby wygenerować tego pdfa
    public function generatepdf2($id)
    {
      $transaction =  Transaction::where('id',$id)->first();
      $file = resource_path(). "\\views\\pdf\\TransactionPDF.blade.php";
      $pdf = PDF::loadView($file, $transaction); //load view page
       return $pdf->download(); // download pdf fileTransactionPDF.blade
    }
}
