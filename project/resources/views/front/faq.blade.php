@extends('layouts.front')

@push('css')

@endpush

@section('content')


<!-- Banner -->
<section class="hero-section inner-hero">
    <div class="container">
      <div class="inner-hero-text">
        <h2 class="title">@lang('FAQ')</h2>
        <ul class="breadcrumb">
          <li>
            <a href="index.html">@lang('Home')</a>
          </li>
          <li>
            @lang('Faq')
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Banner -->
 

  <section class="pb-100 faqs-section mt-5 ">
    <div class="container">
        
        <div class="accordion-wrapper">

           @foreach ($faqs as $faq)

           <div class="accordion-item {{ $loop->first ? 'active' : '' }}  open">
            <div class="accordion-title">
                <h5 class="title">
                   {{ $faq->title }}
                </h5>
                <span class="right-icon"></span>
            </div>
            <div class="accordion-content">
                <p>
                    {!! $faq->details !!}
                    
                </p>
                
            </div>
        </div>       
           @endforeach
            
            
            
           
        </div>
    </div>
</section>



@endsection
@push('js')

@endpush
