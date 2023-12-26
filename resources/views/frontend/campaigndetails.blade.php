@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 14px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        color: #0c4c45;
        background-color: #ccc;
    }
</style>

<section class="bleesed default">
    <div class="container">
        <div class="row">
            
            <h3 class="fw-bold txt-primary mb-4">{{$data->title}}</h3>
            @if(session()->has('error'))
                <p class="alert alert-danger"> {{ session()->get('error') }}</p>
            @endif

            <div class='col-md-8'>
                <div class="popup-gallery shadow-sm p-4 bg-white">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($data->campaignimage as $key => $img)
                                <div class="carousel-item @if ($key == 0) active @endif">
                                    <a href="{{asset('images/campaign/'.$img->image)}}" class="img-fluid" title="Some Text for the image">
                                        <img src="{{asset('images/campaign/'.$img->image)}}" style="height: 711;width:304" class="img-fluid" alt="Alt text" />
                                    </a>
                                </div>
                            @endforeach
                          

                          @if (isset($data->video_link))
                            <div class="carousel-item">
                                <a href="{{$data->video_link}}" class="video" target="_blank" title="This is a video">
                                    <video width="711" height="304" autoplay controls>
                                        <source src="{{$data->video_link}}" type="video/mp4">
                                    </video>
                                </a>
                                {{-- <video width="711" height="304" autoplay controls>
                                    <source src="{{$data->video_link}}" type="video/mp4">
                                </video> --}}
                            </div> 
                          @endif
                          
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class='col-md-4'>

                <div>
                    <div class=" display-6 fw-bold"> £@if (isset($totalcollection))
                        {{$totalcollection}}
                    @else 0 @endif  </div>
                    <span class="w-100 fw-bold">raised of £{{$data->raising_goal}} goal</span> 

                    <div class="d-flex justify-content-between my-3 ">
                        
                            <a href="{{ route('frontend.campaignDonate',$data->id)}}" class="btn-theme bg-secondary w-100 me-1 ms-0">Donate Now</a>
                        
                        <button class="btn-theme bg-primary w-100 ms-1" data-bs-toggle="modal"
                            data-bs-target="#shareModal">Share</button>
                    </div>
                    <div class="card p-4 rounded sideCard">
                       
                        @foreach ($doners as $doner)

                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    
                                    <h5 class="user d-inline ms-2 fw-bold">
                                        {{$doner->donation_display_name}}
                                    </h5>
                                </div>
                                <h5 class="fw-bold mb-0">£{{$doner->sumamount}}</h5>
                            </div>
                        @endforeach
                        
                    </div>
                    <div class="my-3">

                        @if (($totalcollection> 0))
                        
                        <a href="#" class="btn-theme bg-primary w-100 ms-1"  data-bs-toggle="modal" data-bs-target="#viewMoreDonation">View More..</a>

                        @endif


                    </div>
                </div>



                
                {{-- <div class="card p-4 rounded sideCard mb-3">
                    <div class=" display-6 fw-bold"> £@if (isset($totalcollection))
                        {{$totalcollection}}
                    @else 0 @endif  </div>
                    <big> <span class="w-100 fw-bold">raised of £{{$data->raising_goal}} goal</span></big>

                    <div class="d-flex justify-content-between my-3 ">
                        @if (Auth::user())
                            <a href="{{ route('frontend.campaignDonate',$data->id)}}" class="btn-theme bg-secondary w-100 me-1 ms-0">Donate Now</a>
                        @else
                            <!-- Button trigger modal -->
                            <button type="button"  class="btn-theme bg-secondary w-100 me-1 ms-0" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Donate Now
                                </button>
                        @endif
                        <button class="btn-theme bg-primary w-100 ms-1" data-bs-toggle="modal"
                            data-bs-target="#shareModal">Share</button>
                    </div>
                    @foreach ($doners as $doner)
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="user d-inline ms-2 fw-bold">
                                    {{$doner->donation_display_name}}
                                </h5>
                            </div>
                            <h3 class="fw-bold">£{{$doner->sumamount}}</h3>
                        </div>
                    @endforeach

                    
                    
                </div> --}}

            </div>
        <div>
        <div class="row">
            <div class="col-lg-8">
                
                <ul class="nav nav-tabs justify-content-start mt-4 mb-2 rounded-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fs-5 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Story</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fs-5" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false">Update</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fs-5" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab"
                            aria-controls="contact-tab-pane" aria-selected="false">Comments</button>
                    </li>
                    
                </ul>
                <div class="tab-content fs-5 mb-4" id="myTabContent">
                    <div class="tab-pane fade p-4 bg-white show active" id="home-tab-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        {!!$data->story!!}
                    </div>
                    <div class="tab-pane fade p-4 bg-white" id="profile-tab-pane" role="tabpanel"
                        aria-labelledby="profile-tab" tabindex="0">
                        {!!$data->information!!}
                    </div>
                    <div class="tab-pane fade p-4 bg-white" id="contact-tab-pane" role="tabpanel"
                        aria-labelledby="contact-tab" tabindex="0">

                        @foreach (\App\Models\Comment::where('campaign_id', $data->id)->orderby('id','DESC')->get(); as $comment)
                        <div class=" my-2 d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="user d-inline ms-2 fw-bold">
                                    {{$comment->user->name}}
                                </h5>
                                <p>{{$comment->comment}}</p>
                            </div>
                        </div>
                        @endforeach
                        
                        
                        <div class="cmntermsg"></div>
                        <div class="form-custom">
                            <div class="title text-center txt-secondary">Comment</div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="Message" required></textarea> 
                            </div>
                            <br>
                            <div class="form-group">


                                
                            @if (Auth::user())
                                <!-- Button trigger modal -->
                                
                                <button id="commentsubmit" class="btn-theme bg-primary d-block text-center mx-0 w-100"> Comment</button>
                            @else
                                <!-- Button trigger modal -->
                                <button type="button"  class="btn-theme bg-secondary w-100 me-1 ms-0 btn-contact" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Comment
                                </button>
                            @endif

                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                

                <div class="card p-4 rounded mb-3">
                    <div class="about-card text-center">
                        @if (isset($data->user->photo))
                            <img src="{{ asset('images/'.$data->user->photo)}}" class="img-circle">
                        @else
                            <img src="https://via.placeholder.com/100.png" class="img-circle">
                        @endif
                        <div class="title">{{$data->user->name}}</div>
                        <div class="my-3">
                            @if (Auth::user())
                                <!-- Button trigger modal -->
                                <button type="button"  class="btn-theme bg-secondary w-100 me-1 ms-0" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#contactmessageModal">
                                    Contact Organizer
                                </button>
                            @else
                                <!-- Button trigger modal -->
                                <button type="button"  class="btn-theme bg-secondary w-100 me-1 ms-0 btn-contact" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Contact Organizer
                                </button>
                            @endif
                        </div>

                        <div class="row"> 
                            @foreach ($data->campaignshare as $cshare)
                            <div class="col-lg-6 mb-2">
                                <div class="organizer-card text-center">
                                    <img src="{{ asset('images/'.$cshare->user->photo)}}" class="img-circle">
                                    <div class="title">{{$cshare->user->name}}</div>
                                </div>
                            </div> 
                            @endforeach
                        </div>

                    </div>
                </div>

                {{-- qr code scanner  --}}
                <div class="card p-4 rounded">
                    <div class="about-card text-center" style="background: #ffffff">

                        {!! QrCode::size(250)->generate(URL::current()) !!}
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
    <!-- share modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content fs-5 darkerGrotesque-semibold ">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="shareModalLabel">Help by sharing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-dark lh-1">Sharing the donation link is a simple yet impactful way to make a difference.</p>
                    <hr>
                    <div class="shareIcons">
                        {!! $shareComponent !!}
                        {{-- <div class="items text-center shadow-sm">
                            <a href="" class="d-flex flex-column justify-content-center align-items-center">
                                <iconify-icon class="fs-3" icon="logos:facebook"></iconify-icon>
                                <div class="txt-primary fw-bold">Facebook</div>
                            </a>
                        </div>
                        <div class="items text-center shadow-sm">
                            <a href="" class="d-flex flex-column justify-content-center align-items-center">
                                <iconify-icon class="fs-3" icon="logos:twitter"></iconify-icon>
                                <div class="txt-primary fw-bold">Twitter</div>
                            </a>
                        </div>
                        <div class="items text-center shadow-sm">
                            <a href="" class="d-flex flex-column justify-content-center align-items-center">
                                <iconify-icon class="fs-3" icon="ic:outline-email"></iconify-icon>
                                <div class="txt-primary fw-bold">Email</div>
                            </a>
                        </div>
                        <div class="items text-center shadow-sm">
                            <a href="" class="d-flex flex-column justify-content-center align-items-center">
                                <iconify-icon class="fs-3" icon="logos:whatsapp-icon"></iconify-icon>
                                <div class="txt-primary fw-bold">whatsapp</div>
                            </a>
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control fs-5"  id="myInput" style="height:46px;"
                            value="{{ URL::current() }}@if (Auth::user())?uid={{Auth::user()->id}} @else @endif">
                        <button class="btn btn-theme bg-primary"  onclick="copyTextFS()">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <input type="hidden" name="conid" id="conid" value="">
                    <input type="hidden" name="campaignid" id="campaignid" value="{{$data->id}}">
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
                     <a href="{{ route('register')}}" class="btn-theme bg-secondary d-block text-center mx-0 w-100"> Open an account</a>
                </div>
            </form>



        </div>
      </div>
    </div>
</div>

    <!--Message  Modal -->
    <div  class="modal fade" id="contactmessageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="ermsg"></div>

                <div class="form-custom">
    
                    <div class="title text-center txt-secondary">Message</div>
                    <div class="form-group">
                        <input type="hidden" id="campaignid" name="campaignid" value="{{$data->id}}">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="msgemail" type="email" class="form-control @error('msgemail') is-invalid @enderror" name="msgemail" value="{{ old('msgemail') }}" required autocomplete="msgemail" placeholder="Email" autofocus>
                        
                    </div>
                    <div class="form-group">
                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" placeholder="Subject" autofocus>
                        @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" id="message" name="message" placeholder="Message" required></textarea> 
                    </div>
                    <br>
                    <div class="form-group">
                        <button id="submit" class="btn-theme bg-primary d-block text-center mx-0 w-100">Send</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

         <!-- Modal -->
         <div class="modal fade" id="viewMoreDonation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h4 class="modal-title fw-bold my-1 text-white" id="exampleModalLabel">Donations</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row px-3 mb-2">
                            <!-- loop -->

                            @foreach ($alldoners as $doner)
                            <div class="mb-2 d-flex align-items-center justify-content-between px-2">
                                <div class="d-flex align-items-start">
                                    <h5 class="user d-inline ms-2 fw-bold d-flex flex-column ">
                                        {{$doner->donation_display_name}}
                                    </h5>
                                </div>
                                <h5 class="fw-bold">£{{$doner->sumamount}}</h5>
                            </div>
                            @endforeach

                        </div> 
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


        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

           //  make mail start
           var url = "{{URL::to('/campaign-message')}}";
           $("#submit").click(function(){
            
                   var name= $("#name").val();
                   var email= $("#msgemail").val();
                   var subject= $("#subject").val();
                   var message= $("#message").val();
                   var campaignid= $("#campaignid").val();
                   $.ajax({
                       url: url,
                       method: "POST",
                       data: {name,email,subject,message,campaignid},
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


           //  make mail start
           var cmnturl = "{{URL::to('/campaign-comment')}}";
           $("#commentsubmit").click(function(){
            
                   var comment = $("#comment").val();
                   var campaignid = $("#campaignid").val();
                   $.ajax({
                       url: cmnturl,
                       method: "POST",
                       data: {comment,campaignid},
                       success: function (d) {
                           if (d.status == 303) {
                               $(".cmntermsg").html(d.message);
                           }else if(d.status == 300){
                               $(".cmntermsg").html(d.message);
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

    $(document).on('click', '.btn-contact', function () {
        $('#loginModal').find('.modal-body #conid').val(1);
    });
</script>

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(document).ready(function () {
    // $('#loginModal').modal('show');
    window.$('#loginModal').modal();
});
</script>
@endif

@endsection