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
                            <form action="{{route('newcampaigngeninfo_post')}}" method="POST">
                                @csrf
                                                
                                <div class="row my-2">
                                    <div class="col-lg-6">
                                        <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Select your country</label>
                                        <select name="country" id="country" class="form-control darkerGrotesque-bold fs-5  darkerGrotesque-medium select2" required>
                                            <option value="">Select Country</option>
                                            <option value="225" selected>UNITED KINGDOM</option>
                                            {{-- @foreach ($country as $cntry)
                                            <option value="{{$cntry->id}}" @if((isset($step2Data["country"]))&&($step2Data["country"]==$cntry->id)) selected @endif>{{$cntry->name}}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Campaign category </label>
                                        <select name="source" id="source" class="form-control darkerGrotesque-bold fs-5 darkerGrotesque-medium select2" required>
                                            <option value="">Select</option>
                                            <@foreach ($source as $source)
                                            <option value="{{$source->id}}" @if((isset($step2Data["source"]))&&($step2Data["source"]==$source->id)) selected @endif>{{$source->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="row my-3">
                                    <div class="col-lg-12 mb-3">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Campaign Title</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{ $step2Data['title'] ?? '' }}" required>
                                    </div>
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

                                    <div class="col-lg-12 ">
                                        <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell donor why you are fundraising </label>
                                        <textarea name="story" id="story" class="form-control summernote" required>{{ $step2Data['story'] ?? '' }}</textarea>
                                    </div>

                                    <a href="{{route('newcampaign_show')}}" class="btn-theme  bg-primary mx-auto mt-4">Back</a>
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



@endsection

@section('script')

<script type="text/javascript">
    $('.summernote').summernote({
        height: 200
    });
</script>
@endsection