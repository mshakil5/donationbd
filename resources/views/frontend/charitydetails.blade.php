@extends('frontend.layouts.master')

@section('title')

@endsection
@section('css')
@endsection

@section('content')

<section class="bleesed py-5">
    <div class="container-sm">

        <div class="row">
            <div class="col-md-12 col-lg-7">
                <div class="row mb-2">
                    {{-- <div class="col-md-3 text-center text-xs-start">
                        <img src="https://consensa.is/utbod/wp-content/uploads/2016/01/dummylogo3.png" class="img-fluid">
                    </div> --}}
                    <div class="col-md-9  text-left  text-xs-start">
                        <h1 >
                           <a href="#"class="txt-primary fw-bold"> {{ $data->name }}</a>
                        </h1>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-12 mb-3 ">
                        <div class="card p-3">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($data->charityimage as $key => $slider)
                                        
                                        <div class="carousel-item @if ($key == 0) active @endif">
                                            <img src="{{asset('images/charity/'.$slider->image)}}"
                                                class="d-block w-100" alt="">
                                        </div>
                                    @endforeach

                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap gap-3 align-items-center mb-3">
                        <div class="col-2">
                            {{-- <a href="#" class="btn-theme bg-primary w-100"><iconify-icon
                                    icon="gg:facebook"></iconify-icon> share</a> --}}
                                    {!! $facebook !!}
                        </div>
                        <div class="col-2">
                            {{-- <a href="#" class="btn-theme bg-secondary w-100"><iconify-icon
                                    icon="gg:twitter"></iconify-icon> share</a> --}}
                        </div>
                        <div class="col-7">
                            <div class="input-group gap-1 fs-3">
                                <div class="ms-1 input-group-prepend col-5 col-sm-3 col-md-4 row" style=" ">
                                    <button class="input-group-text col-12 d-flex justify-content-center btn-sm fs-5"  onclick="copyTextFS()">Copy URL</button>
                                </div>
                                
                                    <input type="text" class="form-control fs-5"  id="myInput" style="height:46px;" value="{{ URL::current() }}@if (Auth::user())?uid={{Auth::user()->id}} @else @endif">
                            </div>
                        </div>
                    </div>
                   
                </div>

            </div>
            <div class="col-md-12 col-lg-5">

                <div class="row">

                    <div class="d-flex gap-2 text-center border mb-2">
                                   
                        <a href="{{ route('frontend.charityDonate',$data->id)}}" class="btn-theme bg-primary d-block w-100">Donate Now</a>
                        <a href="{{ route('frontend.charityDonate',$data->id)}}" class="btn-theme bg-secondary d-block w-100">Give Monthly</a>
                        
                    </div>

                    <div class="col-12">
                        <div id="donation_amount" class="card p-4 mb-3">
                            <h3 class="fw-bold txt-primary mb-3">What your
                                gift could provide
                            </h3>
                            <div class="charity-donationoption">
                                <div class="example-donation-row d-flex mb-3">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <a class="btn-theme bg-secondary d-block" href="#" type="button">£500</a>
                                    </div>
                                    <div class="col-xs-9 col-md-9">
                                        <div class="txt-theme fs-6 px-3">Weekly emergency basic supplies
                                            (food and clothing) for the most vulnerable families.</div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="example-donation-row d-flex mb-3">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <a class="btn-theme bg-secondary d-block" href="#" type="button">£250</a>
                                    </div>
                                    <div class="col-xs-9 col-md-9">
                                        <div class="txt-theme fs-6 px-3">Sponsor a week therapy for a
                                            special need child</div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="example-donation-row d-flex mb-3">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <a class="btn-theme bg-secondary d-block" href="#" type="button">£50</a>
                                    </div>
                                    <div class="col-xs-9 col-md-9">
                                        <div class="txt-theme fs-6 px-3">Sponsor a week transportation cost
                                            for a disabled child</div>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-12">
                                <div class="card p-3">
                                    <a class="btn-theme bg-secondary w-100" href="#" type="button">
                                        Fundraise for us!
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card p-3">
                                    <h3 class="fw-bold txt-primary ">Chartity information
                                    </h3>
                                    <h5>
                                        <b class="txt-secondary">{{$data->name}}</b> <br>
                                        <span class="txt-theme">Registered charity no.: {{$data->charity_reg_number}}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 mb-3">
                <aside class="  p-4 bleesed bg-light">
                    
                    {!! $data->about !!}


                </aside>
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
    function copyTextFS() {
        // Get the text field
        var copyText = document.getElementById("myInput");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>
<script>
$(document).ready(function () {
    




});
</script>


<script>
    // Create a Stripe instance with your publishable key
    // var stripe = Stripe('pk_test_51N5D0QHyRsekXzKiScNvPKU4rCAVKTJOQm8VoSLk7Mm4AqPPsXwd6NDhbdZGyY4tkqWYBoDJyD0eHLFBqQBfLUBA00tj1hNg3q');
   
    var stripe = Stripe('pk_live_Gx0P9OLtn53jOp5TdChtaONF00LxuoVYFb');
  
    // Create a card element and mount it to the card-element div
    var cardElement = stripe.elements().create('card');
    cardElement.mount('#card-element');
  
    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      $("#loading").show();
      // Create a PaymentMethod and confirm the PaymentIntent on the backend
      stripe.createPaymentMethod('card', cardElement).then(function(result) {
        if (result.error) {
            $("#loading").hide();
          // Handle errors (e.g. invalid card details)
          console.error(result.error);
          $(".ermsg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+result.error.message+"</b></div>");
        } else {
          // Send the PaymentMethod ID to your backend
          var paymentMethodId = result.paymentMethod.id;
          confirmPayment(paymentMethodId);
        }
      });
    });
  
    var url = "{{URL::to('/event-payment')}}";
    // Function to confirm the PaymentIntent on the backend
    function confirmPayment(paymentMethodId) {
        
        var amount = $("#amount").val();
        var quantity = $("#qty").val();
        var cardHolderName = $("#cardholder-name").val();
        var event_id = $("#event_id").val();
        var c_amount = $("#c_amount").val();
        var ticket_type = $("#ticket_type").val();
        var event_price_id = $("#selectType").val();
        var note = $("#note").val();

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json', // Specify the Accept header for JSON
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body: JSON.stringify({ payment_method_id: paymentMethodId, amount: amount, cardHolderName: cardHolderName, event_id:event_id, c_amount:c_amount, quantity:quantity,ticket_type:ticket_type,event_price_id:event_price_id,note:note })
      }).then(function(response) {
        return response.json();
      }).then(function(data) {
        console.log(data);
        // Handle the response from the backend
        if (data.client_secret) {
          stripe.confirmCardPayment(data.client_secret).then(function(result) {
            if (result.error) {
                $("#loading").hide();
                $(".ermsg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+result.error.message+"</b></div>");
              // Handle errors (e.g. authentication required)
              console.error(result.error);
            } else {
                $("#loading").hide();
              // Payment successful
              $(".ermsg").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Payment Successfull.</b></div>");
              console.log(result.paymentIntent);
              window.setTimeout(function(){location.reload()},2000)
            }
          });
        }
      });
    }
</script>

@endsection