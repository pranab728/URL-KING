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
        <h3 class="title text--white">@lang('Edit Pixel')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('Edit Pixel')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">

                <form id="userform" action="{{route('user.update-pixel',$pixel->id)}}" method="POST">
                @csrf
                <div class="profile--card">
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xxl-4">
                                <div class="form-group my-2">
                                    <label for="my-select">@lang('Pixel Provider')</label>
                                    <select id="my-select" class="form-control" name="type">
                                        <option {{ $pixel->type=='facebook' ? 'selected' : '' }} value="facebook">@lang('Facebook')</option>
                                        <option {{ $pixel->type=='google' ? 'selected' : '' }}  value="google">@lang('Google Tag Manager')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="counter" class="form-label">@lang('Pixel Name')</label>
                                <input  type="text" id="counter" class="form-control form--control bg--section"
                                     name="name" value="{{ $pixel->name }}" required>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="product" class="form-label">@lang('Pixel Tag')</label>
                                <input  type="text" value="{{ $pixel->tag }}" id="product" class="form-control form--control bg--section"
                                     name="tag" required>
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



@endpush
