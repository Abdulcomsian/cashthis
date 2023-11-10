<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=100% , initial-scale=1.0" />
    <title>Login</title>
    <!-- <link rel="stylesheet" href="./assets/style/login.css" /> -->
    <!-- <link rel="stylesheet" href="./assets/style/login-en.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/style/login-en.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- font-family  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <style>
        .form-error-message {
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
    </style>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.12/build/css/intlTelInput.css"> -->

</head>

<body>
    <div>
        <div class="login-main">
            <div class="left-login-side">
                <div>
                    <img src="./assets/images/Frame 277132034.png" alt="logo" />
                </div>
                </li>
                <li class="nav-item d-none ">
                    <div class="dropdown">
                        <div class="language-div dropdown-toggle" id="dropdownMenu2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div>
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="language">
                                <span id="lang-select" data-translate="lang"> </span>
                            </div>
                            <div><i class="bi bi-chevron-down"></i></div>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li>
                                <button class="dropdown-item" type="button" id="englishButton"
                                    onclick="onLangChange('English')">
                                    English
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="button" id="arabicButton"
                                    onclick="onLangChange('Arabic')">
                                    Arabic
                                </button>
                            </li>
                        </ul>
                    </div>
                </li>
            </div>
            <div class="right-login-side">
                <div class="logo-section">
                    <div>
                        <a href="/"><img src="{{ asset('assets/images/Frame127.png') }}" alt="logo" /></a>
                    </div>
                </div>
                <div class="form-section">
                    <div>
                        <div class="text-container">
                            <div class="text-line-1">
                                <span data-translate="welcome-to"> Welcome to </span><span style="color:  #5570f1;"
                                    data-translate="anjez">GiftHub</span>
                            </div>
                            <div class="text-line-2">
                                <span data-translate="account">
                                    Don't have any account?
                                    <a href="signup" data-translate="sign-up">Sign Up</a>
                                </span>

                            </div>
                        </div>
                        <!-- <div class="row d-flex justify-content-start mt-5">
                <div class="col-3 show" id="mail" onclick="showEmail()" style="cursor: pointer;" data-translate="email"> Email </div>
    
                <div class="col-6" id="no"  onclick="showNumber()" style="cursor: pointer;" data-translate="phone-number"> Phone  Number</div>
              </div> -->

                        <div class="form-container">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div id="emails">
                                    <label for="email" class="form-label" data-translate="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder ="Your Email " />
                                    @error('email')
                                        <span class="form-error-message" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="form-label" data-translate="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="********" />
                                    @error('password')
                                        <span class="form-error-message" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" data-translate="log-in">Log In</button>
                                </div>

                            </form>
                            <div class="text-line-2">
                                <span>
                                    <!-- {{ __('lang.login_form.dont_have_any_account') }} <a href="{{ url('/signup') }}">{{ __('lang.navbar.signup') }}</a> -->
                                    Don't remember password?.
                                    <a href="{{ route('forgetPassword') }}">Forgot Password?</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.12/build/js/intlTelInput.min.js"></script>
    <script>
        var input = document.querySelector("#phone-input");
        var iti = window.intlTelInput(input, {
            initialCountry: "ae",
            preferredCountries: ["ae", "gb"], // You can set the preferred countries
            separateDialCode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.12/build/js/utils.js" // Make sure to include this script
        });
    </script>
    <script>
        function showNumber() {
            document.getElementById("emails").style.display = "none";
            document.getElementById("numd").style.display = "block";
            document.getElementById("mail").classList.remove("show")
            document.getElementById("no").classList.add("show")
        }

        function showEmail() {
            document.getElementById("emails").style.display = "block";
            document.getElementById("numd").style.setProperty("display", "none", "important");
            document.getElementById("mail").classList.add("show")
            document.getElementById("no").classList.remove("show")
        }
    </script>

</body>

</html>
