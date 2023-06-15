@extends('layouts.user')

@push('css')

@endpush
@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('All Transaction')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Transaction Log')
        </li>
    </ul>
</div>
</div>
<div class="dashborad--content">
    <div class="dashboard--content-item">
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
        {{ $transactions->links() }}
    </div>
    <div class="footer-copyright text-center mt-auto">
        {!! $gs->copyright !!}
    </div>
</div>
</article>

@endsection