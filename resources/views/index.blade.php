@extends('main.main')

@section('title')
    Home
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/style.css')}}" />
@endsection

    <!-- section 2  -->
@section('content')
    <div class="section-2">
        <div class="container px-5 py-5">
            <div class="main-heading pt-5 m-auto">
                Imagine what it feels like to save every. single. time.
            </div>
            <!-- <div class="para text-center mt-4 m-auto">
                Lorem ipsum dolor sit amet consectetur. Vitae sit elementum vitae quis nibh pellentesque tempor lorem
                enim. Scelerisque egestas turpis egestas lacus iaculis lacus augue condimentum.
            </div> -->
        </div>

    </div>

    <!-- section-3  -->
    <div class="section-3 section-height">
        <div class="container px-3 py-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading-2">How we work</div>

                    <div class="d-flex gap-2 mt-2">
                        <input class="radio" type="radio" name="toggle" id="sellingRadio" checked>
                        <label class="radio-label" for="sellingRadio"></label>
                        <input class="radio" type="radio" name="toggle" id="buyingRadio">
                        <label class="radio-label" for="buyingRadio"></label>
                    </div>
                    <!-- <div class="para-1 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor.
                    </div> -->
                    <div class="mt-3"> <a href="">Get in touch with us <img src="./assets/images/Arrow 2.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 slider">
                    <div class="row" id="selling">
                        <div class="heading-4">Selling</div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 01</div>
                            <!-- <div class="small-heading mt-3">Shop around</div> -->
                            <div class="para-2 mt-2"> Find your gift card in our search box.
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 02</div>
                            <!-- <div class="small-heading mt-3">Find [gift] cards </div> -->
                            <div class="para-2 mt-2">Enter amount of your gift card and see your pay out.
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 03</div>
                            <!-- <div class="small-heading mt-3">Save at checkout</div> -->
                            <div class="para-2 mt-2"> Submit, complete your information and receive money.
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mt-4">
                            <div class="box "> 04</div>
                            <div class="small-heading mt-3">Protect yourself </div>
                            <div class="para-2">Euismod faucibus turpis eu gravida mi. Pellentesque et velit aliquam .
                            </div>
                        </div> -->
                    </div>

                    <div class="row d-none" id="buying">
                        <div class="heading-4">Buying</div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 01</div>
                            <!-- <div class="small-heading mt-3">Shop around</div> -->
                            <div class="para-2 mt-2"> Find gift card in our search box.
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 02</div>
                            <!-- <div class="small-heading mt-3">Find [gift] cards </div> -->
                            <div class="para-2 mt-2">Save and checkout.
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <div class="box "> 03</div>
                            <!-- <div class="small-heading mt-3">Save at checkout</div> -->
                            <div class="para-2 mt-2"> You will receive the e-gift in email.
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mt-4">
                            <div class="box "> 04</div>
                            <div class="small-heading mt-3">Protect yourself </div>
                            <div class="para-2">Euismod faucibus turpis eu gravida mi. Pellentesque et velit aliquam .
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- section-4  -->

    <!-- <div class="section-4">
        <div class="container px-3 pt-3">
            <div class="row pt-5 justify-content-between">
                <div class="col-md-6">
                    <img class="sec-4-img" src="./assets/images/card.png" alt="">
                </div>
                <div class="col-md-5 right">
                    <div class="heading-3 ">Lorem ipsum dolor sit amet consectetur.</div>
                    <div class="para-3 mt-4"> Lorem ipsum dolor sit amet consectetur. Sagittis integer morbi dictum
                        rutrum pellentesque aliquam. Fames iaculis cursus aliquet sagittis mattis.</div>
                    <div class="mt-3 link"> <a href="">Get in touch with us <img src="./assets/images/Arrow 2.png"
                        alt=""> </a></div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- section-5  -->
    <div class="section-5 py-4">
        <div class="container sec-5">
            <div class="row px-3 justify-content-between">
                <div class="col-md-1 p-3 d-flex justify-content-start"> <img class="sec5-img m-md-auto "
                        src="./assets/images/twoP.png" alt=""> </div>
                <div class="col-md-6 m-auto">
                    <div class="heading-4 "> Refer A friend</div>
                    <!-- <div class="para-4"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua.</div> -->

                </div>
                <div class="col-md-2 d-flex justify-content-md-end"> <button class="btn-2 m-md-auto ">Get Link</button>
                </div>
            </div>
        </div>
    </div>

    <!-- section-6  -->
    <div class="secyion-6 pt-5">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-4">
                    <div class="heading-5"> Frequently asked questions</div>
                    <div class="mt-3"> <a href="">Contact us for more info</a></div>
                </div>
                <div class="col-md-7">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="d-flex">
                                <div class="number p-3">01</div>
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is Cashthis?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body px-5">
                                    <p class="text-2">Cashthis specializes in purchasing unwanted gift cards at a
                                        reduced rate and subsequently offering them at a discounted price to savvy
                                        shoppers nationwide. This platform provides an excellent opportunity to convert
                                        your unused gift cards into cash while enabling you to make substantial savings
                                        on your purchases through these discounted gift cards. </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="accordion-item">
                            <h2 class="d-flex">
                                <div class="number p-3">02</div>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Refund Policy
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body  px-5">
                                    <p class="text-2">We regret to inform you that our company does not offer refunds
                                        for any purchases made on our platform. All transactions are considered final,
                                        and once a purchase is completed, it cannot be reversed or refunded. We
                                        encourage our customers to review their orders carefully before confirming them,
                                        as we are unable to entertain requests for refunds, exchanges, or returns. This
                                        policy is in place to maintain the integrity of our operations and ensure a
                                        consistent experience for all our users. If you have any questions or concerns
                                        about a specific purchase, please contact our customer support team, and they
                                        will be happy to assist you in resolving any issues within the parameters of our
                                        policy. We appreciate your understanding and support. </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="accordion-item">
                            <h2 class="d-flex">
                                <div class="number p-3">03</div>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    When do I get my pay out?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body  px-5">
                                    <p class="text-2">You will receive your payment 7 days after the transactions are
                                        completed. </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="accordion-item">
                            <h2 class="d-flex">
                                <div class="number p-3">04</div>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                    Referral
                                </button>
                            </h2>
                            <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body  px-5">
                                    <p class="text-2">When your friend successfully completes their initial purchase on
                                        our platform, we want to express our gratitude by offering you a $5 coupon
                                        reward. Please be aware that it may take up to seven (7) business days following
                                        your friend's completed purchase for you to receive this reward coupon via
                                        email. Kindly note that this offer is exclusively available to new customers.
                                        Additionally, please remember that only one (1) coupon can be redeemed per
                                        household and/or IP address. We value your support and the connections you bring
                                        to our community. </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="accordion-item">
                            <h2 class="d-flex">
                                <div class="number p-3">05</div>
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                    Other questions
                                </button>
                            </h2>
                            <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body  px-5">
                                    <p class="text-2">If you have questions that are not covered in the provided
                                        information, please don't hesitate to reach out to our dedicated customer
                                        support team. They are here to assist you and can address any additional
                                        inquiries or concerns you may have. Feel free to contact us, and we'll be more
                                        than happy to provide you with the information and assistance you need. Your
                                        satisfaction is our priority, and we're here to help in any way we can. </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection
@section('page-script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sellingRadio = document.getElementById("sellingRadio");
            const buyingRadio = document.getElementById("buyingRadio");
            const sellingDiv = document.getElementById("selling");
            const buyingDiv = document.getElementById("buying");

            setInterval(function () {
                sellingDiv.classList.toggle("d-none");
                buyingDiv.classList.toggle("d-none");
            }, 2000);

            sellingRadio.addEventListener("click", function () {
                sellingDiv.classList.remove("d-none");
                buyingDiv.classList.add("d-none");
            });

            buyingRadio.addEventListener("click", function () {
                sellingDiv.classList.add("d-none");
                buyingDiv.classList.remove("d-none");
            });
        });
    </script>

@endsection
