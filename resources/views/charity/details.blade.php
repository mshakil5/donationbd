@extends('frontend.layouts.master')

@section('content')



<section class="campaign default" id="editContainer">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-6 mt-2">
                <a href="{{ route('charity.profile')}}" class="btn-theme bg-secondary text-center">Back</a>
            </div> 
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto fs-5 shadow-sm p-4 border">
                <div class="row">
                    <h3 class="fw-bold darkerGrotesque-bold txt-primary">Charity Image</h3>
                </div>
                <div class="row darkerGrotesque-semibold">
                    <div class="col-lg-6">
                        <div class="ermsg"></div>
                        <div class="row">


                            <div class="col-lg-12">
                                {{-- <label for="image">Slider Image</label> --}}
                                <div class="form-group mb-3">
                                    <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="preview2">
                                    
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <button id="uploadimgBtn" class="ms-0 btn-theme bg-primary">Upload</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-6" >
                        <div id="contentContainer">
                            <table>
                                @foreach (\App\Models\CharityImage::where('user_id', Auth::user()->id)->get() as $item)
                                    
                                <tr>
                                    <td style="width: 80%; padding:2px">
                                        <img src="{{asset('images/charity/'.$item->image)}}" height="120px" width="220px" alt="">
                                    </td>
                                    <td style="width: 20%">
                                        <a id="deleteBtn" rid="{{$item->id}}" class="ms-0 btn-theme bg-primary"> Delete </a>
                                    </td>
                                </tr>
    
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            
            <div class="col-lg-8 mx-auto fs-5 shadow-sm p-4 border mt-2">
                <div class="row">
                    <h3 class="fw-bold darkerGrotesque-bold txt-primary">Charity Description</h3>
                </div>
                <div class="row darkerGrotesque-semibold">
                    <div class="col-lg-12">
                        <div class="cermsg"></div>
                        <div class="row">


                            <div class="col-lg-12">
                                {{-- <label for="image">Description</label> --}}
                                <div class="form-group mb-3">
                                    <textarea name="charity_details" id="charity_details" class="form-control summernote" cols="30" rows="10">{{Auth::user()->about}}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <button id="charityupdateBtn" class="ms-0 btn-theme bg-primary">Update</button>
                                </div>
                            </div>
                            
                            
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
    
    var storedFiles = [];
    $(document).ready(function () {

        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "{{URL::to('/charity/charity-images')}}";
            // console.log(url);
            $("#uploadimgBtn").click(function(){
                
                    var form_data = new FormData();
                    for(var i=0, len=storedFiles.length; i<len; i++) {
                        form_data.append('image[]', storedFiles[i]);
                    }
                    
                    
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


            var descurl = "{{URL::to('/charity/charity-description')}}";
            // console.log(url);
            $("#charityupdateBtn").click(function(){
                
                var form_data = new FormData();
                form_data.append("charity_details", $("#charity_details").val());
                $.ajax({
                    url:descurl,
                    type: "POST",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    data:form_data,
                    success: function(d){
                        // console.log(d);
                        if (d.status == 303) {
                            $(".cermsg").html(d.message);
                            pagetop();
                        }else if(d.status == 300){
                            $(".cermsg").html(d.message);
                            window.setTimeout(function(){location.reload()},2000)
                        }
                    },
                    error:function(d){
                        console.log(d);
                    }
                });
            });
            //Edit

            





    });

    // images
        /* WHEN YOU UPLOAD ONE OR MULTIPLE FILES */
        $(document).on('change','#image',function(){
            len_files = $("#image").prop("files").length;
            var construc = "<div class='row'>";
            for (var i = 0; i < len_files; i++) {
                var file_data2 = $("#image").prop("files")[i];
                storedFiles.push(file_data2);
                construc += '<div class="col-6 singleImage my-3"><span data-file="'+file_data2.name+'" class="btn ' +
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
<script type="text/javascript">
    $('.summernote').summernote({
        height: 200
    });
</script> 
@endsection