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
            <h3 class="title text--white">@lang('All QRcode')</h3>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
                </li>
                <li>
                    @lang('All QRcode')
                </li>
            </ul>
        </div>
        <div class="two">
            <a href="{{ route('user.create-qr') }}" class="btn btn-primary">@lang('All QRcode')</a>
        </div>
    </div>
</div>
</div>
<div class="dashborad--content">
    <div class="dashboard--content-item">
        <div class="dashboard--wrapper">
            @foreach ($qrs as $qr) 
            <div class="dashboard--width">
                <div class="dashboard-card">
                    <div class="dashboard-card__header">
                        <div class="dashboard-card__header__icon">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div class="dashboard-card__header__cont">
                            <div class="dropdown btn-group">    
                                <p class="name">{{ $qr->name }}</p>
                                <button type="button " id="dropdown" class="btn  btn-rounded btn-sm " data-bs-toggle="dropdown"  aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-three-dots align-top" viewBox="0 0 15 12">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                      </svg>
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" aria-labelledby="dropdown">
                                    @if(json_decode($qr->data)->type =='text')                                    
                                    <a id="link"  href="{{ route('user.edit-text-qr',$qr->id) }}"   class="dropdown-item link-status" >@lang("Edit")</a>
                                    @endif
                                    @if(json_decode($qr->data)->type =='sms')
                                    <a id="link"  href="{{ route('user.edit-sms-qr',$qr->id) }}"   class="dropdown-item link-status" >@lang("Edit")</a>
                                    @endif
                                    @if(json_decode($qr->data)->type =='wifi')
                                    <a id="link"  href="{{ route('user.edit-wifi-qr',$qr->id) }}"   class="dropdown-item link-status" >@lang("Edit")</a>
                                    @endif

                                    @if(json_decode($qr->data)->type =='vcard')
                                    <a id="link"  href="{{ route('user.edit-vcard-qr',$qr->id) }}"   class="dropdown-item link-status" >@lang("Edit")</a>
                                    @endif
                                    <a  href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteModal" class="dropdown-item link-status dismiss" data-href="{{ route('user.delete-text-qr',$qr->id) }}">@lang("Delete")</a>
                                  </div>
                              </div> 
                              <br>
                              <small class="bg-primary text-light p-1 rounded" style="font-size: 12px">{{ json_decode($qr->data)->type }}</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p> <small>{{ $qr->created_at->diffForHumans() }}</small></p>
                    </div>    
                </div>
            </div>
            @endforeach           
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
    <h5 class="modal-title text-center">{{ __("Delete QRcode") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{ __("You are about to delete this QRcode.") }}</p>
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


</script>


@endpush
