@extends('main.main')


@section('title')
    Dashboard
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/contact.css')}}" />
@endsection




@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="row my-5">
                <div class="col-4">
                    <div class="card">
                        <div class="d-flex justify-content-between py-5 px-3">
                            <h4>Total Orders</h4>
                            <h5>{{$totalOrders}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

