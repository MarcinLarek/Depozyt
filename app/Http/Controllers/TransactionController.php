<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Currency;
use App\Models\ClientBankAccount;
use App\Models\Wallet;
use App\Models\CompanyData;
use App\Models\ClientData;
use App\Models\Transaction;
use App\Models\PlatformData;
use App\Models\TransactionToAccept;
use Illuminate\Support\Carbon;
use PDF;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Models\WalletHistory;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
      try {
          $user = Auth::user();
          $succesaalert = 0;
          $transactions =Transaction::where('contractor_id',$user['id'])->orWhere('customer_id',$user['id'])->get();
          foreach ($transactions as $transaction) {
            $transaction['from_date'] = Carbon::parse($transaction['from_date'])->format('d/m/Y');
            $transaction['to_date'] = Carbon::parse($transaction['to_date'])->format('d/m/Y');
          }
          return view("/frontend/transaction/index")
            ->with('transactions', $transactions)
            ->with('user', $user)
            ->with('succesaalert', $succesaalert);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function filter(Request $request)
    {
      $user = Auth::user();
      $succesaalert = 0;
      $request['from_date'] = Carbon::parse($request['from_date'])->format('d/m/Y');
      $request['to_date'] = Carbon::parse($request['to_date'])->format('d/m/Y');
      if ($request['client_type'] == 'AN') {
        if ($request['serach'] != null) {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('contractor_id',$user['id'])
                                        ->orWhere('customer_id',$user['id'])
                                        ->where('name',$request['serach'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }
        else {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('contractor_id',$user['id'])
                                        ->orWhere('customer_id',$user['id'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->orWhere('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }

        return view("/frontend/transaction/index")
          ->with('transactions', $transactions)
          ->with('user', $user)
          ->with('succesaalert', $succesaalert);
      }
      elseif ($request['client_type'] == 'CU') {
        if ($request['serach'] != null) {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('customer_id',$user['id'])
                                        ->where('name',$request['serach'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }
        else {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('customer_id',$user['id'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('customer_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }

        return view("/frontend/transaction/index")
          ->with('transactions', $transactions)
          ->with('user', $user)
          ->with('succesaalert', $succesaalert);
      }
      elseif ($request['client_type'] == 'CO') {
        if ($request['serach'] != null) {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('contractor_id',$user['id'])
                                        ->where('name',$request['serach'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->where('name',$request['serach'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }
        else {
          if ($request['from_date'] == null && $request['to_date'] == null) {
            $transactions =Transaction::where('contractor_id',$user['id'])
                                        ->get();
          }
          else {
            if ($request['from_date'] == null && $request['to_date'] != null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->get();
            }
            elseif ($request['from_date'] != null && $request['to_date'] == null) {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
            else {
              $transactions =Transaction::where('contractor_id',$user['id'])
                                          ->whereDate('from_date' ,'<=', $request['to_date'])
                                          ->whereDate('from_date' ,'>=', $request['from_date'])
                                          ->get();
            }
          }
        }

        return view("/frontend/transaction/index")
          ->with('transactions', $transactions)
          ->with('user', $user)
          ->with('succesaalert', $succesaalert);
      }
    }

    public function create()
    {
      try {
        $currencies = Currency::all();
        $viewPath = '/frontend/transaction/create';
        if (Auth::user()->canAddTransaction() == false) {
            $viewPath = '/frontend/transaction/complete-data';
        }
        return View($viewPath)
          ->with('currencies', $currencies);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "create", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function store(Request $request)
    {
      $request->validate([
          'personal-code2' => ['required'],
          'name' => ['required','max:100'],
          'transaction_type' => ['required','max:100'],
          'from_date' => ['required','max:100','date'],
          'to_date' => ['required','max:100','date'],
          'commission_payer' => ['required'],
          'bank_name' => ['required','max:100'],
          'currency_name' => ['required'],
          'amount' => ['required','numeric'],
          'description' => ['required','max:200']
      ]);
        try {
          $user =  User::where('personal_code',$request['personal-code2'])->first();
          if ($user == null) {
            return redirect()->route('transaction.create');
          }
          $usercontractor = Auth::user();
          $currency =  Currency::where('symbol',$request['currency_name'])->first();
          $carbon = Carbon::now();
          $mytime = $carbon->format('Y-m-d H:i:s');
          $data = array(
            'customer_id' => $user['id'],
            'contractor_id' => $usercontractor['id'],
            'bank_name' => $request['bank_name'],
            'currency_id' => $currency['id'],
            'name' => $request['name'],
            'transaction_code' => Str::random(60),
            'commission_payer' => $request['commission_payer'],
            'from_date' => $request['from_date'],
            'to_date' => $request['to_date'],
            'amount' => $request['amount'],
            'date_of_order' => $mytime,
            'payment' => 0.00,
            'status' => 'Ready',
            'token' => Str::random(60),
            'transaction_type' => $request['transaction_type'],
            'description' => $request['description']
          );
          Transaction::create($data);
          $transactionforwallet = Transaction::where('transaction_code',$data['transaction_code'])->first();
          $platfromwallet = array(
            'transaction_id' => $transactionforwallet['id'],
            'currency_id' => $transactionforwallet['currency_id'],
            'amount' => 0.00,
          );
          WalletTransactions::create($platfromwallet);

          return redirect()->route('transaction')->with('successalert','successalert');
        }
        catch (\Exception $ex) {
            saveException(sqlDateTime(), "Transaction", "store", $ex->getMessage(), $request->ip());
            return redirect()->route('siteerror');
        }
    }

    public function getContractor(Request $request)
    {
      try {
        $personalCode = $request->post('personal_code');
        $client = User::where('personal_code', $personalCode)->first();
        if ($client['client_type_id'] == 1) {
          $data =ClientData::where('user_id',$client['id'])->get();
          return view('/frontend/transaction/_client-data')
          ->with('data', $data)
          ->with('client', $client);
        }
        else {
          $data =CompanyData::where('user_id',$client['id'])->first();
          return view('/frontend/transaction/_company-data')
          ->with('data', $data)
          ->with('client', $client);
        }
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function edit($id)
    {
      try {
        $transaction = Transaction::find($id);
        $currencies = Currency::all();
        $banks = ClientBankAccount::all();
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
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function complete($id, Request $request)
    {
      $transaction = Transaction::where('id',$id)->first();
      $user = Auth::user();

      if ($user['id'] == $transaction['customer_id'] ) {
        $data = array(
          'customer_id' => $transaction['customer_id'],
          'contractor_id' => $transaction['contractor_id'],
          'customer_accept' => 1,
          'contractor_accept' => 0,
          'bank_name' => $transaction['bank_name'],
          'currency_id' => $transaction['currency_id'],
          'name' => $transaction['name'],
          'commission_payer' => $transaction['commission_payer'],
          'from_date' => $transaction['from_date'],
          'to_date' => $transaction['to_date'],
          'amount' => $transaction['amount'],
          'payment' => $transaction['payment'],
          'transaction_type' => $transaction['transaction_type'],
          'description' => $transaction['description'],
          'status' => 'Completed',
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
          'bank_name' => $transaction['bank_name'],
          'currency_id' => $transaction['currency_id'],
          'name' => $transaction['name'],
          'commission_payer' => $transaction['commission_payer'],
          'from_date' => $transaction['from_date'],
          'to_date' => $transaction['to_date'],
          'amount' => $transaction['amount'],
          'payment' => $transaction['payment'],
          'transaction_type' => $transaction['transaction_type'],
          'description' => $transaction['description'],
          'status' => 'Completed',
          'transaction_code' => $transaction['transaction_code'],
          'date_of_order' => $transaction['date_of_order'],
          'token' => $transaction['token']
        );
      }
      TransactionToAccept::create($data);

      return redirect()->route('transaction')->with('successalert','successalert');
      try {

      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function update($id, Request $request)
    {

      $request->validate([
          'name' => ['required','max:100'],
          'transaction_type' => ['required'],
          'from_date' => ['required','max:100','date'],
          'to_date' => ['required','max:100','date'],
          'commission_payer' => ['required'],
          'bank_name' => ['required','max:100'],
          'currency_name' => ['required'],
          'payment' => ['required'],
          'amount' => ['required','numeric'],
          'description' => ['required','max:200']
      ]);

        try {
            $transaction = Transaction::find($id);

            $currency =  Currency::where('symbol',$request['currency_name'])->first();
            $user = Auth::user();
            if ($user['id'] == $transaction['customer_id'] ) {
              $data = array(
                'customer_id' => $transaction['customer_id'],
                'contractor_id' => $transaction['contractor_id'],
                'customer_accept' => 1,
                'contractor_accept' => 0,
                'bank_name' => $request['bank_name'],
                'currency_id' => $currency['id'],
                'name' => $request['name'],
                'commission_payer' => $request['commission_payer'],
                'from_date' => $request['from_date'],
                'to_date' => $request['to_date'],
                'amount' => $request['amount'],
                'payment' => $request['payment'],
                'transaction_type' => $request['transaction_type'],
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
                'bank_name' => $request['bank_name'],
                'currency_id' => $currency['id'],
                'name' => $request['name'],
                'commission_payer' => $request['commission_payer'],
                'from_date' => $request['from_date'],
                'to_date' => $request['to_date'],
                'amount' => $request['amount'],
                'payment' => $request['payment'],
                'transaction_type' => $request['transaction_type'],
                'description' => $request['description'],
                'status' => 'ApprovalRequired',
                'transaction_code' => $transaction['transaction_code'],
                'date_of_order' => $transaction['date_of_order'],
                'token' => $transaction['token']
              );
            }

            TransactionToAccept::create($data);
            return redirect()->route('transaction')->with('successalert','successalert');
        }
    catch (\Exception $exception) {
            saveException(sqlDateTime(), 'Transaction', 'update', $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('siteerror');
        }
    }

    public function transactionsToAccept()
    {
      try {
        $currentuser = Auth::user();
        $transactions =TransactionToAccept::where('contractor_id',$currentuser['id'])->orWhere('customer_id',$currentuser['id'])->get();
        foreach ($transactions as $transaction) {
          $transaction['from_date'] = Carbon::parse($transaction['from_date'])->format('d/m/Y');
          $transaction['to_date'] = Carbon::parse($transaction['to_date'])->format('d/m/Y');
        }
        return view("/frontend/transaction/transactionsToAccept")
          ->with('transactions', $transactions)
          ->with('currentuser', $currentuser);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "transactionsToAccept", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
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
              'status' => $changes['status'],
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
              'status' => $changes['status'],
              'token' => $changes['token'],
              'transaction_type' => $changes['transaction_type'],
              'description' => $changes['description']
            );
          }
          $transactionwallet = WalletTransactions::where('transaction_id',$transaction['id'])->first();
          $contractorwallet = Wallet::where('user_id',$transaction['contractor_id'])
                                    ->where('currency_id',$transaction['currency_id'])->first();
          if ($contractorwallet==null) {
            $changes->delete();
            return redirect()->route('transaction.transactionsToAccept')->with('nomoneyerror2','nomoneyerror2');
          }

          $payment = $changes['payment'] - $transaction['payment'];

          $update = $contractorwallet['amount'] - $payment;
          if ($update > 0) {
            $wallethistorydata = array(
              'user_id' => $contractorwallet['user_id'],
              'bank_name' => $changes['bank_name'],
              'currency_id' => $contractorwallet['currency_id'],
              'amount' => -$payment
            );
            if ($wallethistorydata['amount'] != 0) {
              WalletHistory::create($wallethistorydata);
            }
            $contractorwallet->update(['amount' => $update ]);
          }
          else {
            $currentuser = Auth::user();
            $transactions =TransactionToAccept::where('contractor_id',$currentuser['id'])->orWhere('customer_id',$currentuser['id'])->get();
            $changes->delete();
            return redirect()->route('transaction.transactionsToAccept')->with('nomoneyerror1','nomoneyerror1');
          }
          $transactionwallet = WalletTransactions::where('transaction_id',$transaction['id'])->first();
          $payment = $changes['payment'] - $transactionwallet['payment'];
          $transactionwallet->update(['amount' => $payment ]);

          $transaction->update($data);
          $changes->delete();
        }

        $transaction =  Transaction::where('transaction_code',$changes['transaction_code'])->first();
        if ($transaction['status'] == 'Completed') {
          $customerwallet = Wallet::where('user_id',$transaction['customer_id'])
                                    ->where('currency_id',$transaction['currency_id'])->first();
          if ($customerwallet==null) {
              $walletdata = array(
                'user_id' => $transaction['customer_id'],
                'currency_id' => $transaction['currency_id'],
              );
              Wallet::create($walletdata);
            }
        $customerwallet = Wallet::where('user_id',$transaction['customer_id'])
                                  ->where('currency_id',$transaction['currency_id'])->first();
        $updatecustomer = $customerwallet['amount'] + $transactionwallet['amount'];
        $customerwallet->update(['amount' => $updatecustomer ]);
        $wallethistorydata = array(
          'user_id' => $customerwallet['user_id'],
          'bank_name' => $changes['bank_name'],
          'currency_id' => $customerwallet['currency_id'],
          'amount' => $transactionwallet['amount']
        );
        WalletHistory::create($wallethistorydata);
        $transactionwallet->delete();

      }


        return redirect()->route('transaction')->with('successalert','successalert');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "confirm", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');

              }

    }

    public function preview($id)
    {
      try {
        $transaction =  TransactionToAccept::where('id',$id)->first();
        return view("/frontend/transaction/preview")
        ->with('transaction', $transaction);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Transaction", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
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

    public function generatePdf2($id)
    {
    try {
      $transaction =Transaction::where('id',$id)->first();
      $usercontractor = User::where('id',$transaction['contractor_id'])->first();
      $usercontractordata = CompanyData::where('user_id',$usercontractor['id'])->first();
      $usercustomer = User::where('id',$transaction['customer_id'])->first();
      $usercustomerdata = ClientData::where('user_id',$usercustomer['id'])->first();
      $carbon = Carbon::now();
      $mytime = $carbon->format('Y-m-d H:i:s');
      $currency = Currency::where('id',$transaction['currency_id'])->first();
      $platformdata = PlatformData::where('id',1)->first();

      $mpdf = new Mpdf();
      $css = file_get_contents(resource_path(). "\\views\\pdf\\TransactionPDF.blade.php");
      $mpdf->WriteHTML($css, 1);
      $billHtml = View::make('pdf/TransactionPDF')
          ->with('transaction', $transaction)
          ->with('usercontractor', $usercontractor)
          ->with('usercontractordata', $usercontractordata)
          ->with('usercustomer', $usercustomer)
          ->with('usercustomerdata', $usercustomerdata)
          ->with('mytime', $mytime)
          ->with('currency', $currency)
          ->with('platformdata', $platformdata);

      $mpdf->WriteHTML($billHtml, 2);
      $path = storage_path('\TransactionPDF.pdf');
      $mpdf->Output($path, 'F');

      $pdfPath = storage_path('\TransactionPDF.pdf');
      return response()->download($pdfPath);
    }
    catch (\Exception $e)
     {
      saveException(sqlDateTime(), "Transaction", "generatePdf2", $ex->getMessage(), $request->ip(), Auth::id());
      return redirect()->route('siteerror');
    }

    }

}
