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
                Profile Detail
            </div>
        </div>
    </div>

    <!-- section-3  -->
    <div class="section-3">
        <div class="container d-flex justify-content-center">
            <div class="offer p-5 sellCard-container">
                <div class="row justify-content-between g-3">
                    <h3>Update User</h3>
                    <form  class="submit-form" action="{{route('updateUserProfile')}}" id="profile-detail">
                        <label>First Name</label>
                        <input class="input-1 my-2" type="text" value="{{$userDetail->first_name}}" name="first_name" placeholder="First Name" >
                        <label>Last Name</label>
                        <input class="input-1 my-2" type="text" value="{{$userDetail->last_name}}" name="last_name" placeholder="Last Name" >
                        <label>Phone</label>
                        <input class="input-1 my-2" type="text" value="{{$userDetail->phone}}" name="phone" placeholder="Phone" >
                        <button type="submit" class="w-100 btn btn-primary btn-sellCard" style="height: 53px;">Update User</button>
                    </form>

                </div>

                <div class="row justify-content-between g-3 my-4">
                    <h3>Update Password</h3>
                    <form  class="submit-form" action="{{route('updateUserPassword')}}" id="user-password">
                        <label>Password</label>
                        <input class="input-1 my-2" type="password"  name="password" placeholder="Password" >
                        <label>New Password</label>
                        <input class="input-1 my-2" type="password" name="new_password"  placeholder="New Password" >
                        <label>Confirm Password</label>
                        <input class="input-1 my-2" type="password" name="confirm_password" placeholder="Confirm Password" >
                        <button type="submit" class="w-100 btn btn-primary btn-sellCard" style="height: 53px;">Update Password</button>
                    </form>

                </div>



                <div class="row justify-content-between g-3 my-3">
                   
                    <h3>Update Bank Detail</h3>
                    <form  class="submit-form" action="{{route('addBankInformation')}}" id="bank-detail">
                        <label>Bank Name:</label>
                        <input class="input-1 my-2" type="text" value="{{isset($userDetail->bankDetails) && !is_null($userDetail->bankDetails) ? $userDetail->bankDetails->name : "" }}" name="bank_name" placeholder="Bank Name" >
                       

                        <label>Routing Number:</label>
                        <input class="input-1 my-2" type="text" value="{{isset($userDetail->bankDetails) && !is_null($userDetail->bankDetails) ? $userDetail->bankDetails->routing_number : "" }}" name="routing_number" placeholder="Routing Number" >
                        

                        <label>Account Number:</label>
                        <input class="input-1 my-2" type="text" value="{{isset($userDetail->bankDetails) && !is_null($userDetail->bankDetails) ? $userDetail->bankDetails->account_number : "" }}" name="account_number" placeholder="Account Number" >
                        

                        <label>Account Name:</label>
                        <input class="input-1 my-2" type="text"  name="account_name" value="{{isset($userDetail->bankDetails) && !is_null($userDetail->bankDetails) ? $userDetail->bankDetails->account_name : "" }}" placeholder="Account Name" >
                        
    
                        <button type="submit" class="w-100 btn btn-warning btn-sellCard" style="height: 53px;">Update Bank</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('page-script')
    <script>
        $(document).on("submit" , ".submit-form" , function(e){
            e.preventDefault();
            let element = this;
            let form = new FormData(element);
            let url = element.getAttribute('action');
            form.append('_token' , "{{csrf_token()}}");
            $.ajax({
                type : "POST",
                url : url,
                data : form,
                processData: false,
                contentType: false, 
                success : function(res){
                    if(res.status){
                        toastr.success(res.msg);
                    }else{
                        toastr.error(res.error);
                    }
                }
            })
        })
    </script>
    @endsection