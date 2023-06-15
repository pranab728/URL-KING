@extends('layouts.admin')
@section('content')
<div class="card">
   <div class="d-sm-flex align-items-center justify-content-between">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Splash') }}</h5>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
         <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
         <li class="breadcrumb-item"><a href="{{ route('admin.general.splash') }}">{{ __('Splash') }}</a></li>
      </ol>
   </div>
</div>
<div class="row justify-content-center mt-3">
   <div class="col-lg-6">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Default Splash') }}</h6>
         </div>
         <div class="card-body">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form  action="{{route('admin.gs.update')}}" method="POST" enctype="multipart/form-data">
               @include('includes.admin.form-both')
               {{ csrf_field() }}


               <div class="form-group">
                <div class="wrapper-image-preview">
                  <label for="">{{ __('Splash Banner') }} <small>{{ __('( Image should be between 980 and 500 )') }}</small></label>
                   <div class="box full-width">
                      <div class="back-preview-image" style="background-image: url({{ $gs->banner ? asset('assets/images/splash/'.$gs->banner):asset('assets/images/placeholder.jpg') }});"></div>
                      <div class="upload-options-settings">
                         <label class="img-upload-label full-width" for="img-upload-1">
                         <i class="fas fa-camera"></i> {{ __('Upload Picture') }}
                         <br>
                         <small class="small-font">{{ __('980 X 500') }}</small>
                         </label>
                         <input id="img-upload-1" type="file" class="image-upload" name="banner" accept="image/*">
                      </div>
                   </div>
                </div>
             </div>


             <div class="form-group mt-5">
                <div class="wrapper-image-preview">
                  <label for="">{{ __('Splash Avatar') }} <small>{{ __('( Image should be between 200 and 200 )') }}</small></label>
                    <div class="box-settings">
                       <div class="back-preview-image" style="background-image: url({{ $gs->avatar ? asset('assets/images/splash/'.$gs->avatar):asset('assets/images/placeholder.jpg') }});"></div>
                       <div class="upload-options-settings">
                          <label class="img-upload-label " for="img-upload-2">
                          <i class="fas fa-camera"></i> {{ __('Upload Picture') }}
                          <br>
                          <small class="small-font">{{ __('200 X 200') }}</small>
                          </label>
                          <input id="img-upload-2" type="file" class="image-upload" name="avatar" accept="image/*">
                       </div>
                    </div>
                 </div>
             </div>

             
            <div class="form-group ">
               <label for="inp-title">{{  __('Splash Title')  }}</label>
               <input type="text" class="form-control" id="inp-title" name="title"  placeholder="{{ __('Enter Splash Title') }}" value="{{ $spdata->title }}" required>
            </div>

            <div class="form-group">
               <label for="inp-title">{{  __('Splash Counter')  }}</label>
               <input type="number" class="form-control" id="inp-title" name="counter"  placeholder="{{ __('Enter Splash Counter') }}" value="{{ $spdata->counter }}" required>
            </div>

            <div class="form-group">
               <label for="inp-title">{{  __('Splash Product Link')  }}</label>
               <input type="text" class="form-control" id="inp-title" name="product"  placeholder="{{ __('Enter Product Link') }}" value="{{ $spdata->product }}" required>
            </div>

            <div class="form-group">
               <label for="inp-title">{{  __('Splash Description')  }}</label>
               <textarea class="summernote" name="description" id="" cols="30" rows="10">{{ $spdata->description }}</textarea>
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
