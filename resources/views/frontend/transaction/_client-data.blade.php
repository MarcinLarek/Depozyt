<div class="card border-0">
    <div class="card-body">
        <img id="more" class="float-right" src="~/Images/more.svg" />
        <h4 class="card-title">{{ __('transaction.CRE-data-customer') }}</h4>
        <div id="moreBox">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-name') }}:</label>
                </div>
                <div class="col-md-6">
                    <p name="cielntsurname" >{{ $client->clientData->surname }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-surname') }}:</label>
                </div>
                <div class="col-md-6">
                    {{ $client->clientData->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-pesel') }}:</label>
                </div>
                <div class="col-md-6">
                    {{ $client->clientData->pesel }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-postcode') }}:</label>
                </div>
                <div class="col-md-6">
                    {{ $client->clientData->post_code }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-street') }}:</label>
                </div>
                <div class="col-md-6">
                    {{ $client->clientData->street }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label font-weight-bold">{{ __('transaction.CRE-city') }}:</label>
                </div>
                <div class="col-md-6">
                    {{ $client->clientData->city }}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(() => {
        $("#more").click(function () {
            $("#moreBox").slideToggle("slow");
        });
    });
</script>
