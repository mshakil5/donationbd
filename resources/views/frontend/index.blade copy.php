@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<section class="banner py-4 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-center column-hide">
                        <div class="inner w-75">
                            <div class="intro-title">
                                {{\App\Models\Slider::where('id','1')->first()->left_title}}
                            </div>
                            <p class="txt-theme mb-4">{{\App\Models\Slider::where('id','1')->first()->left_description}}</p>
                        

                            <div class="">
                                <a href="{{route('register')}}" class="btn-theme bg-secondary">Open an account</a>
                                <a href="{{route('frontend.work')}}" class="btn-theme bg-primary">How it works</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 steps my-5">
                        <div class="w-100 px-3">
                            <div class="row mb-4">
                                <h3 class="  lh-1 fw-bold" style="color:#265080;">
                                    {{\App\Models\Slider::where('id','1')->first()->right_header}}
                                </h3>
                            </div>
                            <div class="inner">
                                <div class="items">
                                    <div class="circle shadow-sm">
                                        <iconify-icon class="fs-1 txt-primary "
                                            icon="material-symbols:filter-1-rounded"></iconify-icon>
                                    </div>
                                    <div class="content">
                                        <h3 class="mb-1 fw-bold txt-primary">{{\App\Models\Slider::where('id','1')->first()->right_title1}}</h3>
                                        <p class="mb-1 txt-theme">{{\App\Models\Slider::where('id','1')->first()->right_description1}}</p>
                                    </div>
                                </div>
                                <div class="items">
                                    <div class="circle shadow-sm">

                                        <iconify-icon class="fs-1 txt-primary "
                                            icon="material-symbols:filter-2"></iconify-icon>
                                    </div>
                                    <div class="content">
                                        <h3 class="mb-1 fw-bold txt-primary">{{\App\Models\Slider::where('id','1')->first()->right_title2}}</h3>
                                        <p class="mb-1 txt-theme">{{\App\Models\Slider::where('id','1')->first()->right_description2}}</p>
                                    </div>
                                </div>
                                <div class="items">
                                    <div class="circle shadow-sm">
                                        <iconify-icon class="fs-1 txt-primary "
                                            icon="material-symbols:filter-3"></iconify-icon>
                                    </div>
                                    <div class="content">
                                        <h3 class="mb-1 fw-bold txt-primary">{{\App\Models\Slider::where('id','1')->first()->right_title3}}</h3>
                                        <p class="mb-1 txt-theme">{{\App\Models\Slider::where('id','1')->first()->right_description3}}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mobile-adjust-action mt-5 text-center">
                                <a href="{{route('register')}}" class="btn-theme bg-secondary">Open an account</a>
                                <a href="{{route('frontend.work')}}" class="btn-theme bg-primary">How it works</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="bleesed default">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">

            <div class="title text-center darkerGrotesque-bold">{{\App\Models\Master::where('name','homepage2ndsection')->first()->title}}</div>
            <div class="para text-center mt-4 txt-theme">
                {!! \App\Models\Master::where('name','homepage2ndsection')->first()->description !!}
                <a href="{{route('charity.register')}}" class="btn-theme bg-secondary mx-auto fs-6 py-2">Register your charity</a>
                <a href="{{route('newcampaign_show')}}" class="btn-theme bg-primary mx-auto fs-6 py-2">Start fundraising</a>
                <a href="{{route('start_new_event')}}" class="btn-theme bg-secondary mx-auto fs-6 py-2">Create new event</a>
            </div>


        </div>
    </div>
</section>

@if (isset($singleevent))
<section class="show-events">
    <div class="container-fluid p-0">
        <div class="row "> 
            <div class="event">
               <a href="{{ route('frontend.eventDetails',$singleevent->id)}}" class="d-block p-0">
                <img src="{{asset('images/event/'.$singleevent->image)}}" alt="">
               </a>
              <div class="action">
                <p class="w-50 text-center para">{{$singleevent->summery}}</p>
               
                <a href="{{ route('frontend.eventDetails',$singleevent->id)}}" class=" btn btn-theme bg-primary eventAction ">Action Button</a>
              </div>
            </div> 
        </div>
    </div>
