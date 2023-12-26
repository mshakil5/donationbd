<footer class="pt-3">
    <div class="container">
        <div class="row py-4 fs-5">
            <div class=" col-md-3 mb-3 ">
                <a href="{{ route('homepage')}}">
                    <img src="{{ asset('images/company/'.\App\Models\CompanyDetail::where('id',1)->first()->header_logo)}}" width="200px">
                    {{-- <img src="{{ asset('assets/images/logo.png')}}" width="200px"> --}}
                </a>
                {{-- <p class="fw-bold my-3 darkerGrotesque-bold lh-1">Lorem ipsum dolor sit amet consectetur </p> --}}
                <p class="text-muted mb-1 lh-1">{{\App\Models\CompanyDetail::where('id',1)->first()->footer_content }}</p>

            </div>
            <div class=" col-md-3 mb-3">
                <ul class="footer-link ">
                    <li class="mb-2"><a href="{{ route('homepage')}}" class="d-flex align-items-center"> 
                        <iconify-icon   class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> Home</a></li>
                    <li class="mb-2"><a href="{{route('frontend.work')}}" class="d-flex align-items-center"> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> How we work</a></li>
                    <li class="mb-2"><a href="{{route('frontend.about')}}" class="d-flex align-items-center"> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> About</a></li>
                    <li class="mb-2"><a href="{{route('newcampaign_show')}}" class="d-flex align-items-center"> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> Start fundrising</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('frontend.terms')}}" class="d-flex align-items-center"> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> Terms & conditions</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('frontend.privacy')}}" class="d-flex align-items-center"> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon>Privacy & Policy</a>
                    </li>
                    {{-- <li class="mb-2"><a href="how-we-works.html#faq" class=""> <iconify-icon
                                class="txt-primary" icon="material-symbols:arrow-forward-ios-rounded"></iconify-icon> FAQs</a></li> --}}
                </ul>
            </div>
            <div class=" col-md-3 mb-3">
                <h4 class="txt-primary fw-bold mb-3 darkerGrotesque-semibold">Contact</h4>
                <p class="mb-1 darkerGrotesque-semibold d-flex align-items-center"><iconify-icon class="txt-primary pe-2"
                        icon="ic:baseline-local-phone"></iconify-icon> Phone: {{\App\Models\CompanyDetail::where('id',1)->first()->phone1 }}</p>
                <p class="mb-1 darkerGrotesque-semibold d-flex align-items-center"><iconify-icon class="txt-primary pe-2" icon="tabler:brand-whatsapp"></iconify-icon> Whatsapp: {{\App\Models\CompanyDetail::where('id',1)->first()->phone1 }} </p>
                <p class="mb-1 darkerGrotesque-semibold d-flex align-items-center"><iconify-icon class="txt-primary pe-2" icon="ic:outline-email"></iconify-icon> Email: {{\App\Models\CompanyDetail::where('id',1)->first()->email1 }}</p>
            </div>
            <div class=" col-md-3 mb-3">
                <form>
                    <h4 class="txt-primary fw-bold mb-3 darkerGrotesque-semibold">Subscribe to our newsletter</h4>
                    <p class=" lh-1 mb-3">Monthly digest of what's new and exciting from us.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn bg-primary text-white" type="button">Subscribe</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</footer>
<div class="footer-bottom text-center">
    <div class="container">
        <div class="row">
            <div class="d-flex flex-column flex-sm-row justify-content-between py-3 align-items-center">
                <small class="mb-0 text-dark  ">© 2022 Company, Inc. All rights reserved.</small>
                <ul class="social p-0">
                    <li><a href=""><iconify-icon class="txt-primary" icon="ic:baseline-facebook"></iconify-icon></a></li>
                    <li><a href=""><iconify-icon class="txt-primary" icon="mdi:twitter"></iconify-icon></a></li>
                    <li><a href=""><iconify-icon class="txt-primary" icon="mdi:pinterest"></iconify-icon></a></li>
                    <li><a href=""><iconify-icon class="txt-primary" icon="mdi:linkedin"></iconify-icon></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>