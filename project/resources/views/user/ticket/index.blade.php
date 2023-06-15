@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Support Tickets')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Support Tickets')
        </li>
    </ul>
</div>
</div>
    <div class="dashborad--content">
        <div class="dashboard--content-item">
            <h4 class="dashboard-title d-flex flex-wrap justify-content-between align-items-center">
                <span>
                    @lang('Create New Ticket')
                </span>
                <a href="{{ route('user.tickets.all') }}" class="cmn--btn font--sm">@lang('View Ticket')</a>
            </h4>
            <div class="create-offer-wrapper">
                <div class="create-offer-body">
                    <form id="emailreply1" class="create-offer-form" action="{{ route('user.send.message') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <label for="name" class="form-label text--primary">@lang('Your Name')</label>
                                <input type="text" id="name" name="name" class="form-control form--control bg--section"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="form-label text--primary">@lang('Email Address')</label>
                                <input type="email" id="email" name="email" class="form-control form--control bg--section"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="col-sm-6">
                                <label for="subject" class="form-label text--primary">@lang('Subject')</label>
                                <input type="text" id="subj1" name="subject" class="form-control form--control bg--section" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text--primary" for="phone">@lang('Phone')</label>
                                <input type="text" id="phone" name="phone" class="form-control form--control bg--section"
                                    value="{{ Auth::user()->phone }}">
                            </div>
                            <div class="col-sm-12">
                                <label for="msg1" class="form-label text--primary">@lang('Your
                                    Message')</label>
                                <textarea class="form-control form--control bg--section"
                                    id="msg1" name="text"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-end">
                                    <button type="submit" class="submit-btn cmn--btn rounded next-step" id="emlsub1">
                                        <i class="fas fa-plus"></i> @lang('Create
                                        New Ticket')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center mt-auto">
           {!! $gs->copyright !!}
        </div>
    </div>
</article>

@endsection

@push('js')

@endpush
