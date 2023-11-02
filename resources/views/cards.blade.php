@extends('main.main')


@section('title')
    Card
@endsection

@section('css-link')
    <link rel="stylesheet" href="{{ asset('assets/style/contact.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.css"
        integrity="sha512-K1k7jSn9RDKEcn/ugqVVvWYu0bcS3q1w6m/5pQSnrj0bCfIqF6Wk49lkmckSb4wglvTP9V17LtS0q0XxYccXbg==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <style>
        button.btn.btn-outline-secondary.filter-card {
            border-radius: 6px;
            background: #5570F1;
            color: white;
            border: 1px solid #5570F1;
        }

        div#pagination-container {
            display: flex;
            justify-content: center;
            padding: 3%
        }
        h4.text-center.py-2{
        font-size: 16px;
        }

        /* div#card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        } */

        .custom-row {
            flex-direction: column !important
        }

        .main-card {
            width: 100%;
            border-radius: 9px;
            overflow: hidden;
            /* height: 25%; */
        }
        .main-card > div{
            height: 100%;
            border-radius: 10px;
            overflow: hidden;
            /* justify-content: space-between  */
            
        }

        /* .main-card .card {
                                                            height: 100% !important;
                                                        } */

        .main-card .card img {
            width: 100%;
            height: 240px;
        }

        .input-group {
            justify-content: center;
            gap: 2%;
            padding: 1%
        }


        .paginationjs .paginationjs-pages li.active>a {
            background: #5570F1;
        }

        .loading {
            height: 33px;
        }
        .card-section{
            min-height: 47%;
        }
        .country-dropdown-section.input-group {
            width: 27%;
            margin: auto;
            gap: 13px;

        }
        #inputGroupSelect04{
            text-align: center;
            border-radius: 5px !important;
            border: 1px solid lightslategray !important;
            min-width: 133px;
        }
        #inputGroupSelect04:focus{
            border: 1px solid dodgerblue !important;
        }
        .card-section .loading{
            align-self: center;
            width: auto !important;
        }
        /* Base styles for grid items */
/* Base styles for grid items */
.grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Desktop layout with 4 columns */
    gap: 20px; /* Adjust the gap between grid items */
}

.grid-item {
    background-color: #3498db;
    color: #fff;
    padding: 20px;
    text-align: center;
}
.main-card:hover{
    box-shadow: 0 0 12px -2px lightslategray;
}


/* Media queries for smaller screens */
@media (max-width: 1198px) { /* Tablets and smaller */
    .grid-container {
        grid-template-columns: repeat(3, 1fr); /* Adjust the number of columns for tablets */
    }
}

@media (max-width: 1023px) { /* Tablets and smaller */
    .grid-container {
        grid-template-columns: repeat(3, 1fr); /* Adjust the number of columns for tablets */
    }
}

@media (max-width: 767px) { /* Mobile devices */
    .grid-container {
        grid-template-columns: repeat(2, 1fr); /* Adjust the number of columns for mobile devices */
    }
}
@media (max-width: 575px) { /* Tablets and smaller */
    .grid-container {
        grid-template-columns: repeat(1, 1fr); /* Adjust the number of columns for tablets */
    }
    h4.text-center.py-2{
        font-size: 16px;
    }
}

    </style>
@endsection


@section('content')
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content card-detail-modal">

            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row">
            {{-- <div class="input-group">
                <select class="custom-select iso" id="inputGroupSelect04">
                    <option selected disabled value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->iso_name }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary filter-card" type="button">Submit</button>
                </div>
                <img class="loading mx-2 d-none" src="{{ asset('assets/images/loading.gif') }}" alt="">
            </div> --}}
        </div>
    </div>

    <div class="card-section container">
        <div class="row custom-row">
            <div id="card-heading">
                <h3 class="text-center">Please Select Country</h3>
            </div>
            
            <div class="country-dropdown-section input-group ">
                <select class="custom-select iso form-control" id="inputGroupSelect04">
                    <option selected disabled value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->iso_name }}" @if($country->iso_name == "US") selected @endif>{{ $country->country_name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary filter-card" type="button">Submit</button>
                </div>
            </div>
            <img class="loading mx-2 d-none" src="{{ asset('assets/images/loading.gif') }}" alt="">
            <div class="grid-container mt-5" id="card-container">
            </div>
            <div id="pagination-container">

            </div>
        </div>
    </div>


@endsection



@section('page-script')
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
@endsection
