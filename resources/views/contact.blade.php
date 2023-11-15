@extends('main.main')

@section('title')
    Condition Of Use
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets/style/contact.css') }}" />
@endsection

@section('content')
    <div class="section-2">
        <div class="container">
            <div class="heading">Get in Touch With Us</div>

            <form method="post" action="{{route('contactform')}}">
                        {{ csrf_field() }}
                <div class="row mb-3 justify-content-between">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="First Name" id="input1" name="first_name">
                    </div>
                    <div class="col-md-6 ">
                        <input type="text" class="form-control" placeholder="Last Name" id="input2" name="last_name">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="email" class="form-control" placeholder="Email" id="input3" name="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Subject" id="input4" name="subject">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <textarea class="form-control" placeholder="Message" id="exampleFormControlTextarea1" name="message" rows="5"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 ">
                        <button type="submit" class="form-btn btn-block" style="width: 100%;">Send</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    </div>
@endsection
