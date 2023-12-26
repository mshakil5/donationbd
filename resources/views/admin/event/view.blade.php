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
                    <button class="nav-link active" id="transaction-tab" data-bs-toggle="tab"
                        data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                        aria-selected="true">Basic Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button" role="tab" aria-controls="location" aria-selected="false"> Events Location & times </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn" type="button" role="tab" aria-controls="moneyIn" aria-selected="false"> Events Photo & Others </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab"
                        data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut"
                        aria-selected="false">Event Summery</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doc-tab" data-bs-toggle="tab" data-bs-target="#doc"
                        type="button" role="tab" aria-controls="doc" aria-selected="false">All Document</button>
                </li>


            </ul>
            <div class="tab-content" id="myTabContent">
                {{-- basic information  --}}
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
                                                        <input type="text" class="form-control" value="{{ $data->user->name }}-{{ $data->user->email }}" readonly>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event title</label>
                                                        <input type="text" name="title" class="form-control" id="title" value="{{$data->title}}">
                                                        <input type="hidden" name="codeid" class="form-control" id="codeid" value="{{$data->id}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Organizer</label>
                                                        <input type="text" name="organizer" class="form-control" id="organizer" value="{{$data->organizer}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Type</label>
                                                        <input type="text" name="event_type" class="form-control" id="event_type" value="{{$data->event_type}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Category</label>
                                                        <input type="text" name="category" class="form-control" id="category" value="{{$data->category}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tags</label>
                                                        <input type="text" name="tagline" class="form-control" id="tagline" value="{{$data->tagline}}">
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

                {{-- event location and time  --}}
                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Venue Name</label>
                                    <input type="text" class="form-control" id="venue_name" name="venue_name" value="{{$data->venue_name}}">
                                </div>               
                            </div>
                            <div class="col-lg-4">      
                                <div>
                                    <label for="house_number" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">House Number</label>
                                    <input type="text" placeholder="House Number" id="house_number" name="house_number" class="form-control" value="{{$data->house_number}}">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="road_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Street Name</label>
                                    <input type="text" placeholder="Road Name" id="road_name" name="road_name" class="form-control" value="{{$data->road_name}}">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="town" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Town</label>
                                    <input type="text" placeholder="city" id="town" name="town" class="form-control" value="{{$data->town}}">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="postcode" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Postcode</label>
                                    <input type="text" id="postcode" name="postcode" placeholder="Postal code" class="form-control" value="{{$data->postcode}}">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="country" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Country</label>
                                    <input type="text" placeholder="Country" id="country" name="country" class="form-control" value="{{$data->country}}">
                                </div>               
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Start Time</label>
                                    <input type="datetime-local" id="event_start_date" name="event_start_date" class="form-control" value="{{$data->event_start_date}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event End Time</label>
                                    <input type="datetime-local" id="event_end_date" name="event_end_date" class="form-control" value="{{$data->event_end_date}}" />
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                {{-- Events Photo & Others  --}}
                <div class="tab-pane fade" id="moneyIn" role="tabpanel" aria-labelledby="moneyIn-tab">
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
                                    <input type="file" name="image[]" class="form-control" multiple required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="preview2">
                                    <div class="row">
                                        @foreach ($data->eventimage as $img)
                                            <div class="col-3 singleImage my-3"><span id="{{$img->id}}" data-file="{{$img->image}}" class="btn btn-sm btn-danger imageremove2">×</span><img width="120px" height="auto" src="{{asset('images/event/'.$img->image)}}"  alt="Image"></div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-lg-12">      
                                <div>
                                    <label for="summery" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Summary</label>
                                    <input type="text" class="form-control" placeholder="Summery" id="summery" name="summery" value="{{$data->summery}}">
                                </div>               
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="description" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Description</label>
                                    <textarea name="description" id="description" class="form-control summernote">{!! $data->description !!}</textarea>
                                </div>
                            </div>

                            <hr>
                        </div>
                        
                    </div>
                </div>
                {{-- Event Summery  --}}
                <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                    <div class="data-container">
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale Start Time</label>
                                    <input type="datetime-local" id="sale_start_date" name="sale_start_date" class="form-control" value="{{$data->sale_start_date}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale End Time</label>
                                    <input type="datetime-local" id="sale_end_date" name="sale_end_date" class="form-control" value="{{$data->sale_end_date}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="price" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Price </label>
                                    <input type="number" name="price" class="form-control" id="price" value="{{$data->price}}">
                                </div>
                            </div>

                            
                            <div class="col-lg-6">
                                <div>
                                    <label for="quantity" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Quantity </label>
                                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{$data->quantity}}">
                                </div>
                            </div>


                            
                            <hr>
                        </div>
                    </div>
                </div>

                {{-- all documents  --}}

                
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
                                                                <input type="hidden" id="event_id" name="event_id" value="{{ $data->id }}">
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
                                                    @foreach ($data->eventimage as $key => $cimg)
                                                        <tr>
                                                            <td style="text-align: center">{{ $cimg->id }}</td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center">{{$cimg->title}}</td>
                                                            <td style="text-align: center">
                                                                @if ($cimg->image)
                                                                <img src="{{asset('images/event/'.$cimg->image)}}" height="120px" width="220px" alt="">
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
                                                            <td style="text-align: center"></td>
                                                            <td style="text-align: center">{{$data->title}}</td>
                                                            <td style="text-align: center"> Feature Image</td>
                                                            <td style="text-align: center">
                                                                
                                                                <img src="{{asset('images/event/'.$data->image)}}" height="120px" width="220px" alt="">
                                                                
                                                            </td>
                                                            <td style="text-align: center">
                                                                <a href="{{ route('download.featureimage',$data->id) }}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-download" style="color: #2196f3;font-size:16px;"></i> Download</a>
                                                                
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






            </div>
        </div>
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
            var imgurl = "{{URL::to('/admin/event-image-store')}}";
            var dlturl = "{{URL::to('/admin/event-image-delete')}}";
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