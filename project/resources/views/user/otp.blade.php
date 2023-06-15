@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('OTP')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('OTP')
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->
  <!-- Account -->
  <section class="account-section pt-100 pb-100">
      <div class="container">
          <div class="account-wrapper bg--section">
              <div class="section-title mb-3">
               
                  <h3 class="title">@lang('OTP verification')</h3>
              </div>

              <form class="account-form row gy-3 gx-4 align-items-center"  action="{{ route('user.otp.submit') }}" method="POST"method="POST">
                @includeIf('alerts.form-both')
                @csrf
                  <div class="col-sm-12">
                      <label for="otp" class="form-label">@lang('Your OTP Code')</label>
                      <input type="text" id="otp" name="otp" class="form-control form--control" placeholder="@lang('Type Your otp')" required="">
                  </div>
                  
                  <div class="col-sm-12">
                      <button type="submit"  class="cmn--btn bg--base me-3">
                          @lang('Submit')
                      </button>
                      <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                          <a href="registration.html" class="text--base mt-1">@lang("Don't have
                            an account ?")</a>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </section>
  <!-- Account -->


@endsection
@push('js')

@endpush
