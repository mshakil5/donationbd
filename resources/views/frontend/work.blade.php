@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')




<section class="how-we-works default" style="display: none">
    <div class="container">
        <div class="row flex-column">
            {{-- <img src="@if (isset(\App\Models\Master::where('name','work')->first()->image))
            {{asset('images/'.\App\Models\Master::where('name','work')->first()->image)}} @else https://via.placeholder.com/260.png @endif" style="width:260px;" class=" mx-auto"/> <br> --}}
            <div class="title darkerGrotesque-bold lh-1">{{\App\Models\Master::where('name','work')->first()->title}}</div>
            <div class="para text-center mt-4">
                {!! \App\Models\Master::where('name','work')->first()->description !!} 
            </div>
            <a href="{{route('newcampaign_show')}}" class="btn-theme bg-secondary mx-auto mt-4">Start your campaign</a>
        </div>
    </div>
</section>

<section class="default contactInfo ">
    <div class="container">
        <div class="row col-md-10 mx-auto">
            <div class="title darkerGrotesque-bold lh-1 mb-5">How we work</div>
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


<section class="  py-5" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row py-5">
                    <div class="col-lg-12  px-3  ">
                        <div class="title darkerGrotesque-bold lh-1 mb-5">
                           Why choose us ?
                        </div> 
                    </div> 
                </div>
                <div class="row">

                    @foreach (\App\Models\WhyChooseUs::orderby('id','DESC')->get() as $whychoose)
                    <div class="col-lg-6 mb-5 ">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center text-center">
                                <img src="@if(isset($whychoose->image)){{asset('images/'.$whychoose->image)}} @else https://via.placeholder.com/160.png @endif" class="me-3 img-fluid" />
                            </div>
                            <div class="col-lg-8">
                                <div class="paratitle">{{$whychoose->title}}</div>
                            <div class="para">
                                {!! $whychoose->description!!}
                            </div>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                    
                   
                </div>
            </div>
        </div>
    </div>
</section>

<section class="client faq default " id="faq">
    <div class="container">
        <div class="row">
            <div class="title txt-primary">
                Frequently asked questions
            </div>
            <br>
            <div class="mt-5">
                <div class="darkerGrotesque-bold lh-1 mb-2"><h2>For Event Organisers</h2></div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How do I get donations?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                GoGiving provides an easy way to raise money from your friends, family, and online community. Our platform makes it simple to share your fundraiser in a variety of ways to bring in donations, track your progress, and post updates to engage your community.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can a friend withdraw the money I raise for them?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, they can. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can someone set up a fundraiser for me?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, all you have to do is provide your friend with the correct information and credentials, and they can set up a fundraiser on your behalf that you will also have managorial access to.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Can I create more than one fundraiser?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, you can create and manage multiple events. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Can more than one person manage an event?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can have multiple event organisers, each with managorial access to each event. Furthermore, you can have associates with each event, who share the event under their name to their parties. 

                            </div>
                        </div>
                    </div>
                </div> 
            </div>


            <div class="mt-2">
                <div class="darkerGrotesque-bold lh-1 mb-2"><h2>For Donors</h2></div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                What payment options can I donate with?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Majority of the most common payment methods are accepted as ways to donate, such as MasterCard, Direct Debit, PayPal, and American Express. If you have questions about a specific payment method, you can always contact our team info@gogiving.co.uk.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                Can I donate anonymously?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can choose to donate as either a registered user of GoGiving or as a guest; if you donate as a guest your name and details will not be shared with the event organiser.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                Why register as a user?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                By registering as a user you have the added benefits of being able to track which campains you have partaked in, see how much you have contributed overall to different fundraisers, and create your own events.
                            </div>
                        </div>
                    </div>
                    
                </div> 
            </div>
            
            <div class="mt-2">
                <div class="darkerGrotesque-bold lh-1 mb-2"><h2>For Charities</h2></div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="collapseNine">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseOne">
                                Can GoGiving host my charity’s fundraisers and events?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="collapseNine" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                GoGiving is happy to host all sorts of events, including charitable ones. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                What can I raise money for?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                People can raise money for themselves, friends and family, or even complete strangers in random acts of kindness. People raise money for just about everything, including medical expenses, education costs, volunteer programs, youth sports, funerals & memorials, and even animals & pets.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingElaven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseElaven" aria-expanded="false" aria-controls="collapseElaven">
                                How can I check how much money I have in my charity account?
                            </button>
                        </h2>
                        <div id="collapseElaven" class="accordion-collapse collapse" aria-labelledby="headingElaven" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                All transaction will be recorded under your charity portal account. You will have access to view and withdraw the amount.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwelve">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                How do I receive the money I’ve raised?
                            </button>
                        </h2>
                        <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                When you wish to take out the money you’ve raised, our team will be alerted with the request and will be dealt with within a few business days. You should receive the donations in the account you set up the event with.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThirteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                Do I have to set a time limit?
                            </button>
                        </h2>
                        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You do have to set a time frame on your fundraiser, however each campaign can be easily extended by the event managor as many times as needed.

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingForteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseForteen" aria-expanded="false" aria-controls="collapseForteen">
                                Can I take out donations before the event has closed?
                            </button>
                        </h2>
                        <div id="collapseForteen" class="accordion-collapse collapse" aria-labelledby="headingForteen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, you can. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFifteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                                How are my donations kept secure?
                            </button>
                        </h2>
                        <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                All transactions are end-to-end encrypted and are undergone securely. GoGiving will not request any unecessary information and donations are available to be made by third-party secure transactional organisations such as PayPal.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSixteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                                What types of fundraisers are there?
                            </button>
                        </h2>
                        <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                When you set up an event, you can either chose for it to be a partial fundraiser or a full fundraiser. In a partial fundraiser, any amount raised is received by the event organiser. In a full fundraiser, if the donations do not reach the specified goal, the donations are redistributed to the original donors. 
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeventeen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                                Pricing
                            </button>
                        </h2>
                        <div id="collapseSeventeen" class="accordion-collapse collapse" aria-labelledby="headingSeventeen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Welcome to JustGiving! We help people from all over the world raise money for the causes they care about. We're passionate about supporting charities, so we don't charge any fees on individual charity donations. Instead, we give donors the option to make a voluntary contribution to support our platform's upkeep.

                            </div>
                        </div>
                    </div>



                </div> 
                <div class="darkerGrotesque-bold lh-1 mb-2"><h2>Choose the plan that’s right for your charity.</h2></div>
            </div>


            <div class="w-100 d-flex align-items-center justify-content-center">
                <a href="{{route('frontend.contact')}}" class="mx-auto mt-5 btn-theme bg-secondary ">Still have questions?</a>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
@endsection