@extends('main.main')

@section('title')
    Condition Of Use
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/sellCard.css')}}" />
<style>
    textarea {
    resize: vertical;
    border: 1px solid #DAD8D8;
    padding: 10px;
}

.alert{
    position: relative;
}

button.close {
    position: absolute;
    right: 13px;
    font-size: 20px;
    border: none;
    background: none;
    top: 12px;
}
.form-radio{
    width: 20px;
    height: 20px;
    margin-top: 3px;
}
.paypal-button-row:first-child{
    display: none!important;
}
select.custom-select {
    height: 48px;
    margin-right: 28px;
}

.paypal-button-number-0 {
    display: none!important;
}
</style>
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
                        <div class="text ">Enter Information</div>
                    </div>
                    <div class="col-4 d-flex  justify-content-center gap-2">
                        <div class="circle "> 2 </div>
                        <div class="text ">Processing Card</div>
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
                <div class="row g-3">

                    @if(Session::has('status') && !Session::get('status'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{Session::get('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                      </div>
                    @endif

                    @if(Session::has('status') && Session::get('status'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success</strong> {{Session::get('msg')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                      </div>
                    @endif

                    {{-- @if(isset($error) && !is_null($error))
                      <span class="text-danger"><strong>{{$error}}</strong></span>
                    @endif
                    @if(isset($success) && !is_null($success))
                      <span class="text-danger"><strong>{{$success}}</strong></span>
                    @endif --}}
                    <form>
                        <div class="d-flex justify-content-between" style='width : 90%'>
                            <h4>Choose Amount</h4>
                            <div class="percentage-section d-none">
                                <span>You will get: <strong class="percentage_amount">${{ number_format( 100 - (($percentage->percentage/100) * 100) , 2 )}}</strong><span>
                            </div>
                        </div>
                        <div class="input-group mb-3 w-100 d-flex justify-content-start">
                            <input type="number" class="card-amount" name="amount" id="amount" style="width: 93%!important" >
                        </div>
                        <div id="paypal-button-container"></div>
                        

                    </form>
                </div>
            </div>
           
        </div>

      
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_LIVE_CLIENT_ID')}}&disable-funding=paylater"></script>
    
    <script>
        (function(){
            paypal.Buttons({

                    style: {
                        label:   'pay'
                    },

                    onInit: function(data, actions) {
                        console.log(data , actions);
                        document.querySelector(".paypal-button-number-0").style.display = "none";
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
                            value: document.getElementsByName("amount")[0].value,
                        }
                        }],
                        application_context: {
                                shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },

                onApprove: function(data, actions) {
                    
                // This function captures the funds from the transaction.
                        return actions.order.capture().then(function(details) {
                            console.log(details);
                            let amount = details.purchase_units[0].amount.value;
                            if(details.status == 'COMPLETED'){
                                $.ajax({
                                    type : "post",
                                    url : "{{route('successTransaction')}}",
                                    data : {
                                        _token : "{{csrf_token()}}",
                                        id : details.id,
                                        payerEmail: details.payer.email_address,
                                        payedAmount: amount,
                                    },
                                    success: function(res){
                                        if(res.status){
                                            toastr.success(res.msg);
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
        if(check.includes(document.querySelector(".card-amount").value)){
            return false;
        }else{
            return true;
        }
    }

    </script>
    <script>
        $(document).on("keyup" , ".card-amount" , function(e){
            let element = e.target;
            let amount = element.value;
            let sellingPercentage = "{{$percentage->percentage}}";
            let currentAmount = (amount * sellingPercentage) / 100;
            let getAmount = amount - currentAmount;
            document.querySelector(".percentage_amount").innerText = "$"+getAmount.toFixed(2);
            document.querySelector(".percentage-section").classList.remove("d-none");
        })
    </script>
    @endsection