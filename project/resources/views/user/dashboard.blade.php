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
        <h3 class="title text--white">@lang('Dashboard')</h3>
        <ul class="breadcrumb">
            <li>
                <a href="user-dashboard.html">@lang('Dashboard')</a>
            </li>
            <li>
                @lang('Dashboard')
            </li>
        </ul>
    </div>
</div>
        <div class="dashborad--content">
            <div class="dashboard--content-item">
                <div class="dashboard--wrapper">
                    <div class="dashboard--width">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header">
                                <div class="dashboard-card__header__icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="dashboard-card__header__cont">
                                    <h4 class="name">{{ convert(Auth::user()->amount) }} {{ $curr->sign }}</h4>
                                    <div class="balance">@lang('Total Balance')</div>
                                </div>
                            </div>
                            <div class="dashboard-card__content">
                                <h6 class="m-0">
                                    <a href="deposit-history.html" class="btn btn--base btn-sm w-100">@lang('View Transaction
                                        Log')</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard--width">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header">
                                <div class="dashboard-card__header__icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="dashboard-card__header__cont">
                                    <h4 class="name">{{ $subscription->title }}</h4>
                                    <div class="balance">@lang('Current Plan')</div>
                                </div>
                            </div>
                            <div class="dashboard-card__content">
                                <h6 class="m-0">
                                    <a href="{{ route('user.plan.log') }}" class="btn btn--base btn-sm w-100">@lang('View Plan
                                        Log')</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard--width">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header">
                                <div class="dashboard-card__header__icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="dashboard-card__header__cont">
                                    <h4 class="name">{{ $links->count() }}</h4>
                                    <div class="balance">@lang('Total Shorten')</div>
                                </div>
                            </div>
                            <div class="dashboard-card__content">
                                <h6 class="m-0">
                                    <a href="{{ route('all.short.link') }}" class="btn btn--base btn-sm w-100">@lang('View All
                                        Link')</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard--width">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header">
                                <div class="dashboard-card__header__icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="dashboard-card__header__cont">
                                    <h4 class="name">{{ $subscription->allowed_url-$links->count() }}</h4>
                                    <div class="balance">@lang('Remaining Shorten')</div>
                                </div>
                            </div>
                            <div class="dashboard-card__content">
                                <h6 class="m-0">
                                    <a href="{{ route('front.index') }}" class="btn btn--base btn-sm w-100">@lang('Create Link')</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <form class="" id="user-short" action="{{ route('front.shortlink') }}">
                            @csrf
                        <div class="card-body ">
                           
                            <div class="form-group my-4">
                                <label for="my-select">SelectDomain</label>
                                <select id="my-select" class="form-control" name="custom">
                                    <option value="{{ url('/') }}">{{ url('/') }}</option>
                                    @if (Auth::user()->domains->count() > 0)
                                    @foreach (App\Models\Domain::with('user')->whereStatus(1)->get() as $item)
                                    <option value="{{ $item->domain }}">{{ $item->domain }}</option>
                                    @endforeach  
                                    @endif

                                </select>
                            </div>
                           
                            <div class="item d-flex">

                               
                              
                                <input type="text" name="url" class="form-control" id="" required>
                                <a class="btn btn-warning" id="custom"><i class='fas fa-tasks'></i></a>
                                <button class="btn btn-primary btn-sm " type="submit">Shorten</button>
                               
                            </div>
                        

                           <div class="row d-none"  id="extra">
                            <div class="form-group mt-3 col-sm-6">
                                <label for="type">@lang('Redirect')</label>
                                <select id="type" class="form-control" name="type">
                                    <option value="direct">Direct</option>
                                    <option value="splash">Splash</option>
                                    @if(Auth::user()->splash->count() > 0)
                                    <option value="custom_splash">@lang('Custom Splash')</option>
                                    @endif

                                    @if(Auth::user()->overlay->count() > 0)
                                    <option value="custom_overlay">@lang('Custom Overlay')</option>
                                    @endif
                                    
                                </select>
                            </div>

                            <div class="form-group mt-3 col-sm-6 d-none" id="splash_div">
                                <label for="splash_id">@lang('Custom Splash')</label>
                                <select id="splash_id" class="form-control" name="splash_id">
                                    @foreach (Auth::user()->splash as $sp)
                                    <option value="{{ $sp->id }}">{{ $sp->name }}</option>     
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group mt-3 col-sm-6 d-none" id="overlay_div">
                                <label for="overlay_id">@lang('Custom Overlay')</label>
                                <select id="overlay_id" class="form-control" name="overlay_id">
                                    @foreach (Auth::user()->overlay as $overlay)
                                    <option value="{{ $overlay->id }}">{{ $overlay->name }}</option>     
                                    @endforeach
                                    
                                </select>
                            </div>


                            <div class="form-group mt-3 col-sm-6">
                                <label for="type">@lang('Custom Alias')</label>
                                <input type="text" name="alias" class="form-control" id="custom_alias">   
                            </div>

                            <div class="form-group mt-3 col-sm-6">
                                <label for="expire_day">@lang('Expire Day') <small>@lang('(number of days)')</small></label>
                                <input type="number" name="expire_day" class="form-control" id="expire_day">   
                            </div>

                            @if (Auth::user()->pixels->count() > 0)
                            <div class="form-group mt-3 col-sm-6">
                                <label for="type">@lang('Tracking Pixel')</label>
                                <select id="type" class="form-control" name="pixel">
                                    
                                    <option value="null">@lang('Select Pixel Tracking')</option>
                                    @foreach (Auth::user()->pixels as $pixel)
                                    <option value="{{ $pixel->name }}">{{ $pixel->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                               
                            @endif
                            

                           </div>
 
                        </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card pb-3">
                        <div class="card-body">
                            @foreach ($links as $key=>$link)
                            
                            <div class="title">
                                
                               <a href="{{ url('/'.$link->alias)}}">{{ $key+1 }}. {{ get_title($link->url) }}</a>
                               <p><small class="ln-text">{{ \Carbon\Carbon::parse($link->created_at)->diffForHumans() }} - {{ $link->click }} {{ __('Clicks') }}</small></p>
                               <hr>
                                
                            </div>
                                
                            @endforeach
                            
                        </div>
                        {{  $links->links()  }}
                    </div>
            </div>
            
            <div class="dashboard--content-item mt-4">
                <h5 class="dashboard-title">@lang('Transactions')</h5>
                <div class="table-responsive table--mobile-lg">
                    <table class="table bg--body">
                        <thead>
                            <tr>
                                <th>@lang('Date')</th>
                                <th>@lang('Transaction ID')</th>
                                <th>@lang('Details')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Currency')</th>
                                <th>@lang('Method')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('m-d-Y') }}</td>
                                    <td>{{ $transaction->txn_number}}</td>
                                    <td>{{ $transaction->details }}</td>
                                    <td class="{{ $transaction->type =='plus' ? 'text-primary' : 'text-danger' }}">{{ $transaction->type =='plus' ? '+' : '-' }}{{ $transaction->amount*$transaction->currency_value }}</td>
                                    <td>{{ $transaction->currency_code }}</td>
                                    <td>{{ $transaction->method }}</td>
                                </tr>
                   @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer-copyright text-center mt-auto">
                {!! $gs->copyright !!}
            </div>
        </div>
    </article>

<!-- User Dashboard -->


<div class="modal fade confirm-modal" id="copyModal" tabindex="-1" role="dialog"
aria-labelledby="statusModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-center">{{ __("Copy Modal") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <div class="input-group">
            <input type="text" name="url" id="surl" class="form-control form--control bg--section"
                placeholder="Enter Your URL and shorten it" value="">
                @if(isset($copylink->alias))
                    <button id="copy" type="submit" data-value="{{ Auth::user() ? $copylink->alias : '' }}" class="cmn--btn">@lang('Copy')</button>
                @endif
               
                
                {{-- {{ SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(100)->generate($copylink->alias) }} --}}
        </div>
        
    </div>

</div>
</div>
</div>


@endsection

@push('js')
<script>


$(document).ready(function(){

    $('#custom').on('click', function(){
        $('#extra').toggleClass('d-none');
    });
        
    });

    
    






    $(document).ready(function(){
        $('#type').on('change',function(){
            var conceptName = $('#type').find(":selected").val();
            if(conceptName == 'custom_splash'){
                $('#splash_div').removeClass('d-none');
        }
        else{
            $('#splash_div').addClass('d-none');
        } 
    });
    });


    $(document).ready(function(){
        $('#type').on('change',function(){
            var conceptName = $('#type').find(":selected").val();
            if(conceptName == 'custom_overlay'){
                $('#overlay_div').removeClass('d-none');
        }
        else{
            $('#overlay_div').addClass('d-none');
        } 
    });
    });
</script>

@endpush
