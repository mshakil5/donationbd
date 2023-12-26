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
            <div class="ermsg"></div>
            <div class="stsermsg"></div>
        </div>
    </div>


<div id="addThisFormContainer">
    
    <div class="row ">
        <div class="col-lg-12">
            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab"
                        data-bs-target="#basic" type="button" role="tab" aria-controls="basic"
                        aria-selected="true">Basic Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cInfo-tab" data-bs-toggle="tab" data-bs-target="#cInfo"
                        type="button" role="tab" aria-controls="cInfo" aria-selected="false">
                    Campaign Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pInfo-tab" data-bs-toggle="tab"
                        data-bs-target="#pInfo" type="button" role="tab" aria-controls="pInfo"
                        aria-selected="false">Personal Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bInfo-tab" data-bs-toggle="tab" data-bs-target="#bInfo"
                        type="button" role="tab" aria-controls="bInfo" aria-selected="false">Bank Information</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doc-tab" data-bs-toggle="tab" data-bs-target="#doc"
                        type="button" role="tab" aria-controls="doc" aria-selected="false">All Document</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="transaction-tab" data-bs-toggle="tab" data-bs-target="#transaction"
                        type="button" role="tab" aria-controls="transaction" aria-selected="false">Transaction</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment"
                        type="button" role="tab" aria-controls="comment" aria-selected="false"> Comment</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="basic" role="tabpanel"
                    aria-labelledby="basic-tab">
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
                                                        <input type="text" class="form-control" value="{{ $data->user->name }}-{{ $data->user->email }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                    <div>
                                                        <label for="name">Select Your Country</label>
                                                        <select name="country" id="country" class="form-control select2" required>
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $cntry)
                                                            <option value="{{$cntry->id}}" @if((isset($data->country_id))&&($data->country_id==$cntry->id)) selected @endif>{{$cntry->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                    <div>
                                                        <label for="source">Category</label>
                                                        
                                                        <select name="source" id="source" class="form-control  select2" required>
                                                            <option value="">Select</option>
                                                            <@foreach ($source as $source)
                                                            <option value="{{$source->id}}" @if((isset($data->fundraising_source_id))&&($data->fundraising_source_id==$source->id)) selected @endif>{{$source->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                
                                                </div>
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Fundriser title</label>
                                                        <input type="text" name="title" class="form-control" id="title" value="{{ $data->title }}" required>
                                                        <input type="hidden" name="codeid" class="form-control" id="codeid" value="{{ $data->id }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">

                                                    <div>
                                                        <label for="story" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell your story </label>
                                                        <textarea name="story" id="story" class="form-control summernote" required>{{ $data->story }}</textarea>
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
                <div class="tab-pane fade" id="cInfo" role="tabpanel" aria-labelledby="cInfo-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">      
                                <div>
                                    <label for="raising_goal" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">How much would you like to raise?</label>
                                    <input type="number" class="form-control" placeholder="Your starting goal" value="{{ $data->raising_goal }}" id="raising_goal" name="raising_goal">
                                </div>               
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="image" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Feature Image</label>
                                    <input type="file" name="fimage" class="form-control" id="fimage" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="image" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Photo</label>
                                    <input type="file" name="image[]" class="form-control" id="image2" multiple required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="preview2">
                                    <div class="row">
                                        @foreach ($data->campaignimage as $img)
                                            <div class="col-3 singleImage my-3"><span id="{{$img->id}}" data-file="{{$img->image}}" class="btn btn-sm btn-danger imageremove2">×</span><img width="120px" height="auto" src="{{asset('images/campaign/'.$img->image)}}"  alt="Image"></div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            <div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload Video Link</label>
                                    <input type="text" name="video_link" class="form-control" id="video_link"  value="{{ $data->video_link }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="tagline" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Tagline</label>
                                    <input type="text" name="tagline" value="{{ $data->tagline}}" class="form-control" id="tagline">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div>
                                    <label for="location" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Location </label>
                                    <input type="text" name="location" class="form-control" id="location" value="{{ $data->location }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="funding_type" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Funding Type</label>
                                    <select name="funding_type" class="form-control" id="funding_type">
                                        <option value="">Select</option>
                                        <option value="Partial" @if ($data->funding_type == "Partial") selected @endif>Partial</option>
                                        <option value="All or Nothing" @if ($data->funding_type == "All or Nothing") selected @endif>All or Nothing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="end_date" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> End Date </label>
                                    <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $data->end_date  }}">
                                </div>
                            </div>
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="pInfo" role="tabpanel" aria-labelledby="pInfo-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">      
                                <div>
                                    <label for="email" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Email</label>
                                    <input type="email" class="form-control" placeholder="Your email" id="email" name="email" value="{{ $data->email }}" required>
                                </div>               
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="family_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Family Name </label>
                                    <input type="text" name="family_name" class="form-control" id="family_name" value="{{ $data->family_name }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="dob" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Date of birth</label>
                                    <input type="date" name="dob" class="form-control" id="dob" value="{{ $data->dob }}" required>
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="phone" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Phone Number </label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $data->phone }}" required>
                                </div>
                                
                                
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="city" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">House Number</label>
                                    <input type="text" name="city" class="form-control" id="city" value="{{ $data->city  }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="street_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Street Name</label>
                                    <input type="text" name="street_name" class="form-control" id="street_name" value="{{ $data->street_name  }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="town" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Town </label>
                                    <input type="text" name="town" class="form-control" id="town" value="{{ $data->town }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="postcode" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Post code </label>
                                    <input type="text" name="postcode" class="form-control" id="postcode" value="{{ $data->postcode  }}" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="gov_issue_id" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Government Issued ID</label>
                                    <input type="text" name="gov_issue_id" class="form-control" id="gov_issue_id" value="{{ $data->gov_issue_id  }}" required>
                                </div>
                            </div>
                            
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="bInfo" role="tabpanel" aria-labelledby="bInfo-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <label for="name_of_account" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name of the account</label>
                                    <input type="text" name="name_of_account" class="form-control" id="name_of_account" value="{{ $data->name_of_account }}" required>
                                </div>
                            </div>
                            

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Name</label>
                                    <input type="bank_name" name="bank_name" class="form-control" id="bank_name" value="{{ $data->bank_name }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_account_number" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Account Number</label>
                                    <input type="text" name="bank_account_number" class="form-control" id="bank_account_number" value="{{ $data->bank_account_number }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_sort_code" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Sort Code</label>
                                    <input type="text" name="bank_sort_code" class="form-control" id="bank_sort_code" value="{{ $data->bank_sort_code }}" required>
                                </div>
                            </div>

                            
                            <div class="col-lg-12">
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
                <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                    <div class="data-container">

                        <div id="addDocContainer" class="mt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="background-color: #fdf3ee">
                                        <div class="card-header">
                                            <h5>New Pages</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="ermsg">
                                                </div>
                                                <div class="col-md-12">
                                                  <div class="tile">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                          {!! Form::open(['url' => 'admin/master/create','id'=>'createThisForm']) !!}
                                                          {!! Form::hidden('codeid','', ['id' => 'codeid']) !!}
                                                          @csrf
                                                          {{-- <div>
                                                              <label for="title">Title</label>
                                                              <input type="text" id="title" name="title" class="form-control">
                                                          </div> --}}

                                                          <div>
                                                            <label for="category">Category</label>
                                                            <select name="category" id="category" class="form-control">
                                                                <option value="1">Slider Image</option>
                                                                <option value="2">Bank Document</option>
                                                                <option value="3">Govt. Document</option>
                                                            </select>
                                                        </div>
                        
                                                          
                                                            
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <label for="image">Image</label>
                                                                <input class="form-control" id="image" name="image[]" type="file" multiple>
                                                                <input type="hidden" id="campaign_id" name="campaign_id" value="{{ $data->id }}">
                                                            </div>

                                                            <div class="imgpreview">
                                    
                                                            </div>

                                                        </div>
                                                      </div>
                                                      <div class="tile-footer mt-3">
                                                          <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                                          <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning">
                                                          {!! Form::close() !!}
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                        
                                        </div>
                                    </div>
                                </div>
                        
                            </div>
                        
                        </div>
                        
                        <button id="newBtn" type="button" class="btn-theme bg-primary">Add New</button>
                        
                        <div id="contentContainer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="background-color: #fdf3ee">
                                        <div class="card-header">
                                            <h3> All Data</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover" id="exdatatable">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center">ID</th>
                                                        <th style="text-align: center">Title</th>
                                                        <th style="text-align: center">Image Category</th>
                                                        <th style="text-align: center">Image</th>
                                                        <th style="text-align: center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->campaignimage as $key => $cimg)
                                                        <tr>
                                                            <td style="text-align: center">{{ $key + 1 }}</td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center">{{$cimg->title}}</td>
                                                            <td style="text-align: center">
                                                                @if ($cimg->image)
                                                                @if ($cimg->title == "Bank")
                                                                    
                                                                <img src="{{asset('images/bank/'.$cimg->image)}}" height="120px" width="220px" alt="">
                                                                @else
                                                                    
                                                                <img src="{{asset('images/campaign/'.$cimg->image)}}" height="120px" width="220px" alt="">
                                                                @endif
                                                                @endif
                                                            </td>
                                                            
                                                            <td style="text-align: center">
                                                                <a href="{{ route('download.campaignimage',$cimg->id) }}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-download" style="color: #2196f3;font-size:16px;"></i>  Download</a>

                                                                <a id="deleteBtn" rid="{{$cimg->id}}" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-trash-o" style="color: red;font-size:16px;"> </i> Delete</a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                        @if ($data->image)
                                                        <tr>
                                                            <td style="text-align: center">{{ $key + 1 }}</td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center"> Feature Image</td>
                                                            <td style="text-align: center">
                                                                
                                                                <img src="{{asset('images/campaign/'.$data->image)}}" height="120px" width="220px" alt="">
                                                                
                                                            </td>
                                                            <td style="text-align: center">
                                                                <a href="{{ route('download.featureimage',$data->id) }}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-download" style="color: #2196f3;font-size:16px;"></i> Download</a>
                                                                
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if ($data->bank_verification_doc)
                                                        <tr>
                                                            <td style="text-align: center">{{ $key + 1 }}</td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center">Bank Document</td>
                                                            <td style="text-align: center">
                                                                
                                                                <img src="{{asset('images/bank/'.$data->bank_verification_doc)}}" height="120px" width="220px" alt="">
                                                                
                                                            </td>
                                                            <td style="text-align: center">
                                                                
                                                                <a href="{{ route('download.bankdoc',$data->id) }}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-download" style="color: #2196f3;font-size:16px;"></i> Download</a>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        

                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('admin.campaign.alltranview')
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="doc-tab">
                    <div class="data-container">
                        
                        <div id="commentContainer">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="background-color: #fdf3ee">
                                        <div class="card-header">
                                            <h3> All Comment</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover" id="exdatatable">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center">ID</th>
                                                        <th style="text-align: center">Campaign Title</th>
                                                        <th style="text-align: center">User</th>
                                                        <th style="text-align: center">Comment</th>
                                                        <th style="text-align: center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data->comment as $key => $comment)
                                                        <tr>
                                                            <td style="text-align: center">{{ $key + 1 }}</td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center">
                                                            {{$comment->user->name}}
                                                            </td>
                                                            <td style="text-align: center">
                                                                {{$comment->comment}}
                                                            </td>
                                                            <td style="text-align: center">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input commentstatus" type="checkbox" role="switch"  data-id="{{$comment->id}}" id="commentstatus" @if ($comment->status == 1) checked @endif >
                                                                </div>
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
            </div>
        </div>
        {{-- <div class="col-lg-12">
            <a href="{{route('admin.campaign')}}" class="btn-theme bg-secondary fs-16 fw-700">Back</a>
            <a id="upBtn" class="btn-theme bg-primary fs-16 fw-700">Update</a>
        </div> --}}
    </div>


