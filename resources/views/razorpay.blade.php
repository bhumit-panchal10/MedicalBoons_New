@extends('layouts.front')
@section('title', 'Payment')
@section('content')



    <style>
        .ship-head {
            padding: 6px;
            background: #9a7c6f;
            color: white;
            font-size: 16px;
            text-transform: uppercase;

        }

        .ship-inp {
            border: none;
            margin-bottom: 0px;
            width: 100%;
            color: #9a7c6f;
        }

        input {
            color: #9a7c6f !important;
            border: none !important;
        }

        .b-none {
            border: none !important;
        }

        .btn:hover {
            color: #9a7c6f !important;
        }

        table {
            border: 1px solid #9a7c6f;
        }

        td {
            padding: 0px 10px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }


        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #318c07;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('front/css/bootstrap-4.5.0.min.css') }}" rel="stylesheet">


    <div class="overlay" id="overlay">
        <div class="loader"></div>
    </div>

    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url({{ asset('assets/frontimages/catagory/SHOP.jpg') }});">
        <h2 class="ltext-105 cl0 txt-center">
            <!--Payment-->
        </h2>
    </section>
    <section class="order-summery1 bg-lp p-8">
        <div class="container" style="display:none;">




            <div class="col-lg-12 p-2">
                <h6 class="title showorder">Order Summary &nbsp; &nbsp; <i class="ti-angle-down"></i>&nbsp;<span
                        class="pull-right"> ₹ {{ $Order['NetAmount'] }}</span> </h6>
            </div>

        </div>
    </section>
    <div class="row">


        <!--<div class="col-md-4"></div>-->
        <div class="col-md-12" style="margin-top: 15px;">
            <form id="myForm">
                <table width="40%" class="  text-center border-0 m-2" border="0" height="120" align="center">

                    <input type="hidden" id="data-key" value="{{ env('RAZORPAY_KEY') }}">
                    <input type="hidden" id="data-amount" value="{{ $Order['NetAmount'] }}">
                    <input type="hidden" id="data-mobile" value="{{ $Order['mobile'] }}">
                    <input type="hidden" id="data-email" value="{{ $Order['email'] }}">

                    <input type="hidden" id="data-profile-id" value="{{ $Order['Corporate_Order_id'] }}">
                    <input type="hidden" id="data-description" value="Rozerpay">
                    <input type="hidden" id="data-order-id" value="{{ $orderId }}">


                    {{-- <tr>
                        <td class="ship-head " colspan="2">Customer information </td>
                    </tr>

                    <tr class="mt-2 ">
                        <!--<td style="width: 30%;"> Name </td>-->
                        <td style="padding-top:20px"> {{ $Order['Name'] }} </td>
                    </tr>
                    <tr>
                        <!--<td> Address </td>-->
                        <td>
                            <?php
                            $address1 = trim($Order['address']);
                            $state = trim($Order['state']);
                            
                            ?>
                            <div class="ship-inp" name="full_address" id="full_address" cols="30" rows="7">
                                {{ $address1 . ',' . $Order['city'] . ' ' . $state }}
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <!--<td>Pincode </td>-->
                        <td>Pincode : {{ $Order['pincode'] }} &nbsp; Mobile : {{ $Order['mobile'] }}
                        </td>
                    </tr>

                    <tr class="mb-2" style="padding-top:10px">
                        <!--<td> Email </td>-->
                        <td> {{ $Order['email'] }} </td>
                    </tr> --}}




                </table>

            </form>
        </div>

    </div>
    <!-- col // -->
    </div>
    <!-- row.// -->
    <!--</div>-->
    <!--container.//-->
    <!--<br><br><br>-->
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // Get reference to the overlay
        const overlay = document.getElementById('overlay');

        // Function to show the loader
        function showLoader() {
            overlay.style.display = 'flex'; // Display overlay
        }

        // Function to hide the loader
        function hideLoader() {
            overlay.style.display = 'none'; // Hide overlay
        }

        // Show loader when page loads
        showLoader();

        // Hide loader when page content is fully loaded
        window.addEventListener('load', function() {
            hideLoader();
        });
    </script>

    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //showLoader();
            // $('body').on('click', '.pay_now', function(e) {
            var totalAmount = $("#data-amount").val();
            totalAmount = totalAmount * 100;
            var order_id = $("#data-order-id").val();
            var orderid = $("#data-profile-id").val();
            var mobile = $("#data-mobile").val();
            var email = $("#data-email").val();
            var url = "{{ route('razprpay.success') }}";
            var options = {
                "key": "{{ config('services.razorpay.key') }}",
                "amount": totalAmount, // 2000 paise = INR 20 order generate ?yes
                "currency": "INR",
                "mobile": mobile,
                "email": email,
                "order_id": order_id,
                "handler": function(response) {
                    showLoader();
                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_signature: response.razorpay_signature,
                            razorpay_order_id: response.razorpay_order_id,
                            orderId: order_id,
                            orderid: orderid
                        },
                        success: function(msg) {
                            if (msg >= 1) {

                                //showLoader();
                                // window.location.href = "{{ route('razorpay.thankyou') }}";
                                setTimeout(function() {
                                    var url =
                                        "{{ route('razorpay.thankyou', ':msg') }}";
                                    url = url.replace(":msg", msg);
                                    window.location.href = url;
                                }, 1000);
                            } else {

                                window.location.href =
                                    "{{ route('razorpay.RazorFail', ':orderid') }}".replace(
                                        ':orderid', orderid);

                                // hideLoader();
                            }

                        },
                        error: function(jqXHR, exception) {
                            hideLoader();
                            var msg = '';
                            if (jqXHR.status === 0) {
                                msg = 'Not connect.\n Verify Network.';
                            } else if (jqXHR.status == 404) {
                                msg = 'Requested page not found. [404]';
                            } else if (jqXHR.status == 500) {
                                msg = 'Internal Server Error [500].';
                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            }
                            //hideLoader();


                        },
                    });
                },
                "prefill": {
                    "contact": mobile,
                    "email": email,
                },
                "theme": {
                    "color": "#528FF0"
                },
                "modal": {
                    "ondismiss": function() {
                        window.location.href =
                            "{{ route('razorpay.RazorFail', ':orderid') }}".replace(
                                ':orderid', orderid);
                    }
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            // e.preventDefault();
        });
        /*document.getElementsClass('buy_plan1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
        }*/
    </script>

    <script>
        $(".showorder").click(function() {
            $(".order-table").toggle();
        });
    </script>
@endsection
