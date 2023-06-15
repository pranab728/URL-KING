@extends('layouts.user')

@push('css')

@endpush
@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>
@includeIf('partials.user.top-nav')
<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Deposit History')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Deposit History')
        </li>
    </ul>
</div>
</div>
<div class="dashborad--content">
    <div class="dashboard--content-item">
        <h5 class="dashboard-title">@lang('Deposit History')</h5>
        <div class="table-responsive table--mobile-lg">
            <table class="table bg--body">
                <thead>
                    <tr>
                        <th>@lang('Date')</th>
                        <th>@lang('Transaction ID')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Currency')</th>
                        <th>@lang('Method')</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($deposits as $deposit)
                    <tr>
                      
                        <td>{{ $deposit->created_at->format('m-d-Y') }}</td>
                        <td>{{ $deposit->txnid}}</td>
                       
                        <td>{{ $deposit->amount*$deposit->currency_value }}</td>
                        <td>{{ $deposit->currency_code }}</td>
                        <td>{{ $deposit->method }}</td>
                    </tr>
                   @endforeach
                </tbody>
                
            </table>
           
        </div>
        {{ $deposits->links() }}
    </div>
    <div class="footer-copyright text-center mt-auto">
        {!! $gs->copyright !!}
    </div>
</div>
</article>

@endsection