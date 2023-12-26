@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="bleesed default">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="title darkerGrotesque-bold lh-1">{{\App\Models\Master::where('name','about')->first()->title}}</div>
            <div class="para text-center mt-4">
                {!! \App\Models\Master::where('name','about')->first()->description !!}
                <a href="{{route('newcampaign_show')}}" class="btn-theme bg-secondary mx-auto">Start fundraising</a>
            </div>
        </div>
    </div>
</section> 


<section class="default contactInfo ">
    <div class="container">
        <div class="row col-md-10 mx-auto">
            <div class="title darkerGrotesque-bold lh-1 mb-5">How we works</div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/healthcare.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon icon="material-symbols:filter-1" class="fs-1 txt-primary "></iconify-icon></div>
                        <div class="txt-secondary">
                            Start your fundraiser
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Set your fundraiser goal
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Tell your story
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Add a picture or video
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Watch a video tutorial
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/friends.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon class="fs-1 txt-primary "
                            icon="material-symbols:filter-2"></iconify-icon></div>
                        <div class="txt-secondary">
                            Share with friends
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Send emails
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Send text messages
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Share on social media
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Watch a video tutorial
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/system-update.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon class="fs-1 txt-primary "
                            icon="material-symbols:filter-3"></iconify-icon></div>
                        <div class="txt-secondary">
                            Manage donations
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Accept donations
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Thank donors
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Withdraw funds
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="campaign default" >
    <div class="container">
        <div class="row mb-5">
            <div class="title ">
                We help charities, raise more
            </div>
        </div>
        <br>
        <div class="row"> 
            <div class="col-lg-4 ">
                <div class="about-card text-center">
                    <img src="https://via.placeholder.com/100.png" class="img-circle">
                    <div class="title">Lorem, ipsum.</div>
                    <div class="para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eius aliquam
                        nobis molestiae velit doloremque ad, aliquid, nulla accusamus obcaecati quos, incidunt
                        numquam eum autem.</div>
                </div>
            </div> 
            <div class="col-lg-4 ">
                <div class="about-card text-center">
                    <img src="https://via.placeholder.com/100.png" class="img-circle">
                    <div class="title">Lorem, ipsum.</div>
                    <div class="para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eius aliquam
                        nobis molestiae velit doloremque ad, aliquid, nulla accusamus obcaecati quos, incidunt
                        numquam eum autem.</div>
                </div>
            </div> 
            <div class="col-lg-4 ">
                <div class="about-card text-center">
                    <img src="https://via.placeholder.com/100.png" class="img-circle">
                    <div class="title">Lorem, ipsum.</div>
                    <div class="para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat eius aliquam
                        nobis molestiae velit doloremque ad, aliquid, nulla accusamus obcaecati quos, incidunt
                        numquam eum autem.</div>
                </div>
            </div> 
        </div>
    </div>
</section> --}}


@endsection

@section('scripts')
@endsection