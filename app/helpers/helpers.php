<?php

function generatePersonalCode($clientId)
{
    return date('md') . $clientId;
}

/**
 * @param $date string date
 * @param $controller string controller name
 * @param $method string method
 * @param $message string exception messae
 * @param $ip string ip
 * @param null|int $userId user id
 */
function saveException($date, $controller, $method, $message, $ip, $userId = null) {
    \App\Models\PlatformException::create([
        'date' => $date,
        'controller' => $controller,
        'method' => $method,
        'message' => $message,
        'client_ip' => $ip,
        'user_id' => $userId
    ]);
}

function sqlDateTime() {
    return date('Y-m-d h:i:s');
}


//public function ValidateBankAccount(ClientBankAccount clientBankAccount)
//{
//    string bankAccount = $"{clientBankAccount.Country} {clientBankAccount.Number}";
//            bankAccount = bankAccount.ToUpper(); //IN ORDER TO COPE WITH THE REGEX BELOW
//            if (String.IsNullOrEmpty(bankAccount))
//                return Json(false);
//            else if (System.Text.RegularExpressions.Regex.IsMatch(bankAccount, "^[A-Z0-9]"))
//            {
//                bankAccount = bankAccount.Replace(" ", String.Empty);
//                string bank = bankAccount.Substring(4, bankAccount.Length - 4) + bankAccount.Substring(0, 4);
//                int asciiShift = 55;
//                StringBuilder sb = new StringBuilder();
//                foreach (char c in bank)
//                {
//                    int v;
//                    if (Char.IsLetter(c)) v = c - asciiShift;
//                    else v = int.Parse(c.ToString());
//                    sb.Append(v);
//                }
//                string checkSumString = sb.ToString();
//                int checksum = int.Parse(checkSumString.Substring(0, 1));
//                for (int i = 1; i < checkSumString.Length; i++)
//                {
//                    int v = int.Parse(checkSumString.Substring(i, 1));
//                    checksum *= 10;
//                    checksum += v;
//                    checksum %= 97;
//                }
//                return Json(checksum == 1);
//            }
//            else
//                return Json(false);
//        }
