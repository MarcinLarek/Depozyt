<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-white px-0 mx-0">
  <div class="w-100" style="background-color:red; color:white">
    <?php
        use App\Http\Requests\ClientDataRequest;
        use App\Http\Requests\RepresentativeRequest;
        use App\Models\ClientData;
        use App\Models\Representative;
        use App\Services\UsersService;
        use Illuminate\Support\Facades\Auth;
        use App\Http\Requests\ClientBankAccounts\StoreRequest;

        $clientData = Auth::user()->clientData;
        if (empty($clientData)) {
            $clientData = ClientData::make();
        }

         ?>
    <?php
         use App\Models\ClientBankAccount;
         use App\Services\ClientBankAccountsService;
         use App\Services\CurrenciesService;
         use Illuminate\Auth\Access\AuthorizationException;
         use Illuminate\Http\Request;
         use App\Http\Requests\CompanyDataRequest;

         $bankAccounts = Auth::user()->bankAccounts;
         $temp = count($bankAccounts);
          ?>
    <?php
          use App\Models\CompanyData;
          use function GuzzleHttp\Promise\all;

          $companyData = Auth::user()->companyData()->first();
          if (empty($companyData)) {
              $companyData = CompanyData::make();
          }
           ?>
    @if (Auth::user()->isCompany())

    @elseif ($clientData->surname == null)
    {{ __('navbar.no_account_data_1') }}<b>{{ __('navbar.no_account_data_2') }}</b> <br>
    @endif

    @if($temp < 1) {{ __('navbar.no_bankaccounts_1') }} <b>{{ __('navbar.no_bankaccounts_2') }}</b><br>
      @endif

      @if ($companyData->name == null && Auth::user()->isCompany())
      {{ __('navbar.no_company_data') }}</b> <br>
      @endif
  </div>
</nav>
