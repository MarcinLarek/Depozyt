<?php

use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    // lista banków dodanych przez użytkownika
    public function GetBank()
    {
    }

    /**
     * pobrane z portfela walut
     * @param $bankName
     * @return mixed
     */
    public function getCurrency($bankName)
    {
    }

    public function GetAvailableAmount($currencyId)
    {
    }
}
