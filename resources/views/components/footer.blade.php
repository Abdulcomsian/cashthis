<div class="section-7 py-4">
    <div class="container">
        <div class="row justify-content-between" style="padding-top: 10%;">
            <div class="col-md-5">
                <img src="{{asset('assets/images/Frame127.png')}}" alt="">
                <!-- <div class="text-4 mt-5">Sign up for our sales and savings emails</div>
                <div class="email mt-3">
                    <input type="email" placeholder="Your email address..">
                    <img class="ms-3 footer-img" src="{{asset('assets/images/arrow.png')}}" alt="">
                </div> -->
            </div>
            <div class="col-md-2" style="display: flex; flex-direction: column">
                <!-- <a class="heading-6">About</a> -->
                {{-- <a class="text-3 mt-3">Our Story</a> --}}
                <a href="{{route('useCondition')}}" class="heading-6">How It Works</a>
            </div>
            <div class="col-md-2" style="display: flex; flex-direction: column">
                <a class="heading-6">Support</a>
                {{-- <a class="text-3 mt-3">FAQ</a> --}}
                <a href="{{route('gurantee')}}" class="text-3 mt-3">Guarantee </a>
                <a href="{{route('contact')}}" class="text-3 mt-3">Contact US</a>
            </div>
            {{-- <div class="col-md-2" style="display: flex; flex-direction: column">
                <a class="heading-6">Account</a>
                <a class="text-3 mt-3">Login</a>
                <a class="text-3 mt-3">Refer a Friend</a>
            </div> --}}
        </div>

        <div class="row mt-md-5 justify-content-between g-2">
            <div class="col-md-3">
                <div class="footer-text"> Copyright © 2023 GiftHub</div>
            </div>
            <div class="col-md-3 d-flex flex-row justify-content-md-center gap-4">
                <img src="{{asset('assets/images/google.png')}}" alt="">
                <img src="{{asset('assets/images/twitter.png')}}" alt="">
                <img src="{{asset('assets/images/insta.png')}}" alt="">
                <img src="{{asset('assets/images/linkedin.png')}}" alt="">
            </div>
            <div class="col-md-3 d-flex gap-4 justify-content-md-end">
                <div class="text-3 "><a href="{{route('useCondition')}}"> Terms of Services </a> </div>
                <div class="text-3 "> <a href="{{route('policy')}}"> Privacy Policy</a></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/jquery-3.7.1.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>