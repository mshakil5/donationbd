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
            <div class="searchBox p-0 mt-3">
                <input placeholder="Search..." type="text" id="searchCharity" name="searchCharity">
                <button data-bs-toggle="modal" data-bs-target="#searchFundrisers">
                    <iconify-icon icon="quill:search"></iconify-icon>
                </button>
            </div>
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
        {{-- <div class="row mt-5"> 

        </div> --}}
        <div class="row mt-5" id="get_charity"> 

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
                                <a href="#">{{$charity->name}}</a>
                            </div>
                           <h5 class="mb-0 darkerGrotesque-semibold mb-3 d-flex align-items-center justify-content-center" style="min-height:45px;">
                            <iconify-icon icon="bx:map"></iconify-icon>
                            <span class="text-dark"> {{$charity->house_number}} {{$charity->street_name}} {{$charity->town}} {{$charity->postcode}}</span>
                           </h5> 
                           
                           <div class="w-100 text-center">

                            <div class="">
                                <a href="{{route('frontend.startcharitycampaign', $charity->id)}}" class="btn btn-sm btn-theme bg-primary py-1 mx-auto fs-5">Select</a>
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





@endsection

@section('script')


<script>


$(document).ready(function () {

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        // select ticket type
        var url = "{{URL::to('/get-charity-campaign')}}";
            $("#searchCharity").keyup(function(){
		            event.preventDefault();
                    var searchdata = $(this).val();
                    console.log(searchdata);
                    
                    $.ajax({
                    url: url,
                    method: "POST",
                    data: {searchdata:searchdata},

                    success: function (d) {
                        console.log(d);
                        $("#get_charity").html(d.charity);
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });

            });

            
    });
</script>



@endsection