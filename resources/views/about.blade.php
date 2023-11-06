@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets/style/contact.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.css"
        integrity="sha512-K1k7jSn9RDKEcn/ugqVVvWYu0bcS3q1w6m/5pQSnrj0bCfIqF6Wk49lkmckSb4wglvTP9V17LtS0q0XxYccXbg==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}" />
    <style>
              h1,
        h2,
        h3,
        h4,
        h5,
        h6 {}
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        
        a,
        a:active,
        a:focus {
            color: #6f6f6f;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        img {
    max-width: 100%;
    height: auto;
}
        section {
            padding: 60px 0;
           /* min-height: 100vh;*/
        }

.sec-title{
  position:relative;
  z-index: 1;
  margin-bottom:60px;
}

.sec-title .title{
  position: relative;
  display: block;
  font-size: 18px;
  line-height: 24px;
  color: #00aeef;
  font-weight: 500;
  margin-bottom: 15px;
}

.sec-title h2{
  position: relative;
  display: block;
  font-size:40px;
  line-height: 1.28em;
  color: #222222;
  font-weight: 600;
  padding-bottom:18px;
}

.sec-title h2:before{
  position:absolute;
  content:'';
  left:0px;
  bottom:0px;
  width:50px;
  height:3px;
  background-color:#d1d2d6;
}

.sec-title .text{
  position: relative;
  font-size: 16px;
  line-height: 26px;
  color: #848484;
  font-weight: 400;
  margin-top: 35px;
}

.sec-title.light h2{
  color: #ffffff;
}

.sec-title.text-center h2:before{
  left:50%;
  margin-left: -25px;
}

.list-style-one{
  position:relative;
}

.list-style-one li{
  position:relative;
  font-size:16px;
  line-height:26px;
  color: #222222;
  font-weight:400;
  padding-left:35px;
  margin-bottom: 12px;
}

.list-style-one li:before {
    content: "\f058";
    position: absolute;
    left: 0;
    top: 0px;
    display: block;
    font-size: 18px;
    padding: 0px;
    color: #ff2222;
    font-weight: 600;
    -moz-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1.6;
    font-family: "Font Awesome 5 Free";
}

.list-style-one li a:hover{
  color: #44bce2;
}

.btn-style-one{
  position: relative;
  display: inline-block;
  font-size: 17px;
  line-height: 30px;
  color: #ffffff;
  padding: 10px 30px;
  font-weight: 600;
  overflow: hidden;
  letter-spacing: 0.02em;
  background-color: #00aeef;
}

.btn-style-one:hover{
  background-color: #0794c9;
  color: #ffffff;
}
.about-section{
  position: relative;
  padding: 120px 0 70px;
}

.about-section .sec-title{
  margin-bottom: 45px;
}

.about-section .content-column{
  position: relative;
  margin-bottom: 50px;
}

.about-section .content-column .inner-column{
  position: relative;
  padding-left: 30px;
}

.about-section .text{
  margin-bottom: 20px;
  font-size: 16px;
  line-height: 26px;
  color: #848484;
  font-weight: 400;
}

.about-section .list-style-one{
  margin-bottom: 45px;
}

.about-section .btn-box{
  position: relative;
}

.about-section .btn-box a{
  padding: 15px 50px;
}

.about-section .image-column{
  position: relative;
}

.about-section .image-column .text-layer{
    position: absolute;
    right: -110px;
    top: 50%;
    font-size: 325px;
    line-height: 1em;
    color: #ffffff;
    margin-top: -175px;
    font-weight: 500;
}

.about-section .image-column .inner-column{
  position: relative;
  padding-left: 80px;
  padding-bottom: 0px;
}
.about-section .image-column .inner-column .author-desc{
    position: absolute;
    bottom: 16px;
    z-index: 1;
    background: orange;
    padding: 10px 15px;
    left: 96px;
    width: calc(100% - 152px);
    border-radius: 50px;
}
.about-section .image-column .inner-column .author-desc h2{
    font-size: 21px;
    letter-spacing: 1px;
    text-align: center;
    color: #fff;
  margin: 0;
}
.about-section .image-column .inner-column .author-desc span{
    font-size: 16px;
    letter-spacing: 6px;
    text-align: center;
    color: #fff;
  display: block;
  font-weight: 400;
}
.about-section .image-column .inner-column:before{
    content: '';
    position: absolute;
    width: calc(50% + 80px);
    height: calc(100% + 160px);
    top: -80px;
    left: -3px;
    background: transparent;
    z-index: 0;
    border: 24px solid #00aeef;
}

.about-section .image-column .image-1{
  position: relative;
}
.about-section .image-column .image-2{
  position: absolute;
  left: 0;
  bottom: 0;
}

.about-section .image-column .image-2 img,
.about-section .image-column .image-1 img{
  box-shadow: 0 30px 50px rgba(8,13,62,.15);
      border-radius: 46px;
}

.about-section .image-column .video-link{
  position: absolute;
  left: 70px;
  top: 170px;
}

.about-section .image-column .video-link .link{
  position: relative;
  display: block;
  font-size: 22px;
  color: #191e34;
  font-weight: 400;
  text-align: center;
  height: 100px;
  width: 100px;
  line-height: 100px;
  background-color: #ffffff;
  border-radius: 50%;
  box-shadow: 0 30px 50px rgba(8,13,62,.15);
  -webkit-transition: all 300ms ease;
  -moz-transition: all 300ms ease;
  -ms-transition: all 300ms ease;
  -o-transition: all 300ms ease;
  transition: all 300ms ease;
}

