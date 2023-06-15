@extends('layouts.user')

@push('css')

@endpush
@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>
@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Withdraw')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('withdraw')
        </li>
    </ul>
</div>
</div>

<div class="dashborad--content">
    <div class="dashboard--content-item">
        <div class="row gy-5">
            <div class="col-lg-5 col-xxl-4">
                <div class="sticky-deposit">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header">
                            <div class="dashboard-card__header__icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="dashboard-card__header__cont">
                                <h6 class="name">@lang('Current Balance')</h6>
                                <div class="balance">{{ number_format(convert($user->amount),2) }} {{ $curr->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="dashboard-card__header">
                            <div class="dashboard-card__header__icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="dashboard-card__header__cont">
                                <h6 class="name text--danger">@lang('Withdraw Charge')</h6>
                                <div class="balance">{{ $gs->withdraw_charge }} %</div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card">
                        <div class="dashboard-card__header">
                            <div class="dashboard-card__header__icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="dashboard-card__header__cont">
                                <h6 class="name text--primary">@lang('Withdraw Limit')</h6>
                                <div class="balance">{{ convert($gs->withdraw_limit) }} {{ $curr->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xxl-8">
                <div class="dashboard--content-item">
                    <div class="create-offer-wrapper py-lg-5">
                        <div class="create-offer-body py-2">
                            <form id="userform" class="form-horizontal" action="{{route('user.wwt.store')}}" method="POST"
                        enctype="multipart/form-data">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="withdraw-amount" class="form-label text--primary">@lang('Withdraw
                                                Method')</label>
                                            <div class="col-sm-12 mt-2">
                                               <select class="form-control form--control border " name="methods" id="withmethod" required>
                                                  <option value="">{{ __('Select Withdraw Method') }}</option>
                                                  <option value="Paypal">{{ __('Paypal') }}</option>
                                                  <option value="Skrill">{{ __('Skrill') }}</option>
                                                  <option value="Payoneer">{{ __('Payoneer') }}</option>
                                                  <option value="Bank">{{ __('Bank') }}</option>
                                               </select>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="withdraw-amount" class="form-label text--primary">@lang('Withdraw
                                            Amount')</label>
                                        <input type="number" name="amount" class="form-control form--control bg--section"
                                            id="withdraw-amount" placeholder="{{ $curr->name }}">
                                    </div>
                                    

                                    
                                        <div class="" id="paypal" style="display: none;">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label text--primary">@lang('Enter Account Email')</label>
                                              
                                                  <input name="acc_email" placeholder="@lang('Enter Account Email')"
                                                     class="form-control form--control border" value="" type="email">
                                              
                                            </div>
                                         </div>
                                    </div>

                                    
                                        <div id="bank" style="display: none;">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                               <label class="form-label text--primary" for="name"> @lang('Enter IBAN/Account No')
                                               
                                               </label>
                                               
                                                  <input name="iban" value="" placeholder="{{ __('Enter IBAN/Account No') }}"
                                                     class="form-control form--control" type="text">
                                              
                                            </div>
                                            <div class="form-group">
                                               <label class="form-label text--primary" for="name">{{ __('Enter Account Name') }} *
                                               </label>
                                              
                                                  <input name="acc_name" value="" placeholder="{{ __('Enter Account Name') }}"
                                                     class="form-control form--control" type="text">
                                             
                                            </div>
                                            <div class="form-group">
                                               <label class="form-label text--primary" for="name">{{ __('Enter Address') }} *
                                               </label>
                                              
                                                  <input name="address" value="" placeholder="{{ __('Enter Address') }}"
                                                     class="form-control form--control" type="text">
                                              
                                            </div>
                                            <div class="form-group">
                                               <label class="form-label text--primary" for="name">{{ __('Enter Swift Code') }} *
                                               </label>
                                               
                                                  <input name="swift" value="" placeholder="{{ __('Enter Swift Code') }}"
                                                     class="form-control form--control" type="text">
                                              
                                            </div>
                                         </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type="submit" class="cmn--btn rounded w-100"> <i
                                                class="fas fa-plus"></i>
                                            @lang('Submit') </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard--content-item">
        <div class="table-responsive table--mobile-lg">
            <table class="table bg--body">
                <thead>
                    <tr>
                        <th>@lang('Account Email')</th>
                        <th>@lang('Payment Method')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Status')</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($withdraws as $withdraw)

                    <tr>
                        <td data-label="Buyer">
                            <div>
                                <div class="name">{{ $withdraw->acc_email }}</div>
                            </div>
                        </td>
                        <td data-label="Payment Method">
                            <div>
                                <div class="name">{{ $withdraw->method }}</div>
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>
                                <div class="name">{{ convert($withdraw->amount) }} {{ $curr->name }}</div>
                            </div>
                        </td>
                        <td data-label="Limits">
                            <div>
                                <div class="name">{{ $withdraw->created_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td data-label="Status">
                            @if($withdraw->status == 'pending')
                                <div>
                                    <div class="name">
                                        <span class="badge btn--warning btn-sm">{{ $withdraw->status }}</span>
                                    </div>
                                </div>

                            @elseif($withdraw->status == 'completed')
                                <div>
                                    <div class="name">
                                        <span class="badge btn--success btn-sm">{{ $withdraw->status }}</span>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <div class="name">
                                        <span class="badge btn--danger btn-sm">{{ $withdraw->status }}</span>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                        
                    @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer-copyright text-center mt-auto">
        {!! $gs->copyright !!}
    </div>
</div>

</article>

@endsection

@push('js')
<script type="text/javascript">
    (function($) {
            "use strict";
 
        $("#withmethod").change(function () {
            var method = $(this).val();
            if (method == "Bank") {
 
                $("#bank").show();
                $("#bank").find('input, select').attr('required', true);
 
                $("#paypal").hide();
                $("#paypal").find('input').attr('required', false);
 
            }
            if (method != "Bank") {
                $("#bank").hide();
                $("#bank").find('input, select').attr('required', false);
 
                $("#paypal").show();
                $("#paypal").find('input').attr('required', true);
            }
            if (method == "") {
                $("#bank").hide();
                $("#paypal").hide();
            }
 
        })
 
    })(jQuery);
 
 </script>
    
@endpush