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
        <h3 class="title text--white">@lang('Create Splash')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('Create Splash')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">

                <form id="userform" action="{{route('user.store-splash')}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="profile--card">
                  
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xxl-4">
                                <label for="name" class="form-label">@lang('Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="" required="">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="counter" class="form-label">@lang('Counter')</label>
                                <input  type="number" id="counter" class="form-control form--control bg--section"
                                     name="counter" required>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="product" class="form-label">@lang('Link to Product')</label>
                                <input  type="text" id="product" class="form-control form--control bg--section"
                                     name="product" required>
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="title" class="form-label">@lang('Custom Title')</label>
                                <input type="text" name="title" class="form-control form--control bg--section" >
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="banner" class="form-label">@lang('Upload Banner')</label>
                                <input type="file" name="banner" id="banner" class=" form--control bg--section"
                                    >
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="avatar" class="form-label">@lang('Upload Avatar')</label>
                                <input type="file" name="avatar" id="avatar" class=" form--control bg--section"
                                    >
                            </div>

                            <div class="col-sm-12">
                                <label for="description" class="form-label">@lang('Description')</label>
                                <textarea name="description " id="description" class="form-control form--control bg--section summernote" rows="5"></textarea>
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
    var prevImg = $('.user--profile .thumb').html();
    function proPicURL(input) {
        if (input.files && input.files[0]) {
            var uploadedFile = new FileReader();
            uploadedFile.onload = function (e) {
                var preview = $('.user--profile').find('.thumb');
                preview.html(`<img src="${e.target.result}" alt="user">`);
                preview.addClass('image-loaded');
                preview.hide();
                preview.fadeIn(650);
                $(".image-view").hide();
                $(".remove-thumb").show();
            }
            uploadedFile.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-image-upload").on('change', function () {
        proPicURL(this);
    });
    $(".remove-thumb").on('click', function () {
        $(".user--profile .thumb").html(prevImg);
        $(".user--profile .thumb").removeClass('image-loaded');
        $(".image-view").show();
        $(this).hide();
    })

 
</script>


@endpush
