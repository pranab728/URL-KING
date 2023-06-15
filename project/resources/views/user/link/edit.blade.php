@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Edit Link')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Edit Link')
        </li>
    </ul>
</div>
</div>

<div class="dashborad--content">
    <div class="dashboard--content-item pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <div class="profile--card">
                    <form id="userform" action="{{ route('user.link.store',$link->id) }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-sm-12">
                                <label for="alias" class="form-label">@lang('Alias')</label>
                                <input type="text" id="alias"
                                    class="form-control form--control bg--white" name="alias" placeholder="Enter Custom Alias" required="" value="{{ $link->alias }}">
                            </div>
                            <div class="col-sm-12">
                                <label for="meta_title" class="form-label">@lang('Meta Title')</label>
                                <input type="meta_title" id="meta_title" name="meta_title" value="{{ $link->meta_title }}"
                                    class="form-control form--control bg--white" placeholder="@lang('Enter Meta Title')">
                            </div>
                            <div class="col-sm-12">
                                <label for="meta_description" class="form-label">@lang('Meta Description')</label>
                                <input type="confirm-password" id="meta_description" name="meta_description" value="{{ $link->meta_description }}"
                                    class="form-control form--control bg--white" placeholder="@lang('Meta Description')">
                            </div>
                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="cmn--btn">@lang('Update')</button>
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

@push('js')

@endpush
