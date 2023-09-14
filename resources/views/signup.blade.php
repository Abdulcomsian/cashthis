<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <!-- <link rel="stylesheet" href="./assets/style/signup-en.css" /> -->
    <link rel="stylesheet" href="{{asset('assets/style/signup-en.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <!-- font-family  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div>
      <div class="signup-main">
        <div class="left-signup-side">
          <div>
            <img
              src="{{asset('assets/images/Frame 277132034.png')}}"
              alt="logo"
            />
          </div>
          <!-- <li class="nav-item d-none ">
              <div class="dropdown">
                <div
                  class="language-div dropdown-toggle"
                  id="dropdownMenu2"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
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
                    <button
                      class="dropdown-item"
                      type="button"
                      id="englishButton"
                      onclick="onLangChange('English')"
                    >
                      English
                    </button>
                  </li>
                  <li>
                    <button
                      class="dropdown-item"
                      type="button"
                      id="arabicButton"
                      onclick="onLangChange('Arabic')"
                    >
                      Arabic
                    </button>
                  </li>
                </ul>
              </div>
            </li> -->
        </div>
        <div class="right-signup-side mb-4">
          <div class="logo-section">
            <div>
              <a href="./index.html"
                ><img src="./assets/images/Frame 126.png" alt="logo"
              /></a>
            </div>
          </div>
          <div class="form-section">
            <div>
              <div class="text-container mt-3">
                <div class="text-line-1 mt-5">
                  <span data-translate="get-started-with">
                    Get started with
                  </span>
                  <span style="color: #5570f1" data-translate="anjez"
                    >CashThis</span
                  >
                </div>
                <div class="text-line-2">
                  <span data-translate="already-have-an-account">
                    Already have an account?
                    <a href="./login.html" data-translate="log-in">Log in</a>
                  </span>
                </div>
              </div>
              <div class="form-container">
                <form>
                  <div class="nav-div">
                    <div>
                      <label
                        for="firstname"
                        class="form-label"
                        data-translate="first-name"
                        >First Name</label
                      >
                      <input
                        style="width: 100%"
                        type="text"
                        class="form-control"
                        id="firstname"
                        placeholder="First Name"
                      />
                    </div>
                    <div>
                      <label
                        for="lastname"
                        class="form-label"
                        data-translate="last-name"
                        >Last Name</label
                      >
                      <input
                        style="width: 100%"
                        type="text"
                        class="form-control"
                        id="lastname"
                        placeholder="Last Name"
                      />
                    </div>
                  </div>
                  <div>
                    <label for="email" class="form-label" data-translate="email"
                      >Email</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="email"
                      placeholder="Your Email"
                    />
                  </div>
                  <div class="d-flex flex-column">
                    <label
                      for="phone"
                      class="form-label"
                      data-translate="phone-number"
                    >
                      Phone Number
                    </label>
                    <input
                      type="number"
                      id="phone"
                      class="form-control"
                      name="phone"
                      placeholder="123456789"
                    />
                  </div>
                  <div>
                    <label
                      for="password"
                      class="form-label"
                      id="pass"
                      data-translate="password"
                      >Password</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="password"
                      placeholder="********"
                    />
                  </div>
                  <div>
                    <label
                      for="confirmpassword"
                      class="form-label"
                      data-translate="confirm-password"
                      >Confirm Password</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="confirmpassword"
                      placeholder="********"
                    />
                  </div>
                  <div>
                    <button type="submit" data-translate="sign-up">
                      Sign Up
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
          initialCountry: "ae",
          preferredCountries: ["ae", "gb", "fr"],
          separateDialCode: true,
        });

        input.classList.add("form-control")
      </script> -->
  </body>
</html>
