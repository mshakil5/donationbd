@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="bleesed default">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="title darkerGrotesque-bold text-center lh-1">{{\App\Models\Master::where('name','nonprofit1')->first()->title}}</div>
            <div class="para text-center mt-4">
                {!! \App\Models\Master::where('name','nonprofit1')->first()->description !!}
            </div>
            {{-- <div class="searchBox p-0 mt-3">
                <input placeholder="Search..." type="text">
                <button data-bs-toggle="modal" data-bs-target="#searchFundrisers">
                    <iconify-icon icon="quill:search"></iconify-icon>
                </button>
            </div> --}}
        </div>
    </div>
</section>


<!--charities-->
<section class="campaign default">
    <div class="container">
        <div class="row">
            <div class="title">
                We help charities, raise more
            </div>
            @if(session()->has('error'))
            <p class="alert alert-danger"> {{ session()->get('error') }}</p>
            @endif
        </div>
        <div class="row mt-5"> 

            @foreach ($charities as $charity)
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="card-theme mb-3">
                    <div class="topper d-flex align-items-center justify-content-center">
                        @if (isset($charity->photo))
                            <a href="" class="p-0 d-block">
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
</section>




{{-- <section class="campaign default">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="inner w-75">
                            <div class="text-left txt-primary display-5 mb-4 darkerGrotesque-bold lh-1">
                                How to fundraise for a nonprofit on GoFundM
                            </div>
                            <p class="txt-theme mb-4">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum
                                is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                                the industry's standard dummy</p>
                            <div>
                                <a href="#" class="btn-theme bg-primary">Fund Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <img src="https://via.placeholder.com/410x350.png" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="campaign default" style="background-color: #E9E1DA;">
    <div class="container">
        <div class="row">
            <div class="title">
                Trending nonprofit fundraisers
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 upperGap">
                <div class="card-theme  ">
                    <div class="topper">
                        <img src="https://via.placeholder.com/100.png" alt="" class="rounded-circle">
                    </div>
                    <div class="card-body pt-5">
                        <div class="inner">
                            <div class="card-title">Lorem, ipsum dolor.</div>
                            <div class="my-4">
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£679 Raised </span>
                                    <span>Last day</span>
                                </p>
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£120,000 Goal </span>
                                    <span>Days left</span>
                                </p>
                            </div>
                            <a href="#" class="btn-theme bg-primary mx-auto w-50 text-center d-block">Donate Now</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 upperGap">
                <div class="card-theme  ">
                    <div class="topper">
                        <img src="https://via.placeholder.com/100.png" alt="" class="rounded-circle">
                    </div>
                    <div class="card-body pt-5">
                        <div class="inner">
                            <div class="card-title">Lorem, ipsum dolor.</div>
                            <div class="my-4">
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£679 Raised </span>
                                    <span>Last day</span>
                                </p>
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£120,000 Goal </span>
                                    <span>Days left</span>
                                </p>
                            </div>
                            <a href="#" class="btn-theme bg-primary mx-auto w-50 text-center d-block">Donate Now</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 upperGap">
                <div class="card-theme  ">
                    <div class="topper">
                        <img src="https://via.placeholder.com/100.png" alt="" class="rounded-circle">
                    </div>
                    <div class="card-body pt-5">
                        <div class="inner">
                            <div class="card-title">Lorem, ipsum dolor.</div>
                            <div class="my-4">
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£679 Raised </span>
                                    <span>Last day</span>
                                </p>
                                <p class="d-flex mb-0 justify-content-between flex-wrap">
                                    <span>£120,000 Goal </span>
                                    <span>Days left</span>
                                </p>
                            </div>
                            <a href="#" class="btn-theme bg-primary mx-auto w-50 text-center d-block">Donate Now</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-lg-6 mx-auto mt-5">
                <a href="all-transaction.html" class="btn-theme bg-secondary mx-auto w-50 text-center d-block">View all Transactions</a>
            </div>
        </div>
    </div>
</section> --}}



@endsection

@section('scripts')
@endsection