</div>

        
</div>


@endsection
@section('script')

<script type="text/javascript">
    $('.summernote').summernote({
        height: 400
    });

    $(document).ready(function() {
        $('#example1, #example2, #example3').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });

    $(function() {
      $('.commentstatus').change(function() {
        var url = "{{URL::to('/admin/active-comment')}}";
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
    
    var imgStoreFile = [];
    var storedFiles = [];
    $(document).ready(function () {
        
            $("#addDocContainer").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addDocContainer").show(300);
            });
            $("#FormCloseBtn").click(function(){
                $("#addDocContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });
            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var imgurl = "{{URL::to('/admin/campaign-image-store')}}";
            var dlturl = "{{URL::to('/admin/campaign-image-delete')}}";
            // console.log(url);
            $("#addBtn").click(function(){
                
                if($(this).val() == 'Create') {
                    
                    var form_data = new FormData();
                    for(var i=0, len=imgStoreFile.length; i<len; i++) {
                        form_data.append('image[]', imgStoreFile[i]);
                    }
                    // form_data.append("title", $("#title").val());
                    form_data.append("category", $("#category").val());
                    form_data.append("campaign_id", $("#campaign_id").val());
                    $.ajax({
                      url: imgurl,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                        console.log(d);
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
                }
                //create  end
                
            });
            //Edit

            //Delete
            $("#contentContainer").on('click','#deleteBtn', function(){
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
        // $(document).on('change','#image',function(){
        //     len_files = $("#image").prop("files").length;
        //     var construc = "<div class='row'>";
        //     for (var i = 0; i < len_files; i++) {
        //         var file_data2 = $("#image").prop("files")[i];
        //         storedFiles.push(file_data2);
        //         construc += '<div class="col-3 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' +
        //             'btn-sm btn-danger imageremove2">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data2) + '" alt="'  +  file_data2.name  + '" /></div>';
        //     }
        //     construc += "</div>";
        //     $('.preview2').append(construc);
        // });

        // $(".preview2").on('click','span.imageremove2',function(){
        //     var trash = $(this).data("file");
        //     for(var i=0;i<storedFiles.length;i++) {
        //         if(storedFiles[i].name === trash) {
        //             storedFiles.splice(i,1);
        //             break;
        //         }
        //     }
        //     $(this).parent().remove();

        // });

        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        $(document).on('change','#image',function(){
            len_files = $("#image").prop("files").length;
            var construc = "<div class='row'>";
            for (var i = 0; i < len_files; i++) {
                var file_data2 = $("#image").prop("files")[i];
                imgStoreFile.push(file_data2);
                construc += '<div class="col-6 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' +
                    'btn-sm btn-danger imageremove2">&times;</span><img width="120px" height="auto" src="' +  window.URL.createObjectURL(file_data2) + '" alt="'  +  file_data2.name  + '" /></div>';
            }
            construc += "</div>";
            $('.imgpreview').append(construc);
        });

        $(".imgpreview").on('click','span.imageremove2',function(){
            var trash = $(this).data("file");
            for(var i=0;i<imgStoreFile.length;i++) {
                if(imgStoreFile[i].name === trash) {
                    imgStoreFile.splice(i,1);
                    break;
                }
            }
            $(this).parent().remove();

        });


    
</script>
@endsection