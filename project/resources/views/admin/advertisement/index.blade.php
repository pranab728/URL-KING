@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Advertisement') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.ad.index') }}">{{ __('Advertisement') }}</a></li>
	</ol>
	</div>
</div>


<!-- Row -->
<div class="row mt-3">
  <!-- Datatables -->
  <div class="col-lg-12">

	@include('includes.admin.form-success')

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
                <th>{{ __('Ad URL') }}</th>
                <th>{{ __('Expression') }}</th>
                <th>{{ __('Status') }}</th>
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

{{-- Advertisement Create MODAL  Start--}}

<div class="modal fade confirm-modal" id="adcreate" tabindex="-1" role="dialog"
aria-labelledby="deleteModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">{{ __("Add Advertisement") }}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ route('admin.ad.store') }}" method="POST">
    @csrf
<div class="modal-body">
        <div class="form-group">
            <label for="inp-name">{{ __('Ad URL') }}</label>
            <input type="text" class="form-control" id="inp-name" name="ad_url"  placeholder="{{ __('Enter Advertise URL') }}" required>
        </div>
</div>
<div class="modal-footer">
	<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
	<button type="submit" class="btn btn-success ok">{{ __("Submit") }}</button>
</div>
</form>
</div>
</div>
</div>

{{-- Advertisement Create Modal END --}}

{{-- Advertisement Edit MODAL  Start--}}

<div class="modal fade confirm-modal" id="editModal" tabindex="-1" role="dialog"
aria-labelledby="deleteModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">{{ __("Edit Advertisement") }}</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
<form  id="editaddform" action="" method="POST">
    @csrf
<div class="modal-body">
        <div class="form-group">
            <label for="ad_url">{{ __('Ad URL') }}</label>
            <input type="text" class="form-control" id="ad_url" name="ad_url"  placeholder="{{ __('Enter Advertise URL') }}" required>
        </div>
</div>
<div class="modal-footer">
	<a href="javascript:;" class="btn btn-secondary" data-dismiss="modal">{{ __("Cancel") }}</a>
	<button type="submit" class="btn btn-success ok">{{ __("Submit") }}</button>
</div>
</form>
</div>
</div>
</div>

{{-- Advertisement Edit Modal END --}}

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
               ajax: '{{ route('admin.ad.datatables') }}',
               columns: [

                        { data: 'ad_url', name: 'ad_url' , searchable: false, orderable: false},
                        { data: 'expression', name: 'expression' },
                        { data: 'status', name: 'status' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

			$(function() {
            $(".btn-area").append('<div class="col-sm-12 col-md-4 pr-3 text-right">'+
                '<a href="javascript:;" data-toggle="modal" data-target="#adcreate" class="btn btn-primary text-white" >'+
            '<i class="fas fa-plus"></i> Add New Ad'+
            '</a>'+
            '</div>');
        });


        $(document).on('click','#editadd',function(){
            var data= $(this).data('value');
            $('#ad_url').val(data);

            var href = $(this).data('href');
            $('#editaddform').prop('action',href);
        })

</script>

@endsection

