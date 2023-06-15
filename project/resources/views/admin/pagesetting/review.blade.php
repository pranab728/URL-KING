@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Customer Review') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.ps.review') }}">{{ __('Customer Review') }}</a></li>
	</ol>
	</div>
</div>


<!-- Row -->
<div class="row mt-3">
  <!-- Datatables -->
  <div class="col-lg-12">

	@include('includes.admin.form-success')


    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Customer Review') }}</h6>
        </div>

        <div class="card-body">
          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
          <form action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">
              @include('includes.admin.form-both')

              {{ csrf_field() }}

              <div class="form-group">
                  <label for="title">{{ __('Review Section Title') }} *</label>
                  <input type="text" class="form-control" id="title" name="review_title"  placeholder="{{ __('Title Here.....') }}" value="{{ $ps->review_title }}" required>
              </div>

              <div class="form-group">
                <label for="text">{{ __('Review Section Text') }} *</label>
                <textarea name="review_text" id="text" cols="30" rows="5" class="form-control summernote" placeholder="{{ __('Review Text') }}" required>{{ $ps->review_text }} </textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

          </form>
        </div>
      </div>

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
                <th>{{ __('Featured Image') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Details') }}</th>\
                <th>{{ __('Ratings') }}</th>
                <th>{{ __('Options') }}</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
  <!-- DataTable with Hover -->

</div>
<!--Row-->

{{-- STATUS MODAL --}}

<div class="modal fade confirm-modal" id="statusModal" tabindex="-1" role="dialog"
	aria-labelledby="statusModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title">{{ __("Update Status") }}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div class="modal-body">
			<p class="text-center">{{ __("You are about to change the status.") }}</p>
			<p class="text-center">{{ __("Do you want to proceed?") }}</p>
		</div>
		<div class="modal-footer">
		<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
		<a href="javascript:;" class="btn btn-success btn-ok">{{ __("Update") }}</a>
		</div>
	</div>
	</div>
</div>

{{-- STATUS MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog"
aria-labelledby="deleteModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">{{ __("Confirm Delete") }}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
	<p class="text-center">{{__("You are about to delete this Blog.")}}</p>
	<p class="text-center">{{ __("Do you want to proceed?") }}</p>
</div>
<div class="modal-footer">
	<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
	<a href="javascript:;" class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
</div>
</div>
</div>
</div>

{{-- DELETE MODAL ENDS --}}

@endsection



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">
	"use strict";

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               searching: false,
               ajax: '{{ route('admin.rating.datatables') }}',
               columns: [

                        { data: 'photo', name: 'photo' , searchable: false, orderable: false},
                        { data: 'name', name: 'name' },
                        { data: 'details', name: 'details' },
                        { data: 'rating', name: 'rating' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

			$(function() {
            $(".btn-area").append('<div class="col-sm-12 col-md-4 pr-3 text-right">'+
                '<a class="btn btn-primary" href="{{route('admin.rating.create')}}">'+
            '<i class="fas fa-plus"></i> Add New Client'+
            '</a>'+
            '</div>');
        });



{{-- DATA TABLE ENDS--}}


</script>





@endsection
