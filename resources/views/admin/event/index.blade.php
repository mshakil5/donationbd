@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Event
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
                    <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location"
                        type="button" role="tab" aria-controls="location" aria-selected="false">
                    Events Location & times
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyIn-tab" data-bs-toggle="tab" data-bs-target="#moneyIn"
                        type="button" role="tab" aria-controls="moneyIn" aria-selected="false">
                    Events Photo & Others
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="moneyOut-tab" data-bs-toggle="tab"
                        data-bs-target="#moneyOut" type="button" role="tab" aria-controls="moneyOut"
                        aria-selected="false">Event Type & Price</button>
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
                                                        <label for="user_id" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Select User</label>
                                                        <select name="user_id" id="user_id" class="form-control select2" required>
                                                            <option value="">Select User</option>
                                                            @foreach ($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}-{{$user->sur_name}}-{{$user->email}}{{$user->clientid}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event title</label>
                                                        <input type="text" name="title" class="form-control" id="title">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Organizer</label>
                                                        <input type="text" name="organizer" class="form-control" id="organizer">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Type</label>
                                                        <input type="text" name="event_type" class="form-control" id="event_type">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Category</label>
                                                        <input type="text" name="category" class="form-control" id="category">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div>
                                                        <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tags</label>
                                                        <input type="text" name="tagline" class="form-control" id="tagline">
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

                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-12">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Venue Name</label>
                                    <input type="text" class="form-control" id="venue_name" name="venue_name">
                                </div>               
                            </div>
                            <div class="col-lg-4">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">House Number</label>
                                    <input type="text" placeholder="House Number" id="house_number" name="house_number" class="form-control">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Street Name</label>
                                    <input type="text" placeholder="Road Name" id="road_name" name="road_name" class="form-control">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Town</label>
                                    <input type="text" placeholder="city" id="town" name="town" class="form-control">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Postcode</label>
                                    <input type="text" id="postcode" name="postcode" placeholder="Postal code" class="form-control">
                                </div>               
                            </div>

                            
                            <div class="col-lg-4">      
                                <div>
                                    <label for="venue_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Country</label>
                                    <input type="text" placeholder="Country" id="country" name="country" class="form-control">
                                </div>               
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Start Time</label>
                                    <input type="datetime-local" id="event_start_date" name="event_start_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event End Time</label>
                                    <input type="datetime-local" id="event_end_date" name="event_end_date" class="form-control" />
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

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
                                    <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="preview2">
                                    
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-12">      
                                <div>
                                    <label for="summery" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Summary</label>
                                    <input type="text" class="form-control" placeholder="Summery" id="summery" name="summery">
                                </div>               
                            </div>

                            <div class="col-lg-12">
                                <div>
                                    <label for="description" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Event Description</label>
                                    <textarea name="description" id="description" class="form-control summernote"></textarea>
                                </div>
                            </div>
                            <hr>
                    
                        </div>
                        
                    </div>
                </div>
                
                <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                    <div class="data-container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale Start Time</label>
                                    <input type="datetime-local" id="sale_start_date" name="sale_start_date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale End Time</label>
                                    <input type="datetime-local" id="sale_end_date" name="sale_end_date" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div>
                                    <label for="quantity" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Quantity </label>
                                    <input type="number" name="quantity" class="form-control" id="quantity">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row"> 
                                    <div class="col-md-12 text-start">
                                        <input type="checkbox" id="pricecheck" value="1" class="me-2">
                                        Check this if event entry is free.
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">

                                <div class="row pricediv"> 
                                    <table class="text-left">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Type</th>
                                                <th scope="col" class="text-center">Description</th>
                                                <th scope="col" class="text-center">Price</th>
                                                <th scope="col" class="text-center">Total ticket</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="priceinner">
                                            <tr>
                                                <td class="px-2"><input type="text"    id="type" name="type[]"  class="form-control"></td>
                                                <td class="px-2"><input type="text" id="note" name="note[]"  class="form-control"></td>
                                                <td class="px-2"><input type="number"  id="ticket_price" name="ticket_price[]"  class="form-control"></td>
                                                <td class="px-2"><input type="number"  id="qty" name="qty[]"  class="form-control qty"></td>
                                                <td><a class="btn btn-sm btn-theme bg-secondary ms-1 add-new-row" id="addnewrow">+</a></td>
                                            </tr>
                                            
                                            
                                        </tbody>
                                    </table>
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
            
            <!-- Image loader -->
            <div id='loading' style='display:none ;'>
                <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." style="height: 225px;" />
            </div>
            
            <div class="col-md-12">
                <div class="card" style="background-color: #fdf3ee">
                    <div class="card-header">
                        <h3> All Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="exampleevent">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Date</th>
                                <th style="text-align: center">Title</th>
                                <th style="text-align: center">Event Organizer</th>
                                <th style="text-align: center">Event Start & End Date </th>
                                <th style="text-align: center">Sale Start & End Date </th>
                                <th style="text-align: center">Price</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $data)
                                    <tr>
                                        <td style="text-align: center">{{$data->id}}</td>
                                        <td style="text-align: center">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                                        <td style="text-align: center">
                                            <a href="{{route('admin.eventView',$data->id)}}" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">{{$data->title}}</a>
                                        </td>
                                        <td style="text-align: center">{{$data->user->name}}</td>
                                        
                                        <td style="text-align: center">{{ \Carbon\Carbon::parse($data->event_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->event_end_date)->format('d/m/Y') }}</td>
                                        <td style="text-align: center">{{ \Carbon\Carbon::parse($data->sale_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->sale_end_date)->format('d/m/Y') }}</td>

                                        <td style="text-align: center">
                                        @if ($data->is_free == 1)
                                            Free
                                        @else
                                            <a href="{{route('admin.eventPrice',$data->id)}}" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">Price</a>
                                        @endif    
                                        </td>
                                        <td style="text-align: center">
                                              <div class="dropdown account text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">
                                                <div class="d-flex align-items-center  dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="fw-bold fs-16 me-2">@if ($data->status == 0) Processing @elseif($data->status == 1) Active
                                                        @elseif($data->status == 2) Complete @else Decline @endif</span>
                                                </div>
                                                <ul class="dropdown-menu  " aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item stsBtn" data-id="{{$data->id}}" value="0">Processing</a>
                                                    <a class="dropdown-item stsBtn" data-id="{{$data->id}}" value="1">Active</a>
                                                    <a class="dropdown-item stsBtn" data-id="{{$data->id}}" value="2">Complete</a>
                                                    <a class="dropdown-item stsBtn" data-id="{{$data->id}}" value="3">Decline</a>
                                                </ul>
                                            </div>
                                        </td>
                                        
                                        <td style="text-align: center">

                                            <a href="{{route('admin.eventEdit',$data->id)}}"> <i class="fa fa-edit" style="color: #2196f3;font-size:16px;"> </i></a>

                                            <a href="{{route('admin.eventSaleRecord',$data->id)}}"> <i class="fa fa-eye" style="color: #287828;font-size:16px;"> </i></a>


                                            @if ($data->status == 0)
                                                <a id="deleteBtn" rid="{{$data->id}}"> <i class="fa fa-trash-o" style="color: red;font-size:16px;"></i></a>
                                            @endif

                                            
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


