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
            <h3 class="title text--white">@lang('Create a CTA Overlay')</h3>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
                </li>
                <li>
                    @lang('CTA Overlay')
                </li>
            </ul>
        </div>
        <div class="two">
            <a href="{{ route('user.create-overlay') }}" class="btn btn-primary">@lang('Create a CTA Overlay')</a>
        </div>
    </div>
   
    
</div>


</div>

<div class="dashborad--content">
    <div class="dashboard--content-item">
       

            <div class="row">
                <div class="col-md-9">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="icon h1 text-center ">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="title mb-2 mt-3">
                                                <p class="text-center font-weight-normal">@lang('CTA Contact')</p>
                                            </div>
                                            <div class="paragraph mt-4">
                                                <p class="text-center" style="font-size: 14px; line-height:20px">@lang('Create a contact form where users will be able to contact you via email.')</p>
                                            </div>

                                            <div class="button mt-4 text-center">
                                                <a href="{{ route('user.create-overlay.item','contact') }}" class="btn btn-primary btn-sm">{{ ('Create') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="icon h1 text-center ">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            <div class="title mb-2 mt-3">
                                                <p class="text-center font-weight-normal">@lang('CTA Poll')</p>
                                            </div>
                                            <div class="paragraph mt-4">
                                                <p class="text-center" style="font-size: 14px; line-height:20px">@lang('Create a quick poll where users will be able to answer it upon visit.')</p>
                                            </div>

                                            <div class="button mt-4 text-center">
                                                <a href="{{ route('user.create-overlay.item','poll') }}" class="btn btn-primary btn-sm">{{ ('Create') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="icon h1 text-center ">
                                                <i class="fas fa-comment" aria-hidden="true"></i>
                                            </div>
                                            <div class="title mb-2 mt-3">
                                                <p class="text-center font-weight-normal">@lang('CTA Message')</p>
                                            </div>
                                            <div class="paragraph mt-4">
                                                <p class="text-center" style="font-size: 14px; line-height:20px">@lang('Create a small popup with a message and a link to a page or a product.')</p>
                                            </div>

                                            <div class="button mt-4 text-center">
                                                <a href="{{ route('user.create-overlay.item','message') }}" class="btn btn-primary btn-sm">{{ ('Create') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">@lang('Info')</h5>
                            <p class="card-text text-justify">@lang('An overlay page allows you to display a small non-intrusive overlay on the destination website to advertise your product or your services. You can also use this feature to send a message to your users. You can customize the message and the appearance of the overlay right from this page. As soon as you save it, the changes will be applied immediately across all your URLs using this type. Please note that some secured and sensitive websites such as google.com or facebook.com do not work with this feature. You can have unlimited overlay pages and you can choose one for each URL.')</p>
                        </div>
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
    <h5 class="modal-title text-center">{{ __("Delete Splash") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{ __("You are about to delete this Splash.") }}</p>
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
