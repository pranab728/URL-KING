@extends('layouts.user')
@push('css')

@endpush

@section('content')

<!-- User Dashboard -->


    <article class="main--content">
        <div class="dashboard-header position-relative">
    <div class="bg--gradient">&nbsp;</div>
    @includeIf('partials.user.top-nav')
    <div class="breadcrumb-area">
        <h3 class="title text--white">@lang('CTA Contact')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('CTA Contact')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">



                <div class="row">
                    <div class="col-md-8">
                        <form id="userform" action="{{route('user.store-contact-overlay')}}" method="POST">
                @csrf

                <div class="profile--card">
                  
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xxl-4">
                                <label for="name" class="form-label">@lang('Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="" required="" placeholder="{{ __('Enter Contact Overlay Name') }}">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="email" class="form-label">@lang('Email')</label>
                                <input  type="email" id="email" class="form-control form--control bg--section"
                                     name="email" required placeholder="@lang('Enter Your Email')">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="subject" class="form-label">@lang('Email Subject')</label>
                                <input  type="text" id="subject" class="form-control form--control bg--section"
                                     name="subject" required placeholder="Email Subject Here...">
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="form_label" class="form-label">@lang('Form Label')</label>
                                <input type="text" id="form_label" placeholder="@lang('Mail Send')" name="label" class="form-control form--control bg--section" >
                            </div>

                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="cmn--btn submit-btn">@lang('Submit')</button>
                                </div>
                            </div>
                            
                           
                        </div>
                </div>

            </form>

                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-text" ><i class="fa fa-question-circle" aria-hidden="true"></i> <span id="label_text"></span></h5>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title " id="form-title">@lang('Email Form')</h5>

                                
                                <div class="form-group mt-2">
                                    <label for="name" class="form-label">@lang('Name')</label>
                                    <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                        value="" required="" placeholder="{{ __('Jhon Doe') }}">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="demo-email" class="form-label">@lang('Email')</label>
                                    <input type="text" id="demo-email" class="form-control form--control bg--section"
                                        value="" required="" placeholder="{{ __('Enter Email Here..') }}">
                                </div>
                                <div class="form-group mt- mb-4">
                                    <label for="demo-email" class="form-label">@lang('Message')</label>
                                    <textarea class="form-control" name="" id="" ></textarea>
                                </div>

                                <button class="btn btn-primary" type="button">@lang('Send')</button>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <div class="footer-copyright text-center mt-auto">
                &copy; All Right Reserved by <a href="#0" class="text--base">Genius Short</a>
            </div>
        </div>
    </article>

<!-- User Dashboard -->


@endsection

@push('js')
<script>
    "use strict"

     $(document).ready(function () {
        $('#form_label').on('keyup', function () {
           
            var label = $(this).val();

            $('#label_text').text(label);
            $('#form-title').text(label);
        });
    });

 
</script>


@endpush
