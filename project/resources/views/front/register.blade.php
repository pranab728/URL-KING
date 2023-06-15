@extends('layouts.front')

@push('css')

@endpush

@section('content')

<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('Registration')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Registration')
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
                  <h6 class="subtitle mb-3 text--base">@lang('Sign Up')</h6>
                  <h3 class="title">@lang('Create Account Now')</h3>
              </div>
              <form class="account-form row gy-3 gx-4 align-items-center" id="registerform" action="{{ route('user.register.submit') }}" method="POST">
                @includeIf('alerts.form-both')
              @csrf
                  <div class="col-sm-6">
                      <label for="name" class="form-label">@lang('Your Name')</label>
                      <input type="text" id="name" name="name" class="form-control form--control">
                  </div>

                  <div class="col-sm-6">
                      <label for="email" class="form-label">@lang('Your Email')</label>
                      <input type="text" id="email" name="email" class="form-control form--control">
                  </div>

                  <div class="col-sm-6">
                    <label class="form-label">@lang('Country')</label>
                    <select required="" class="form-control form--control" id="country" name="country">
                        <option value="">@lang('Select Country')</option>
                        @foreach ($countries as $contry)
                        <option value="{{ $contry->phone_code }}">{{ $contry->name }}</option>
                        @endforeach
                    </select>
                 </div>

                  <div class="col-sm-6">
                    <label for="phone" class="form-label">@lang('Your Phone')</label>
                    <div class="input-group ">
                        <div class="input-group-prepend">
                          <span class="input-group-text"  id="phone_code">00</span>
                        </div>
                        <input type="text" id="phone" name="phone" required="" class="form-control form--control"  aria-label="Phone" aria-describedby="phone_code">
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <label for="password" class="form-label">@lang('Your Password')</label>
                      <input type="password" id="password" name="password" required="" class="form-control form--control">
                  </div>

                  <div class="col-sm-6">
                      <label for="confirm-password" class="form-label">@lang('Confirm Password')</label>
                      <input type="password" id="confirm-password" name="password_confirmation"
                          class="form-control form--control" required="">
                  </div>

                  @if($gs->is_capcha == 1)
                  <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <label class="col-sm-6 control-label">@lang('Captcha')</label>
                    <div class="col-sm-6">
                        {!! NoCaptcha::renderJs() !!}
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                  @endif

                    <input class="mprocessdata" type="hidden" value="{{ (('Processing...'))}}">
                  <div class="col-sm-12 d-flex flex-wrap justify-content-between align-items-center">
                      <button type="submit" id="btn" class="cmn--btn bg--base me-3 btn">
                          @lang('Register Now')
                      </button>
                      <div class="text-end">
                          <a href="{{ route('user.loginform') }}" class="text--base">@lang('Already have
                              an account ?')</a>
                      </div>
                  </div>
                  
              </form>
          </div>
      </div>
  </section>
  <!-- Account -->



@endsection

@push('js')

<script>
    $(document).on('change','#country',function(){
        var value= $(this).val();
        document.getElementById("phone_code").innerHTML = value;

    })


</script>

@endpush
