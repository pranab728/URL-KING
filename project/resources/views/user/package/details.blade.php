@extends('layouts.front')

@push('css')

@endpush

@section('content')

<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Pricing Plan')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Pricing Plan')
          </li>
        </ul>
      </div>
    </div>
  </section>

  <div class="pt-100 mb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body rounded">
                        <div class="p-md-4">
                            <h5 class="mb-2">@lang('Payment Method')</h5>
                            <ul class="nav nav-tabs nav--tabs">
                                <li>
                                    <a href="#credit" class="active" data-bs-toggle="tab">@lang('Payment Gateway')</a>
                                </li>
                                <li>
                                    <a href="#bank" data-bs-toggle="tab">@lang('Wallet')</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="credit">

                                    <div class="payment">
                                        <span class="notic"><b>{{ __('Note:') }}</b>
                                            {{ __('Your Previous Plan will be deactivated!') }}</span>
                                    </div>

                                    <form id="subscribe-form" class="pay-form" action="{{ $subs->id == 0 ? route('user-subscription-request-submit') : '' }}" method="POST">

                                        @include('alerts.form-success')
                                        @include('alerts.form-error')


                                        @csrf

                                        <input type="hidden" name="subs_id" value="{{ $subs->id }}">

                                        @if($subs->id != 0)

                                    <select name="method" id="method" class="option form-control border mb-3" required="">
                                        <option value="" data-form="" data-show="no" data-val="" data-href="">{{ __('Select an option') }}</option>
                                        @foreach($gateway as $paydata)

                                        <option value="{{ $paydata->name }}" data-form="{{ $paydata->showSubscriptionLink() }}" data-show="{{ $paydata->showForm() }}" data-href="{{ route('user.load.payment',['slug1' => $paydata->showKeyword(),'slug2' => $paydata->id]) }}" data-val="{{ $paydata->keyword }}">
                                            {{ $paydata->name }}
                                        </option>


                                         @endforeach
                                         <option value="" data-form="" data-show="no" data-val="" data-href="">{{ __('Select an option') }}</option>
                                    </select>

                                    <div id="payments" class="d-none">

                                    </div>
                                    @endif
                                        <input type="hidden" id="ck" value="0">
                                    <input type="hidden" name="sub" id="sub" value="0">
                                    <input type="hidden" name="txnid" id="txnid" value="">
                                    <button type="submit" id="final-btn" class="mybtn1 cmn--btn mt-4">{{ __('Submit') }}</button>

                                    </form>
                                </div>
                                <div class="tab-pane fade show" id="bank">

                                    <div class="payment">
                                        <span class="notic"><b>{{ __('Wallet balance:') }} </b><span class="text--primary">
                                            {{ $curr->sign }}{{ convert(Auth::user()->amount) }}</span></span>
                                            <br>
                                </div>
                                <form id="subscribe-form" class="pay-form" action="{{ route('user.wallet.submit') }}" method="POST">
                                    @csrf
                                <div class="d-flex align-items-center mt-4">
                                   
                                    <input type="hidden" name="subs_id" value="{{ $subs->id }}">
                                    <span class="notice"> <b>@lang('Plan Price')</b></span>
                                    <div class="input-group flex-grow-1 ms-2 w-50">
                                        <span class="input-group-text">{{ $curr->sign }}</span>
                                        <input value="{{ convert($subs->price) }}" type="text" disabled class="form-control" aria-label="Amount (to the nearest dollar)">
                                        <input type="hidden" value="{{ convert($subs->price) }}" name="amount">
                                        <button type="submit" id="final-btn" class="mybtn1 cmn--btn input-group-text">{{ __('Submit') }}</button>
                                    </div>
                                   


                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body rounded bg--base text-white">
                        <div class="p-4 pb-0">
                            <h5 class="text-white">@lang('Summary')</h5>
                            <ul class="list--group">
                                <li>
                                    <div>{{ $subs->title }}</div>
                                    <div>{{ $curr->sign }}{{ convert($subs->price) }}</div>
                                </li>
                                <li>
                                    <div>
                                        @lang('Days')
                                    </div>
                                    <div>{{ $subs->days }}</div>
                                </li>
                                <li>
                                    <div>
                                        @lang('Allowed URL')
                                    </div>
                                    <div>{{ $subs->allowed_url }}</div>
                                </li>
                                <li>
                                    <div>
                                        @lang('Total Click')
                                    </div>
                                    <div>{{ $subs->click_limit }}</div>
                                </li>
                               

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('js')

<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">

(function($) {
		"use strict";

$('#method').on('change',function(){
    var val  = $(this).find(':selected').attr('data-val');
    var form = $(this).find(':selected').attr('data-form');
    var show = $(this).find(':selected').attr('data-show');
    var href = $(this).find(':selected').attr('data-href');

    if(show == "yes"){
        $('#payments').removeClass('d-none');
    }else{
        $('#payments').addClass('d-none');
    }

    if(val == 'paystack'){
			$('.pay-form').prop('id','paystack');
		}
		else if(val == 'voguepay'){
			$('.pay-form').prop('id','voguepay');
		}
		else if(val == 'mercadopago'){
			$('.pay-form').prop('id','mercadopago');
		}
		else if(val == '2checkout'){
			$('.pay-form').prop('id','twocheckout');
		}
		else {
			$('.pay-form').prop('id','subscribe-form');
		}


    $('#payments').load(href);
    $('.pay-form').attr('action',form);
});


    $(document).on('submit','#paystack',function(){
            var val = $('#sub').val();
            if(val == 0)
            {

                setTimeout(function(){
                    if($('#ck').val() == '0') {

                        var total = {{ $subs->price }}*{{ $curr->value }};
                        total = Math.round(total);

                        var handler = PaystackPop.setup({
                        key: '{{ $paystack["key"] }}',
                        email: '{{ Auth::user()->email }}',
                        amount: total * 100,
                        currency: "{{ $curr->name }}",
                        ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                        callback: function(response){

                            $('#txnid').val(response.reference);

                            $('#sub').val('1');
                            $('#final-btn').click();
                        },
                        onClose: function(){
                            window.location.reload();
                        }
                        });
                        handler.openIframe();
                        return false;
                    }

                }, 1000);
            return false;
            }
            else {
                return true;
            }
		});

})(jQuery);

</script>


@endpush
