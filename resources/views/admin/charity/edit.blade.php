@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Charity Update
            </div>
        </div>
    </div>
    <div id="addThisFormContainer">
        <div class="row">
            <div class="ermsg"> </div>

            {{-- new code  --}}
            
            <div class="col-lg-12">
                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="transaction-tab" data-bs-toggle="tab"
                            data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                            aria-selected="true">Charity Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn"
                            type="button" role="tab" aria-controls="moneyIn" aria-selected="false">
                            Representative Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab"
                            data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut"
                            aria-selected="false">Image</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                            type="button" role="tab" aria-controls="pending" aria-selected="false">Bank Information</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="transaction" role="tabpanel"
                        aria-labelledby="transaction-tab">
                        <div class="data-container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="background-color: #fdf3ee">
                                        <div class="card-body">
                                            <div class="tile">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        {!! Form::open(['url' => 'admin/master/create','id'=>'createThisForm']) !!}
                                                        {!! Form::hidden('codeid','', ['id' => 'codeid']) !!}
                                                        @csrf
                                                        <div>
                                                            <label for="name">Charity Name</label>
                                                            <input type="text" id="name" name="name" class="form-control" value="{{$data->name}}">
                                                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{$data->id}}">
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="charity_reg_number">Registration Number</label>
                                                            <input type="number" id="charity_reg_number" name="charity_reg_number" class="form-control" value="{{$data->charity_reg_number}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="country">Country</label>
                                                            <select name="country" id="country" class="form-control">
                                                                <option value="">Please Select</option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{$country->id}}" @if ($country->id == $data->country) active
                                                                    @endif>{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="story" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Charity Description </label>
                                                            <textarea name="story" id="story" class="form-control summernote">{{$data->about}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                        
                                        </div>
                                    </div>
                                </div>
                        
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="moneyIn" role="tabpanel" aria-labelledby="moneyIn-tab">
                        <div class="data-container">
                            <div class="row">

                                
                                <div class="col-lg-6">
                                    <div>
                                        <label for="r_name">Name</label>
                                        <input type="text" id="r_name" name="r_name" value="{{$data->r_name}}" class="form-control">
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" value="{{$data->email}}" class="form-control">
                                    </div>
                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="r_position">Position</label>
                                        <input type="text" id="r_position" name="r_position" value="{{$data->r_position}}" class="form-control">
                                    </div>
                                    <div>
                                        <label for="r_phone">Phone</label>
                                        <input type="text" id="r_phone" name="r_phone" value="{{$data->r_phone}}" class="form-control">
                                    </div>
                                    <div>
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                    </div>
                                </div>

                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                        <div class="data-container">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div>
                                        <label for="image" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Feature Image <small>(1000*700)</small> </label>
                                        <input type="file" name="fimage" class="form-control" id="fimage" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="image" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Photo <small>(711*304)</small></label>
                                        <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="preview2">
                                        
                                    </div>
                                </div>

                                <div class="col-lg-6" id="imgContainer">
                                    <table>
                                        @foreach ($data->charityimage as $iimg)
                                            
                                        <tr>
                                            <td style="width: 80%; padding:2px">
                                                <img src="{{asset('images/charity/'.$iimg->image)}}" height="120px" width="220px" alt="">
                                            </td>
                                            <td style="width: 20%">
                                                <a id="deleteBtn" rid="{{$iimg->id}}" class="ms-0 btn-theme bg-primary"> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </table>
                                </div>
                                
                                <hr>
                        
                            </div>
                            
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="data-container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <label for="name_of_account" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name of the account</label>
                                        <input type="text" name="name_of_account" class="form-control" id="name_of_account" value="{{$data->account_name}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="bank_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Name</label>
                                        <input type="bank_name" name="bank_name" class="form-control" id="bank_name" value="{{$data->bank_name}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="bank_account_number" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Account Number</label>
                                        <input type="text" name="bank_account_number" class="form-control" id="bank_account_number" value="{{$data->account_number}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="bank_sort_code" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Sort Code</label>
                                        <input type="text" name="bank_sort_code" class="form-control" id="bank_sort_code" value="{{$data->account_sortcode}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>
                                        <label for="bank_verification_doc" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Verification Document</label>
                                        <input type="file" name="bank_verification_doc" class="form-control" id="bank_verification_doc">
                                    </div>
                                </div>
                                <hr>
                        
                            </div>
                            
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-12">
                    <input type="button" id="upBtn" value="Update" class="btn-theme bg-primary fs-16 fw-700">
                    <input type="button" id="FormCloseBtn" value="Close" class="btn-theme bg-secondary">
                </div>


            </div>
            {{-- new code end --}}
        </div>

    </div>
</div>


@endsection
@section('script')

<script>
    
    var storedFiles = [];
    $(document).ready(function () {
        
        $('.summernote').summernote({
            height: 200
        });


        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/admin/charity')}}";
            var dlturl = "{{URL::to('/admin/charityimage')}}";
            var updateurl = "{{URL::to('/admin/charity-update')}}";
            // console.log(url);
            $("#upBtn").click(function(){

                var file_data = $('#fimage').prop('files')[0];
                if(typeof file_data === 'undefined'){
                    file_data = 'null';
                }
                var bank_verification_doc = $('#bank_verification_doc').prop('files')[0];
                if(typeof bank_verification_doc === 'undefined'){
                    bank_verification_doc = 'null';
                }
                var form_data = new FormData();
                for(var i=0, len=storedFiles.length; i<len; i++) {
                    form_data.append('image[]', storedFiles[i]);
                }
                form_data.append('bank_verification_doc', bank_verification_doc);
                form_data.append('fimage', file_data);
                form_data.append("name", $("#name").val());
                form_data.append("charity_reg_number", $("#charity_reg_number").val());
                form_data.append("country", $("#country").val());
                form_data.append("story", $("#story").val());

                form_data.append("email", $("#email").val());
                form_data.append("r_phone", $("#r_phone").val());
                form_data.append("r_position", $("#r_position").val());
                form_data.append("r_name", $("#r_name").val());
                form_data.append("password", $("#password").val());
                form_data.append("confirm_password", $("#confirm_password").val());

                form_data.append("name_of_account", $("#name_of_account").val());
                form_data.append("bank_name", $("#bank_name").val());
                form_data.append("bank_account_number", $("#bank_account_number").val());
                form_data.append("bank_sort_code", $("#bank_sort_code").val());
                form_data.append("user_id", $("#user_id").val());
                
                $.ajax({
                    url: updateurl,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function (d) {
                        console.log(d);
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


            //Delete
            $("#imgContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                info_url = dlturl + '/'+codeid;
                $.ajax({
                    url:info_url,
                    method: "GET",
                    type: "DELETE",
                    data:{
                    },
                    success: function(d){
                        if(d.success) {
                            alert(d.message);
                            location.reload();
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
            //Delete

            

            function clearform(){
                $('#createThisForm')[0].reset();
                $("#addBtn").val('Create');
            }

    });
   // images
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        $(document).on('change','#image',function(){
            len_files = $("#image").prop("files").length;
            var construc = "<div class='row'>";
            for (var i = 0; i < len_files; i++) {
                var file_data2 = $("#image").prop("files")[i];
                storedFiles.push(file_data2);
                construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' +
                    'btn-sm btn-danger imageremove2">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data2) + '" alt="'  +  file_data2.name  + '" /></div>';
            }
            construc += "</div>";
            $('.preview2').append(construc);
        });

        $(".preview2").on('click','span.imageremove2',function(){
            var trash = $(this).data("file");
            for(var i=0;i<storedFiles.length;i++) {
                if(storedFiles[i].name === trash) {
                    storedFiles.splice(i,1);
                    break;
                }
            }
            $(this).parent().remove();

        });
    
</script>
@endsection