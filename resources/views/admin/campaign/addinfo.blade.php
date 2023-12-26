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
        </div>
    </div>


<div id="addThisFormContainer">
    
    
    
    <div class="row ">
        <div class="col-lg-12">
            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="transaction-tab" data-bs-toggle="tab"
                        data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                        aria-selected="true">Update</button>
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
                                                        <label for="information" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Information </label>
                                                        <textarea name="information" id="information" class="form-control summernote" required>{{ $data->information }}</textarea>
                                                        
                                                        <input type="hidden" name="codeid" class="form-control" id="codeid" value="{{ $data->id }}">
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
        <div class="col-lg-12">
            <a href="{{route('admin.campaign')}}" class="btn-theme bg-secondary fs-16 fw-700">Back</a>
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
    $(document).ready(function () {
        
        //header for csrf-token is must in laravel
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            // var url = "{{URL::to('/admin/campaign')}}";
            var updateurl = "{{URL::to('/admin/campaign-info-update')}}";
            // console.log(url);
            $("#upBtn").click(function(){
                    
                var form_data = new FormData();
                form_data.append("information", $("#information").val());
                form_data.append("codeid", $("#codeid").val());
                
                $.ajax({
                    url: updateurl,
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