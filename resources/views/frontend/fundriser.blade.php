@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<section class="fundriser">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-1">Lets begin your fundriser journey
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                we are here to guide you every step for thre way
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="row my-5">
                                <div class="col-lg-6 ">
                                    <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Select your
                                        country</label>
                                    <select name="" id=""
                                        class="form-control darkerGrotesque-bold fs-5  darkerGrotesque-medium">
                                        <option value="">Bangladesh</option>
                                        <option value="">Bangladesh</option>
                                        <option value="">Bangladesh</option>
                                        <option value="">Bangladesh</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 ">
                                    <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Why you are
                                        fundrising ? </label>
                                    <select name="" id=""
                                        class="form-control darkerGrotesque-bold fs-5  darkerGrotesque-medium">
                                        <option value="">Faith</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-9 mx-auto">
                            <div class="title darkerGrotesque-bold lh-1 fs-3">Tell us a bit more about your
                                fundriser
                            </div>
                            <h5 class="para text-center mt-3 text-muted fs-6">
                                Who are you fundrising for
                            </h5>

                            <ul class="nav nav-tabs mt-5 border-0 py-4 justify-content-center  bg-transparent" id="myTab"
                                role="tablist">
                                <li class="nav-item fs-5 mx-2" role="presentation">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
                                        <div class="fw-bold">Your Self</div>
                                    </div>
                                </li>
                                <li class="nav-item fs-5 mx-2" role="presentation">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" role="tab" aria-controls="profile"
                                        aria-selected="false">
                                        <div class="fw-bold">Someone Else</div>
                                    </div>
                                </li>
                                <li class="nav-item fs-5 mx-2" role="presentation">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#contact" role="tab" aria-controls="contact"
                                        aria-selected="false">
                                        <div class="fw-bold">Charity</div>
                                    </div>
                                </li>
                            </ul>
                            <div class="tab-content shadow-sm" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <h4 class="fs-4  mb-2 darkerGrotesque-bold txt-secondary">How much would you
                                        like
                                        to raise ?</h4>
                                    <h6 class="para text-muted fs-6">lorem ipsum dolor sit amet tio tjso</h6>

                                    <input type="text" class="my-3 form-control fs-4"
                                        placeholder="Your starting goal">
                                    <p class="para text-muted fs-6">lorem ipsum dolor sit amet tio tjsolo rem ipsum
                                        dolor sit amet tio tjso lorem ipsum
                                        dolor sit amet tio tjso</p>
                                    <div class="alert  para text-muted fs-6 shadow-sm" role="alert">
                                        <ul class="list-group list-group-numbered">
                                            <li class="list-group-item">lorem ipsum dolor sit amet tio</li>
                                            <li class="list-group-item">lorem ipsum dolor sit amet tio</li>
                                            <li class="list-group-item">lorem ipsum dolor sit amet tio</li>
                                        </ul>
                                    </div>
                                    <br>
                                    <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Add a cover
                                        photo or video
                                    </div>
                                    <h5 class="para text-center mt-3 text-muted fs-6">
                                        Who are you fundrising for
                                    </h5>
                                    <div class="row my-5">
                                        <div class="col-lg-6 ">
                                            <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Upload
                                                Photo</label>
                                            <input type="file" name="" class="form-control" id="">
                                        </div>
                                        <div class="col-lg-6 ">
                                            <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold"> Upload
                                                Video Link </label>
                                            <input type="text" name="" class="form-control" id="">
                                        </div>

                                    </div>
                                    <br>
                                    <div class="title darkerGrotesque-bold lh-1 fs-3 txt-secondary">Tell donor why
                                        you are
                                        fundrising </div>
                                    <h5 class="para text-center mt-3 text-muted fs-6">
                                        lorem, ipsum dolor et semet
                                    </h5>
                                    <div class="row my-5">
                                        <div class="col-lg-12 mb-3">
                                            <label for=""
                                                class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Fundriser
                                                title</label>
                                            <input type="text" name="" class="form-control" id="">
                                        </div>
                                        <div class="col-lg-12 ">
                                            <label for="" class="fs-5  mb-2 darkerGrotesque-medium fw-bold">Tell
                                                your story </label>
                                            <textarea name="" id="" class="form-control"></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3">
                                            <label for="" class="fs-5 mb-2 darkerGrotesque-medium fw-bold">Confirm
                                                your charity </label>
                                            <p class="para mb-3 text-muted fs-6 float-start"> <input type="checkbox"
                                                    class="me-2">lorem, ipsum dolor et semet lorem, ipsum dolor et
                                                semetlorem, ipsum
                                                dolor et semetlorem, ipsum dolor et semet lorem, ipsum dolor et
                                                semet
                                                lorem, ipsum dolor et semetlorem, ipsum dolor
                                                et semetlorem, ipsum dolor et semet</p>
                                        </div>
                                        <button class="btn-theme bg-secondary mx-auto mt-4">Complete
                                            Fundriser</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">...</div>
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">...</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
@endsection