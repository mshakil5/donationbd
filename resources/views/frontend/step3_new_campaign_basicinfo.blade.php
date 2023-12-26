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
                            <div class="title darkerGrotesque-bold lh-1 fs-3">
                            </div>
                            <form action="{{route('campaignBasicInfo_post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                    <h4 class="fs-4  mb-2 darkerGrotesque-bold txt-secondary">How much would you like to raise?</h4>
                                    <h6 class="para text-muted fs-6">Keep the mind that transaction fees, including credit and debit charges are deducted from each donation.</h6>

                                    
                                    <input type="number" class="my-3 form-control fs-4" placeholder="Your starting goal" value="{{ $step3dataForm['raising_goal'] ?? '' }}" id="raising_goal" name="raising_goal">
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
                                    {{-- <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Add a cover photos  and videos 
                                    </div> --}}
                                    {{-- <h5 class="para text-center mt-3 text-muted fs-6">
                                        Who are you fundrising for
                                    </h5> --}}
                                    <div class="row my-3">
                                        <div class="col-lg-6 ">
                                            <label for="image" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Upload Photo</label>
                                            <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                            
                                            <div class="col-md-12 my-2" style="display: none">
                                                <div class="preview2"></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="video_link" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Upload Video Link </label>
                                            <input type="text" name="video_link" class="form-control" id="video_link"  value="{{ $step3dataForm['video_link'] ?? ''  }}">
                                        </div>

                                    </div>
                                    
                                    {{-- <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Tell donor why you are fundrising </div> --}}
                                    
                                    <div class="row my-3">

                                            <div class="col-lg-6">
                                                <label for="tagline" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Tagline</label>
                                                <input type="text" name="tagline" value="{{ $step3dataForm['tagline'] ?? ''  }}" class="form-control" id="tagline">
                                            </div>
                                            {{-- <div class="col-lg-6 ">
                                                <label for="category" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Category </label>
                                                <input type="text" name="category" class="form-control"  id="category" value="{{ $step3dataForm['category'] ?? ''  }}">
                                            </div> --}}

                                            
                                        <div class="col-lg-6 mb-3">
                                            <label for="location" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Location </label>
                                            <input type="text" name="location" class="form-control" id="location" value="{{ $step3dataForm['location'] ?? ''  }}">
                                        </div>

                                        <div class="col-lg-6 ">
                                            <label for="funding_type" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Funding Type</label>
                                            {{-- <input type="text" name="funding_type" class="form-control" id="funding_type" value="{{ $step3dataForm['funding_type'] ?? ''  }}"> --}}
                                            <select name="funding_type" class="form-control" id="funding_type">
                                                <option value="Partial" @if((isset($step3dataForm["funding_type"]))&&($step3dataForm["funding_type"]=="Partial")) selected @endif>Partial</option>
                                                <option value="All or Nothing" @if((isset($step3dataForm["funding_type"]))&&($step3dataForm["funding_type"]=="All or Nothing")) selected @endif>All or Nothing</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="end_date" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> End Date </label>
                                            <input type="date" name="end_date" class="form-control" id="end_date" value="{{ $step3dataForm['end_date'] ?? ''  }}">
                                        </div>
    

                                        <a href="{{route('newcampaigngeninfo_show')}}" class="btn btn-theme  bg-primary mx-auto mt-4">Back</a>

                                        <button type="submit" class="btn-theme bg-secondary mx-auto mt-4">Next</button>

                                        

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