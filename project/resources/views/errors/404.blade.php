@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Error')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Error')
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->

   <!--==================== Error Section Start ====================-->
   <div class="full-row" style="padding: 100px 0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center">
                    <img src="{{ $gs->error_banner ? asset('assets/images/'.$gs->error_banner):asset('assets/images/noimage.png') }}" alt="">
                    <h2 class="my-4">{{ __('404 Page not found') }}</h2>
                    <p>{{ __('The page you are looking for dosen’t exist or another error occourd go back to home or another source') }}</p>
                    <a class="btn btn-secondary mt-5" href="{{ route('front.index') }}">{{ __('Return to home') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==================== Error Section Form Start ====================-->


 

  

@endsection
@push('js')

@endpush
