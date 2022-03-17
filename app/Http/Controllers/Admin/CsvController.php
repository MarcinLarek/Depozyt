<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CsvController extends Controller
{
    public function csvexport()
    {
        $wallethistories = WalletHistory::all();
        $fileName = 'wallet_histories.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
                        'Kod_zlecenia',
                        'Data_wykonania',
                        'kwota',
                        'Nr_rozliczeniowy_banku_zleceniodawcy',
                        'Pole_zerowe1',
                        'Nr_rachunku_banku_zleceniodawcy',
                        'Nr_rachunku_banku_kontrahenta',
                        'Nazwa_i_adres_zleceniodawcy',
                        'Nazwa_i_adres_kontrahenta',
                        'Pole_zerowe2',
                        'Nr_rozliczeniowy_banku_kontrahenta',
                        'Tytul_zlecenia',
                        'Pole_puste1',
                        'Pole_puste2',
                        'Klasyfikacja_polecenia',
                        'user_id',
                        'bank_name',
                        'currency_id',
                        'amount',
                        'generated_document_id',
                        'created_at',
                        'updated_at');

        $callback = function () use ($wallethistories, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($wallethistories as $task) {
                $row['Kod_zlecenia']  = $task['Kod_zlecenia'];
                $row['Data_wykonania']  = $task['Data_wykonania'];
                $row['kwota']  = $task['kwota'];
                $row['Nr_rozliczeniowy_banku_zleceniodawcy']  = $task['Nr_rozliczeniowy_banku_zleceniodawcy'];
                $row['Pole_zerowe1']  = $task['Pole_zerowe1'];
                $row['Nr_rachunku_banku_zleceniodawcy']  = $task['Nr_rachunku_banku_zleceniodawcy'];
                $row['Nr_rachunku_banku_kontrahenta']  = $task['Nr_rachunku_banku_kontrahenta'];
                $row['Nazwa_i_adres_zleceniodawcy']  = $task['Nazwa_i_adres_zleceniodawcy'];
                $row['Nazwa_i_adres_kontrahenta']  = $task['Nazwa_i_adres_kontrahenta'];
                $row['Pole_zerowe2']  = $task['Pole_zerowe2'];
                $row['Nr_rozliczeniowy_banku_kontrahenta']  = $task['Nr_rozliczeniowy_banku_kontrahenta'];
                $row['Tytul_zlecenia']  = $task['Tytul_zlecenia'];
                $row['Pole_puste1']  = $task['Pole_puste1'];
                $row['Pole_puste2']  = $task['Pole_puste2'];
                $row['Klasyfikacja_polecenia']  = $task['Klasyfikacja_polecenia'];
                $row['user_id']    = $task['user_id'];
                $row['bank_name']    = $task['bank_name'];
                $row['currency_id']  = $task['currency_id'];
                $row['amount']  = $task['amount'];
                $row['generated_document_id']  = $task['generated_document_id'];
                $row['created_at']  = $task['created_at'];
                $row['updated_at']  = $task['updated_at'];
                fputcsv($file, array($row['Kod_zlecenia'],
                                     $row['Data_wykonania'],
                                     $row['kwota'],
                                     $row['Nr_rozliczeniowy_banku_zleceniodawcy'],
                                     $row['Pole_zerowe1'],
                                     $row['Nr_rachunku_banku_zleceniodawcy'],
                                     $row['Nr_rachunku_banku_kontrahenta'],
                                     $row['Nazwa_i_adres_zleceniodawcy'],
                                     $row['Nazwa_i_adres_kontrahenta'],
                                     $row['Pole_zerowe2'],
                                     $row['Nr_rozliczeniowy_banku_kontrahenta'],
                                     $row['Tytul_zlecenia'],
                                     $row['Pole_puste1'],
                                     $row['Pole_puste2'],
                                     $row['Klasyfikacja_polecenia'],
                                     $row['user_id'],
                                     $row['bank_name'],
                                     $row['currency_id'],
                                     $row['amount'],
                                     $row['generated_document_id'],
                                     $row['created_at'],
                                     $row['updated_at']));
            }

            fclose($file);
        };
        foreach ($wallethistories as $task) {
            $wallet = Wallet::where('currency_id', $task['currency_id'])
                          ->where('user_id', $task['user_id'])
                          ->first();
            $walletupdate['amount'] = 0;
            $wallet->update($walletupdate);
        }

        return response()->stream($callback, 200, $headers);
        return view('/frontend/admin/admin/index');
        try {
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Admin", "csvexport", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function csvToArray($filename = '', $delimiter = ',')
    {
        try {
            if (!file_exists($filename) || !is_readable($filename)) {
                return false;
            }

            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false) {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                    if (!$header) {
                        $header = $row;
                    } else {
                        $data[] = array_combine($header, $row);
                    }
                }
                fclose($handle);
            }

            return $data;
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Admin", "csvToArray", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function csvimport(Request $request)
    {
        $file = $request['import'];
        $customerArr = $this->csvToArray($file);
        for ($i = 0; $i < count($customerArr); $i ++) {
            $wallet = Wallet::where('currency_id', $customerArr[$i]['currency_id'])
                        ->where('user_id', $customerArr[$i]['user_id'])
                        ->first();
            if ($wallet ==null) {
                $walletdata = array(
            'user_id' => $customerArr[$i]['user_id'],
            'currency_id' => $customerArr[$i]['currency_id'],
          );
                Wallet::create($walletdata);
            }
            $wallet = Wallet::where('currency_id', $customerArr[$i]['currency_id'])
                        ->where('user_id', $customerArr[$i]['user_id'])
                        ->first();
            $walletupdate['amount'] = $wallet['amount'] + $customerArr[$i]['amount'];
            $wallet->update($walletupdate);
            WalletHistory::firstOrCreate($customerArr[$i]);
        }

        $wallethistories = WalletHistory::all();
        foreach ($wallethistories as $history) {
          if ($history['amount'] == 0 && $history['kwota'] != 0) {
            $history['amount'] = $history['kwota'] / 100;
          }
          if ($history['currency_id'] == 0) {
            $history['currency_id'] = substr($history['Tytul_zlecenia'], -1);
          }
          if ($history['bank_name'] == 0) {
            $history['bank_name'] = $history['Nr_rachunku_banku_kontrahenta'];
          }
          if ($history['user_id'] == 0) {
            $user = User::where('personal_code',substr($history['Tytul_zlecenia'], -190, 188))->first();
            $history['user_id'] = $user['id'];
          }
          $history->update();
        }

        return redirect()->route('admin')->with('successalert', 'successalert');
        try {
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Admin", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
