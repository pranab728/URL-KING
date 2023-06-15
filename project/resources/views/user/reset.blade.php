@extends('layouts.user')

@push('css')

@endpush
@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>
@includeIf('partials.user.top-nav')
<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Change Password')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Change Password')
        </li>
    </ul>
</div>
</div>
    <div class="dashborad--content">
        <div class="dashboard--content-item pt-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <div class="profile--card">
                        <form id="userform" action="{{route('user.reset.submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <label for="password" class="form-label">@lang('Old Password')</label>
                                    <input type="password" name="cpass" id="password" class="form-control form--control bg--white" placeholder=" @lang('Old Password')" required="">
                                </div>
                                <div class="col-sm-12">
                                    <label for="new-password" class="form-label">@lang('New Password')</label>
                                    <input type="password" id="new-password" name="newpass"
                                        class="form-control form--control bg--white" placeholder="@lang('New Password')" required="">
                                </div>
                                <div class="col-sm-12">
                                    <label for="confirm-password" class="form-label">@lang('Confirm Password')</label>
                                    <input type="password" id="confirm-password" name="renewpass" required
                                        class="form-control form--control bg--white" placeholder="@lang('Confirm Password')">
                                </div>
                                <div class="col-sm-12">
                                    <div class="text-end">
                                        <button type="submit" class="submit-btn cmn--btn">@lang('Change Password')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center mt-auto">
            {!! $gs->copyright !!}
        </div>
    </div>
</article>

@endsection
