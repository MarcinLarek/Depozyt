<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = "client";

    protected $fillable = [
        'username',
        'email',
        'password',
        'personal_code',
        'country_id',
        'client_type_id',
        'token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function displayPersonalCode()
    {
        return Crypt::decryptString($this->getAttribute('personal_code'));
    }

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function representative()
    {
        return $this->hasOne(Representative::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }

    public function clientData()
    {
        return $this->hasOne(ClientData::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(ClientBankAccount::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function walletHistory()
    {
        return $this->hasMany(WalletHistory::class);
    }

    public function canAddTransaction()
    {
        $canAddTransaction = false;
        if (
            $this->bankAccounts()->count() > 0
            && $this->representative()->count() == 1
            && $this->companyData()->count() == 1
        ) {
            $canAddTransaction = true;
        }
        return $canAddTransaction;
    }

    public function getFullName()
    {
        $clientData = $this->representative()->first();
        return $clientData->name . ' ' . $clientData->surname;
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }

    public function getFullAddress()
    {
        $clientData = $this->representative()->first();
        return $clientData->street . ' ' . $clientData->post_code . ' ' . $clientData->city;
    }

    public function registrationDate()
    {
        return $this->getAttribute('created_at');
    }

    public function transactionsAsCustomer()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    public function isCompany()
    {
        $isCompany = true;
        if ($this->clientType->id == 1) {
            $isCompany = false;
        }

        return $isCompany;
    }

    public function companyData()
    {
        return $this->hasOne(CompanyData::class);
    }

    public function getTransactions($filter)
    {
        // todo where to query
        return $this->transactionsAsCustomer();
    }

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function isBlocked(): bool
    {
        return $this->getAttribute('blocked');
    }

    public function isActive(): bool
    {
        return $this->getAttribute('active');
    }

    public function getPassword()
    {
        return $this->getAttribute('password');
    }
}
