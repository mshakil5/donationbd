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
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="inner p-4">
                    <div class="row mb-4">
                        <a href="{{ route('homepage') }}" class="text-start btn btn-theme bg-primary">
                            <iconify-icon icon="material-symbols:arrow-back-rounded"
                                class="text-white fs-4"></iconify-icon>
                            Return</a>
                    </div>
                    
                    @if(session()->has('error'))
                    <section class="px-4">
                        <div class="row my-3">
                            <div class="alert alert-warning" id="successMessage">{{ session()->get('error') }}</div>
                        </div>
                    </section>
                    @endif

                    <div class="row"> 
                        <div class="col-mg-12">
                            <div class="row">
                                <div class="col-lg-3 text-center">
                                    @if (isset($data->photo))
                                        <img src="{{asset('images/'.$data->photo)}}" alt="" class="img-fluid">
                                    @else
                                        <img src="https://via.placeholder.com/100.png" class="img-fluid">
                                    @endif
                                </div>
                                <div class="col-lg-9">
                                    <p class="para fs-6 mb-1 text-muted py-2">
                                    <b class="para mt-3 text-dark fs-6"> {{$data->name}} </b>
                                </div>
                            </div>
                        </div>

                        @if (!Auth::user())
                        <div class="col-md-12 my-3 ">
                            <div class="paymentMethodNew border border-2 bg-white mx-auto" >
                                <form action="{{route('paypalcharitypayment')}}" method="POST">
                                <div class="topper p-3 border-bottom" id="lvlShow">
                                    <div class="items">
                                        <iconify-icon icon="zondicons:checkmark" class="txt-primary"></iconify-icon>
                                        <span class="ms-2"> Doner Information</span>
                                    </div>
                                </div>
                                
                                <div class="form-row row p-3 pt-0">
                                    <div class="col-xs-12 form-group required">
                                        <label class="control-label">Name</label>
                                        <input class="form-control" id="guest_name" name="guest_name" type="text" required>
                                    </div>
                                </div>

                                <div class="form-row row p-3 pt-0">
                                    <div class="col-xs-12 form-group required">
                                        <label class="control-label">Email</label>
                                        <input class="form-control" id="guest_email" name="guest_email" type="email" required>
                                    </div>
                                </div>

                                <div class="form-row row p-3 pt-0">
                                    <div class="col-xs-12 form-group required">
                                        <label class="control-label">Phone</label>
                                        <input class="form-control" id="guest_phone" name="guest_phone" type="number" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        
                        
                        <div class="col-md-12 my-3 ">
                            <div class="paymentMethodNew border border-2 bg-white">
                                <div class="topper p-3 border-bottom" id="lvlShow">
                                    <div class="items">
                                        <iconify-icon icon="zondicons:checkmark" class="txt-primary"></iconify-icon>
                                        <span class="ms-2"> Giving Level</span>
                                    </div>
                                    <div class="items" id="charitytitle"> Level </div>
                                </div>
                                <div class="p-3 pt-0" id="givinglvlDiv">
                                    <h4 class="text-center fs-4 fw-bold mb-3">Select a giving level:</h4>

                                    <div class="d-flex justify-content-center border level para text-center p-3 border-2 btn-amount" amt="10" title="Just helping">
                                        Just helping (choose amount next)
                                    </div>

                                    @foreach ($givinglvls as $item)
                                    <div class="d-flex align-items-center level border p-3 border-2 my-2 py-2 btn-amount" amt="{{$item->amount}}" title="{{$item->title}}">
                                        <div class="me-5"><span class="fw-bold txt-primary fs-3">£{{$item->amount}}</span>
                                            <small class="text-muted fs-6">GBP</small>
                                        </div>
                                        <div class="fs-5 fw-bold">{{$item->title}} </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                            <div class="paymentAmount  border border-2 bg-white mt-3" id="amantDiv">
                                <div class="topper p-3 border-bottom">
                                    <div class="items">
                                        <iconify-icon icon="zondicons:checkmark" class="txt-primary"></iconify-icon>
                                        <span class="ms-2">Amount</span>
                                    </div>
                                    <div class="items"> £<span id="camntshowdiv"></span> </div>
                                </div>
                                <div class="p-3 w-100">
                                    <p class="txt-secondary text-center fs-5 fw-bold">Adjust your amount here </p>

                                    <div class="row">
                                        <div class="col-md-8 text-center">
                                            <div class="d-flex align-items-center justify-content-center w-75 mx-auto">
                                                <div class="display-2">£ </div>
                                                <input type="text" value="10" id="charityamount" name="charityamount" class="input-custom form-control famount">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="" id="" class="form-control mt-4 para fs-6 mb-2 text-dark">
                                                <option value="">GBP</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-theme mx-auto w-50 bg-primary">Continue </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>


                        


                    </div>
                    <div class="  ">
                        <div class="title darkerGrotesque-bold lh-1 fs-3 mt-2">Payment Methods </div>
                        

                        <ul class="nav nav-tabs mt-2 border-0 py-4 justify-content-center  bg-transparent" id="paymentTab" role="tablist">
                            <li class="nav-item fs-5 mx-2" role="presentation">
                                <label for="paypal">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center"
                                        id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab"
                                        aria-controls="home" aria-selected="true">
                                        <div class="fw-bold d-flex align-items-center">
                                            
                                                @csrf
                                                <input type="hidden" name="amount" id="paypalamount" value="">
                                                <input type="hidden" name="charity_id" value="{{$data->id}}">
                                                <input type="hidden" name="paypalcommission" id="paypalcommission" value="">
            
                                                <button type="submit" class="btn mx-auto">
                                                    <img src="{{ asset('paypal.png')}}" alt="" style="height: 35px; border-radius:5px;">
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
                                    <input type="hidden" name="donor_id" id="donor_id" value="">    
                                    <input type="hidden" name="c_amount" id="c_amount" value="">    
                                    <input type="hidden" name="charity_id" id="charity_id" value="{{$data->id}}">  
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
   $(document).ready(function() {
        //calculation end
        $("#charityamount").keyup(function(){
            var amount = Number($("#charityamount").val());
            var commission = (amount * 10)/100;
            var net_amount = amount + commission;
            $("#amount").val(net_amount.toFixed(2));
            $("#paypalamount").val(net_amount.toFixed(2));
            $("#c_amount").val(commission.toFixed(2));
            $("#paypalcommission").val(commission.toFixed(2));
        });
        //calculation end  

        $("#amantDiv").hide();
        $(document).on('click', '.btn-amount', function () {
            $("#givinglvlDiv").hide();
            $("#amantDiv").show();
            amt = $(this).attr('amt');
            title = $(this).attr('title');
            $("#charityamount").val(amt);
            $("#charitytitle").html(title);
            $("#camntshowdiv").html(amt);
            
            var amount = parseInt(amt)
            var commission = (amount * 10)/100;
            var net_amount = amount + commission;
            $("#amount").val(net_amount.toFixed(2));
            $("#paypalamount").val(net_amount.toFixed(2));
            $("#c_amount").val(commission.toFixed(2));
            $("#paypalcommission").val(commission.toFixed(2));

        });

        $(document).on('click', '#lvlShow', function () {
            $("#givinglvlDiv").show();
        });

        // $(document).on('click', '#paypalbtn', function () {
        //     var amount = Number($("#paypalamount").val());
        //     if (amount == "") {
        //         alert('btn');
        //     } else {
                
        //     }
        // });
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
  
      // Create a PaymentMethod and confirm the PaymentIntent on the backend
      stripe.createPaymentMethod('card', cardElement).then(function(result) {
        if (result.error) {
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
  
    var url = "{{URL::to('/charity-payment')}}";
    // Function to confirm the PaymentIntent on the backend
    function confirmPayment(paymentMethodId) {
        
        var amount = $("#amount").val();
        var donor_id = $("#donor_id").val();
        var charity_id = $("#charity_id").val();
        var c_amount = $("#c_amount").val();

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json', // Specify the Accept header for JSON
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body: JSON.stringify({ payment_method_id: paymentMethodId, amount: amount, donor_id: donor_id, c_amount:c_amount,charity_id:charity_id })
      }).then(function(response) {
        return response.json();
      }).then(function(data) {
        console.log(data);
        // Handle the response from the backend
        if (data.client_secret) {
          stripe.confirmCardPayment(data.client_secret).then(function(result) {
            if (result.error) {
                $(".ermsg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+result.error.message+"</b></div>");
              // Handle errors (e.g. authentication required)
              console.error(result.error);
            } else {
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