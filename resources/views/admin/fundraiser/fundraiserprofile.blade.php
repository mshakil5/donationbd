@extends('admin.layouts.admin')

@section('content')


<a href="{{route('admin.fundraiserProfile',$data->id)}}" class="btn-theme bg-primary">Profile</a>
<a href="{{route('admin.fundraiserdonation',$data->id)}}" class="btn-theme bg-primary">Donation</a>
<a href="{{route('admin.fundraisertran',$data->id)}}" class="btn-theme bg-primary">Transaction</a>
    <hr>
<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                User profile
            </div>
            
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12">
            <div class="row ">
                <div class="col-lg-3 py-5 text-center flex-column d-flex align-items-center">
                    @if (isset($data->photo))
                        <img src="{{ asset('images/'.$data->photo)}}" class="img-fluid mt-3 mb-2" alt="">
                    @else
                        <img src="{{ asset('assets/admin/images/profile.png')}}" class="img-fluid mt-3 mb-2" alt="">
                    @endif

                    
                    <label for="">Update profile picture</label>
                    <div class="d-flex align-items-center">
                        <input type="file" class="form-control me-3" name="image" id="image">
                    </div>
                    {{-- <a href="#" class="txt-theme txt-secondary fs-14 my-2">Update profile picture</a> --}}
                </div>

                <div class="col-lg-9 border-left-lg  pt-3">
                    <div class="col-lg-11 mx-auto">
                        <div class="ermsg"></div>
                            <div class="row mt-4">
                                <div class="col-lg-6  ">
                                    <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" name="name" id="name" value="{{$data->name}}" placeholder="Benzion Yehuda">
                                            <input type="hidden" class="form-control me-3" name="codeid" id="codeid" value="{{$data->id}}" placeholder="Benzion Yehuda">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Surname</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" name="sur_name" id="sur_name" value="{{$data->sur_name}}" placeholder="Landau">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Phone</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" value="{{$data->phone}}" id="phone" name="phone" placeholder="02071128919">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <div class="d-flex align-items-center">
                                            <input type="email" class="form-control me-3" id="email" name="email" value="{{$data->email}}" placeholder="14 Grosevenor Way@initact.com">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">House Number</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" id="house_number" name="house_number" value="{{$data->house_number}}" placeholder="House Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Street Name</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" id="street_name" name="street_name" value="{{$data->street_name}}" placeholder="Street Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Town</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" id="town" name="town" value="{{$data->town}}" placeholder="London">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Postcode</label>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="form-control me-3" id="postcode" name="postcode" value="{{$data->postcode}}" placeholder="E5 9ND">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Password</label>
                                        <div class="d-flex align-items-center">
                                            <input type="password" class="form-control me-3" id="" name="" placeholder="********">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="">Confirm password</label>
                                        <div class="d-flex align-items-center">
                                            <input type="password" class="form-control me-3" id="" name="" placeholder="********">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mt-4">
                                        <button class="btn-theme bg-primary" id="updateBtn">Update profile</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                  
                 
                </div> 
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')

<script>
    $(document).ready(function () {

        $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/admin/new-fundraiser-update')}}";
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
                    form_data.append("email", $("#email").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("house_number", $("#house_number").val());
                    form_data.append("street_name", $("#street_name").val());
                    form_data.append("town", $("#town").val());
                    form_data.append("postcode", $("#postcode").val());
                    form_data.append("password", $("#password").val());
                    form_data.append("confirm_password", $("#confirm_password").val());
                    form_data.append("codeid", $("#codeid").val());
                    
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
                //Update

            });

            

            

            

    });

    
</script>
@endsection