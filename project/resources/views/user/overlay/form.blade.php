@if ($slug == 'contact')
    @include('user.overlay.contact')
    
@elseif($slug == 'poll')
    @include('user.overlay.poll')
@else
    @include('user.overlay.message')
@endif