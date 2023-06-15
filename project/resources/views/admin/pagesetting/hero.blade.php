@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Hero Section') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Setting') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.hero') }}">{{ __('Hero Section') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-8">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Hero Section') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form  action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">
            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">{{ __('Hero Section Info') }} *</label>
                <input type="text" class="form-control" id="info" name="hero_info"  placeholder="{{ __('Hero Info') }}" value="{{ $ps->hero_info }}" required>
            </div>

            <div class="form-group">
                <label for="title">{{ __('Hero Section Title') }} *</label>
                <input type="text" class="form-control" id="title" name="hero_title"  placeholder="{{ __('Hero Title') }}" value="{{ $ps->hero_title }}" required>
            </div>

            <div class="form-group">
              <label for="text">{{ __('Hero Section Text') }} *</label>
              <textarea name="hero_text" id="text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Hero Text') }}" required>{{ $ps->hero_text }} </textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>

    <!-- Form Sizing -->

    <!-- Horizontal Form -->

  </div>

</div>
<!--Row-->

@endsection
