<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            box-shadow: 0 0 in -0.25in rgba(0, 0, 0, 0.5);
            padding: 1mm;
            margin: 0 auto;
            width: 60mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: black;
        }

        #invoice-POS h2 {
            font-size: .9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: 0.7em;
            color: black;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .8em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 30mm;
        }

        #invoice-POS .itemtext {
            font-size: .7em;
        }

        #invoice-POS #legalcopy {
            margin-top: 1mm;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">
    <div id="invoice-POS">
        <center id="top">
            <div class="">
                <img width="120px" height="130px" src="{{ asset('image/WILLIAMS LOGO (1).png') }}" alt="">
            </div>
            <!--End Info-->
        </center><!--End InvoiceTop-->
        <div id="">
            <div class="">
                <p>
                <p class="mb-0">Tricia Plaza Anwii Road/Government House Road Beside First Bank at Interbau Flyover
                    Asaba, Delta State<br>
                    Phone: 08118111362, 07036909584 .<br>

                </p>
                </p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Item</h2>
                        </td>
                        <td class="Hours">
                            <h2>Qty</h2>
                        </td>
                        <td class="Rate">
                            <h2>Price</h2>
                        </td>
                        <td class="Rate">
                            <h2>Subtotal</h2>
                        </td>
                    </tr>
                    @foreach ($Pos_invoice as $Pos_invoice)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $Pos_invoice->prod_id }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $Pos_invoice->qty }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $Pos_invoice->price }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $Pos_invoice->price * $Pos_invoice->qty }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <center>
                        <tr class="">
                        </tr>
                        <tr class="">

                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>{{ number_format($finalPrice, 2, '.', ',') }}</h2>
                            </td>
                        </tr>
                    </center>

                </table>
            </div><!--End Table-->

            <div id="legalcopy">
                <center>
                    <p class="legal"><strong>Thanks for your coming.</strong> </p>

                    <h6>{{ date('d F Y') }}</h6>
                </center>
            </div>
            <button id="btnPrint" class="hidden-print">Print</button>
            <a href="{{ route('Admin.Pos.Pos') }}"><button class="btn btn-primary btn-lg hidden-print"
                    style="margin-left: 50%">Back</button></a>
            <script src="script.js"></script>
        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
</body>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>

</html>
