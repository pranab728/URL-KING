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
        <h3 class="title text--white">@lang('CTA Message')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('CTA Message')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">

                <div class="head mb-3">
                    <h3>@lang('Enter Your Custom Domain')</h3>
                    <hr>
                </div>
                <form id="userform" action="{{route('user.store-domain')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-body p-5 border-rounded">
                        <div class="content mt-4" id="first">
                            <p>To enable your Custom Domain, you must create a <b>CNAME record</b> with your domain host. Instructions are on next screen. </p>
        
                            <p class="mt-3">
                                You may use a sub-domain so as to not affect your main website.<b>
                                    WARNING: using your main website domain will cause your website to stop working. 
                                </b>
                            </p>
        
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label for="domain">@lang('Enter your Custom Domain below:')</label>
                                    <input id="domain" type="text" name="domain" class="form-control">
                                </div>
                            </div>
                            <div class="button mt-4 mb-4 text-center">
                            <span id="cntinue" class="btn btn-primary btn-sm mt-5">Continue</span>
                            </div>
                        </div> 
                         {{-- second page  --}}
                <div class="content mt-4" id="second">
                    <h5 class="mb-4">Changing Record on server</h5>
                    <p>To use the custom domain, you must change the CNAME record with your domain host (Note: DNS changes can take up 24 hours with some hosts but the changes can sometimes be seen in as little as a couple of hours.) </p>
                    <li><b>Step One:</b>Sign in to your domain hosting service.
                    </li>
                    <li><b>Step Two:</b>From your cPanel, access the Zone Editor under the Domains section.
                    </li>
                    <li><b>Step Three:</b>Find the domain you wish to edit the record for and select Manage.
                    </li>
                    <li>you can edit two field like this.</li>
                        <li class="mx-4">Record Type: CNAME
                        <li class="mx-4">Name: www.your domain.</li>

                    <li>Edit type with "CNAME" and record  with this domain-<b> {{ (request()->getHttpHost())}}</b></li>
                    
                    <li>Click on the Save button. The changes may take up to 48 hours to take effect.</li>
                   
                       <div class="button mt-4 mb-4 text-center">
                     <button type="submit" class="btn btn-primary" >Submit</button>
                       </div>

                </div> 
                    </div>
                </div>
            </form>
            <div class="footer-copyright text-center mt-auto">
                &copy; All Right Reserved by <a href="#0" class="text--base">Genius Short</a>
            </div>
        </div>
        </div>
    </article>

<!-- User Dashboard -->


@endsection

@push('js')
<script>
   
    
    $(document).ready(function(){
        
        $('#second').hide();
        $('#cntinue').on('click', function(){
            var domain = $('#domain').val();
            if(domain == ''){
                toastr.error('Please enter your domain');
            }else{
                $('#first').hide();
                $('#second').show();
            }
        })
    })


 
</script>

@endpush
