@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets/style/contact.css') }}" />
    <style>
        img.card-logo {
            width: 500px;
        }

        form#card-form {
            width: 468px;
        }

        .custom-select {
            width: 468px;
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
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 d-flex justify-content-center flex-column">
                @if (isset($cardDetail->logoUrls) && sizeof($cardDetail->logoUrls) > 0)
                    <img class="card-logo w-100" src="{{ $cardDetail->logoUrls[0] }}" alt="">
                @endif
                <p class="text-center">{{ $cardDetail->productName }}</p>
                <p class="text-center">{{ $cardDetail->brand->brandName }}</p>
                <p class="text-center"><strong>Amount:</strong>
                    {{ $cardDetail->denominationType == 'FIXED' ? $cardDetail->fixedRecipientDenominations[0] : $cardDetail->minSenderDenomination[0] }}
                    {{ $cardDetail->recipientCurrencyCode }}</p>
            </div>
            <div class="col-6">
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
                        <input type="hidden" name="product_id" value="{{ $cardDetail->productId }}">
                        <input type="hidden" name="product_amount"
                            value="{{ $cardDetail->denominationType == 'FIXED' ? $cardDetail->fixedRecipientDenominations[0] : $cardDetail->minSenderDenomination[0] }}">
                        <input type="hidden" name="product_name" value="{{ $cardDetail->productName }}">
                        <div class="form-group mb-3">
                            <label for="email">Recipient Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="emailHelp" placeholder="Enter Recipient Email">
                            @error('email')
                                <small class="form-text text-danger">{{ $msg }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Recipient Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                aria-describedby="emailHelp" placeholder="Enter Recipient Phone">
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
                            <input type="text" class="form-control" name="sender_name" id="sender-name"
                                aria-describedby="nameHelp" placeholder="Enter Sender Name">
                            @error('sender_name')
                                <small class="form-text text-danger">{{ $msg }}</small>
                            @enderror
                        </div>

                        <div class="form-group my-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                aria-describedby="quantityHelp" placeholder="1" min="1" value="1">
                            @error('quantity')
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

                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="https://js.stripe.com/v3/"></script>
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
                console.log(error)
            } else {
                let input = document.createElement('input')
                input.setAttribute('type', 'hidden')
                input.setAttribute('name', 'payment_method')
                input.setAttribute('value', paymentMethod.id)
                cardForm.appendChild(input)
                cardForm.submit()
            }
        })



        $(document).on("click", ".remove-error", function() {
            $(".alert-danger").alert('close')
        })
    </script>
@endsection
