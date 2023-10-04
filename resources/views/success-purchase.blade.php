@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/contact.css')}}" />
<style>
    .success-img{
        max-width: 600px;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="container">
        <div class="col-12">
            <div class="d-flex justify-content-center flex-column">
                <div class="d-flex justify-content-center"><img class="success-img" src="{{asset('assets/images/success.png')}}" alt="" /></div>
                <h2 class="text-center">Thank You</h2>
                <h3 class="text-center text-success">Your purchase was successfull</h3>
            </div>
        </div>
    </div>
</div>
@endsection