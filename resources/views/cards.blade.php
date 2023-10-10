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
            border-radius: 1px;
            background: #5570F1;
            color: white;
            border: 1px solid #5570F1;
        }

        div#pagination-container {
            display: flex;
            justify-content: center;
            padding: 1%
        }

        div#card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .custom-row {
            flex-direction: column !important
        }

        .main-card {
            width: 30%;
            margin: 20px;
            /* height: 25%; */
        }

        /* .main-card .card {
                                                            height: 100% !important;
                                                        } */

        .main-card .card img {
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

    <div class="container">
        <div class="row custom-row">
            <div id="card-container">
                <h3>Please Select Country</h3>
            </div>
            <div id="pagination-container">

            </div>
            <div class="input-group">
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
                $('#pagination-container').pagination({
                    dataSource: cards,
                    pageSize: 10, // Number of cards to display per page
                    callback: function(data, pagination) {
                        // Clear the card container
                        $('#card-container').empty();

                        // Render cards for the current page's data
                        for (var i = 0; i < data.length; i++) {
                            var card = data[i];
                            var cardHtml = `
                    <div class="main-card" data-product-id="${card.product_id}">
                        <div class="card">
                            <img src="${card.logo_url}" alt="${card.product_id}" />
                            <h4 class="text-center py-2">${card.brand} ${card.country_iso}</h4>
                            <div class="d-flex justify-content-center p-3">
                                <a href="{{ url('gift-card-detail') }}/${card.product_id}" class="btn btn-success view-card-detail" data-product-id="${card.product_id}">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    `;
                            $('#card-container').append(cardHtml);
                        }
                    }
                });
            }
        })
    </script>
@endsection
