@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets/style/contact.css') }}" />
    <style>
        * {
            font-family: "Lato";
        }

        .custom-select {
            width: 100%;
            height: 55px;
            border: 1px solid #8b8b8b;
        }

        .alert {
            position: relative;
        }

        button.close.remove-error {
            background: none;
            border: none;
            font-size: 25px;
            position: absolute;
            top: 7px;
            right: 8px;
            color: #842029;
            font-weight: bold;
        }

        .loading {
            width: 28px;
        }

        .gift-details {
            padding-top: 2%;
            padding-bottom: 2%;
        }

        .gift-details .gift-card-details {
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 0.5rem
        }

        .gift-details .gift-card-details div img {
            width: auto;
            height: 440px;
        }

        .gift-details .gift-card-details div .heading {
            font-size: 18px;
            font-weight: 900;
        }

        .gift-details .gift-card-details div span {
            font-size: 16px;
            font-weight: 600;
        }

        .gift-details .recipient-card-details .card {
            padding: 6%
        }

        .gift-details .recipient-card-details .card form {
            width: 100%;
            margin: 0%
        }

        .gift-details .recipient-card-details .card label {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 1%
        }

        .gift-details .recipient-card-details .card button {
            float: right;
            background-color: #5570F1;
            color: #ffffff
        }
    </style>
@endsection


@section('content')
<div class="modal fade" id="buy-card-modal-loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body d-flex justify-content-center">
          <img src="{{asset('assets/images/purple-loading.gif')}}" alt="">
        </div>
      </div>
    </div>
  </div>


    <div class="container">
        <div class="row gift-details">
            <div class="col-6 gift-card-details align-items-center">
                <div>
                    @if (isset($cardDetail->logoUrls) && sizeof($cardDetail->logoUrls) > 0)
                        <img class="card-logo" src="{{ $cardDetail->logoUrls[0] }}" alt="">
                    @endif
                </div>
                <div>
                    <span>
                        {{ $cardDetail->productName }}
                    </span>
                </div>
                <div>
                    <span>
                        {{ $cardDetail->brand->brandName }}
                    </span>
                </div>
                <div>
                    <span class="heading">Amount:</span>
                    <span>
                        {{-- @dd($cardDetail) --}}
                        {{ $cardDetail->denominationType == 'FIXED' ? $cardDetail->fixedRecipientDenominations[0] : $cardDetail->minRecipientDenomination }}
                        {{ $cardDetail->recipientCurrencyCode }}
                    </span>
                </div>
            </div>
            <div class="col-6 recipient-card-details">
                <div class="card">
                    @if (Session::has('status') && !session('status'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session::get('error') }}
                            <button type="button" class="close remove-error" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('purchaseGiftCard') }}" id="card-form">
                        @csrf
                        <input type="hidden" class="product-id" name="product_id" value="{{ $cardDetail->productId }}">
                        <input type="hidden" class="product-amount" name="product_amount" value="{{ $cardDetail->denominationType == 'FIXED' ? $cardDetail->fixedRecipientDenominations[0] : $cardDetail->minRecipientDenomination }}">
                        <input type="hidden" class="product-name" name="product_name" value="{{ $cardDetail->productName }}">
                        <input type="hidden" class="product-quantity" name="quantity" value="1">
                        <div class="form-group mb-3">
                            <label for="email">Recipient Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Recipient Email">
                            @error('email')
                                <small class="form-text text-danger">{{ $msg }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Recipient Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="emailHelp" placeholder="Enter Recipient Phone">
                            @error('phone')
                                <small class="form-text text-danger">{{ $msg }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Recipient Country</label>
                            <div>
                                <select class="custom-select iso" name="country_code" id="inputGroupSelect04">
                                    <option selected disabled value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->iso_name }}">{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                @error('country_code')
                                    <small class="form-text text-danger">Please Select Country</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <label for="text">Name</label>
                            <input type="text" class="form-control" name="sender_name" id="sender-name" aria-describedby="nameHelp" placeholder="Enter Sender Name">
                            @error('sender_name')
                                <small class="form-text text-danger">{{ $msg }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Enter
                                Card Detail</label>

                            <div class="bg-gray-100 p-6 rounded-xl">
                                <div id="card"></div>
                            </div>
                        </div>
                        <div id="paypal-button-container"></div>
                        {{-- <button type="submit" class="btn">Purchase <img class="loading d-none" src="{{ asset('assets/images/white-loading.gif') }}" alt=""></button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script src="{{ asset('assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') }}"></script>
    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        let stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const elements = stripe.elements()
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px'
                }
            }
        })
        const cardForm = document.getElementById('card-form')
        const cardName = document.getElementById('sender-name')
        cardElement.mount('#card')
        cardForm.addEventListener('submit', async (e) => {
            e.preventDefault()
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: cardName.value
                }
            })
            if (error) {
                toastr.error(error.message);
                console.log(error)
            } else {
                document.querySelector(".loading").classList.remove("d-none");
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'payment_method')
                input.setAttribute('value', paymentMethod.id)
                cardForm.appendChild(input)
                cardForm.submit()
            }
        })



        </script> --}}

