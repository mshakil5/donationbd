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
                            <form action="{{route('campaignConfirmation_post')}}" method="POST">
                            {{-- <form action="{{route('campaignConfirmation')}}" method="POST"> --}}
                                @csrf
                                <div class="row my-3">
                                    <div class="col-lg-12 mt-3">
                                        <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Confirm your charity </label>
                                        <p class="para mb-3 text-muted fs-6 float-start"> <input type="checkbox" class="me-2" id="confirmcondition" required>lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet lorem, ipsum dolor et semet lorem, ipsum dolor et semetlorem, ipsum dolor et semetlorem, ipsum dolor et semet</p>
                                    </div>
                                    <a href="{{route('campaignBankInfo_show')}}" class="btn-theme  bg-primary mx-auto mt-4">Back</a>
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