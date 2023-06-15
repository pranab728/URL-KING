<form id="deposit-form" data-val="1" class="pay-form" action="" method="POST">

  @include('alerts.form-success')
  @include('alerts.form-error')

  @csrf

<div class="modal-body">

    <div class="mb-3">
            <label class="form-label">
              {{ __('Deposit Amount') }}
            </label>
        <input type="number" class="option form-control form--control" min="1" id="amount"  name="amount" placeholder="{{ $curr->name }}" step="0.01" required="" value="{{ old('amount') }}">
      </div>

      @includeIf('load.payment-user')
    <div id="payments" class="d-none">
     <input type="hidden" name="sub" id="sub" value="0">
</div>
</div>
<div class="modal-footer">
<a href="javascript:;" class="btn btn--danger" data-bs-dismiss="modal">{{ __("Cancel") }}</a>
<button type="submit" id="final-btn" class="mybtn1 btn btn--success btn-ok">{{ __('Submit') }}</button>

</div>

</form>