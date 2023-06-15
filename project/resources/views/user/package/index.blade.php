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
<section class="pricing-section pb-100 pt-100">
   <div class="container">
      <div class="section-title text-center">
         <h2 class="title">{{ $ps->pricing_title }}</h2>
         <p>
            {!! $ps->pricing_text !!}
         </p>
      </div>
      <div class="row g-3 g-md-4 justify-content-center">

        @foreach ($plans as $plan)

         <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="pricing-card">
               <div class="pricing-card__top">
                  <div>
                     {{ $plan->title }}
                  </div>
                  <h4 class="price">{{ $plan->planprice() }}<sub> / {{ $plan->days }} @lang('days')</sub></h4>
               </div>
               <div class="pricing-card__bottom">
                  <ul>
                     <li>
                         @if ($plan->free==1)
                         <i class="fas fa-check"></i> {{ ('Free Advertisement') }}
                         @else
                         <i class="fas fa-times " style="color:rgb(216, 32, 32)"></i> {{ ('Free Advertisement') }}
                         @endif

                     </li>
                     <li>
                        <i class="fas fa-check"></i> {{ $plan->allowed_url }} - @lang('Short Links ')
                     </li>
                     <li>
                        <i class="fas fa-check"></i>{{ $plan->click_limit }} - @lang('Redirect Limit')
                     </li>
                     <li>
                        <i class="fas fa-check"></i> @lang('Custom Aliases')
                     </li>
                     <li>
                        <i class="fas fa-check"></i> {{ $plan->days }} - @lang('Days validity')
                     </li>
                     <li>
                        <i class="fas fa-check"></i>@lang('Price') - {{ round($plan->price,2) }}
                     </li>
                  </ul>

                  @if (Auth::user())
                  @if(DB::table('user_subscriptions')->where('user_id',Auth::user()->id)->where('status',1)->first()->subscription_id==$plan->id)
                <a href="{{ route('user.subscription',$plan->slug) }}" class="cmn--btn w-100">@lang('Activated')</a>

                    @else
                   <a href="{{ route('user.subscription',$plan->slug) }}" class="cmn--btn w-100">@lang('Active Now')</a>
                   @endif
                    @else
                  <a href="{{ route('user.loginform') }}" class="cmn--btn w-100">@lang('Activate Now')</a>
                    @endif

               </div>
            </div>
         </div>

         @endforeach


      </div>
   </div>
</section>
@endsection
@push('js')
@endpush
