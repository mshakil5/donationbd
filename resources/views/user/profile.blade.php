@extends('frontend.layouts.master')

@section('content')

<section class="campaign default" id="viewContainer">
    <div class="container">
       
       <div class="col-lg-10 mx-auto">
        <h3 class="fw-bold darkerGrotesque-bold txt-primary mb-5">Your Profile</h3>
        <div class="row">
            <div class="col-lg-4 fs-5 shadow-sm p-4 border">
                @if (isset(Auth::user()->photo))
                    <img src="{{ asset('images/'.Auth::user()->photo)}}" class="img-fluid" alt="">
                @else
                    <img src="https://via.placeholder.com/510x440.png" class="img-fluid" alt="">
                @endif
                
            </div>
            <div class="col-lg-8 fs-5 shadow-sm p-4 border d-flex align-items-center position-relative">
                <div class="row darkerGrotesque-semibold "> 

                        <p class="mb-1"> Name: {{ Auth::user()->name }} </p>
                        <p class="mb-1"> Surname: {{ Auth::user()->sur_name }} </p>
                        <p class="mb-1"> Phone: {{ Auth::user()->phone }} </p>
                        <p class="mb-1"> Email: {{ Auth::user()->email }} </p>
                        <p class="mb-1"> House Number: {{ Auth::user()->house_number }} </p>
                        <p class="mb-1"> Street: {{ Auth::user()->street_name }} </p>
                        <p class="mb-1"> Town: {{ Auth::user()->town }} </p>
                        <p class="mb-1"> Post Code: {{ Auth::user()->postcode }} </p>
                   
                   

                </div>
                <button class="editProfile" id="editProfileBtn"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
            </div>

        </div>
       </div>
    </div>
</section>

<section class="campaign default" id="editContainer">
    <div class="container">
        <div class="row">
            <h3 class="fw-bold darkerGrotesque-bold txt-primary mb-5">Update Profile</h3>
        </div>
        <div class="row">
            <div class="col-lg-12 fs-5 shadow-sm p-4 border">
                <div class="row darkerGrotesque-semibold">
                    <div class="col-lg-10">
                        <div class="ermsg"></div>
                        <div class="row">
                            <div class="col-lg-4 ">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input class="form-control fs-5" type="text" id="name" name="name" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="sur_name">Surname</label>
                                    <input class="form-control fs-5" type="text" id="sur_name" name="sur_name" value="{{Auth::user()->sur_name}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control fs-5" type="text" id="phone" name="phone" value="{{Auth::user()->phone}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input class="form-control fs-5" type="email" id="email" name="email" value="{{Auth::user()->email}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="house_number">House Number</label>
                                    <input class="form-control fs-5" type="text" id="house_number" name="house_number" value="{{Auth::user()->house_number}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="street_name">Street Name</label>
                                    <input class="form-control fs-5" type="text" id="street_name" name="street_name" value="{{Auth::user()->street_name}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="town">Town</label>
                                    <input class="form-control fs-5" type="text" id="town" name="town" value="{{Auth::user()->town}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="postcode">Postcode</label>
                                    <input class="form-control fs-5" type="text" id="postcode" name="postcode" value="{{Auth::user()->postcode}}">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control fs-5" type="password" id="password" name="password" placeholder="Password">
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input class="form-control fs-5" type="password" id="confirm_password" name="" placeholder="Confirm Password">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group mb-3 text-center">
                            @if (isset(Auth::user()->photo))
                                <img src="{{ asset('images/'.Auth::user()->photo)}}" class="img-fluid mb-2 mx-auto rounded " width="120px" alt="">
                            @else
                                <img src="https://via.placeholder.com/510x440.png" class="img-fluid mb-2 mx-auto rounded " width="120px" alt="">
                            @endif
                            <p class="mb-1 text-start">Change profile Photo</p>
                            <input class="form-control fs-5" type="file" id="image" name="image">
                        </div>
                    </div>
                   
                    
                    <div class="col-lg-12 mt-3">
                        <div class="form-group">
                            <button id="updateBtn" class="ms-0 btn-theme bg-primary">Update Profile</button>
                            <button id="FormCloseBtn" class="ms-0 btn-theme bg-secondary">Close</button>
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
    $(document).ready(function () {

        $("#editContainer").hide();
        $("#editProfileBtn").click(function(){
            $("#viewContainer").hide(100);
            $("#editContainer").show(300);

        });
        $("#FormCloseBtn").click(function(){
            $("#editContainer").hide(200);
            $("#viewContainer").show(100);
        });

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/user/profile-update')}}";
            // console.log(url);
            $("#updateBtn").click(function(){
                var file_data = $('#image').prop('files')[0];
                if(typeof file_data === 'undefined'){
                    file_data = 'null';
                }
                var form_data = new FormData();
                form_data.append('image', file_data);
                form_data.append("name", $("#name").val());
                form_data.append("sur_name", $("#sur_name").val());
                form_data.append("phone", $("#phone").val());
                form_data.append("email", $("#email").val());
                form_data.append("house_number", $("#house_number").val());
                form_data.append("street_name", $("#street_name").val());
                form_data.append("town", $("#town").val());
                form_data.append("postcode", $("#postcode").val());
                form_data.append("password", $("#password").val());
                form_data.append("confirm_password", $("#confirm_password").val());
                
                $.ajax({
                    url: url,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function (d) {
                        if (d.status == 303) {
                            $(".ermsg").html(d.message);
                        }else if(d.status == 300){
                            pagetop();
                            $(".ermsg").html(d.message);
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });
            });

    });

    
</script>
@endsection