<script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_LIVE_CLIENT_ID')}}&disable-funding=paylater"></script>
<script>
    (function(){
            paypal.Buttons({

                    style: {
                        label:   'pay'
                    },

                    onInit: function(data, actions) {
                        // console.log(data , actions);
                        // document.querySelector(".paypal-button-number-0").style.display = "none";
                        // Code to run when the button is initialized
                    },

                createOrder: function(data, actions) {
                
                // This function sets up the details of the transaction, including the amount and line item details.
                    if(!validationForm()){
                        toastr.error("Please Enter Amount");
                        return actions.order.create({});
                    }
                    
                    return actions.order.create({
                            application_context: {
                            brand_name : 'GiftHub Card Sell And Purcahse',
                            user_action : 'PAY_NOW',
                        },
                        purchase_units: [{
                        amount: {
                            value: document.getElementsByName("product_amount")[0].value,
                        }
                        }],
                    });
                },

                onApprove: function(data, actions) {

                // This function captures the funds from the transaction.
                        return actions.order.capture().then(function(details) {
                            $("#buy-card-modal-loading").modal("show");
                            let paymentId = details.id;
                            let productAmount = document.querySelector(".product-amount").value;
                            let productId = document.querySelector(".product-id").value;
                            let productQuantity = document.querySelector(".product-quantity").value;
                            let recipientEmail = document.getElementById("email").value;
                            let recipientPhone = document.getElementById("phone").value;
                            let senderName = document.getElementById("sender-name").value;
                            let recipientCode = document.querySelector(".iso").value;
                            let productName = document.querySelector(".product-name").value;
                            
                            if(details.status == 'COMPLETED'){
                                $.ajax({
                                    type : "post",
                                    url : "{{route('buyGiftCard')}}",
                                    data : {
                                        _token : "{{csrf_token()}}",
                                        payerEmail: details.payer.email_address,
                                        paymentId : paymentId,
                                        productAmount : productAmount,
                                        productId : productId,
                                        productQuantity : productQuantity,
                                        recipientEmail : recipientEmail,
                                        recipientPhone : recipientPhone,
                                        recipientCode : recipientCode,
                                        senderName : senderName,
                                        productName : productName
                                    },
                                    success: function(res){
                                        $("#buy-card-modal-loading").modal("hide");
                                        if(res.status){
                                            toastr.success(res.msg);
                                            window.location.href = "{{route('successPurchase')}}";
                                        }else{
                                            toastr.error(res.msg);
                                        }
                                    }

                                })
                            }else{
                                alert("failed")
                                // window.location.href = '/pay-failed?reason=failedToCapture';
                            }
                        });
                },


            }).render('#paypal-button-container');
        })()

        function validationForm(){
            let check = [ undefined , null , ""];
            if(check.includes(document.querySelector(".product-amount").value)){
                return false;
            }else{
                return true;
            }
        }

        $(document).on("click", ".remove-error", function() {
            $(".alert-danger").alert('close')
        })
        
        $(document).ready(function() {
            $('#phone').mask('(000) 0000-0000');
            $('#buy-card-modal-loading').modal({backdrop: 'static', keyboard: false}, 'show');
        })

</script>
@endsection
