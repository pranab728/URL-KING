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
            <a href="user-dashboard.html">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Support Tickets')
        </li>
    </ul>
</div>
</div>
    <div class="dashborad--content">
        <div class="dashboard--content-item">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card default--card h-100">
                        <div class="card-body">
                            <div class="chatbox__list__wrapper">
                                <div class="d-flex justify-content-between py-4 border-bottom border--dark">
                                    <h3><a href="javascript:void(0)">@lang('Tickets')<i class="fas fa-arrow-right "></i></a>
                                    </h3>

                                </div>

                                <ul class="chat__list nav-tab nav border-0">

                                    @foreach ($convs as $conv)
                                    <li>
                                        <a href="javascript:;" class="chat__item tckt" data-href="{{ route('ticket.load',$conv->id) }}" data-bs-toggle="tab">
                                            <div class="item__inner">
                                                <div class="post__creator">
                                                    <div class="post__creator-thumb d-flex justify-content-between">
                                                        <span class="username">{{ $conv->ticket }} </span>
                                                    </div>
                                                    <div class="post__creator-content">
                                                        <h4 class="name d-inline-block">{{ $conv->subject }}</h4>
                                                    </div>
                                                </div>
                                                <ul class="chat__meta d-flex justify-content-between">
                                                    <li><span class="last-msg"></span></li>
                                                    <li><span class="last-chat-time">{{ $conv->created_at->diffForHumans() }}</span></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </li>

                                    @endforeach



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card default--card h-100">
                        <div class="card-body " id="load-conv">
                            @includeIf('load.ticket')
                        </div>
                    </div>
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
<script>


        $(document).on("click", ".tckt", function (e) {
			e.preventDefault();
			$.get($(this).data("href"), function () {

					$("#load-conv").load(mainurl + "/conv/view");
                    

			});
			return false;
		});


</script>

@endpush
