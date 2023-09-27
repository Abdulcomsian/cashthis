<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Coming Soon - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('assets/style/comming-soon.css')}}" rel="stylesheet" />
        <style>
            .passcode-area {
                    height: 40px;
                    width: 300px;
                    display: flex;
                    align-items: center;
                    background: white;
                    padding-left: 10px;
                    justify-content: space-between;
                    padding: 0px 20px;
                }
            .passcode-area input{
                border: none;
            }
            .passcode-area input:focus{
                outline: none;
            }
            .passcode-area button {
                color: #465F59;
                border-radius: 55%;
                width: 32px;
                border: 2px solid #465F59;
                font-weight: 900;
                background: none;
                rotate: 15deg;
                height: 32px;
            }

            .passcode-area button:hover{
                background: #465F59;
                color: white;
            }

            .toast-error {
                background-color: #bd362f;
                }
            .toast-success {
                background-color: #51a351;
            }
        </style>
    </head>
    <body>
        <!-- Background Video-->
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="{{asset('assets/mp4/bg.mp4')}}" type="video/mp4" /></video>
        <!-- Masthead-->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <h1 class="fst-italic lh-1 mb-4">Our Website is Coming Soon</h1>
                    <p class="mb-5">We're working hard to finish the development of this site. Sign up below to receive updates and to be notified when we launch!</p>
                    <div class="passcode-area">
                        <input type="text" name="passcode" id="passcode" placeholder="Enter Passcode"/>
                        <button id="passcode-btn">&#x2713;</button>
                    </div>



                </div>
            </div>
        </div>
        <!-- Social Icons-->
        <!-- For more icon options, visit https://fontawesome.com/icons?d=gallery&p=2&s=brands-->
        <!-- <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-instagram"></i></a>
            </div>
        </div> -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('assets/js/comming-soon.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <script>
            $(document).on("click" , "#passcode-btn" , function(){
                let passcode = document.getElementById("passcode").value;

                $.ajax({
                    type : 'POST',
                    url : '{{route("set.passcode")}}',
                    data : {
                        _token : '{{csrf_token()}}',
                        passcode : passcode
                    },
                    success:function(res){
                        if(res.status == true){
                            toastr.success(res.msg);
                            window.location.href = '{{route("home")}}';
                        }else{
                            toastr.error(res.msg);
                        }
                    }

                })
            })
        </script>

    </body>
</html>
