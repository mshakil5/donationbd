@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="ermsg"></div>
                            <div class="title darkerGrotesque-bold lh-1 fs-1">Lets begin your fundriser journey
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                we are here to guide you every step for thre way
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <form action="{{route('campaignBasicInfo')}}" method="post">
                                @csrf
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Select your country</label>
                                        <select name="country" id="country" class="form-control darkerGrotesque-bold fs-5  darkerGrotesque-medium select2">
                                            <option value="">Select Country</option>
                                            @foreach ($country as $cntry)
                                            <option value="{{$cntry->id}}">{{$cntry->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Why you are fundrising? </label>
                                        <select name="source" id="source" class="form-control darkerGrotesque-bold fs-5 darkerGrotesque-medium select2">
                                            <option value="">Select</option>
                                            <@foreach ($source as $source)
                                            <option value="{{$source->id}}">{{$source->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="row my-3">
                                    <div class="col-lg-12 mb-3">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Fundriser title</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="col-lg-12 ">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell your story </label>
                                        <textarea name="story" id="story" class="form-control"></textarea>
                                    </div>

                                    <div class="col-lg-12 mt-3">
                                        <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Confirm your charity </label>
                                        <p class="para mb-3 text-muted fs-6 float-start"> <input type="checkbox" class="me-2" id="confirmcondition">lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet</p>
                                    </div>
                                    <a href="#" class="btn-theme  bg-primary mx-auto mt-4">Back</a>
                                    <button type="submit" class="btn-theme bg-secondary mx-auto mt-4 saveBtn" id="saveBtn">Next</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    
                    <div class="row mt-4">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-3">Tell us a bit more about your fundriser
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                Who are you fundrising for
                            </h5>
                            <form action="{{route('campaignPersonalInfo')}}" method="post">
                                @csrf
                            
                                    <h4 class="fs-4  mb-2 darkerGrotesque-bold txt-secondary">
                                        How much would you like to raise?</h4>
                                    <h6 class="para text-muted fs-6">Keep the mind that transaction fees, including credit and debit charges are deducted from each donation.</h6>

                                    <input type="number" class="my-3 form-control fs-4" placeholder="Your starting goal" id="raising_goal" name="raising_goal">
                                    <p class="para text-muted fs-6">
                                        To received money raised, please make sure the person withdrawing has:
                                    </p>
                                    <div class="alert  para text-muted fs-6 shadow-sm" role="alert">
                                        <ul class="list-group list-group-numbered">
                                            <li class="list-group-item">A national insurance number</li>
                                            <li class="list-group-item">A bank account in the United Kingdom</li>
                                            <li class="list-group-item">A mailing address in the united kingdom</li>
                                        </ul>
                                    </div>
                                    <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Add a cover photo or video
                                    </div>
                                    <h5 class="para text-center mt-3 text-muted fs-6">
                                        Who are you fundrising for
                                    </h5>
                                    <div class="row my-3">
                                        <div class="col-lg-6 ">
                                            <label for="image" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Upload Photo</label>
                                            <input type="file" name="image[]" class="form-control" id="image" multiple>
                                            
                                            <div class="col-md-12 my-2" style="display: none">
                                                <div class="preview2"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="video_link" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Upload Video Link </label>
                                            <input type="text" name="video_link" class="form-control" id="video_link">
                                        </div>

                                    </div>
                                    
                                    <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Tell donor why you are fundrising </div>
                                    <h5 class="para text-center mt-3 text-muted fs-6">
                                        Some idea to help you start writing
                                    </h5>
                                    <div class="alert  para text-muted fs-6 shadow-sm" role="alert">
                                        <ul class="list-group list-group-numbered">
                                            <li class="list-group-item">Introduce yourself and what you are raising funds for</li>
                                            <li class="list-group-item">Describe why it's important to you</li>
                                            <li class="list-group-item">Explain how the funds will be used</li>
                                        </ul>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-12 mb-3">
                                            <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Fundriser title </label>
                                            <input type="text" name="title" class="form-control" id="title" value="">
                                        </div>
                                        <div class="col-lg-12 ">
                                            <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell your story </label>
                                            <textarea name="story" id="story" class="form-control"></textarea>
                                        </div>

                                            <div class="col-lg-6 ">
                                                <label for="tagline" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Tagline</label>
                                                <input type="text" name="tagline" class="form-control" id="tagline">
                                            </div>
                                            <div class="col-lg-6 ">
                                                <label for="category" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Category </label>
                                                <input type="text" name="category" class="form-control" id="category">
                                            </div>

                                            
                                        <div class="col-lg-12 mb-3">
                                            <label for="location" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Location </label>
                                            <input type="text" name="location" class="form-control" id="location" value="">
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label for="funding_type" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Funding Type</label>
                                            <input type="text" name="funding_type" class="form-control" id="funding_type">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="end_date" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> End Date </label>
                                            <input type="text" name="end_date" class="form-control" id="end_date">
                                        </div>
    

                                        <a href="#" class="btn-theme  bg-primary mx-auto mt-4 saveBtn">Back</a>
                                        <button type="submit" class="btn-theme bg-secondary mx-auto mt-4 saveBtn" id="saveBtn">Next</button>

                                        

                                        </form>
                                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    
                    <div class="row mt-4">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-3">Tell us a bit more about your fundriser
                            </div>
                            <form action="{{route('campaignBankInfo')}}" method="post">
                                @csrf
                            
                                    <h4 class="fs-4  mb-2 darkerGrotesque-bold txt-secondary">
                                        Email</h4>
                                    <input type="email" class="my-3 form-control fs-4" placeholder="Your email" id="email" name="email">

                                    
                                    
                                    <div class="row my-3">
                                        <div class="col-lg-6 ">
                                            <label for="name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="family_name" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Family Name </label>
                                            <input type="text" name="family_name" class="form-control" id="family_name">
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label for="dob" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Date of birth</label>
                                            <input type="date" name="dob" class="form-control" id="dob">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="phone" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Phone Number </label>
                                            <input type="text" name="phone" class="form-control" id="phone">
                                        </div>


                                        <div class="col-lg-12 mb-3">
                                            <label for="country_address" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Country </label>
                                            <input type="text" name="country_address" class="form-control" id="country_address">
                                        </div>
                                        <div class="col-lg-12 ">
                                            <label for="address" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Address </label>
                                            <textarea name="address" id="address" class="form-control"></textarea>
                                        </div>

                                            <div class="col-lg-6 ">
                                                <label for="city" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">City</label>
                                                <input type="text" name="city" class="form-control" id="city">
                                            </div>
                                            <div class="col-lg-6 ">
                                                <label for="street_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Street Name</label>
                                                <input type="text" name="street_name" class="form-control" id="street_name">
                                            </div>
                                            <div class="col-lg-6 ">
                                                <label for="town" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Town </label>
                                                <input type="text" name="town" class="form-control" id="town">
                                            </div>
                                            <div class="col-lg-6 ">
                                                <label for="postcode" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Post code </label>
                                                <input type="text" name="postcode" class="form-control" id="postcode">
                                            </div>

                                            
                                        

                                        <div class="col-lg-12 ">
                                            <label for="gov_issue_id" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Government Issued ID</label>
                                            <input type="text" name="gov_issue_id" class="form-control" id="gov_issue_id">
                                        </div>
                                        <a href="#" class="btn-theme  bg-primary mx-auto mt-4 saveBtn">Back</a>
                                        <button type="submit" class="btn-theme bg-secondary mx-auto mt-4 saveBtn" id="saveBtn">Next</button>

                                        

                                        </form>
                                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    
                    <div class="row mt-4">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-3">Tell us a bit more about your fundriser
                            </div>
                            <form action="{{route('campaignTermCondition')}}" method="post">
                                @csrf
                            
                                <div class="row my-3">
                                    <div class="col-lg-12 mb-3">
                                        <label for="currency" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Currency </label>
                                        <input type="text" name="currency" class="form-control" id="currency">
                                    </div>

                                    <div class="col-lg-12 ">
                                        <label for="name_of_account" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Name of the account</label>
                                        <input type="text" name="name_of_account" class="form-control" id="name_of_account">
                                    </div>
                                    <div class="col-lg-12 ">
                                        <label for="bank_account_country" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Country </label>
                                        <input type="text" name="bank_account_country" class="form-control" id="bank_account_country">
                                    </div>

                                    <div class="col-lg-12 ">
                                        <label for="bank_name" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Name</label>
                                        <input type="bank_name" name="bank_name" class="form-control" id="bank_name">
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label for="bank_account_class" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Account Class </label>
                                        <select name="bank_account_class" id="bank_account_class"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Corporate">Corporate</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <label for="bank_account_type" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Account Type </label>
                                        <select name="bank_account_type" id="bank_account_type"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="Checking">Checking</option>
                                            <option value="Saving">Saving</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-6 ">
                                        <label for="bank_routing" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Bank Routing </label>
                                        <select name="bank_routing" id="bank_routing"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="SWIFT">SWIFT</option>
                                            <option value="BIC">BIC</option>
                                            <option value="Sort Code">Sort Code</option>
                                            <option value="BSB">BSB</option>
                                        </select>
                                    </div>


                                    <div class="col-lg-6">
                                        <label for="iban" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">IBAN </label>
                                        <input type="text" name="iban" class="form-control" id="iban">
                                    </div>
                                    

                                    <div class="col-lg-12">
                                        <label for="bank_verification_doc" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Bank Verification Document</label>
                                        <input type="file" name="bank_verification_doc" class="form-control" id="bank_verification_doc">
                                    </div>
                                    
                                    <a href="#" class="btn-theme  bg-primary mx-auto mt-4 saveBtn">Back</a>
                                    <button type="submit" class="btn-theme bg-secondary mx-auto mt-4 saveBtn" id="saveBtn">Next</button>

                                    

                                    </form>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto p-4">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="ermsg"></div>
                            <div class="title darkerGrotesque-bold lh-1 fs-1">Lets begin your fundriser journey
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                we are here to guide you every step for thre way
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <form action="{{route('campaignConfirmation')}}" method="GET">
                                {{-- @csrf --}}
                                

                                <div class="row my-3">
                                    

                                    <div class="col-lg-12 mt-3">
                                        <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Confirm your charity </label>
                                        <p class="para mb-3 text-muted fs-6 float-start"> <input type="checkbox" class="me-2" id="confirmcondition">lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet</p>
                                    </div>
                                    <a href="#" class="btn-theme  bg-primary mx-auto mt-4 saveBtn">Back</a>
                                    <button type="submit" class="btn-theme bg-secondary mx-auto mt-4 saveBtn" id="saveBtn">Complete Fundriser</button>
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