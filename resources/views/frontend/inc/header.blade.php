<section class="siteHeader ">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light py-0 ">
                <a class="navbar-brand" href="{{ route('homepage')}}">
                    <img src="{{ asset('images/company/'.\App\Models\CompanyDetail::where('id',1)->first()->header_logo)}}" class="py-2 img-fluid mx-auto" width="120px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto navCustom">
                        <!-- "me-auto" for left align | "ms-auto" for right align | "mx-auto" for center align--->

                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('newcampaign_show')}}">Start fundraising </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('charity.register')}}">Register your charity </a>
                        </li>


                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('frontend.about')}}">About </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('frontend.work')}}">how we works</a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('frontend.nonprofit')}}">Non Profit </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('frontend.contact')}}">Contact </a>
                        </li>
                        

                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownItem" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Fundraisers
                            </a>
                            <ul class="dropdown-menu border-0 shadow-lg " aria-labelledby="dropdownItem">
                                <li><a class="dropdown-item" href="{{route('frontend.nonprofit')}}">Non Profit</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.individual')}}">For Individual</a></li>
                                @if (Auth::user())
                                @else
                                <li><a class="dropdown-item" href="{{route('charity.register')}}">Charity Register </a></li>
                                @endif
                            </ul>
                        </li> --}}

                        

                        @if (Auth::user())
                            @if (Auth::user()->is_type == 1)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="dropdownItem"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://via.placeholder.com/510x440.png" class="img-fluid  rounded"
                                            width="45px" />
                                        <span class="ms-2"> Admin </span>
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-lg " aria-labelledby="dropdownItem">
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard')}}">Dashboard </a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                            @elseif (Auth::user()->is_type == 2)

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="dropdownItem"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://via.placeholder.com/510x440.png" class="img-fluid  rounded"
                                            width="45px" />
                                        <span class="ms-2"> {{Auth::user()->name}} </span>
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-lg " aria-labelledby="dropdownItem">
                                        <li><a class="dropdown-item" href="{{ route('charity.profile')}}">Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ route('charity.alltransaction')}}">All Statements</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="dropdownItem" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if (isset(Auth::user()->photo))
                                            <img src="{{ asset('images/'.Auth::user()->photo)}}" class="img-fluid  rounded" width="45px" />
                                        @else
                                            <img src="https://via.placeholder.com/510x440.png" class="img-fluid  rounded" width="45px" />
                                        @endif
                                        <span class="ms-2"> My account </span>
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-lg " aria-labelledby="dropdownItem">
                                        <li><a class="dropdown-item" href="{{ route('user.activecampaign')}}">My Campaign </a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.refcampaign')}}">Reffered campaign</a></li>
                                        <li><a class="dropdown-item" href="{{ route('newcampaign_show')}}">Create new campaign</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.donationhistory')}}">Donation I have made</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.myevent')}}">My Event </a></li>
                                        <li><a class="dropdown-item" href="{{ route('start_new_event')}}">Start new event</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.eventdocument')}}">Purchase History </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('user.alltransaction')}}">All statement</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.profile')}}">Account settings</a> </li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login </a>
                        </li>
                        @endif

                        



                    </ul>
                </div> 
            </nav>

        </div>
    </div>
</section>