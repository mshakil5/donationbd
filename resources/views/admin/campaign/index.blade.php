@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Campaign
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ermsg">
            </div>
        </div>
    </div>
<div id="addThisFormContainer">
    
    
    <div class="row ">
        <div class="col-lg-12">
            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="transaction-tab" data-bs-toggle="tab"
                        data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                        aria-selected="true">Basic Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn"
                        type="button" role="tab" aria-controls="moneyIn" aria-selected="false">
                    Campaign Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab"
                        data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut"
                        aria-selected="false">Personal Information</button>
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
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="user_id">Select User</label>
                                                        <select name="user_id" id="user_id" class="form-control select2" required>
                                                            <option value="">Select User</option>
                                                            @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}-{{$user->sur_name}}-{{$user->email}}{{$user->clientid}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="name">Select Your Country</label>
                                                        <select name="country" id="country" class="form-control select2" required>
                                                            <option value="">Select Country</option>
                                                            <option value="225">UNITED KINGDOM</option>
                                                            {{-- @foreach ($countries as $cntry)
                                                            <option value="{{$cntry->id}}">{{$cntry->name}}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="source">Category</label>
                                                        <select name="source" id="source" class="form-control  select2" required>
                                                            <option value="">Select</option>
                                                            @foreach ($source as $source)
                                                            <option value="{{$source->id}}">{{$source->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Fundriser title</label>
                                                        <input type="text" name="title" class="form-control" id="title">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="story" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell your story </label>
                                                        <textarea name="story" id="story" class="form-control summernote"></textarea>
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
                            <div class="col-lg-12">      
                                <div>
                                    <label for="raising_goal" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">How much would you like to raise?</label>
                                    <input type="number" class="form-control" placeholder="Your starting goal" id="raising_goal" name="raising_goal">
                                </div>               
                            </div>
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
                            <div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Video Link</label>
                                    <input type="text" name="video_link" class="form-control" id="video_link">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="tagline" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Tagline</label>
                                    <input type="text" name="tagline" class="form-control" id="tagline">
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div>
                                    <label for="category" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Category </label>
                                    <input type="text" name="category" class="form-control"  id="category">
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div>
                                    <label for="location" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Location </label>
                                    <input type="text" name="location" class="form-control" id="location">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="funding_type" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Funding Type</label>
                                    <select name="funding_type" class="form-control" id="funding_type">
                                        <option value="">Select</option>
                                        <option value="Partial">Partial</option>
                                        <option value="All or Nothing">All or Nothing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="end_date" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> End Date </label>
                                    <input type="date" name="end_date" class="form-control" id="end_date">
                                </div>
                            </div>
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">      
                                <div>
                                    <label for="email" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Email</label>
                                    <input type="email" class="form-control" placeholder="Your email" id="email" name="email">
                                </div>               
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="family_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Family Name </label>
                                    <input type="text" name="family_name" class="form-control" id="family_name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="dob" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Date of birth</label>
                                    <input type="date" name="dob" class="form-control" id="dob">
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="phone" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Phone Number </label>
                                    <input type="text" name="phone" class="form-control" id="phone">
                                </div>
                                
                                
                            </div>
                            {{-- <div class="col-lg-12">
                                <div>
                                    <label for="country_address" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Country </label>
                                    <input type="text" name="country_address" class="form-control" id="country_address" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="address" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Address </label>
                                    <textarea name="address" id="address" class="form-control"></textarea>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div>
                                    <label for="city" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">House Number</label>
                                    <input type="text" name="city" class="form-control" id="city">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="street_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Street Name</label>
                                    <input type="text" name="street_name" class="form-control" id="street_name">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="town" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Town </label>
                                    <input type="text" name="town" class="form-control" id="town">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="postcode" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Post code </label>
                                    <input type="text" name="postcode" class="form-control" id="postcode">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="gov_issue_id" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Government Issued ID</label>
                                    <input type="file" name="gov_issue_id" class="form-control" id="gov_issue_id">
                                </div>
                            </div>
                            
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="data-container">
                        <div class="row">
                            {{-- <div class="col-lg-6">      
                                <div>
                                    <label for="currency" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Currency </label>
                                    <input type="text" name="currency" class="form-control" id="currency" required>
                                </div>               
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div>
                                    <label for="bank_account_country" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Country </label>
                                    <input type="text" name="bank_account_country" class="form-control" id="bank_account_country" required>
                                </div>
                            </div> --}}
                            <div class="col-lg-6">
                                <div>
                                    <label for="name_of_account" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name of the account</label>
                                    <input type="text" name="name_of_account" class="form-control" id="name_of_account" required>
                                </div>
                            </div>
                            

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Name</label>
                                    <input type="bank_name" name="bank_name" class="form-control" id="bank_name" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_account_number" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Account Number</label>
                                    <input type="text" name="bank_account_number" class="form-control" id="bank_account_number" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_sort_code" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Sort Code</label>
                                    <input type="text" name="bank_sort_code" class="form-control" id="bank_sort_code" required>
                                </div>
                            </div>

                            
                            {{-- <div class="col-lg-12">
                                <div>
                                    <label for="bank_routing" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Routing </label>
                                    <select name="bank_routing" id="bank_routing"  class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="SWIFT">SWIFT</option>
                                        <option value="BIC">BIC</option>
                                        <option value="Sort Code">Sort Code</option>
                                        <option value="BSB">BSB</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="iban" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">IBAN </label>
                                    <input type="text" name="iban" class="form-control" id="iban" required>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_verification_doc" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Verification Document</label>
                                    <input type="file" name="bank_verification_doc" class="form-control" id="bank_verification_doc">
                                </div>
                            </div>

                            

                            <div class="col-lg-12">
                                <div>
                                    
                                    
                                </div>
                            </div>
                            
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <input type="button" id="addBtn" value="Create" class="btn-theme bg-primary fs-16 fw-700">
            <input type="button" id="FormCloseBtn" value="Close" class="btn-theme bg-secondary">
        </div>
    </div>


</div>

<button id="newBtn" type="button" class="btn-theme bg-primary">Add New</button>
<div class="stsermsg"></div>
    <hr>
    <div id="contentContainer">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: #fdf3ee">
                    <div class="card-header">
                        <h3> All Data</h3>
                    </div>
                    <div class="card-body">

                        
                        <div class="container" style="max-width: 1400px;">
                            <table class="table table-bordered table-hover table-responsive" id="example" style="width: 100%">
                                <thead>
                                <tr>
                                    <th style="text-align: center">SL</th>
                                    <th style="text-align: center">Title</th>
                                    <th style="text-align: center">Username</th>
                                    <th style="text-align: center">Country</th>
                                    <th style="text-align: center">Raising Goal</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td style="text-align: center">{{ $key + 1 }}</td>
                                            <td style="text-align: center">
                                                <a href="{{route('admin.campaignView',$data->id)}}" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">{{$data->title}}</a>
                                            </td>
                                            <td style="text-align: center">{{$data->user->name}}</td>
                                            <td style="text-align: center">{{$data->country->name}}</td>
                                            <td style="text-align: center">{{$data->raising_goal}}</td>
                                            <td style="text-align: center">
                                                {{-- {{$data->status}} --}}
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input campaignstatus" type="checkbox" role="switch"  data-id="{{$data->id}}" id="campaignstatus" @if ($data->status == 1) checked @endif >
                                                </div>
                                            </td>
                                            
                                            <td style="text-align: center">
                                                
                                                <a href="{{route('admin.addinfo',$data->id)}}"> <i class="fa fa-plus" style="color: rgb(116, 197, 133);font-size:16px;"> </i></a>
    
                                                <a href="{{route('admin.campaignEdit',$data->id)}}"> <i class="fa fa-edit" style="color: #2196f3;font-size:16px;"> </i></a>
                                                <a id="deleteBtn" rid="{{$data->id}}"> <i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
    
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>

                        


                    </div>
                </div>
            </div>
        </div>
    </div>


        
</div>


@endsection
@section('script')
<script type="text/javascript">
    $('.summernote').summernote({
        height: 200
    });
    
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
<script>
    $(function() {
      $('.campaignstatus').change(function() {
        var url = "{{URL::to('/admin/active-campaign')}}";
          var status = $(this).prop('checked') == true ? 1 : 0;
          var id = $(this).data('id');
           console.log(id);
          $.ajax({
              type: "GET",
              dataType: "json",
              url: url,
              data: {'status': status, 'id': id},
              success: function(d){
                // console.log(data.success)
                if (d.status == 303) {
                        pagetop();
                        $(".stsermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)
                    }else if(d.status == 300){
                        pagetop();
                        $(".stsermsg").html(d.message);
                        window.setTimeout(function(){location.reload()},2000)
                    }
                },
                error: function (d) {
                    console.log(d);
                }
          });
      })
    })
</script>
<script>
    
    var storedFiles = [];
    $(document).ready(function () {

        $("#addThisFormContainer").hide();
            $("#newBtn").click(function(){
                // clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                // clearform();
            });

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/admin/campaign')}}";
            // console.log(url);
            $("#addBtn").click(function(){
                // fundraiser create 
                if($(this).val() == 'Create') {
                    var file_data = $('#fimage').prop('files')[0];
                    if(typeof file_data === 'undefined'){
                        file_data = 'null';
                    }

                    var bank_verification_doc = $('#bank_verification_doc').prop('files')[0];
                    if(typeof bank_verification_doc === 'undefined'){
                        bank_verification_doc = 'null';
                    }

                    var gov_issue_id = $('#gov_issue_id').prop('files')[0];
                    if(typeof gov_issue_id === 'undefined'){
                        gov_issue_id = 'null';
                    }

                    var form_data = new FormData();
                    for(var i=0, len=storedFiles.length; i<len; i++) {
                        form_data.append('image[]', storedFiles[i]);
                    }
                    form_data.append('fimage', file_data);
                    form_data.append("source", $("#source").val());
                    form_data.append("country", $("#country").val());
                    form_data.append("title", $("#title").val());
                    form_data.append("story", $("#story").val());
                    form_data.append("raising_goal", $("#raising_goal").val());
                    form_data.append("video_link", $("#video_link").val());
                    form_data.append("tagline", $("#tagline").val());
                    form_data.append("category", $("#category").val());
                    form_data.append("location", $("#location").val());
                    form_data.append("funding_type", $("#funding_type").val());
                    form_data.append("end_date", $("#end_date").val());
                    form_data.append("email", $("#email").val());
                    form_data.append("name", $("#name").val());
                    form_data.append("family_name", $("#family_name").val());
                    form_data.append("dob", $("#dob").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("country_address", $("#country_address").val());
                    form_data.append("address", $("#address").val());
                    form_data.append("city", $("#city").val());
                    form_data.append("street_name", $("#street_name").val());
                    form_data.append("town", $("#town").val());
                    form_data.append("postcode", $("#postcode").val());
                    // form_data.append("gov_issue_id", $("#gov_issue_id").val());
                    form_data.append("currency", $("#currency").val());
                    form_data.append("bank_account_country", $("#bank_account_country").val());
                    form_data.append("name_of_account", $("#name_of_account").val());
                    form_data.append("bank_name", $("#bank_name").val());
                    form_data.append("bank_account_number", $("#bank_account_number").val());
                    form_data.append("bank_sort_code", $("#bank_sort_code").val());
                    form_data.append("bank_account_class", $("#bank_account_class").val());
                    form_data.append("bank_account_type", $("#bank_account_type").val());
                    form_data.append("bank_routing", $("#bank_routing").val());
                    form_data.append("iban", $("#iban").val());
                    form_data.append('bank_verification_doc', bank_verification_doc);
                    form_data.append('gov_issue_id', gov_issue_id);
                    form_data.append("user_id", $("#user_id").val());
                    
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
                }
                // fundraiser create 
                

            });

            

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
                if(!confirm('Sure?')) return;
                codeid = $(this).attr('rid');
                info_url = url + '/'+codeid;
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