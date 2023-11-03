<div class="d-none">
    <form method="post" action="{{ route('logout') }}" id="logout-form">
        @csrf
    </form>
</div>

<style>
    .dropdown-toggle::after {
        display: none;
    }

    input[type="search"] {
        height: 20px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/images/Frame127.png')}}" alt="Logo" width="40" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item m-lg-auto">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item m-lg-auto">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item m-lg-auto">
                    <a class="nav-link " href="{{ route('useCondition') }}">How It Works</a>
                </li>
                <li class="nav-item m-lg-auto">
                    <a class="nav-link " href="{{ route('giftCardPage') }}">Gift Cards</a>
                </li>

                <li class="nav-item m-lg-auto">
                    <a class="nav-link " href="{{ route('card') }}">Sell Card</a>
                </li>
                @if (!auth()->user())
                    <li class="nav-item m-lg-auto d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn-1">Sign in</a>
                        <img class="nav-img" src="{{ asset('assets/images/Vector.png') }}" alt="Image">
                    </li>
                @endif
                <!-- <li>
                    <button class="logout-btn">Logout</button>
                </li> -->
                @if (auth()->check())
                    <div class="dropdown">
                        <div class="d-flex align-items-center  dropdown-toggle" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- Avatar -->
                            <div class="dropdown p-1 " style="border:1px solid black; border-radius:22px">
                                <img src="{{ asset('assets/images/profile.svg') }}" class="rounded-circle"
                                    height="35" alt="Black and White Portrait of a Man" loading="lazy" />
                            </div>
                        </div>
                        @if (auth()->user())
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if(auth()->check() && auth()->user()->type == \AppConst::USER)
                                    <a class="dropdown-item" href="{{ route('userDashboard') }}" role="button">Dashboard</a>
                                @endif
                                @if(auth()->check())
                                    <a class="dropdown-item" href="{{ route('orders') }}" role="button">Orders</a>
                                @endif
                                @if(auth()->check() && auth()->user()->type == AppConst::ADMIN)
                                    <a class="dropdown-item" href="{{ route('cardList') }}" role="button">Card List</a>
                                @endif
                                <button class="dropdown-item logout-btn">Logout</button>
                            </div>
                        @endif
                    </div>
                @endif
            </ul>

        </div>
    </div>
</nav>
