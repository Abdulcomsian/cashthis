@extends('main.main')

@section('title')
    Condition Of Use
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/sellCard.css')}}" />
@endsection

@section('content')

    <!-- section 2  -->

    <div class="section-2">
        <div class="container px-5 py-5">
            <div class="main-heading pt-5 m-auto ">
                Sell Your Cards
            </div>
            <div class="steps m-auto mt-5">
                <div class="row justify-content-between">
                    <div class="col-4 d-flex  justify-content-center gap-3 ">
                        <div class="circle active"> 1 </div>
                        <div class="text ">Get Quote</div>
                    </div>
                    <div class="col-4 d-flex  justify-content-center gap-2">
                        <div class="circle "> 2 </div>
                        <div class="text ">Submit Cards</div>
                    </div>
                    <div class="col-4 d-flex  justify-content-center gap-2">
                        <div class="circle "> 3 </div>
                        <div class="text m">Get Paid</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- section-3  -->
    <div class="section-3">
        <div class="container d-flex justify-content-center">
            <div class="offer p-5">
                <div class="row justify-content-between g-3">
                    <div class="col-md-8">
                        <div class="input-container">
                            <input class="input-1" type="text" placeholder="Store ">
                            <span class="input-icon"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input class="input-2" type="text" placeholder="$ Balance">
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col d-flex justify-content-center mt-2">
                        <button class="btn-2">Sign In</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- section-4  -->
        <div class="section-4 py-5">
            <div class="container  d-flex justify-content-center">
                <div class="cash">
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <div class="d-flex gap-3 align-items-center">
                                <img class="cash-img " src="./assets/images/cash.png" alt="">
                                <div class="heading-1"> Get Cash</div>
                            </div>
                            <!-- <div class="text-1 mt-2">
                                Lorem ipsum dolor sit amet consectetur. Nec interdum enim massa varius ultrices
                                phasellus nam senectus
                            </div> -->
                        </div>
                        <div class="col-md-1 line">
                            <img class="line-img" src="./assets/images/line.png" alt="">
                        </div>
                        <div class="col-md-5 top">
                            <div class="d-flex gap-3 align-items-center">
                                <img class="rotate-img " src="./assets/images/rotate.png" alt="">
                                <div class="heading-1">Trade and get gift cards</div>
                            </div>
                            <!-- <div class="text-1 mt-2">
                                Lorem ipsum dolor sit amet consectetur. Nec interdum enim massa varius ultrices
                                phasellus nam senectus
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection