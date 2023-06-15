@extends('layouts.front')
@push('css')

@endpush

@section('content')


<section class="hero-section">
    <span class="line-1"></span>
    <span class="line-2"></span>
    <span class="hero-bg bg--body">&nbsp;</span>
    <div class="container">
        <div class="hero-wrapper">
            <span class="hero-info">{{ $ps->hero_info }}</span>
            <h1 class="hero-title">
                {{ $ps->hero_title }}
            </h1>
            <p class="hero-text">
                {{$ps->hero_text}}
            </p>
            <div class="btn__grp">
               
                <a href="{{ route('user.package') }}" class="cmn--btn">@lang('Pricing')</a>
            </div>
        </div>
    </div>
    <div class="hero-img">
        <img src="./assets/images/banner/banner.png" alt="banner">
    </div>
</section>
<div class="container pb-100 pt-100 pt-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div id="first-form" class="">
                <form class="shorten--form " id="short-linkk" action="{{ route('front.shortlink') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="url" class="form-control form--control bg--section"
                            placeholder="Enter Your URL and shorten it">
                        <button type="submit" class="cmn--btn">@lang('Shorten')</button>
                    </div>
                </form>
            </div>
            <div id="second-form" class="d-none">
                    <div class="input-group">
                        <input type="text" name="url" id="surl" class="form-control form--control bg--section"
                            placeholder="Enter Your URL and shorten it" value="">
                            @if(isset($link->alias))
                            <button id="copy" type="submit" data-value="{{ Auth::user() ? $link->alias : '' }}" class="cmn--btn">@lang('Copy')</button>
                            @endif
                    </div>
            </div>
        </div>
    </div>
    <div class="mt-3 font--sm text-center">
       <p>@lang('By using our service you accept the Terms and conditions and Privacy.')</p>
    </div>
</div>
<!-- Hero -->
<section class="pb-100 @@classes">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title">{{ $ps->brand_title }}</h2>
            <p>
                {{$ps->brand_text}}
            </p>
        </div>
        <div class="row g-4 gy-5 justify-content-center">
            @foreach ($services as $data)
            <div class="col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-card__img">
                        <img src="{{ $data->photo ? asset('assets/images/'.$data->photo) : asset('assets/images/placeholder.jpg') }}" alt="feature">
                    </div>
                    <div class="feature-card__cont">
                        <h5 class="title">{{ $data->title }}</h5>
                        <p>
                           {{$data->details}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="testimonial-section pb-100">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title">{{ $ps->review_title }}</h2>
            <p>
               {{$ps->review_text}}
            </p>
        </div>

        <div class="testimonial-slider owl-carousel owl-theme">

            @foreach ($reviews as $review)


            <div class="testimonial-item">
                <div class="testimonial-header">
                    <div class="thumb">
                        <img src="{{ $review->photo ? asset('assets/images/client/'.$review->photo) : asset('assets/images/placeholder.jpg') }}" alt="testimonial">
                    </div>
                    <div class="icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                </div>
                <div class="rating">
                        @php
                            $n=5-$review->rating
                        @endphp

                        @foreach (range(1, $review->rating) as $item)
                        <span>
                            <i class="fas fa-star"></i>

                        </span>

                        @endforeach
                        @if ($n != 0)
                        @foreach (range(1,$n) as $i)
                        <span>
                            <i class="far fa-star"></i>
                        </span>
                        @endforeach
                        @endif
                </div>
                <div class="testimonial-content">
                    <p>
                       {{ $review->details }}
                    </p>
                    <h5 class="name  mt-3">{{ $review->name }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="pricing-section pb-100 @@classes">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title">{{ $ps->pricing_title }}</h2>
            <p>
                {{$ps->pricing_text}}
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

                @if ($plan->status==1)
                <a href="{{ route('user.subscription',$plan->slug) }}" class="cmn--btn w-100">@lang('Activated')</a>

                @else
                <a href="{{ route('user.subscription',$plan->slug) }}" class="cmn--btn w-100">@lang('Active Now')</a>
                @endif
                 

                  @else
                  <a href="{{ route('user.loginform') }}" class="cmn--btn w-100">@lang('Active Now')</a>
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
