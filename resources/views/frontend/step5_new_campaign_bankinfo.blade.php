@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    
                    <div class="row mt-4">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-3">Bank information
                            </div>
                            <form action="{{route('campaignConfirmation_post')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                                     
                                <div class="row my-3">
                                    {{-- <div class="col-lg-12 mb-3">
                                        <label for="currency" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Currency </label>
                                        <input type="text" name="currency" class="form-control" id="currency" value="{{ $step5dataForm['currency'] ?? ''  }}" required>
                                    </div> --}}

                                    <div class="col-lg-12 ">
                                        <label for="name_of_account" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name of the account</label>
                                        <input type="text" name="name_of_account" class="form-control" id="name_of_account" value="{{ $step5dataForm['name_of_account'] ?? ''  }}">
                                    </div>
                                    {{-- <div class="col-lg-12 ">
                                        <label for="bank_account_country" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Country </label>
                                        <input type="text" name="bank_account_country" class="form-control" id="bank_account_country" value="{{ $step5dataForm['bank_account_country'] ?? ''  }}" required>
                                    </div> --}}

                                    <div class="col-lg-12 ">
                                        <label for="bank_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Name</label>
                                        <input type="bank_name" name="bank_name" class="form-control" id="bank_name" value="{{ $step5dataForm['bank_name'] ?? ''  }}">
                                    </div>
                                    {{-- <div class="col-lg-6 ">
                                        <label for="bank_account_class" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Account Class </label>
                                        <select name="bank_account_class" id="bank_account_class"  class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Personal" @if((isset($step5dataForm["bank_account_class"]))&&($step5dataForm["bank_account_class"]=="Personal")) selected @endif>Personal</option>
                                            <option value="Corporate" @if((isset($step5dataForm["bank_account_class"]))&&($step5dataForm["bank_account_class"]=="Corporate")) selected @endif>Corporate</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <label for="bank_account_type" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Account Type </label>
                                        <select name="bank_account_type" id="bank_account_type"  class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Checking" @if((isset($step5dataForm["bank_account_type"]))&&($step5dataForm["bank_account_type"]=="Checking")) selected @endif>Checking</option>
                                            <option value="Saving" @if((isset($step5dataForm["bank_account_type"]))&&($step5dataForm["bank_account_type"]=="Saving")) selected @endif>Saving</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <label for="bank_routing" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Routing </label>
                                        <select name="bank_routing" id="bank_routing"  class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="SWIFT"  @if((isset($step5dataForm["bank_routing"]))&&($step5dataForm["bank_routing"]=="SWIFT")) selected @endif>SWIFT</option>
                                            <option value="BIC" @if((isset($step5dataForm["bank_routing"]))&&($step5dataForm["bank_routing"]=="BIC")) selected @endif>BIC</option>
                                            <option value="Sort Code" @if((isset($step5dataForm["bank_routing"]))&&($step5dataForm["bank_routing"]=="Sort Code")) selected @endif>Sort Code</option>
                                            <option value="BSB" @if((isset($step5dataForm["bank_routing"]))&&($step5dataForm["bank_routing"]=="BSB")) selected @endif>BSB</option>
                                        </select>
                                    </div> --}}


                                    <div class="col-lg-6">
                                        <label for="bank_account_number" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Account Number </label>
                                        <input type="text" name="bank_account_number" class="form-control" id="bank_account_number" value="{{ $step5dataForm['bank_account_number'] ?? ''  }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="bank_sort_code" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Sort Code </label>
                                        <input type="text" name="bank_sort_code" class="form-control" id="bank_sort_code" value="{{ $step5dataForm['bank_sort_code'] ?? ''  }}">
                                    </div>
                                    

                                    <div class="col-lg-12">
                                        <label for="bank_verification_doc" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Verification Document</label>
                                        <input type="file" name="bank_verification_doc" class="form-control" id="bank_verification_doc">
                                    </div>

                                    <div class="row my-3">
                                        <div class="col-lg-12 mt-3">
                                            <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Confirm your charity </label>
                                            <p class="para mb-3 text-muted fs-6 float-start"> <input type="checkbox" class="me-2" id="confirmcondition" required>I agree to the <a href="{{route('frontend.terms')}}" style="text-decoration: none;color:#212529"> Terms & Conditions. </a></p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{route('campaignPersonalInfo_show')}}" class="btn-theme  bg-primary mx-auto mt-4">Back</a>
                                    <button type="submit" class="btn-theme bg-secondary mx-auto mt-4">Complete Fundriser</button>

                                    

                                    </form>
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

$(document).ready(function() {
    
});


</script>

@endsection