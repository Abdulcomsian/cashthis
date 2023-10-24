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
            <div class="offer p-5 sellCard-container">
                <div class="row justify-content-between g-3">
                    <input class="input-1 sellInput " type="text" maxlength="16" placeholder="Card Number " >
                    <div class="p-0 d-flex gap-5">
                        <div class="exp-wrapper input-2 p-0">
                            <input autocomplete="off" class="exp " id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
                            <input autocomplete="off" class="exp " id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
                            </div>
                        <input class="input-2 sellInput" type="text"  id="cvvInput" maxlength="3" placeholder="CVV">
                    </div>
                        <button class="w-100 btn-2 btn-sellCard">Sell Card</button>
                </div>
            </div>
           
        </div>

        <!-- section-4  -->
        {{-- <div class="section-4 py-5">
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
        </div> --}}
    </div>
<script>
    const monthInput = document.querySelector('#month');
    const yearInput = document.querySelector('#year');
    const cvvInput = document.getElementById('cvvInput');

    const focusSibling = function(target, direction, callback) {
    const nextTarget = target[direction];
    nextTarget && nextTarget.focus();
    callback && callback(nextTarget);
    }




    monthInput.addEventListener('input', (event) => {

    const value = event.target.value.toString();
    // adds 0 to month user input like 9 -> 09
    if (value.length === 1 && value > 1) {
        event.target.value = "0" + value;
    }
    // bounds
    if (value === "00") {
        event.target.value = "01";
    } else if (value > 12) {
        event.target.value = "12";
    }
    // if we have a filled input we jump to the year input
    2 <= event.target.value.length && focusSibling(event.target, "nextElementSibling");
    event.stopImmediatePropagation();
    });

    yearInput.addEventListener('keydown', (event) => {

    if (event.key === "Backspace" && event.target.selectionStart === 0) {
        focusSibling(event.target, "previousElementSibling");
        event.stopImmediatePropagation();
    }
    });

    const inputMatchesPattern = function(e) {
    const { 
        value, 
        selectionStart, 
        selectionEnd, 
        pattern 
    } = e.target;
    
    const character = String.fromCharCode(e.which);
    const proposedEntry = value.slice(0, selectionStart) + character + value.slice(selectionEnd);
    const match = proposedEntry.match(pattern);
    
    return e.metaKey || 
        e.which <= 0 || 
        e.which == 8 || 
        match && match["0"] === match.input; 
    };

    document.querySelectorAll('input[data-pattern-validate]').forEach(el => el.addEventListener('keypress', e => {
    if (!inputMatchesPattern(e)) {
        return e.preventDefault();
    }
    }));
    </script>
    @endsection