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
</style>
@endsection

@section('content')

    <!-- section 2  -->

    <div class="section-2">
        <div class="container px-5 py-5">
            <div class="main-heading pt-5 m-auto ">
                Bank Information
            </div>
        </div>
    </div>

    <!-- section-3  -->
    <div class="section-3">
        <div class="container d-flex justify-content-center">
            <div class="offer p-5 sellCard-container">
                <div class="text-center text-primary"><strong>Please Enter Your Bank Information Before Selling Card</strong></div>
                <div class="row justify-content-between g-3">
                    @if(Session::has('status') && !Session::get('status'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{Session::get('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                      </div>
                    @endif
                    <form action="{{route('addBankInformation')}}" method="post">
                        @csrf
                        <input class="input-1 my-2" type="text"  name="bank_name" placeholder="Bank Name" >
                        @error('bank_name')
                         <span class="text-danger">{{$message}}</span>
                        @enderror

                        <input class="input-1 my-2" type="text"  name="routing_number" placeholder="Routing Number" >
                        @error('routing_number')
                         <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input class="input-1 my-2" type="text"  name="account_number" placeholder="Account Number" >
                        @error('account_number')
                         <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input class="input-1 my-2" type="text"  name="account_name" placeholder="Account Name" >
                        @error('account_name')
                         <span class="text-danger">{{$message}}</span>
                        @enderror
    
                        <button type="submit" class="w-100 btn-2 btn-sellCard">Add Information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection