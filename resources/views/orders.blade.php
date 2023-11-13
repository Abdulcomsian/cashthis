@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/contact.css')}}" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

@endsection


@section('content')
<div class="container my-5">
    <div class="row my-5">
        <h3>Card Orders</h3>
        <table class="order-table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Order Id</th>
                <th scope="col">Card</th>
                <th scope="col">Recipient Email</th>
                <th scope="col">Recipient Phone</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Status</th>
                <th scope="col">Purchase Date</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          
    </div>
</div>

@if(auth()->user()->type == AppConst::USER)
<div class="container my-5">
    <div class="row my-5">
        <h3>Sold Cards</h3>
        <table class="card-table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Transaction Id</th>
                <th scope="col">Transaction Email</th>
                <th scope="col">Amount</th>
                <th scope="col">Recieve Amount</th>
                <th scope="col">Payment Status</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          
    </div>
</div>
@endif


@endsection



@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        (function(){
            let url = '{{route("ordersList")}}';
            let columns = [
                            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                            { data: 'orderId', name: 'orderId' },
                            { data: 'card', name: 'card' },
                            { data: 'recipientEmail', name: 'recipientEmail' },
                            { data: 'recipientPhone', name: 'recipientPhone' },
                            { data: 'quantity', name: 'quantity' },
                            { data: 'unitPrice', name: 'unitPrice' },
                            { data: 'status', name: 'status' },
                            { data: 'purchaseDate', name: 'purchaseDate' },
                       ];

         loadTable( ".order-table" ,  url , columns)

         let cardTable = document.querySelector(".card-table");
         if(cardTable){
            url = '{{route("getSoldCard")}}';
            columns = [
                            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                            { data: 'transaction_id', name: 'transaction_id' },
                            { data: 'email', name: 'email' },
                            { data: 'amount', name: 'amount' },
                            { data: 'recieve_amount', name: 'recieve_amount' },
                            { data: 'status', name: 'status' },
                       ];
            loadTable(".card-table" , url , columns);
         }

        })()

        function loadTable(table , url, columns){
            $(table).DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                pagingType: 'full_numbers',
                "bDestroy": true,
                ajax : {
                    type : 'POST',
                    url : url,
                    data : {
                        _token : "{{csrf_token()}}"
                    }
                },
                columns: columns
            });
        }

    </script>
@endsection