@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')
<style>
    /* Custom styles for Card Element iframe */
.StripeElement {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    color: #32325d;
    background-color: #f8f8f8;
    border: 1px solid #ced4da;
    border-radius: 4px;
}
#card-element{
    margin-bottom: 20px;

}
#payButton{
    background-color: #007bff; /* Set the background color */
    color: #fff; /* Set the text color */
    font-size: 18px; /* Set the font size */
    padding: 10px 20px; /* Set padding */
    border: none; /* Remove border */
    border-radius: 4px; /* Set border radius */
    cursor: pointer; /* Set cursor */
}

/* Custom styles for invalid input in Card Element iframe */
.StripeElement--invalid {
    border-color: #fa755a;
}
</style>


<section class="fundriser my-2 py-4">
    <div class="container">
        
        <!-- Image loader -->
        <div id='loading' style='display:none ;'>
            <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." style="height: 225px;" />
        </div>
        <!-- Image loader -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="inner p-4">
                    <div class="row mb-4">
                        <a href="{{route('frontend.campaignDetails',$data->id)}}" class="text-start btn btn-theme bg-primary">
                            <iconify-icon icon="material-symbols:arrow-back-rounded"
                                class="text-white fs-4"></iconify-icon>
                            Return to fundriser</a>
                    </div>
                    <div class="row"> 
                        <div class="col-mg-12">
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <img src="{{asset('images/campaign/'.$data->image)}}"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-8">
                                    <b class="para mt-3 text-dark fs-6"> {{$data->title}} </b>
                                    <p class="para fs-6 mb-1 text-muted py-2">
                                        {{-- {{ Illuminate\Support\Str::limit($data->story, 20) }} --}}
                                        {{-- {!! Illuminate\Support\Str::limit($data->story, 300) !!}</p> --}}
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('campaignpayment') }}" method="POST">
                            @csrf
                        <div class="col-md-12 mt-2">
                            <label class="para mt-2 text-dark fs-6 mb-2 fw-bold " for="">Enter Your
                                donation</label>
                            <input type="number" id="d_amount" name="d_amount" placeholder="£GBP" class="form-control py-3 border fs-1 fw-bold @error('d_amount') is-invalid @enderror" value="{{ old('d_amount') }}" required>
                                @error('d_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            
                            @if (Auth::user())
                                <p class="para fs-6 mb-2 text-dark">This donation will be displayed in the name of
                                    <b>
                                        <div class="d-inline" title="You can update the name here " id="editable">
                                        @if (Auth::user()) {{ Auth::user()->name }} @endif 
                                        </div>
                                    </b> 
                                    <button onclick="goEdit();" class="btn btn-sm bg-primary fs-6 fw-bold py-0 text-white">Edit</button>
                                </p>
                            @else

                                <div class="row">
                                    <div class="col-lg-4 ">
                                        <div>
                                            <label for="doner_name">Name</label>
                                            <input type="text" id="doner_name" name="doner_name" class="form-control @error('doner_name') is-invalid @enderror">
                                            @error('doner_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="doner_email">Email</label>
                                            <input type="email" id="doner_email" name="doner_email" class="form-control @error('doner_email') is-invalid @enderror">
                                            @error('doner_email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="doner_phone">Phone</label>
                                            <input type="number" id="doner_phone" name="doner_phone" class="form-control @error('doner_phone') is-invalid @enderror">
                                            @error('doner_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            @endif


                            <p class="para fs-6 mb-2 text-dark">
                                Because Gogiving doesn't charge a platform fee, we rely on
                                the generosity of donors like you to continue to help more people. Thank you for
                                including a contribution of:
                            </p>
                            <select name="tips" id="tips" class="form-control fs-6 fw-bold my-4">
                                <option value="10" class="fs-6 fw-bold">10%</option>
                                <option value="15" class="fs-6 fw-bold">15%</option>
                                <option value="20" class="fs-6 fw-bold">20%</option>
                                <option value="30" class="fs-6 fw-bold">30%</option>
                            </select>

                        </div>


                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center  lh-1  my-1">
                                <input type="checkbox" id="public" name="public" value="1" class="publicbtn">
                                <label for="public" class="fs-5 fw-bold ps-2 text-dark flex-1 ">
                                    Don't display my name publicly on fundriser.
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center  lh-1  my-1">
                                <input type="checkbox" id="terms" name="terms" value="1" class="terms" required>
                                <label for="terms" class="fs-5 fw-bold ps-2 text-dark flex-1 ">
                                    By Continuing, you agree with GoGiving <a href="{{route('frontend.terms')}}">terms</a> and <a href="{{route('frontend.privacy')}}">privacy</a>  notice.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 my-2 ">
                            <h4 class="fw-bold txt-secondary my-3">Your donation</h4>
                            <hr class="my-1">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <div class="fs-6 para">Your donation</div>
                                <div class="fs-6 para">
                                    <h5 class="fs-6 para"><span id="donation_amount"></span></h5>
                                </div>
                            </div>
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <div class="fs-6 para">Your Tip</div>
                                <div class="fs-6 para">
                                    <h5 class="fs-6 para"><span id="donation_tips"></span></h5>
                                </div>
                            </div>
                            {{-- <div class="d-flex w-100 align-items-center justify-content-between" >
                                <div class="fs-6 para">Commission</div>
                                <div class="fs-6 para">
                                    <h5 class="fs-6 para"><span id="donation_commission"></span></h5>
                                </div>
                            </div> --}}
                            <hr class="my-1">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <div class="fs-6 para">Total due today</div>
                                <div class="fs-6 para">
                                    <h5 class="fs-6 para"><span id="net_donation_amount"></span></h5>
                                </div>
                            </div>

                        </div>

                        <div class="title darkerGrotesque-bold lh-1 fs-3 mt-2">Payment Methods </div>

                        <ul class="nav nav-tabs mt-2 border-0 py-4 justify-content-center  bg-transparent" id="paymentTab" role="tablist">
                            <li class="nav-item fs-5 mx-2" role="presentation">
                                <label for="paypal">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center"
                                        id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab"
                                        aria-controls="home" aria-selected="true">
                                        <div class="fw-bold d-flex align-items-center">
                                            
                                                <input type="hidden" name="amount" id="paypalamount" value="">
                                                <input type="hidden" name="campaign_id" value="{{$data->id}}">
                                                <input type="hidden" name="paypalcommission" id="paypalcommission" value="">
                                                <input type="hidden" name="pdisplayname" id="pdisplayname" value="@if (Auth::user()) {{ Auth::user()->name }} @endif">
            
                                                <button type="submit" class="btn mx-auto">
                                                    <img src="{{ asset('paypal.png')}}" alt="" style="height: 50px; border-radius:5px;">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li class="nav-item fs-5 mx-2" role="presentation">
                                <label for="google_pay">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center"
                                        id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">

                                        <div class="fw-bold d-flex align-items-center">
                                            <input type="radio" class="d-none" id="google_pay" value="google_pay" name="paymentMethod">
                                            <img src="{{ asset('stripe.png')}}" alt="" style="height: 50px; border-radius:5px;">
                                        </div>

                                    </div>
                                </label>
                            </li>
                            
                        </ul>

                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="tab-content shadow-sm" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">

                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                
                                <div class="ermsg">
                                </div>
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif
                                <!-- Include the Stripe Elements JS library -->
                                <script src="https://js.stripe.com/v3/"></script>
        
                                <!-- Create a form to collect card details -->
                                <form id="payment-form">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Donation Amount</label>
                                            <input class='form-control' id="amount" name="amount" placeholder='£' type='number' step="any" required>
                                        </div>
                                    </div>
        
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label>
                                            <input class='form-control' id="cardholder-name" name="cardholder_name" size='4' type='text' required>
                                        </div>
                                    </div>
                                    <br>
                                      
                                    <input type="hidden" name="tips_amount" id="tips_amount" value="">    
                                    <input type="hidden" name="c_amount" id="c_amount" value="">    
                                    <input type="hidden" name="campaign_id" id="campaign_id" value="{{$data->id}}">  
                                    <div id="card-element"></div>
                                    <div class="col-lg-12  mt-4 d-flex align-items-center">
                                        <button id="payButton" type="submit" class="btn btn-primary btn-theme mx-auto w-50 bg-primary">Pay</button>
                                    </div>
                                

                                </form>
                            </div>
                            
                        </div>


                        {{-- <div class="col-lg-12  mt-4 d-flex align-items-center">
                            <button class="btn btn-primary btn-theme mx-auto w-50 bg-primary">Donate now! </button>
                        </div> --}}

                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
</section>


@endsection

@section('script')
<script>
    function goEdit(){
        let editable = document.getElementById("editable");
         editable.setAttribute('contenteditable','true'); 
         editable.focus();
         setEndOfContenteditable(editable);
    }
</script>

<script>
   $(document).ready(function() {
        //calculation end
        $("#d_amount").keyup(function(){
            var amount = Number($("#d_amount").val());
            var tips = Number($("#tips").val());
            var total_tips = (amount * tips)/100;
            var total_amount = amount + total_tips;
            var commission = (total_amount * 10)/100;
            var net_amount = total_amount;
            var total_amount_with_commission = total_amount - total_tips;
            
            $("#donation_amount").html("£"+ total_amount_with_commission.toFixed(2));
            $("#donation_tips").html("£"+ total_tips.toFixed(2));
            // $("#donation_commission").html("£"+ commission.toFixed(2));
            $("#net_donation_amount").html("£"+ net_amount.toFixed(2));
            $("#amount").val(net_amount.toFixed(2));
            $("#paypalamount").val(net_amount.toFixed(2));
            $("#c_amount").val(commission.toFixed(2));
            $("#paypalcommission").val(commission.toFixed(2));
            $("#tips_amount").val(total_tips.toFixed(2));
            $("#paypaltips").val(total_tips.toFixed(2));
        });
        //calculation end  
        //calculation end
        $("#tips").change(function(){
            var amount = Number($("#d_amount").val());
            var tips = Number($("#tips").val());
            var total_tips = (amount * tips)/100;
            var total_amount = amount + total_tips;
            var commission = (total_amount * 10)/100;
            var net_amount = total_amount + commission;
            var total_amount_with_commission = total_amount + commission - total_tips;
            
            $("#donation_amount").html("£"+ total_amount_with_commission.toFixed(2));
            $("#donation_tips").html("£"+ total_tips.toFixed(2));
            // $("#donation_commission").html("£"+ commission.toFixed(2));
            $("#net_donation_amount").html("£"+ net_amount.toFixed(2));
            $("#amount").val(net_amount.toFixed(2));
            $("#paypalamount").val(net_amount.toFixed(2));
            $("#c_amount").val(commission.toFixed(2));
            $("#paypalcommission").val(commission.toFixed(2));
            $("#tips_amount").val(total_tips.toFixed(2));
            $("#paypaltips").val(total_tips.toFixed(2));
        });
        //calculation end  

        $(document).on('click', '.publicbtn', function () {
            if ($('#public').is(":checked")){
                var displayname = "Kind Soul";
            }else{
                var displayname = $('#editable').text();
            }
            $("#pdisplayname").val(displayname);
        });

    });   
</script>
<script>
    // Create a Stripe instance with your publishable key
    var stripe = Stripe('pk_live_Gx0P9OLtn53jOp5TdChtaONF00LxuoVYFb');
    // var stripe = Stripe('pk_test_51N5D0QHyRsekXzKiScNvPKU4rCAVKTJOQm8VoSLk7Mm4AqPPsXwd6NDhbdZGyY4tkqWYBoDJyD0eHLFBqQBfLUBA00tj1hNg3q');
  
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
  
    var url = "{{URL::to('/campaign-payment')}}";
    // Function to confirm the PaymentIntent on the backend
    function confirmPayment(paymentMethodId) {
        if ($('#public').is(":checked")){
            var displaynameshow = "yes";
            }else{
            var displaynameshow = "Kind Soul";
            }
        var amount = $("#amount").val();
        var cardHolderName = $("#cardholder-name").val();
        var tips = $("#tips").val();
        var campaign_id = $("#campaign_id").val();
        var tips_amount = $("#tips_amount").val();
        var c_amount = $("#c_amount").val();
        var displayname = $('#editable').text();
        var doner_name = $('#doner_name').val();
        var doner_email = $('#doner_email').val();
        var doner_phone = $('#doner_phone').val();
        console.log(doner_name, doner_email, doner_phone);
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json', // Specify the Accept header for JSON
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body: JSON.stringify({ payment_method_id: paymentMethodId, amount: amount, cardHolderName: cardHolderName, campaign_id:campaign_id,tips_amount:tips_amount,c_amount:c_amount,displayname:displayname,displaynameshow:displaynameshow,tips:tips,doner_name:doner_name,doner_email:doner_email,doner_phone:doner_phone })
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
              // Payment successful
                $("#loading").hide();
                
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