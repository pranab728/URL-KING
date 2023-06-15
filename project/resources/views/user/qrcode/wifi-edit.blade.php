@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>
@includeIf('partials.user.top-nav')
<div class="breadcrumb-area">
    <div class="d-flex justify-content-between">
        <div class="one">
            <h3 class="title text--white">@lang('Update QRcode')</h3>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
                </li>
                <li>
                    @lang('Update QRcode')
                </li>
            </ul>
        </div>
        <div class="two">
            <a href="{{ route('user.qr-code') }}" class="btn btn-primary">@lang('Back')</a>
        </div>
    </div>
</div>
</div>
<div class="dashborad--content">
    <div class="dashboard--content-item">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-center mb-4">@lang('Qr-code Type')</h6>
                       <hr>
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link {{ $view->type=='wifi' ? 'active':'' }}" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">@lang('Wifi')</button>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <label for="counter" class="form-label mb-3">@lang('QR Code Name')</label>
                        <input type="text" value="{{ $qr->name }}" id="name" class="form-control form--control bg--section" name="name" placeholder="e.g. For Facebook" required>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ $view->type=="wifi" ? 'show active':'' }}" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <form action="{{ route('user.update-wifi-qr',$qr->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="name" class="text_name" value="{{ $qr->name }}">
                                <h5 class="form-label mb-5">@lang('Wi-Fi')</h5>
                                <input type="hidden" name="type" value="wifi">
                                <div class="mb-3">
                                    <label for="text" class="form-label ">@lang('Network SSID')</label>
                                    <input type="text" class="form-control form--control bg--section" name="ssid" placeholder="e.g. 123455324" value="{{ $view->ssid }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label ">@lang('Password')</label>
                                    <input type="text" class="form-control form--control bg--section" value="{{ $view->password }}" name="password" placeholder="your password here...." required>
                                </div>
                                <div class="mb-3">
                                    <label for="text" class="form-label ">@lang('Encryption')</label>
                                   
                                    <select name="encryption" class="form-control form--control bg--section">
                                        <option {{ $view->encryption=='WEP' ? 'selected': '' }} value="WEP">WEP</option>
                                        <option {{ $view->encryption=='WPA' ? 'selected': '' }} value="WPA">WPA/WPA2</option>
                                        <option {{ $view->encryption=='nopass' ? 'selected': '' }}  value="nopass">nopass</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary mt-4" type="submit">@lang('Generate QRcode')</button>
                            </form>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Qr-code</h6>
                        <img class="img-fluid"   src="{{ asset('project/public/images/'.$view->image) }}" alt="">
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="footer-copyright text-center mt-auto">
       {!! $gs->copyright !!}
    </div>
</div>
{{-- Delete Modal Start --}}
<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog"
aria-labelledby="statusModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-center">{{ __("Delete Overlay") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{ __("You are about to delete this Overlay.") }}</p>
        <p class="text-center">{{ __("Do you want to proceed?") }}</p>
    </div>
    <div class="modal-footer">
    <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancel") }}</a>
    <a href="javascript:;" class="btn btn--danger btn-ok" id="del">{{ __("Delete") }}</a>
    </div>
</div>
</div>
</div>
{{-- Delete Modal Ends here --}}
</article>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">

$('.dismiss').on('click', function(){
    var link = $(this).data('href');
    
    $('#del').attr('href', link);
         });

var pane= $('#v-pills-tabContent').find('.active');
// alert(pane.attr('id'));

$('#name').on('keyup', function(){
    var name = $(this).val();
  $('#text_name').val(name);
});

</script>
@endpush



