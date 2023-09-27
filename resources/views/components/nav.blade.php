<div class="d-none">
    <form method="post" action="{{route('logout')}}" id="logout-form">
    @csrf
    </form>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="./assets/images/Frame 126.png" alt="Logo" width="40" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item m-lg-auto">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item m-lg-auto">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item m-lg-auto">
                    <a class="nav-link " href="{{route('useCondition')}}">How It Works</a>
                </li>
                @if(!auth()->user())
                <li>
                    <a href="{{route('login')}}" class="btn-1">Sign in</a>
                    <img class="nav-img  " src="{{asset('assets/images/Vector.png')}}" alt="Image">
                </li>
                @endif
                <li>
                    <button class="logout-btn">Logout</button>
                </li>
            </ul>
            
            
            



        </div>
    </div>
</nav>