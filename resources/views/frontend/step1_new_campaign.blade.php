@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-1">Lets begin your fundriser journey
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                we are here to guide you every step for thre way
                            </h5>
                        </div>
                    </div>
                    
                    <div class="row ">
                        <div class="col-lg-12 mx-auto">

                            <ul class="nav nav-tabs mt-5 border-0 py-4 justify-content-center  bg-transparent" id="myTab"
                                role="tablist">
                                <li class="nav-item fs-5 mx-2" role="presentation">
                                    <form action="{{route('newcampaign_post')}}" method="POST">
                                        @csrf
                                        <div class="nav-link shadow-sm d-flex align-items-center justify-content-center active" id="home-tab" data-bs-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                            
                                            <input type="hidden" name="fund_raising_type" class="form-control" id="fund_raising_type" value="yourself">
                                            
                                            @if (Auth::user())
                                            <button type="submit" class="fw-bold" style="border: none;background: #18988b;color: white;">Your Self/Someone Else</button>
                                            @else
                                            <!-- Button trigger modal -->
                                            <button type="button"  class="fw-bold" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                            Your Self/Someone Else
                                            </button>
                                            @endif
                                            
                                            
                                        </div>
                                    </form>
                                </li>
                                {{-- <li class="nav-item fs-5 mx-2" role="presentation">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center" id="profile-tab" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                        <div class="fw-bold">Someone Else</div>
                                    </div>
                                </li> --}}
                                <li class="nav-item fs-5 mx-2" role="presentation">
                                    {{-- <div class="nav-link shadow-sm d-flex align-items-center justify-content-center" id="contact-tab" data-bs-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">
                                        <div class="fw-bold">Charity</div>
                                    </div> --}}
                                    <a href="{{route('frontend.charityCampaign')}}" class="nav-link shadow-sm d-flex align-items-center justify-content-center">Charity</a>
                                </li>
                            </ul>
                            {{-- <div class="tab-content shadow-sm">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">

                                    <div class="row my-5">
                                        <button class="btn-theme bg-secondary mx-auto mt-4">Complete
                                            Fundriser</button>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
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
             
            <form method="POST" action="{{ route('login') }}" class="form-custom">
                @csrf

                <div class="title text-center txt-secondary">LOGIN</div>
                <div class="form-group">
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



@endsection

@section('script')
<script>

$(document).ready(function() {
    
});


</script>

@endsection