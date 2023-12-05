@extends('main.main')

@section('title')
    Condition Of Use
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('assets/style/sellCard.css')}}" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{asset('assets/plugins/sweet-alert/sweet-alert.min.css')}}">
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
select{
    border: 1px solid dodgerblue;
    border-radius: 5px
}
.form-check-input{
    display: inline-block;
    padding: 2px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover{
    background: rgb(73, 115, 158);
    border-radius: 10px;
    outline: none;
    border: 1px solid transparent;
    padding: 3px 16px;
    /* box-shadow: 0 0 5px dodgerblue; */
}
.dataTables_wrapper .dataTables_info{
    padding-top: 14px;
    color: #4455;
}
table.dataTable.no-footer{
    border-bottom: 0px solid #4455;
}
table.dataTable thead th{
    border-bottom: 1px solid #4455
}
table.dataTable .dataTables_empty{
    padding: 35px 10px;
    color: gray;
}
#selling-cards{
    padding-top: 40px;
}
#selling-cards_filter input[type="search"]{
    padding: 12px;
    border-radius:5px;
    border: 1px solid dodgerblue;
}
#selling-cards_filter input[type="search"]:focus{
    outline: none
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
            <div class="offer p-5 pb-3 userList-container">
                <div class="card-list">
                    <div style="overflow-x: auto">
                        <table id="users-list" class="table w-100" >
                            <thead>
                                <th>Sno</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Orders</th>
                                <th>Sold Cards</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection

    @section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/plugins/sweet-alert/sweet-alert.min.js')}}"></script>
    <script>

        $(document).ready(function(){
            loadDataTable()
        })

     

     


        function loadDataTable(){
            $("#users-list").DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    pagingType: 'full_numbers',
                    "bDestroy": true,
                    ajax : {
                        type : 'POST',
                        url : "{{route('users')}}",
                        data : {
                            _token : "{{csrf_token()}}"
                        }
                    },
                    columns: [
                          { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
                          { data: 'username', name: 'username' },
                          { data: 'email', name: 'email' },
                          { data: 'phone', name: 'phone' },
                          { data: 'order', name: 'order' },
                          { data: 'sold_card', name: 'sold_card' },
                          { data: 'action', name: 'action' },
                      ]
                });
        }


        $(document).on("click" , ".user-bank-detail " , function(event){
            let userId = this.dataset.userId;
            $.ajax({
                type : 'POST',
                url : "{{route('bankDetails')}}",
                data : {
                    _token : "{{csrf_token()}}",
                    id : userId
                },
                success:function(res){
                    if(res.status){
                        document.querySelector(".bank-detail-body").innerHTML = res.html
                        $(".bank-detail").modal("show");
                    }else{
                        toastr.error(res.msg);
                    }
                }
            })
        })

        $(document).on("click" , ".delete-user " , function(event){

            let userId = this.dataset.userId;
            

            Swal.fire({
                title: "Are you sure you want to delete this user?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                        $.ajax({
                            type : 'POST',
                            url : "{{route('deleteUser')}}",
                            data : {
                                _token : "{{csrf_token()}}",
                                userId : userId
                            },
                            success:function(res){
                                if(res.status){
                                    loadDataTable();
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                }else{
                                    toastr.error(res.msg)
                                }
                            }
                        })

                    
                }
            });



            
        })

        $(document).on("click" , ".close" , function(event){
            element  = this.closest(".modal")
            $(element).modal("hide");
        })

        </script>
   
    @endsection