.about-section .image-column .video-link .link:hover{
  background-color: #191e34;
  color: #6f6f6f}

</style>
@endsection


@section('content')

<div class="section-2">
    <div class="container px-5 py-5">
        <div class="main-heading pt-5 m-auto ">
            About Us
        </div>
    </div>
</div>
<section class="about-section">
    <div class="container">
        <div class="row">                
            <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="title">About Giftthis</span>
                        <h2>We are Creative Tech Enthusiast working since 2015</h2>
                    </div>
                    <div class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias eveniet consectetur animi necessitatibus eligendi consequuntur similique aspernatur explicabo perspiciatis sit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora voluptates, omnis dolores facere dolor odit iure culpa natus similique sapiente dolorem atque nesciunt necessitatibus laudantium cupiditate non unde. Natus, reprehenderit?</div>
                  <div class="text">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est quidem vitae, placeat dolor ut repellendus esse reiciendis obcaecati magnam neque fugiat repudiandae nostrum dolore amet assumenda ratione animi vel ipsa.
                  </div>
                    <div class="btn-box">
                        <a href="#" class="theme-btn btn-style-one">Contact Us</a>
                    </div>
                </div>
            </div>

            <!-- Image Column -->
            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                <div class="inner-column wow fadeInLeft">
                  <div class="author-desc">
                    <h2>TITLE</h2>
                    <span>Lorem ipsum dolor sit amet.</span>
                  </div>
                    <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images"><img title="Rahul Kumar Yadav" src="https://i.ibb.co/QP6Nmpf/image-1-about.jpg" alt=""></a></figure>
                 
                </div>
            </div>
          
        </div>
       <div class="sec-title mt-5">
                        {{-- <span class="title">Our Future Goal</span> --}}
                        <h2>We want to lead in innovation & Technology</h2>
                    </div>
      <div class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique accusantium suscipit nulla saepe iure id animi optio libero expedita quas!
          </div>
           <div class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur temporibus optio non minima quae alias aperiam at iusto, iure ducimus!
          </div>
           <div class="text">                
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem rem soluta laborum odio, aliquam tempora atque in reprehenderit explicabo iste magni similique nam eum. Omnis beatae magni quia commodi quos.
          </div>
           <div class="text">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus at tenetur fuga suscipit possimus distinctio fugiat ea autem rem assumenda!
          </div>
           <div class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quo quibusdam non tenetur eligendi fugiat itaque accusantium eveniet dignissimos ipsa.
          </div>
    </div>
</section>

@endsection



{{-- @section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.js"
        integrity="sha512-GzbaI5EsNzdEUq6/2XLYpr1y9CUZRIVsUeWTAFgULtQa5jZ3Nug8i0nZKM6jp9NffBCZhymPPQFcF0DK+JkRpw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var isPaginationSet = false;

            (function(){
                let arrayIs = "{{$cards}}";
                let decodedJSON = arrayIs.replace(/&quot;/g, '"'); // Replace &quot; with double quotes
                let cards = JSON.parse(decodedJSON);
                setPaginationTable(cards);
            })()



            $(document).on("click", ".filter-card", function() {
                let iso = document.querySelector(".iso").value;
                let element = this;
                let check = [null, undefined, ""];
                if (check.includes(iso)) {
                    toastr.error("Please Select Country");
                    return
                }
                element.setAttribute("disabled", true);
                let loader = document.querySelector(".loading");
                loader.classList.remove("d-none")
                $.ajax({
                    type: "POST",
                    url: "{{ route('getGiftCard') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        iso: iso
                    },
                    success: function(res) {
                        if (res.status) {
                            setPaginationTable(res.cards);
                            element.removeAttribute('disabled');
                            loader.classList.add("d-none")
                        } else {
                            toastr.error(res.error)
                        }
                    },
                    error: function(res) {
                        toastr.error(res.error);
                    }
                });
            })

            function setPaginationTable(cards) {
                console.log(typeof(cards));
                $('#pagination-container').pagination({
                    dataSource: cards,
                    pageSize: 16, // Number of cards to display per page
                    callback: function(data, pagination) {
                        // Clear the card container
                        $('#card-container').empty();

                        // Render cards for the current page's data
                        for (let i = 0; i < data.length; i++) {
                            let card = data[i];
                            let cardHtml = `
                                <div class="main-card" data-product-id="${card.product_id}">
                                    <div class="card">
                                        <div>
                                        <img src="${card.logo_url}" alt="${card.product_id}" /></div>`;
                            let brand = card.brand !== null ? card.brand : "";
                            cardHtml +=  `<div class="h-100 d-flex flex-column justify-content-between"><h4 class="text-center py-2">${brand} ${card.country_iso}</h4>
                                            <div class="d-flex justify-content-center py-2 pb-4">
                                                <a href="{{ url('gift-card-detail') }}/${card.product_id}" class="btn btn-success view-card-detail" data-product-id="${card.product_id}">Buy Now</a>
                                            </div></div>
                                    </div>
                                </div>
                                `;
                        // $('.card-list').append(cardHtml);
                            $('#card-container').append(cardHtml);
                        }
                    }
                });
            }
        })
    </script>
@endsection --}}
