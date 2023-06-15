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
        <h3 class="title text--white">@lang('Edit Splash')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('Edit Splash')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">

                <form id="userform" action="{{route('user.update-splash', $splash->id)}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="profile--card">
                  
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xxl-4">
                                <label for="name" class="form-label">@lang('Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="{{ $splash->name }}" required="">
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="counter" class="form-label">@lang('Counter')</label>
                                <input  type="number" id="counter" class="form-control form--control bg--section"
                                     name="counter" value="{{ $data->counter }}" required>
                            </div>
                            <div class="col-sm-6 col-xxl-4">
                                <label for="product" class="form-label">@lang('Link to Product')</label>
                                <input  type="text" id="product" class="form-control form--control bg--section"
                                     name="product" value="{{ $data->product }}" required>
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <label for="title" class="form-label">@lang('Custom Title')</label>
                                <input type="text" name="title" value="{{ $data->title }}" class="form-control form--control bg--section" >
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <div class="thumb mb-5">
                                    <img class="w-100" src="{{ $splash->banner ? asset('assets/images/splash/'.$splash->banner) : asset('assets/images/placeholder.jpg') }}" alt="clients">
                                </div>
                                <label for="banner" class="form-label">@lang('Upload Banner')</label>
                                <input type="file" name="banner" id="banner" class=" form--control bg--section"
                                    >
                            </div>

                            <div class="col-sm-6 col-xxl-4">
                                <div class="thumb">
                                    <img src="{{ $splash->avatar ? asset('assets/images/splash/'.$splash->avatar) : asset('assets/images/placeholder.jpg') }}" alt="clients">
                                </div>
                                <label for="avatar" class="form-label">@lang('Upload Avatar')</label>
                                <input type="file" name="avatar" id="avatar" class=" form--control bg--section"
                                    >
                            </div>

                            <div class="col-sm-12">
                                <label for="description" class="form-label">@lang('Description')</label>
                                <textarea name="description " id="description" class="form-control form--control bg--section summernote" rows="5">
                                    @php echo $data->description @endphp
                                </textarea>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="cmn--btn submit-btn">@lang('Update')</button>
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
