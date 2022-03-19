<div class="card border-0">
  <div class="card-body">
    <h4 class="card-title">{{ __('transaction.CRE-data-customer') }}</h4>
    <div id="moreBox">
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('company.COM-name') }}:</label>
        </div>
        <div class="col-md-6">
          <p name="cielntsurname">{{ $data['name'] }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('company.COM-nip') }}:</label>
        </div>
        <div class="col-md-6">
          {{ $data['nip'] }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('company.COM-regon') }}:</label>
        </div>
        <div class="col-md-6">
          {{ $data['regon'] }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('transaction.CRE-postcode') }}:</label>
        </div>
        <div class="col-md-6">
          {{ $data['post_code'] }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('transaction.CRE-street') }}:</label>
        </div>
        <div class="col-md-6">
          {{ $data['street'] }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="control-label font-weight-bold">{{ __('transaction.CRE-city') }}:</label>
        </div>
        <div class="col-md-6">
          {{ $data['city'] }}
        </div>
      </div>
    </div>
  </div>
</div>
