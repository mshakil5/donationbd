@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<section class="contact py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title mb-5 fs-1 " >
                            Contact us Today 
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <img class='img-fluid shadow-sm' src="{{asset('assets/images/undraw_Envelope_re_f5j4.png')}}" alt="conatct image missing" > 
                    </div><div class="col-lg-6">
                      
                        <div class="theme-para ">
                            Fill out the form below and we’ll get back to you as   soon as we can.
                        </div>
                        <div class="ermsg"></div>
                        <div class="form-custom"> 
                            <div class="form-group">
                                <input class="form-control" type="text" id="name" name="name" placeholder="Name"> 
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email"> 
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject"> 
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id="message" name="message" placeholder="Message"></textarea> 
                            </div>
                            <div class="form-group">
                                <button id="submit" class="btn-theme bg-primary">Send</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section class="default contactInfo" style="display: none">
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 d-flex flex-column align-items-center">
                <div class="paratitle text-center">Phone</div>
                <p class="theme-para text-center">  {{\App\Models\CompanyDetail::where('id',1)->first()->phone1 }}  </p>
                <a href="#" class="btn-theme bg-primary">Call</a>
            </div>
            <div class="col-lg-3 d-flex flex-column align-items-center">
                <div class="paratitle text-center">Whatsapp</div>
                <p class="theme-para text-center">  {{\App\Models\CompanyDetail::where('id',1)->first()->phone1 }}  </p>
                <a href="#" class="btn-theme bg-primary">Message</a>
            </div>
            <div class="col-lg-3 d-flex flex-column align-items-center">
                <div class="paratitle text-center">Email</div>
                <p class="theme-para text-center"> {{\App\Models\CompanyDetail::where('id',1)->first()->email1 }}  </p>
                <a href="#" class="btn-theme bg-primary">Email</a>
            </div>
            <div class="col-lg-3 d-flex flex-column align-items-center">
                <div class="paratitle text-center">Address</div>
                <p class="theme-para text-center"> {{\App\Models\CompanyDetail::where('id',1)->first()->address1 }}</p>
                <a href="#" class="btn-theme bg-primary">Visit</a>
            </div>
            
        </div>
    </div>
</section>


@endsection

@section('script')

<script>
    $(document).ready(function () {


        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

           //  make mail start
           var url = "{{URL::to('/contact-submit')}}";
           $("#submit").click(function(){
            
                   var name= $("#name").val();
                   var email= $("#email").val();
                   var subject= $("#subject").val();
                   var message= $("#message").val();
                   $.ajax({
                       url: url,
                       method: "POST",
                       data: {name,email,subject,message},
                       success: function (d) {
                           if (d.status == 303) {
                               $(".ermsg").html(d.message);
                           }else if(d.status == 300){
                               $(".ermsg").html(d.message);
                               window.setTimeout(function(){location.reload()},2000)
                           }
                       },
                       error: function (d) {
                           console.log(d);
                       }
                   });

           });
           // send mail end


    });
</script>
@endsection