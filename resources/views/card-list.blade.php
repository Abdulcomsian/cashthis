@extends('main.main')

@section('title')
    Condition Of Use
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/sellCard.css')}}" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<script async defer src="https://buttons.github.io/buttons.js"></script>
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
.offer {
    width: 100%;
}
.fas{
    cursor: pointer;
}
.fas:hover{
    color: rgb(0, 140, 255);
}
.form-check-input{
    display: inline-block;
    padding: 2px;
}
</style>
@endsection

@section('content')


    <!-- section 2  -->
    <div class="modal bank-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Bank Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body bank-detail-body">
                
            </div>  
          </div>
        </div>
    </div>

    <div class="modal card-status" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Change Card Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body card-status-body">
               
            </div>  
          </div>
        </div>
    </div>

    <div class="section-2">
        <div class="container px-5 py-5">
            <div class="main-heading pt-5 m-auto ">
                Card List
            </div>
        </div>
    </div>

    <!-- section-3  -->
    <div class="section-3">
        <div class="container d-flex justify-content-center">
            <div class="offer p-5 sellCard-container">
                <div class="card-list">
                    <table id="selling-cards" class="table">
                        <thead>
                            <th>Sno</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Transaction Id</th>
                            <th>Payer Email</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            loadDataTable()
        })

        $(document).on("click" , ".bank-detail-btn" , function(){
            id = this.dataset.userId;
            $.ajax({
                type :  "POST",
                url : "{{route('bankDetails')}}",
                data : {
                    _token : "{{csrf_token()}}",
                    id  : id
                },
                success :function(res){
                    if(res.status){
                        document.querySelector(".bank-detail-body").innerHTML = res.html;
                        $(".bank-detail").modal("show");
                    }else{
                        toastr.error(res.msg);
                    }
                }
            })
        })

        

        $(document).on("click" , ".card-status-btn" , function(){
            id = this.dataset.cardId;
            $.ajax({
                type :  "POST",
                url : "{{route('getCardStatus')}}",
                data : {
                    _token : "{{csrf_token()}}",
                    id  : id
                },
                success :function(res){
                    if(res.status){
                        document.querySelector(".card-status-body").innerHTML = res.html;
                        $(".card-status").modal("show");
                    }else{
                        toastr.error(res.msg);
                    }
                }
            })
        })


        $(document).on("click" , ".close" , function(){
            let modal = this.closest(".modal");
            $(modal).modal("hide");
        })


        $(document).on("click" , ".edit-card-status" , function(){
            pendingStatus = document.getElementById("card-status-pending");
            let status = pendingStatus.checked == true ? 1 : 2;
            let id = document.getElementById("update-card-status-id").value;
            $.ajax({
                type : "POST",
                url : "{{route('updateCardStatus')}}",
                data : {
                    _token : "{{csrf_token()}}",
                    id : id,
                    status : status 
                },
                success : function(res){
                    if(res.status){
                        toastr.success(res.msg);
                        $(".card-status").modal("hide")
                        loadDataTable()
                    }else{
                        toastr.error(res.msg)
                    }
                }
            })
        })


        function loadDataTable(){
            $("#selling-cards").DataTable({
                    processing: true,
                    serverSide: true,
                    pagingType: 'full_numbers',
                    "bDestroy": true,
                    ajax : {
                        type : 'POST',
                        url : "{{route('sellingCards')}}",
                        data : {
                            _token : "{{csrf_token()}}"
                        }
                    },
                    columns: [
                          { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                          { data: 'username', name: 'username' },
                          { data: 'email', name: 'email' },
                          { data: 'transaction_id', name: 'transaction_id' },
                          { data: 'payer_email', name: 'payer_email' },
                          { data: 'amount', name: 'amount' },
                          { data: 'status', name: 'status' },
                          { data: 'action', name: 'action' },
                      ]
                });
        }

        </script>
       


    @endsection

    @section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    @endsection