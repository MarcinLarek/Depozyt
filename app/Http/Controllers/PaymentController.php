<?php

namespace App\Http\Controllers;

use App\Models\PlatformData;
use App\Models\WalletHistory;
use App\Models\User;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\Recipient;
use App\Models\ClientBankAccount;
use App\Services\PlatformBankAccountsService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;
use App\Models\Currency;


class PaymentController extends Controller
{
    private $platformBankAccountsService;

    public function __construct(PlatformBankAccountsService $platformBankAccountsService)
    {
        $this->platformBankAccountsService = $platformBankAccountsService;
    }

    public function index()
    {
      try {
        $this->platformBankAccountsService->getActive();
        $data = PlatformData::where('id',1)->first();
        $currencies = Currency::all();
        return view("/frontend/payment/index")
        ->with('currencies', $currencies)
        ->with('data', $data);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Payment", "index", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }

    }

    public function paymentpost(Request $request)
    {
      $request->validate([
          'recipment_id' => ['required'],
          'currency_id' => ['required'],
          'payment_title' => ['required','max:100'],
          'amount' => ['required','numeric'],
      ]);

      try {

              $user = Auth::user();
              $recipient =  Recipient::where('id',$request['recipment_id'])->first();
              $wallet = Auth::user()->wallet->where('currency_id',$request['currency_id'])->first();
              if ($wallet ==null) {
                $walletdata = array(
                  'user_id' => $user['id'],
                  'currency_id' => $request['currency_id'],
                );
                Wallet::create($walletdata);
              }
              $wallet = Wallet::where('currency_id',$request['currency_id'])
              ->where('user_id',$user['id'])
              ->first();
              $wallethistory = WalletHistory::where('user_id',$user['id'])->first();
              $clientbank = ClientBankAccount::where('account_number',$recipient['account_number'])->first();
              $data = array(
                'user_id' => $user['id'],
                'recipient_id' => $request['recipment_id'],
                'account_number' => $recipient['account_number'],
                'token' => $request['_token'],
                'amount' => $request['amount'],
                'payment_title' => $request['payment_title']
              );

              if ($clientbank !=null) {

                $wallethistorydata = array(
                  'user_id' => $user['id'],
                  'bank_name' => $clientbank['bank_name'],
                  'currency_id' => $request['currency_id'],
                  'amount' => -$request['amount']
                );
                $walletupdate = $wallet['amount'] - $data['amount'];

                if ($walletupdate >= 0) {
                  Payment::create($data);
                  WalletHistory::create($wallethistorydata);
                  $wallet->update(['amount' => $walletupdate ]);
                  $userrecipient =  User::where('id',$clientbank['user_id'])->first();


                  if ($userrecipient != null) {
                    $walletrecipient = $userrecipient->wallet->where('currency_id',$request['currency_id'])->first();
                    if ($walletrecipient ==null) {
                      $walletrecipientdata = array(
                        'user_id' => $userrecipient['id'],
                        'currency_id' => $request['currency_id'],
                      );
                      Wallet::create($walletrecipientdata);
                    }
                    $walletrecipient = Wallet::where('currency_id',$request['currency_id'])
                    ->where('user_id',$userrecipient['id'])
                    ->first();
                    $wallethistoryrecipient = WalletHistory::where('user_id',$user['id'])->first();

                    $wallethistoryrecipientdata = array(
                      'user_id' => $userrecipient['id'],
                      'bank_name' => $clientbank['bank_name'],
                      'currency_id' => $request['currency_id'],
                      'amount' => $request['amount']
                    );
                    WalletHistory::create($wallethistoryrecipientdata);
                    $walletupdaterecipient = $walletrecipient['amount'] + $data['amount'];
                    $walletrecipient->update(['amount' => $walletupdaterecipient ]);
                  }

                  return redirect()->route('recipients.payment')->with('successalert','successalert');

                }
                else {
                  return redirect()->route('recipients.payment')->with('walleterror','walleterror');
                }
              }
              else {
                $wallethistorydata = array(
                  'user_id' => $user['id'],
                  'bank_name' => $recipient['bank_name'],
                  'currency_id' => $request['currency_id'],
                  'amount' => -$request['amount']
                );
                $walletupdate = $wallet['amount'] - $data['amount'];

                if ($walletupdate >= 0) {
                  Payment::create($data);
                  WalletHistory::create($wallethistorydata);
                  $wallet->update(['amount' => $walletupdate ]);
                return redirect()->route('recipients.payment')->with('successalert','successalert');
              }
              }

      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Payment", "paymentpost", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }
    }

    public function getAmount()
    {
        $wallet = Auth::user()->wallet;
        return view('/frontend/payment/wallet-amount', compact('wallet'));

    }

    public function downloadDocument($walletHistoryId, Request $request)
    {
        try {
            $walletHistory = Auth::user()->walletHistory->find($walletHistoryId);
            $fileName = $walletHistory->getDocumentPath();
            if (empty($fileName)) {
                $fileName = $this->generatePdf($walletHistory);
            }
            return response()->download(Storage::disk('payments')->path($fileName));
        }
        catch (\Exception $exception) {
            saveException(sqlDateTime(), "PaymentController", "downloadDocument()", $exception->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('siteerror');
        }
    }

    private function generatePdf($walletHistory)
    {
      try {
        $mPdf = new Mpdf();
        $mPdf->SetAuthor(config('app.name'));
        $mPdf->SetSubject('Potwierdzenie wpłaty na platforę ' . config('app.name'));
        $headerHtml = View::make('/pdf/header');
        $mPdf->SetHTMLHeader($headerHtml);

        $platformData = PlatformData::all()->first();
        $footerHtml = View::make('/pdf/footer')
            ->with('platformData', $platformData);
        $mPdf->SetHTMLFooter($footerHtml);

        $contentHtml = View::make('/pdf/payment')
            ->with('payment', $walletHistory)
            ->with('platformData', $platformData);
        $mPdf->WriteHTML($contentHtml);
        $clientName = Auth::user()->clientData->getFullName();
        $fileName = 'wplata ' . $clientName . ' ' . date('Y-m-d') . '.pdf';
        $mPdf->Output($fileName, 'F');
        $file = file_get_contents($fileName);
        Storage::disk('payments')->put($fileName, $file);
        unlink($fileName);
        $documentId = $walletHistory->document()->create([
            'file_name' => $fileName,
            'disk' => 'payments',
            'created_at' => sqlDateTime()
        ])->id;
        $walletHistory->update([
            'generated_document_id' => $documentId
        ]);

        return $fileName;
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Payment", "generatePdf", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('siteerror');
              }

    }
}
