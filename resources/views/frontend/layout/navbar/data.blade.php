<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-white px-0 mx-0">
    <div class="w-100" style="background-color:red; color:white">
        <?php
        use App\Http\Requests\ClientDataRequest;
        use App\Http\Requests\RepresentativeRequest;
        use App\Models\ClientData;
        use App\Models\Representative;
        use App\Services\UsersService;
        use Illuminate\Support\Facades\Auth;
        use function GuzzleHttp\Promise\all;
        $clientData = Auth::user()->clientData;
        if (empty($clientData)) {
            $clientData = ClientData::make();
        }

         ?>
         <?php
         use App\Http\Requests\ClientBankAccounts\StoreRequest;
         use App\Models\ClientBankAccount;
         use App\Services\ClientBankAccountsService;
         use App\Services\CurrenciesService;
         use Illuminate\Auth\Access\AuthorizationException;
         use Illuminate\Http\Request;
         $bankAccounts = Auth::user()->bankAccounts;
         $temp = count($bankAccounts);
          ?>
          <?php
          use App\Http\Requests\CompanyDataRequest;
          use App\Models\CompanyData;
          $companyData = Auth::user()->companyData()->first();
          if (empty($companyData)) {
              $companyData = CompanyData::make();
          }
           ?>
         @if (Auth::user()->isCompany())

         @elseif ($clientData->surname == null)
           Nie uzupełniono danych o swoim koncie. Aby to zrobić wejdź w <b>Ustawienia Konta -> Moje Dane</b> <br>
         @endif

         @if($temp < 1)
         Nie dodano jeszcze żadnego konta bankowego. Aby to zrobić wejdź w <b>Środki -> Konta Bankowe</b><br>
         @endif

         @if ($companyData->name == null && Auth::user()->isCompany())
           Nie uzupełniono danych o firmie.</b> <br>
         @endif
    </div>
</nav>
