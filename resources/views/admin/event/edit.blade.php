@extends('admin.layouts.admin')

@section('content')


<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Event
            </div>
            <div class="ermsg"></div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-lg-12">
        </div>
    </div> --}}


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
                                                        <label for="organizer" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Organizer</label>
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
                                    <input type="text" class="form-control" placeholder="Summary" id="summery" name="summery" value="{{$data->summery}}">
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
                <div class="tab-pane fade" id="moneyOut" role="tabpanel" aria-labelledby="moneyOut-tab">
                    <div class="data-container">
                        <div class="row">
                            
                            <div class="col-lg-4">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale Start Time</label>
                                    <input type="datetime-local" id="sale_start_date" name="sale_start_date" class="form-control" value="{{$data->sale_start_date}}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label for="title" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sale End Time</label>
                                    <input type="datetime-local" id="sale_end_date" name="sale_end_date" class="form-control" value="{{$data->sale_end_date}}" />
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div>
                                    <label for="quantity" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Quantity </label>
                                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{$data->quantity}}">
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
                                                <th scope="col" class="text-center">
                                                    <a class="btn btn-sm btn-theme bg-secondary ms-1 add-new-row" id="addnewrow">+</a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="priceinner">
                                            @foreach ($data->eventprice as $price)
                                            <tr>
                                                <td class="px-2"><input type="text"    id="type" name="type[]"  value="{{$price->type}}" class="form-control"><input type="hidden" id="priceid" name="priceid[]" value="{{$price->id}}" ></td>
                                                <td class="px-2"><input type="text" id="note" name="note[]"  value="{{$price->note}}" class="form-control"></td>
                                                <td class="px-2"><input type="number" id="ticket_price" name="ticket_price[]"  value="{{$price->ticket_price}}" class="form-control">
                                                </td>
                                                <td class="px-2"><input type="number"  id="qty" name="qty[]"  value="{{$price->qty}}" class="form-control qty"></td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            
                                            
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
            <a href="{{route('admin.event')}}" class="btn-theme bg-secondary fs-16 fw-700">Back</a>
            <a id="upBtn" class="btn-theme bg-primary fs-16 fw-700">Update</a>
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
        
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            
            var updateurl = "{{URL::to('/admin/event-update')}}";
            // console.log(url);
            $("#upBtn").click(function(){
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
                    
                    form_data.append("codeid", $("#codeid").val());

                    if ($('#pricecheck').is(":checked"))
                    {
                        form_data.append("is_free", $("#pricecheck").val());
                    }
                    
                    var priceid = $("input[name='priceid[]']")
                        .map(function(){return $(this).val();}).get();

                    var type = $("input[name='type[]']")
                    .map(function(){return $(this).val();}).get();

                    var qty = $("input[name='qty[]']")
                        .map(function(){return $(this).val();}).get();

                    var ticket_price = $("input[name='ticket_price[]']")
                        .map(function(){return $(this).val();}).get();

                    var note = $("input[name='note[]']")
                        .map(function(){return $(this).val();}).get();

                        form_data.append('priceid', priceid);
                        form_data.append('type', type);
                        form_data.append('qty', qty);
                        form_data.append('ticket_price', ticket_price);
                        form_data.append('note', note);

                    
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