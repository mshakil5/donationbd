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
                    <h3 class="fw-bold darkerGrotesque-bold txt-primary">Bank Information</h3>
                </div>
                <div class="row darkerGrotesque-semibold">
                    <div class="col-lg-12">
                        <div class="ermsg"></div>
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
                                    <input type="bank_name" name="bank_name" class="form-control" id="bank_name"  value="{{$data->bank_name}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="bank_account_number" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Account Number</label>
                                    <input type="text" name="bank_account_number" class="form-control" id="bank_account_number"  value="{{$data->account_number}}" required>
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
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <button id="charitybankBtn" class="ms-0 btn-theme bg-primary">Save</button>
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
            

            var descurl = "{{URL::to('/charity/charity-bank-info')}}";
            // console.log(url);
            $("#charitybankBtn").click(function(){
                var bank_verification_doc = $('#bank_verification_doc').prop('files')[0];
                    if(typeof bank_verification_doc === 'undefined'){
                        bank_verification_doc = 'null';
                    }
                var form_data = new FormData();
                form_data.append('bank_verification_doc', bank_verification_doc);
                form_data.append("name_of_account", $("#name_of_account").val());
                form_data.append("bank_name", $("#bank_name").val());
                form_data.append("bank_account_number", $("#bank_account_number").val());
                form_data.append("bank_sort_code", $("#bank_sort_code").val());

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
                            $(".ermsg").html(d.message);
                            pagetop();
                        }else if(d.status == 300){
                            $(".ermsg").html(d.message);
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

</script>   
<script type="text/javascript">
    $('.summernote').summernote({
        height: 200
    });
</script> 
@endsection