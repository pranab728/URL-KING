@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.subscription.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

      <li class="breadcrumb-item"><a href="{{route('admin.subscription.index')}}">{{ __('Subscription Plan') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.subscription.create')}}">{{ __('Add New Plan') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-lg-6">
  <!-- Form Basic -->
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Subscription Plan Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form action="{{route('admin.subscription.store')}}" method="POST" >
        @include('includes.admin.form-both')


          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="title" name="title"  placeholder="{{ __('Enter Title') }}" value="" required>
         </div>
         <div class="form-group">
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" class="form-control" id="slug" name="slug"  placeholder="{{ __('Enter Slug') }}" value="" required>
         </div>

         <div class="form-group">
            <label for="trial_days">{{ __('Days') }}</label>
            <input type="number" class="form-control" name="days" min="1"  placeholder="{{ __('Enter Days') }}" value="" required>
         </div>
         <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="number" class="form-control" name="price" min="0"  placeholder="{{ __('Enter Price') }}" value="" required>
         </div>

         <div class="form-group">
            <label for="allowed_url">{{ __('Allowed Links') }}</label>
            <input type="number" class="form-control"  name="allowed_url" min="1 "  placeholder="{{ __('Limit URl for this plan') }}" value="" required min="1">
         </div>
         <div class="form-group">
            <label for="allowed_url">{{ __('Limit Click') }}</label>
            <input type="number" class="form-control"  name="click_limit" min="1"  placeholder="{{ __('Limit URl for this plan') }}" value="" required min="1">
         </div>
         <div class="form-group">
          <label for="allowed_url">{{ __('Link Expired Limit') }} <small>{{ __('In days') }}</small></label>
          <input type="number" class="form-control" min="1"  name="expired_limit"  placeholder="{{ __('Link Expired Limit') }}" value="" required >
       </div>
        </div>


          <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>

  <!-- Form Sizing -->

  <!-- Horizontal Form -->

</div>

</div>
<!--Row-->


@endsection

@section('scripts')

<script>
'use strict';
$("#seo").change(function() {
    if(this.checked) {
        $('.showbox').removeClass('d-none');
    }else{
        $('.showbox').addClass('d-none');
    }
});

$("#title").keyup(function() {
  var Text = $(this).val();
  Text = Text.toLowerCase();
  Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
  $("#slug").val(Text);
});

</script>

@endsection
