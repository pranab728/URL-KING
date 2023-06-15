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
        <h3 class="title text--white">@lang('User Profile')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('User Profile')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">

                <form id="userform" action="{{route('user.profile.update')}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="profile--card">
                    <div class="user--profile mb-5">
                        <div class="thumb">
                            <img src="{{ $user->photo ? asset('assets/images/user/'.$user->photo) : asset('assets/images/placeholder.jpg') }}" alt="clients">
                        </div>
                        <div class="remove-thumb">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="content">
                            <div>
                                <h3 class="title">
                                   {{$user->name}}
                                </h3>

                            </div>
                            <div class="mt-4">
                                <label class="btn btn-sm btn--base text--dark">
                                    @lang('Update Profile Picture')
                                    <input type="file" id="profile-image-upload" name="photo" hidden>
                                </label>
                                <div class="text--primary mt-2 font--sm">
                                    @lang('Image size should be 260x175')
                                </div>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xxl-4">
                                <label for="name" class="form-label">@lang('Your Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="{{ $user->name }}" required="">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="last-name" class="form-label">@lang('Full Name')</label>
                                <input disabled type="text" id="last-name" class="form-control form--control bg--section"
                                    value="{{ $user->username }}" name="username" required>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="email" class="form-label">@lang('Your Email')</label>
                                <input disabled type="text" id="email" class="form-control form--control bg--section"
                                    value="{{ $user->email }}" name="email" required>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label class="form-label">@lang('Country')</label>
                                <select class="form-control form--control" id="country" name="country" >
                                    <option value="{{ App\Models\Country::where('phone_code',$user->country)->first()->phone_code }}">{{ App\Models\Country::where('phone_code',$user->country)->first()->name }}</option>
                                    @foreach ($countries as $contry)
                                    <option value="{{ $contry->phone_code }}">{{ $contry->name }}</option>
                                    @endforeach
                                </select>
                             </div>

                             <div class="col-sm-6">
                                <label for="phone" class="form-label">@lang('Your Phone')</label>
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"  id="phone_code">{{ $user->country }}</span>
                                    </div>
                                    <input type="text" id="phone" name="phone" required="" class="form-control form--control" value="{{ $user->phone }}"  aria-label="Phone" aria-describedby="phone_code">
                                  </div>
                              </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="name" class="form-label">@lang('Your Address')</label>
                                <input type="text" name="address" class="form-control form--control bg--section" value="{{ $user->address }}">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="fax" class="form-label">@lang('Your Fax')</label>
                                <input type="text" name="fax" id="fax" class="form-control form--control bg--section"
                                    value="{{ $user->fax }}">
                            </div>

                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="cmn--btn submit-btn">@lang('Update Profile')</button>
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

    $(document).on('change','#country',function(){
        var value= $(this).val();
        document.getElementById("phone_code").innerHTML = value;

        $('#phone').val('');

    })
</script>


@endpush