</section>
@endif



<!--Campaign Section -->
<section class="campaign default">
    <div class="container-fluid">
        <div class="row">
            <div class="title">
                Featured Campaign
            </div>
        </div>
        <div class="row mt-4">

            <div class="campaign-slider">
                @foreach ($campaign as $campaign)

                @php
                    $today = $todate->format('Y-m-d');
                    $end = $campaign->end_date;
                    $datetime1 = new DateTime($today);
                    $datetime2 = new DateTime($end);
                    $interval = $datetime1->diff($datetime2);
                    $days = $interval->format('%a');
                    $total_collection = $campaign->transaction->sum('amount');
                    $total_donar = $campaign->transaction->count();
                @endphp

                <div class="col-md-3 col-sm-6">
                    <div class="card-theme mb-3">
                        <div class="topper d-flex align-items-center justify-content-center">
                            <a href="{{ route('frontend.campaignDetails',$campaign->id)}}" class="p-0 d-block w-100">
                                <img src="{{asset('images/campaign/'.$campaign->image)}}">
                            </a>
                        </div>
                        <div class="card-body ">
                            <div class="inner">
                                <div class="card-title text-start ">
                                    <a href="{{ route('frontend.campaignDetails',$campaign->id)}}">
                                        {{$campaign->title}}
                                    </a>
                                </div>
                                <div class="status d-flex py-2">
                                    <span class="d-flex align-items-center me-4">
                                        <iconify-icon class="me-1" icon="ic:baseline-people-outline"></iconify-icon>
                                        {{$total_donar}}
                                    </span>
                                    <span class="d-flex align-items-center me-2">
                                        <iconify-icon class="me-1" icon="ic:round-access-time"></iconify-icon> 
                                        {{$days}} days left
                                    </span>
                                </div>
                                <div class="progress " style="height: 7px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 25%;"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <div>
                                        <h4 class="mb-1 text-dark fw-bold">@if ($total_collection > 0) <small class="txt-primary">£{{$total_collection}}</small>  Raised @else @endif</h4>
                                        <h6 class="mb-1 text-dark  fw-bold">funded of £{{$campaign->raising_goal}}</h6>
                                    </div>
                                    <div>
                                        <a href="{{ route('frontend.campaignDetails',$campaign->id)}}" class="btn-theme bg-primary">Donate Now</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
                

            </div>

            

        </div>
    </div>
</section>

<!--Event Section -->
<section class="bleesed default">
    <div class="container-fluid">
        <div class="row">
            <div class="title">
                Featured Events
            </div>
        </div>
        <div class="row mt-4"> 

            <div class="event-slider">
                @foreach ($events as $event) 
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="card-theme mb-3">
                        <div class="topper d-flex align-items-center justify-content-center">
                            <a href="{{ route('frontend.eventDetails',$event->id)}}" class="p-0 d-block w-100">
                                <img src="{{asset('images/event/'.$event->image)}}">
                            </a>
                        </div>
    
                        
                        <div class="card-body  bg-light fs-4 text-center">
                            <div class="inner" style="font-size: 22px;">
                                <div class="card-title  ">
                                    <a href="{{ route('frontend.eventDetails',$event->id)}}" title="{{$event->title}}">
                                        {{$event->title}}
                                    </a>
                                </div>
                               <div class="d-flex justify-content-center align-items-center">
                                <span class="darkerGrotesque-bold txt-secondary text-center">
                                    
                                    {{ \Carbon\Carbon::parse($event->event_start_date)->isoFormat('MMM Do YYYY')}} -  <span class=" darkerGrotesque-bold txt-primary">
                                        @if ($event->price > 0) £{{$event->price}} @else Free @endif  
                                      </span> 
                                    </span>
                                  
                               </div>
                               <h5 class="mb-0 darkerGrotesque-semibold mb-0">
                                <span class="txt-primary"> Venue:</span>
                                {{$event->venue_name}}
                               </h5> 
                               <h5 class="mb-0 darkerGrotesque-semibold mb-2 mh-50">
                               Location:  <span class="text-muted"> {{$event->house_number}} {{$event->road_name}} {{$event->town}} {{$event->postcode}}</span>
                               </h5> 
                               
                               <div class="w-100 text-center">
                                <a href="{{ route('frontend.eventDetails',$event->id)}}" class="btn btn-sm btn-theme bg-primary py-1 mx-auto fs-5">See Details</a>
                               </div>
                            </div>
                        </div>
    
                    </div>
                </div> 
                @endforeach

            </div>
            


        </div>
    </div>
