{{-- <x-admin-master>
    @section('content')

    @endsection
</x-admin-master> --}}
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        {{-- <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /> --}}
        {{-- <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /> --}}

        <style>
      @media print {
          .page-break { display: block; page-break-before: always; }
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
         color:black;
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
        color:black;
        line-height: 1.2em;
      }
      #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
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

      <body translate="no" >
        <div id="invoice-POS">
         <center> <h4>Maven Veterinary Consult And Pet Shop</h4></center>

          <div id="">
            <div class="">
              {{-- <h2>Contact Info</h2> --}}
              <p>
                <p class="mb-0">Tricia Plaza Anwii Road/Government House Road Beside First Bank at Interbau Flyover Asaba, Delta State<br>
                    Phone: 08118111362, 07036909584 .<br>

                 </p>
              </p>
            </div>
          </div><!--End Invoice Mid-->

          <div id="bot">

                          <div id="table">
                              <table>
                                  <tr class="tabletitle">
                                      <td class="item"><h2>Item</h2></td>
                                      <td class="Hours"><h2>Qty</h2></td>
                                      <td class="Rate"><h2>Price</h2></td>
                                       <td class="Rate"><h2>Subtotal</h2></td>
                                  </tr>
                                  @foreach ($Pos_invoice->orderIteams  as $Pos_invoice)

                                  <tr class="service">
                                      <td class="tableitem"><p class="itemtext">{{$Pos_invoice->prod_id}}</p></td>
                                      <td class="tableitem"><p class="itemtext">{{$Pos_invoice->qty}}</p></td>
                                      <td class="tableitem"><p class="itemtext">{{$Pos_invoice->price}}</p></td>
                                       <td class="tableitem"><p class="itemtext">{{$Pos_invoice->price * $Pos_invoice->qty}}</p></td>
                                  </tr>
                                  @endforeach
                              <center>
                                  <tr class="">

                                    <td class="Rate"><h2>Balance</h2></td>
                                    <td class="payment"><h2>{{number_format($print->due,2, '.', ',')}}</h2></td>
                                </tr>
                                  <tr class="">

                                    <td class="Rate"><h2>Total</h2></td>
                                    <td class="payment"><h2>{{number_format($pay+$cash_transfer+$cash_pos,2, '.', ',')}}</h2></td>
                                </tr>
</center>

                              </table>
                          </div><!--End Table-->

                          <div id="legalcopy">
                              <p class="legal"><strong>Thanks for your patronage.!!!</strong>
                              </p>

                                <p>{{date('d F Y')}}</p>
                          </div>

                          <button id="btnPrint" class="hidden-print">Print</button>
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
