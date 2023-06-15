@if (Session::has('loaddata'))

<div class="tab-content">
    <div class="tab-pane show fade active tckpane" id="">
        <div class="chat__msg">
            <div class="chat__msg-header py-2">
                <div class="post__creator align-items-center">

                    <div class="post__creator-content">
                        <h4 class="name d-inline-block">@lang('Ticket Number') : {{ Session::get('loaddata')->ticket }}
                        </h4>
                    </div>
                    <a class="profile-link" href="javascript:void(0)"></a>
                </div>
            </div>

            <div class="chat__msg-body">
                <ul class="msg__wrapper mt-3">



                    @foreach (Session::get('loaddata')->messages as $message)

                    @if ($message->user_id == 0  )
                    <li class="incoming__msg">
                        <div class="msg__item">
                            <div class="post__creator">
                                <div class="post__creator-content">
                                    <p>{{ $message->message }}</p>
                                    <span class="comment-date text--secondary">{{$message->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                        </div>
                    </li>


                    @else
                    <li class="outgoing__msg">
                        <div class="msg__item">
                            <div class="post__creator ">
                                <div class="post__creator-content">
                                    <p class="out__msg">{{ $message->message }}</p>
                                    <span class="comment-date text--secondary">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </li>

                    @endif




                    @endforeach



                </ul>
            </div>
            <div class="chat__msg-footer">
                <form id="messageform" class="send__msg" action="{{route('user.message.store')}}" data-href="{{ route('ticket.load',Session::get('loaddata')->id) }}" method="POST">
                    {{csrf_field()}}

                    <input type="hidden" name="conversation_id" value="{{Session::get('loaddata')->id}}">
                    <input type="hidden" name="user_id" value="{{Session::get('loaddata')->user_id}}">

                    <div class="input-group">
                        <textarea class="form-control rounded form--control shadow-none"
                            name="message" id="wrong-invoice" required=""></textarea>
                        <button class="border-0 outline-0 send-btn mybtn1" type="submit"><i
                                class="fab fa-telegram-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endif
