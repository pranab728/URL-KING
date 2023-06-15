@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Forgot Password')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Forgot Password')
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
                  
                  <h3 class="title">@lang('Forgot Password')</h3>
              </div>

              <form class="account-form row gy-3 gx-4 align-items-center" id="forgotform" action="{{route('user.forgot.submit')}}" method="POST">
             
                <div class="alert alert-info validation" style="display: none;">
                    <p class="text-left"></p>
                </div>
                @csrf
                  <div class="col-sm-12">
                      <label for="email" class="form-label">@lang('Your Email')</label>
                      <input type="text" id="email" id="reg_email" name="email" class="form-control form--control">
                  </div>
                 <p>@lang('A password will be sent to your email address.')</p>
                  <div class="col-sm-12">
                    <input id="authdata" type="hidden" value="{{ __('Checking...') }}">
                      <button type="submit" name="register" id="btn" class="cmn--btn bg--base me-3 submit-btn">
                          @lang('Submit')
                      </button>
                     
                  </div>
              </form>
          </div>
      </div>
  </section>
  <!-- Account -->


@endsection
@push('js')

@endpush
