<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        $columns = array('id', 'user_id', 'bank_name', 'currency_id', 'amount', 'generated_document_id', 'created_at', 'updated_at');

        $callback = function() use($wallethistories, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($wallethistories as $task) {
                $row['id']  = $task['id'];
                $row['user_id']    = $task['user_id'];
                $row['bank_name']    = $task['bank_name'];
                $row['currency_id']  = $task['currency_id'];
                $row['amount']  = $task['amount'];
                $row['generated_document_id']  = $task['generated_document_id'];
                $row['created_at']  = $task['created_at'];
                $row['updated_at']  = $task['updated_at'];
                fputcsv($file, array($row['id'], $row['user_id'], $row['bank_name'], $row['currency_id'], $row['amount'], $row['generated_document_id'], $row['created_at'], $row['updated_at']));
            }

            fclose($file);
        };
        foreach ($wallethistories as $task) {
          $wallet = Wallet::where('currency_id',$task['currency_id'])
                          ->where('user_id',$task['user_id'])
                          ->first();
          $walletupdate['amount'] = 0;
          $wallet->update($walletupdate);
        }

        return response()->stream($callback, 200, $headers);
        return view('/frontend/admin/admin/index');
      try {

      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "csvexport", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }

    }

    function csvToArray($filename = '', $delimiter = ',')
    {
      try {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false)
            {
              while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
              {
                if (!$header)
                    $header = $row;
                    else
                    $data[] = array_combine($header, $row);
                  }
                  fclose($handle);
                }

                return $data;
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "csvToArray", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
      }

    public function csvimport(Request $request)
    {
      $file = $request['import'];
      $customerArr = $this->csvToArray($file);
      for ($i = 0; $i < count($customerArr); $i ++)
      {
        $wallet = Wallet::where('currency_id',$customerArr[$i]['currency_id'])
                        ->where('user_id',$customerArr[$i]['user_id'])
                        ->first();
        if ($wallet ==null) {
          $walletdata = array(
            'user_id' => $customerArr[$i]['user_id'],
            'currency_id' => $customerArr[$i]['currency_id'],
          );
          Wallet::create($walletdata);
        }
        $wallet = Wallet::where('currency_id',$customerArr[$i]['currency_id'])
                        ->where('user_id',$customerArr[$i]['user_id'])
                        ->first();
        $walletupdate['amount'] = $wallet['amount'] + $customerArr[$i]['amount'];
        $wallet->update($walletupdate);
        WalletHistory::firstOrCreate($customerArr[$i]);
      }

      return view('/frontend/admin/admin/index');
      try {

      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

}
