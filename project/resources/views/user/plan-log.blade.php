@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Plan History')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Plan Log')
        </li>
    </ul>
</div>
</div>

<div class="dashborad--content">
    <div class="dashboard--content-item">
        <h5 class="dashboard-title">@lang('Plan Log')</h5>
        <div class="table-responsive table--mobile-lg">
            <table class="table bg--body " id="link-table">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>@lang('Plan')</th>
                        <th>@lang('Price')</th>
                        <th>@lang('Allowed URL')</th>
                        <th>@lang('Click Limit')</th>
                        <th>@lang('Method')</th>
                        <th>@lang('Expire Date')</th>
                        <th>@lang('Status')</th>
                        
                    </tr>
                </thead>
                <tbody id="link-table">
                    
                        
                   
                    @foreach ($plans as $plan)

                    <tr>
                        <td data-label="Payment Method">
                            <div>
                                {{$loop->iteration}}
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>
                                {{ $plan->title }}
                            </div>
                        </td>

                        <td data-label="Rate">
                            <div>
                                {{ $plan->price }}
                            </div>
                        </td>

                        <td data-label="Rate">
                            <div>
                                {{ $plan->allowed_url }}
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>
                                {{ $plan->click_limit }}
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>
                                {{ $plan->method }}
                            </div>
                        </td>

                        <td data-label="Rate">
                            <div>
                                {{ $plan->created_at->adddays($plan->days) }}
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>

                                @if ($plan->status==1)
                                    
                                <button class="btn btn--success btn-sm">@lang('Active')</button>
                                @else
                                <button class="btn btn--warning btn-sm">@lang('Deactive')</button>

                                @endif
                            </div>
                        </td>
                        

                       
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $plans->links() !!}
    </div>
    <div class="footer-copyright text-center mt-auto">
        {!! $gs->copyright !!}
    </div>
</div>
</article>

@endsection

@push('js')

@endpush
