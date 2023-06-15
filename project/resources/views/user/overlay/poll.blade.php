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
        <h3 class="title text--white">@lang('CTA Poll')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('CTA Poll')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">
                <div class="row">
                    <div class="col-md-8">
                        <form id="userform" action="{{route('user.store-poll-overlay')}}" method="POST">
                @csrf
                <div class="profile--card">
                        <div class="row gy-4">
                            <div class="col-sm-8 col-xxl-4">
                                <label for="name" class="form-label">@lang('Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="" required="" placeholder="{{ __('Enter Poll Overlay Name') }}">
                            </div>
                            <div class="col-sm-8 col-xxl-4">
                                <label for="question" class="form-label">@lang('Question')</label>
                                <input  type="text" id="question" class="form-control form--control bg--section"
                                     name="question" required placeholder="@lang('Enter Your Question')">
                            </div>
                            <hr>
                            <h3>@lang('Options')</h3>

                            <div class="col-sm-12 col-xxl-12 " >
                                
                                <input  type="text" id="subject" class="form-control form--control bg--section option"
                                     name="option[]" ref="first" required placeholder="Option here">
                                     
                            </div>
                            <div class="col-sm-12 col-xxl-12 " >
                                
                                <input  type="text" ref="second" id="subject" class="form-control form--control bg--section option"
                                     name="option[]" required placeholder="Option here">
                                     
                            </div>
                            <div class="col-sm-12 col-xxl-12 " id="option">

                            </div>
                            <div class="col-sm-4">
                                <a  class="btn btn-primary btn-sm mt-2" id="add">@lang('Add Option')</a>
                            </div>
                            
                           
                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="cmn--btn submit-btn">@lang('Submit')</button>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $slug }}" name="type">
                        </div>
                </div>
            </form>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title " id="form-title">@lang('Your Question Here? ')</h5>
                                <div class=" mt-4 mb-4" id="paragraph">
                                    <p class="first">#1</p>
                                    <p class="second">#2</p>
                                </div>
                                
                                <button class="btn btn-primary btn-sm" type="button">@lang('Vote')</button>
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
        $('#question').on('keyup', function () {
            var label = $(this).val();
            $('#form-title').text(label);
        });

       

        var clicks=2;

        $('#add').on('click', function (e) {
            e.preventDefault();

            let generate = Math.random().toString(36).substring(7);

            var html = '<div class=""><input  type="text" id="subject" class="form-control form--control bg--section mt-2 option" name="option[]" ref="'+generate+'" required placeholder="option here">  <a class="btn btn-danger  mt-2 remove">X</a> </div>';
            $('#option').append(html);
           clicks += 1;
            var para ='<p class="'+generate+'">#'+clicks+'</p>';
            $('#paragraph').append(para);
        });

        $(document).on('click', '.remove', function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            var ref = $(this).parent('div').find('input').attr('ref');
            $("p."+ref).remove();

        });
        let ref = $(this).parent('div').find('input').attr('ref');

        $(document).on('keyup', '.option', function (e) {
            e.preventDefault();
            var label = $(this).val();
            var ref = $(this).attr('ref');
            $("p."+ref).text(label);
        });
       
    });

 
</script>


@endpush
