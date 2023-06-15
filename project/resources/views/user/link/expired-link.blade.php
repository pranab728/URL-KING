@extends('layouts.user')

@push('css')

@endpush

@section('content')

<article class="main--content">
    <div class="dashboard-header position-relative">
<div class="bg--gradient">&nbsp;</div>

@includeIf('partials.user.top-nav')

<div class="breadcrumb-area">
    <h3 class="title text--white">@lang('Expired Links')</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
        </li>
        <li>
            @lang('Expired URL')
        </li>
    </ul>
</div>
</div>

<div class="dashborad--content">
    <div class="dashboard--content-item">
        <h5 class="dashboard-title">@lang('Link List')</h5>
        <div class="table--mobile-lg">
            <table class="table bg--body " id="link-table">
                <thead>
                    <tr>
                        <th>@lang('Alias')</th>
                        <th>@lang('URLs')</th>
                        <th>@lang('Total Click')</th>
                        <th>@lang('Plan')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Expire')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody id="link-table">
                    @foreach ($links as $link)

                    @if (checkexpire($link->id)=='Expired')     
                    <tr>
                        <td data-label="Payment Method">
                            <div>
                                {{ $link->alias }}
                            </div>
                        </td>
                        <td data-label="Payment Method">
                            <div>
                               <a href="{{ url($link->custom.'/'.$link->alias)}}" class="btn btn--primary btn-sm"> <i class="fas fa-link"></i> </a>
                               <a id="copy-user" href="javascript:;" class="btn btn--success btn-sm" data-value="{{ $link->custom.'/'.$link->alias }}"> <i class="fas fa-copy"></i> </a>
                            </div>
                        </td>
                        <td data-label="Rate">
                            <div>
                                {{ $link->click }}
                            </div>
                        </td>
                        <td data-label="Limits">
                            <div>
                                @if ($link->planid==0){
                                    <span class="badge btn--warning btn-sm">@lang('Free')</span>
                                }
                                @else
                                <span class="badge btn--primary btn-sm">@lang('Premium')</span>
                                @endif
                            </div>
                        </td>
                        <td data-label="Status">

                           
                              <div class="dropdown btn-group mb-1">
                                <button type="button" id="dropdown" class="btn btn--{{ $link->status == 1 ? 'danger'   : 'success'; }} btn-sm btn-rounded dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{$link->status == 1 ? __('Deactive') : __('Active')}}
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" aria-labelledby="dropdown">
                                  <a  href="javascript:;" data-bs-toggle="modal" data-bs-target="#statusModal" class="dropdown-item link-status" data-href=" {{ route('user.link.status',['id1' => $link->id, 'id2' => 0]) }}">@lang("Active")</a>

                                  <a  href="javascript:;" data-bs-toggle="modal" data-bs-target="#statusModal" class="dropdown-item link-status" data-href="{{ route('user.link.status',['id1' => $link->id, 'id2' => 1]) }}">@lang("Deactive")</a>
                                </div>
                              </div>  
                        </td>
                       

                        <td data-label="Payment Method">
                            <div>
                               
                                <button class="btn btn--danger btn-sm">@lang('Expired')</button>

                               
                               
                            </div>
                        </td>

                        <td data-label="Actions">
                            <div class="dropdown btn-group mb-1">
                               <button type="button" id="dropdown2" class="btn btn--primary btn-sm btn-rounded dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('Actions')
                               </button>
                               <div class="dropdown-menu" x-placement="bottom-start" aria-labelledby="dropdown2">
                                 <a href=" {{ route('user.link.edit',$link->id) }}"class="dropdown-item">@lang("Edit")</a>
                                 
                                 <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteModal" class="dropdown-item dismiss" data-href="{{ route('user.link.delete',$link->id) }}">@lang("Delete")</a>
                               </div>
                             </div> 
                       </td>
                    </tr> 
                    @else
                          
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $links->links() !!}
    </div>
    <div class="footer-copyright text-center mt-auto">
        {!! $gs->copyright !!}
    </div>
</div>
</article>


{{-- STATUS MODAL --}}

<div class="modal fade confirm-modal" id="statusModal" tabindex="-1" role="dialog"
aria-labelledby="statusModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-center">{{ __("Update Status") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{ __("You are about to change the status.") }}</p>
        <p class="text-center">{{ __("Do you want to proceed?") }}</p>
    </div>
    <div class="modal-footer">
    <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Cancel") }}</a>
    <a href="javascript:;" class="btn btn-success btn-ok" id="btn-ok">{{ __("Update") }}</a>
    </div>
</div>
</div>
</div>

{{-- STATUS MODAL ENDS --}}

{{-- Delete Modal Start --}}

<div class="modal fade confirm-modal" id="deleteModal" tabindex="-1" role="dialog"
aria-labelledby="statusModalTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-center">{{ __("Delete Link") }}</h5>
    <button type="button" class="close btn btn--danger" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
        <p class="text-center">{{ __("You are about to delete this Link.") }}</p>
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




@endsection

@push('js')
<script>

$('.link-status').on('click', function () {
   var link= $(this).data('href')
   
   $('#btn-ok').attr('href', link);
         });


$('.dismiss').on('click', function(){
    var link = $(this).data('href');
    
    $('#del').attr('href', link);
         });
    
    

    

</script>


@endpush