</section>

<!--charities-->
<section class="campaign default">
    <div class="container-fluid">
        <div class="row">
            <div class="title">
                We help charities, raise more
            </div>
            @if(session()->has('error'))
            <p class="alert alert-danger"> {{ session()->get('error') }}</p>
            @endif
        </div>
        <div class="row mt-4"> 

            <div class="event-slider">

                @foreach ($charities as $charity)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="card-theme mb-3">
                        <div class="topper d-flex align-items-center justify-content-center">
                            @if (isset($charity->photo))
                                <a href="" class="p-0 d-block w-100">
                                    <img src="{{asset('images/'.$charity->photo)}}">
                                </a>
                            @else
                                <img src="https://via.placeholder.com/100.png">
                            @endif
                        </div>
                        <div class="card-body bg-light text-center">
                            <div class="inner">
                                <div class="card-title ">           
                                    @if (Auth::user())
                                        <a href="{{ route('frontend.charityDonate',$charity->id)}}">{{$charity->name}}</a>
                                    @else
                                        <!-- Button trigger modal -->
                                        <a class="btn-contact" dataid="{{$charity->id}}" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            {{$charity->name}} 
                                        </a>
                                    @endif
                                </div>
                               <h5 class="mb-0 darkerGrotesque-semibold mb-3 d-flex align-items-center justify-content-center" style="min-height:45px;">
                                <iconify-icon icon="bx:map"></iconify-icon>
                                <span class="text-dark"> {{$charity->house_number}} {{$charity->street_name}} {{$charity->town}} {{$charity->postcode}}</span>
                               </h5> 
                               
                               <div class="w-100 text-center">
    
                                <div class="">
                                    @if (Auth::user())
                                        <a href="{{ route('frontend.charityDonate',$charity->id)}}" class="btn btn-sm btn-theme bg-primary py-1 mx-auto fs-5">Donate Now</a>
                                    @else
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-theme bg-primary py-1 mx-auto fs-5 btn-contact" dataid ="{{$charity->id}}" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            Donate Now
                                        </button>
                                    @endif
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach

            </div>
            
        </div>
    </div>
</section>

<!--Login  Modal -->
<div  class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            @if(session()->has('message'))
            <p class="alert alert-success"> {{ session()->get('message') }}</p>
            @endif
                
            <form method="POST" action="{{ route('logintodonate') }}" class="form-custom">
                @csrf

                <div class="title text-center txt-secondary">LOGIN</div>
                <div class="form-group">
                    <input type="hidden" name="charityid" id="charityid" value="">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <br>
                <div class="form-group">
                    <button type="submit" class="btn-theme bg-primary d-block text-center mx-0 w-100">Login </button>
                </div>
                <div class="form-group d-flex justify-content-center">
                        <a href="{{ route('charity.register')}}" class="btn-theme bg-secondary d-block text-center mx-0 w-100"> Open an account</a>
                </div>
            </form>



        </div>
        </div>
    </div>
</div>
    
@endsection

@section('script')
<script>
    $(document).on('click', '.btn-contact', function () {
        $charityid = $(this).attr('dataid');
        console.log($charityid);
        $('#loginModal').find('.modal-body #charityid').val($charityid);
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {


        $('.campaign-slider').slick({
            centerMode: false,
            centerPadding: '0px',
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: true,
            swipeToSlide: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,

                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        arrows: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
            ]
        });

        $('.event-slider').slick({
            centerMode: false,
            centerPadding: '0px',
            slidesToShow: 4,
            slidesToScroll: 1,
            draggable: true,
            swipeToSlide: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,

                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        dots: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        arrows: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
            ]
        });


    });

</script>
@endsection