@endsection
@section('script')
<script type="text/javascript">
    $('.summernote').summernote({
        height: 200
    });
    
    $(document).ready(function () {
        $('.select2').select2();
    });

    $(document).ready(function() {
        var table = $('#exampleevent').DataTable( {
            responsive: true,
            order: [[0, 'desc']],
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        } );
    
    } );

    
</script>
<script>

    $(function() {
      $('.stsBtn').click(function() {
        var url = "{{URL::to('/admin/active-event')}}";
          var id = $(this).data('id');
          var status = $(this).attr('value');
        //   console.log(status);
          $.ajax({
              type: "GET",
              dataType: "json",
              url: url,
              data: {'status': status, 'id': id},
              success: function(d){
                // console.log(data.success)
                if (d.status == 303) {
                        pagetop();
                        $("#loading").hide();
                        $(".stsermsg").html(d.message);
                    }else if(d.status == 300){
                      
                        $("#stsval"+d.id).html(d.stsval);
                        pagetop();
                        $("#loading").hide();
                        $(".stsermsg").html(d.message);
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

    function removeRow(event) {
        event.target.parentElement.parentElement.remove(); 
    }

    $("#addnewrow").click(function() {

    var pmarkup = '<tr><td class="px-2"><input type="text" id="type" name="type[]" class="form-control"></td><td class="px-2"><input type="text" id="note" name="note[]" class="form-control"></td><td class="px-2"><input type="number" id="ticket_price" name="ticket_price[]" class="form-control"></td><td class="px-2"><input type="number" id="qty" name="qty[]" class="form-control qty"></td><td width="50px" style="padding-left:2px"><div style="color:#fff;user-select:none;padding:2px;background:red;width:25px;display:flex;align-items:center;margin-right:5px;justify-content:center;border-radius:4px;left:4px" onclick="removeRow(event)">X</div></td></tr>';
    $("div #priceinner ").append(pmarkup);

    });


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
            var url = "{{URL::to('/admin/event')}}";
            // console.log(url);
            $("#addBtn").click(function(){
                // fundraiser create 
                if($(this).val() == 'Create') {
                    var file_data = $('#fimage').prop('files')[0];
                    if(typeof file_data === 'undefined'){
                        file_data = 'null';
                    }

                    var form_data = new FormData();
                    for(var i=0, len=storedFiles.length; i<len; i++) {
                        form_data.append('image[]', storedFiles[i]);
                    }
                    form_data.append('fimage', file_data);
                    form_data.append("event_type", $("#event_type").val());
                    form_data.append("title", $("#title").val());
                    form_data.append("category", $("#category").val());
                    form_data.append("tagline", $("#tagline").val());
                    form_data.append("organizer", $("#organizer").val());
                    form_data.append("venue_name", $("#venue_name").val());
                    form_data.append("house_number", $("#house_number").val());
                    form_data.append("road_name", $("#road_name").val());
                    form_data.append("country", $("#country").val());
                    form_data.append("town", $("#town").val());
                    form_data.append("postcode", $("#postcode").val());
                    form_data.append("event_start_date", $("#event_start_date").val());
                    form_data.append("event_end_date", $("#event_end_date").val());
                    form_data.append("summery", $("#summery").val());
                    form_data.append("description", $("#description").val());
                    form_data.append("quantity", $("#quantity").val());
                    
                    form_data.append("sale_end_date", $("#sale_end_date").val());
                    form_data.append("sale_start_date", $("#sale_start_date").val());
                    form_data.append("user_id", $("#user_id").val());

                    if ($('#pricecheck').is(":checked"))
                    {
                        form_data.append("is_free", $("#pricecheck").val());
                    }

                    var type = $("input[name='type[]']")
                    .map(function(){return $(this).val();}).get();

                    var qty = $("input[name='qty[]']")
                        .map(function(){return $(this).val();}).get();

                    var ticket_price = $("input[name='ticket_price[]']")
                        .map(function(){return $(this).val();}).get();

                    var note = $("input[name='note[]']")
                        .map(function(){return $(this).val();}).get();

                        form_data.append('type', type);
                        form_data.append('qty', qty);
                        form_data.append('ticket_price', ticket_price);
                        form_data.append('note', note);
                    
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

            // qty calculation

    $("body").delegate(".qty","keyup",function(event){
        event.preventDefault();
        var row = $(this).parent().parent();
        var qty = row.find('.qty').val();
            if (isNaN(qty)) {
                qty = 1;
            }
            if (qty < 1) {
                qty = 1;
            }
        
        var qty_total= 0;
        $('.qty').each(function(){
            qty_total += ($(this).val()-0);
        })
        $('#quantity').val(qty_total);
        
    })
    // qty calculation end

    
</script>
@endsection