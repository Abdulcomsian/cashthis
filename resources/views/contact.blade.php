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
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="post" action="{{route('contactform')}}" class="form-class">
            {{ csrf_field() }}
            <div class="row mb-3 justify-content-between">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="First Name" id="input1" name="first_name" required>
                </div>
                @error('first_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="col-md-6 ">
                    <input type="text" class="form-control" placeholder="Last Name" id="input2" name="last_name"
                        required>
                </div>
                @error('last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="email" class="form-control" placeholder="Email" id="input3" name="email" required>
                </div>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Subject" id="input4" name="subject" required>
                </div>
                @error('subject')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <textarea class="form-control" placeholder="Message" id="exampleFormControlTextarea1" name="message"
                        rows="5" required></textarea>
                </div>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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