@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Deposit')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Deposit')
        </li>
    </ul>
</div>
</div>

<div class="dashborad--content">
    <div class="dashboard--content-item">
        <div class="dashboard--wrapper">
            @foreach ($paymentgateways as $paydata)

            <div class="dashboard--width">
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="dashboard-card__header__cont">
                            <h4 class="name">{{ $paydata->name }}</h4>
                            
                        </div>
                    </div>
                    <div class="dashboard-card__content">
                        <div class="deposit-btn-grp">
                          <a   href="javascript:;" data-bs-toggle="modal" data-bs-target="#paymodal" class="deposit btn btn-sm btn--primary"  data-href=" {{ route('user.withdraw.popup',$paydata->id) }} " data-form="{{ $paydata->showDepositLink() }}" data-val="{{ $paydata->keyword }}">@lang("Deposit")</a>
                        </div>
                    </div>
                    
                </div>
            </div>
                
            @endforeach
           
            
        </div>
    </div>
   
    <div class="footer-copyright text-center mt-auto">
       {!! $gs->copyright !!}
    </div>
</div>

{{-- STATUS MODAL --}}

<div class="modal fade" id="paymodal" tabindex="-1" role="dialog"
 aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-center">{{ __("Deposit Payment") }}</h5>
            <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modalLoad">

            </div>
        </div>
    </div>
</div>

{{-- STATUS MODAL ENDS --}}



</article>
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
        // var depo=$('.deposit-btn-grp').find('a').attr('id');
        // alert(depo);

        $(document).on('click','.deposit',function(){
         
            var mhref= $(this).attr('data-href');
            var val  = $(this).attr('data-val');
            var form = $(this).attr('data-form');
            

            
            $.get(mhref,function(res){
                $('.modalLoad').html(res);
            

            if(val == 'paystack'){

                $('.modalLoad').find('form').attr('id','paystack');
                $('#amount').prop('name','amount');
                
            }
            else if(val == 'voguepay'){
                $('.modalLoad').find('form').attr('id','voguepay');
                   
                $('#amount').prop('name','amount');
                }
            else if(val == 'mercadopago'){
            $('.modalLoad').find('form').attr('id','mercadopago');
            $('#amount').prop('name','deposit_amount');
            }
            else if(val == '2checkout'){
            $('.modalLoad').find('form').attr('id','twocheckout');
            $('#amount').prop('name','amount');
            }
            else {
            $('.modalLoad').find('form').attr('id','deposit-form');
            $('#amount').prop('name','amount');
                }

                $('.modalLoad').find('form').attr('action',form);

            })
        
        });




$(document).on('submit','#paystack',function(){
            var val = $('#sub').val();
            if(val == 0){
                var total = $('#amount').val();
                total = Math.round(total);
                var handler = PaystackPop.setup({
                key: '{{ $paystack["key"] }}',
                email: '{{ Auth::user()->email }}',
                amount: total * 100,
                currency: "{{ $curr->name }}",
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                    callback: function(response){
                        $('#ref_id').val(response.reference);
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
            else {
                return true;
            }
		});




       

})(jQuery);

</script>


@endpush
