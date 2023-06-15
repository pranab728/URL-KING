@extends('layouts.admin')

@section('styles')

<style type="text/css">
    .table-responsive {
    overflow-x: hidden;
}
table#example2 {
    margin-left: 10px;
}

</style>

@endsection

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('User Details') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

        <li class="breadcrumb-item"><a href="{{ route('admin.user.show',$data->id) }}">{{ __('User Details') }}</a></li>
    </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="user-image">
                        <img src="{{ $data->photo ? asset('assets/images/user/'.$data->photo) : asset('assets/images/placeholder.jpg') }}" alt="No Image">

                    <a href="javascript:;" id="send" class="mybtn1 send btn btn-primary mb-3" data-email="{{ $data->email }}" data-toggle="modal" data-target="#vendorform">{{ __("Send Message") }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-link-tab" data-bs-toggle="pill" data-bs-target="#v-pills-link" type="button" role="tab" aria-controls="v-pills-link" aria-selected="true">{{ __('Links') }}</button>
                    <button class="nav-link" id="v-pills-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details" aria-selected="false">{{ __('Details') }}</button>

                  </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mt-3">

        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-link" role="tabpanel" aria-labelledby="v-pills-link-tab">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('All Links') }}</h6>
                    </div>
                    <div class="card">
                        <div class="table-responsive show-table">
                            <table class="table">
                            <tr>
                                <th>@lang('Link')</th>
                                <th>@lang('Total Click')</th>
                                <th>@lang('Alias')</th>
                            </tr>
                            @foreach ($links as $link)
                            <tr>
                                <td>{{ url('/'.$link->alias) }}</td>
                                <td>{{ $link->click }}</td>
                                <td>{{ $link->alias }}</td>
                            </tr>
                            @endforeach
                            
                           
                            </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('Details') }}</h6>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="table-responsive show-table">
                                <table class="table">
                                <tr>
                                    <th>{{__('ID#')}}</th>
                                    <td>{{$data->id}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Username')}}</th>
                                    <td>{{$data->username}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Email')}}</th>
                                    <td>{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Address')}}</th>
                                    <td>{{$data->address}}</td>
                                </tr>
                                </table>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="card">
                            <div class="table-responsive show-table">
                                <table class="table">

                                        <tr>
                                            <th>{{__('Plan')}}</th>
                                            <td>{{$data->planid==0 ? __('Free') : __('Pro')}}</td>
                                        </tr>
                                        <tr>
                                            <th>{{__('Phone')}}</th>
                                            <td>{{$data->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>{{__('Status')}}</th>
                                            <td>
                                            @if ($data->ban==0)
                                            <button class="btn btn-success btn-sm">{{ __('Active') }}</button>
                                            @else
                                            <button class="btn btn-danger btn-sm">{{ __('Banned') }}</button>
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{__('Joined')}}</th>
                                            <td>{{$data->created_at->diffForHumans()}}</td>
                                        </tr>
                                    </table>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>

    </div>
</div>


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


{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal fade confirm-modal" id="vendorform" tabindex="-1" role="dialog"
    aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form">
                            <form id="emailreply2" >
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="email" class="form-control" id="eml1" name="to"  placeholder="{{ __('Email') }}" value="" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subj1" name="subject"  placeholder="{{ __('Subject') }}" value="" required="">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="msg1" cols="20" rows="6" placeholder="{{ __('Your Message') }} "required=""></textarea>
                                </div>



                                <button class="submit-btn btn btn-primary text-center" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
                            </form>
                        </div>
                    </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    {{-- MESSAGE MODAL ENDS --}}

{{-- MESSAGE MODAL ENDS --}}

@endsection

@section('scripts')

<script type="text/javascript">

(function($) {
		"use strict";

$('#example2').dataTable( {
  "ordering": false,
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      'responsive'  : true
} );




})(jQuery);

</script>


@endsection
