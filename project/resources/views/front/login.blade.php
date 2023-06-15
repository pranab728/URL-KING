@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Login')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Login')
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
                  <h6 class="subtitle mb-3 text--base">@lang('Sign In')</h6>
                  <h3 class="title">@lang('Login Now')</h3>
              </div>

              <form class="account-form row gy-3 gx-4 align-items-center" id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                @includeIf('alerts.form-login')
                @csrf
                  <div class="col-sm-12">
                      <label for="email" class="form-label">@lang('Your Email')</label>
                      <input type="text" id="email" name="email" value="user@gmail.com" class="form-control form--control">
                  </div>
                  <div class="col-sm-12">
                      <label for="password" class="form-label">@lang('Your Password')</label>
                      <input type="password" id="password" name="password" value="1234" class="form-control form--control">
                  </div>
                  <div class="col-sm-12">
                    <input id="authdata" type="hidden" value="{{ __('Authenticating...') }}">
                      <button type="submit" id="btn" class="cmn--btn bg--base me-3">
                          @lang('Login Now')
                      </button>
                      <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                          <a href="{{ route('user.forgot') }}" class="text--base mt-1">@lang('Forget Password')</a>
                          <a href="registration.html" class="text--base mt-1">@lang("Don't have
                            an account ?")</a>
                      </div>
                      @if($socialsetting->f_check == 1 || $socialsetting->g_check == 1)
                                                    <div class="social-area text-center">
                                                        <h3 class="title  mt-3">{{ ('OR') }}</h3>
                                                        <p class="text">{{ __('Sign In with social media') }}</p>
                                                        <ul class="social-links">
                                                            @if($socialsetting->f_check == 1)
                                                            <li>
                                                            <a href="{{ route('social-provider','facebook') }}">
                                                                <i class="fab fa-facebook-f"></i>
                                                            </a>
                                                            </li>
                                                            @endif
                                                            @if($socialsetting->g_check == 1)
                                                            <li>
                                                            <a href="{{ route('social-provider','google') }}">
                                                                <i class="fab fa-google"></i>
                                                            </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
					              @endif
                  </div>
              </form>
          </div>
      </div>
  </section>
  <!-- Account -->


@endsection
@push('js')

@endpush
