<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">MVC Pos (Point of sale)</h6>
                            </div>
                        </div>
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="card">

                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title in-line">
                                                <span
                                                    style="display: inline-block; margin-right: 25px;color: black">Employee:
                                                    <b>{{ Auth::user()->name }}</b></span>
                                                <span style="color: black ; margin-right: 20px;"> Status: <b>
                                                        OPEN</b></span>
                                                <span style="color: black;margin-right: 10px;"> Date:
                                                    {{ date('d-F-Y') }}</span>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div class="input-group mb-4">

                                                <div class="card card-block card-stretch card-height blog pricing-details">

                                                    <div class="card-body text-center rounded">
                                                        <ul class="list-unstyled mb-0">
                                                            <div id="cart-content">
                                                                <table class="table" id="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Description</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price</th>
                                                                            <th>Subtotal</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $total = 0;
                                                                        @endphp
                                                                        @if (Session::has('message'))
                                                                            <div class="btn btn-danger">
                                                                                {{ session('message') }}
                                                                            </div>
                                                                        @endif
                                                                        @foreach ($get_cart as $get_cart)
                                                                            <tr>
                                                                                <th>{{ $get_cart->Name }}</th>
                                                                                <th>
                                                                                    <form
                                                                                        action="{{ route('Admin.Cart.update_cart_all', $get_cart->id) }}"
                                                                                        method="post"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('PATCH')
                                                                                        <input type="hidden" name="Qty[]"
                                                                                            value="{{ $get_cart->Qty }}">


                                                                                        <input type="number"
                                                                                            name="Quantity[]"
                                                                                            value="{{ $get_cart->Quantity }}"
                                                                                            style="width: 100px">

                                                                                        <input type="hidden" name="Name[]"
                                                                                            value="{{ $get_cart->Name }}">

                                                                                        <input type="hidden" name="Price[]"
                                                                                            value="{{ $get_cart->Price }}">

                                                                                        <input type="hidden"
                                                                                            name="product_id[]"
                                                                                            value="{{ $get_cart->product_id }}">

                                                                                </th>

                                                                                <th>{{ $get_cart->Price }}</th>

                                                                                <th>{{ $get_cart->Price * $get_cart->Quantity }}
                                                                                </th>
                                                                                <th>

                                                                                    <a class="badge bg-danger mr-2"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top" title=""
                                                                                        data-original-title="Delete"
                                                                                        href="{{ route('Admin.Cart.destory_cart', $get_cart->id) }}"><i
                                                                                            class="r4
                                                                                            4i-delete-bin-line mr-0">Remove</i></a>
                                                                                    {{-- </form> --}}
                                                                                </th>
                                                                            </tr>

                                                                            @php
                                                                                $total +=
                                                                                    $get_cart->Price *
                                                                                    $get_cart->Quantity;
                                                                            @endphp
                                                                        @endforeach

                                                                        <h6 id="granttotal">Grand Total : {{ number_format($total, 2) }}
                                                                        </h6>
                                                                        <br>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </ul>
                                                        @if ($total != '0.00')
                                                            <button class="btn btn-dark btn-lg btn-block">Update
                                                                cart</button>
                                                        @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card" id="reload_content">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class="header-title">
                                                        @if ($total != '0.00')
                                                            <h6 class="card-title">Full direct payment section only </h6>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('Admin.Pos.direct_print') }}"><button
                                                            class="btn btn-dark btn-lg btn-block">Print invoice</button></a>

                                                    <a href="#"><button class="btn btn-secondary btn-lg btn-block"
                                                            data-toggle="modal" data-target=".bd-example-modal-xl">Today
                                                            report</button></a>
                                                    <div class="modal fade bd-example-modal-xl" tabindex="-1"
                                                        role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Today's report</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-header d-flex justify-content-between">

                                                                        <div class="header-title">
                                                                            <h6 style="color: black" class="card-title">
                                                                                Cash:
                                                                                ₦:
                                                                                {{ number_format($cash + $cash_cash + $cash_cash_pos + $new_cash, 2, '.', ',') }}

                                                                            </h6>
                                                                        </div>

                                                                        <div class="header-title">
                                                                            <h6 style="color: black" class="card-title">
                                                                                Transfer:
                                                                                ₦:
                                                                                {{ number_format($tranfer + $cash_transfer + $new_transfer, 2, '.', ',') }}

                                                                                {{-- {{ }} --}}
                                                                            </h6>
                                                                        </div>


                                                                        <div class="header-title">
                                                                            <h6 style="color: black" class="card-title">
                                                                                Pos: ₦:

                                                                                {{ number_format($pos + $cash_pos + $new_pos, 2, '.', ',') }}


                                                                            </h6>
                                                                        </div>

                                                                        <div class="header-title">
                                                                            <h6 style="color: red" class="card-title">
                                                                                Grand Total:
                                                                                ₦:
                                                                                {{ number_format($cash + $tranfer + $pos + $cash_transfer + $cash_cash + $cash_pos + $cash_cash_pos + $new_transfer + $new_pos + $new_cash, 2, '.', ',') }}

                                                                            </h6>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table id="datatable"
                                                                            class="table data-table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Tracking no.</th>
                                                                                    <th>Total bill</th>
                                                                                    <th>Cash</th>
                                                                                    <th>Pos</th>
                                                                                    <th>Transfer</th>
                                                                                    <th>Due</th>
                                                                                    <th>Debt</th>
                                                                                    <th>Mode of payment</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($daily as $daily)
                                                                                    @if ($daily->new_due > 0)
                                                                                        <tr>
                                                                                            <td style="color: red">New due
                                                                                                payment</td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td>
                                                                                                <span
                                                                                                    class="badge badge-danger">{{ $daily->new_mode_of_payment }}</span>
                                                                                                {{ $daily->new_due }}
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td>
                                                                                                <button type="button"
                                                                                                    class="btn btn-primary"
                                                                                                    data-toggle="modal"
                                                                                                    data-target="#exampleModal{{ $daily->id }}">
                                                                                                    View
                                                                                                </button>
                                                                                                <div class="modal fade"
                                                                                                    id="exampleModal{{ $daily->id }}"
                                                                                                    tabindex="-1"
                                                                                                    role="dialog"
                                                                                                    aria-labelledby="exampleModalLabel"
                                                                                                    aria-hidden="true">
                                                                                                    <div class="modal-dialog"
                                                                                                        role="document">
                                                                                                        <div
                                                                                                            class="modal-content">
                                                                                                            <div
                                                                                                                class="modal-header">
                                                                                                                <h5 class="modal-title"
                                                                                                                    id="exampleModalLabel">
                                                                                                                    Details
                                                                                                                </h5>
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    class="close"
                                                                                                                    data-dismiss="modal"
                                                                                                                    aria-label="Close">
                                                                                                                    <span
                                                                                                                        aria-hidden="true">&times;</span>
                                                                                                                </button>
                                                                                                            </div>
                                                                                                            @foreach ($daily->orderIteams as $daily)
                                                                                                                <div
                                                                                                                    class="modal-body">
                                                                                                                    <h6>Item:{{ $daily->prod_id }}
                                                                                                                    </h6>
                                                                                                                    <h6>Item:{{ $daily->qty }}
                                                                                                                    </h6>
                                                                                                                </div>
                                                                                                            @endforeach
                                                                                                            <div
                                                                                                                class="modal-footer">
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    class="btn btn-secondary"
                                                                                                                    data-dismiss="modal">Close</button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @else
                                                                                        <tr>
                                                                                            <td>Mavenvet{{ $daily->trackking_id }}
                                                                                            </td>
                                                                                            <td>{{ number_format($daily->total_price), 2 }}
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($daily->pay != 0)
                                                                                                    {{ number_format($daily->pay), 2 }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($daily->cash_pos != 0)
                                                                                                    {{ number_format($daily->cash_pos), 2 }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($daily->cash_transfer != 0)
                                                                                                    {{ number_format($daily->cash_transfer), 2 }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($daily->due != 0)
                                                                                                    {{ number_format($daily->due), 2 }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($daily->new_due > 0)
                                                                                                    <span
                                                                                                        class="badge badge-danger">{{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                @php
                                                                                                    if (
                                                                                                        $daily->Mode_of_payment ==
                                                                                                        'Cash'
                                                                                                    ) {
                                                                                                        echo '<button type="button" class="btn btn-dark btn-sm mr-2">Cash</button>';
                                                                                                    } elseif (
                                                                                                        $daily->Mode_of_payment ==
                                                                                                        'Transfer'
                                                                                                    ) {
                                                                                                        echo ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                                                                                    } elseif (
                                                                                                        $daily->Mode_of_payment ==
                                                                                                        'Pos'
                                                                                                    ) {
                                                                                                        echo ' <button type="button" class="btn btn-success btn-sm mr-2">Pos</button>';
                                                                                                    } elseif (
                                                                                                        $daily->Mode_of_payment ==
                                                                                                        'cash_pos'
                                                                                                    ) {
                                                                                                        echo ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';
                                                                                                    } elseif (
                                                                                                        $daily->Mode_of_payment ==
                                                                                                        'cash_transfer'
                                                                                                    ) {
                                                                                                        echo ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                                                                                    }
                                                                                                @endphp
                                                                                            </td>
                                                                                            <td>
                                                                                                @php
                                                                                                    $popoverContent =
                                                                                                        '';
                                                                                                @endphp

                                                                                                @foreach ($daily->orderIteams as $dailyItem)
                                                                                                    @php
                                                                                                        // Concatenate item details to the popover content string
                                                                                                        $popoverContent .=
                                                                                                            '' .
                                                                                                            $dailyItem->prod_id .
                                                                                                            ', Qty: ' .
                                                                                                            $dailyItem->qty .
                                                                                                            ',';
                                                                                                        if (
                                                                                                            !$loop->last
                                                                                                        ) {
                                                                                                            $popoverContent .=
                                                                                                                ' ';
                                                                                                        }
                                                                                                    @endphp
                                                                                                @endforeach

                                                                                                <span
                                                                                                    class="d-inline-block"
                                                                                                    tabindex="0"
                                                                                                    data-toggle="tooltip"
                                                                                                    title="{!! $popoverContent !!}">
                                                                                                    <button
                                                                                                        class="btn btn-link btn-sm"
                                                                                                        style="pointer-events: none;"
                                                                                                        type="button"
                                                                                                        disabled><i
                                                                                                            class="ri-eye-line mr-0 ri-lg fw-bold"></i></button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-lg btn-block"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="header-title">
                                                        <div class="header-title">
                                                            <a href="{{ route('Admin.Pos.Pos_pending') }}">
                                                                View pending
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($total == '0.00')
                                                <div class="col-md-12">
                                                    <div class="warning">
                                                        <p><strong style="color: red">Warning:</strong> You are responsible for any actions taken using your account.
                                                            Keep your login details secure and do not share them with anyone.cause you will be charge for any wrong or mistake done wth your login details.Thank you</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($total != '0.00')
                                                    <form action="{{ route('Admin.Pos.directPayment') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <div class="row  col-md-12">
                                                            <center>
                                                                <p>This section doesn't accept double payments; you can only
                                                                    use
                                                                    a single payment method. For double payments, you can
                                                                    utilize the "Process double payment" button below.</p>
                                                            </center>
                                                            <div class="col-md-4 off col-md-4">
                                                                {{-- <br> --}}
                                                                <h6 class="card-title">Amount charged</h6>
                                                                <input type="text" disabled name=""
                                                                    value="{{ $total }}" class="form-control"
                                                                    id="">
                                                                {{-- <br> --}}
                                                            </div>
                                                            <div class="col-md-8 off col-md-1">
                                                                {{-- <br> --}}
                                                                <h6 class="card-title">Mode of payment </h6>
                                                                <select name="Mode_of_payment" id=""
                                                                    class="form-control" required>
                                                                    <option value="" selected>select</option>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Pos">Pos</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                </select>
                                                                <br>

                                                            </div>
                                                            {{-- <div class="col-md-4 off col-md-4">
                                                                <h6 for="checkbox">Amount collected</h6>
                                                                <input type="number" class="form-control" name=""
                                                                    id="">
                                                                <br>
                                                            </div> --}}
                                                            {{-- <br> --}}
                                                            <div class="col-md-12">
                                                                <center> <button
                                                                        class="btn btn-dark btn-lg btn-block">Process
                                                                        direct
                                                                        payment</button></center>
                                                            </div>
                                                            <input type="hidden" name="fname" class="form-control"
                                                                value="****" placeholder="Full Name"><br>
                                                            <input type="hidden" name="phone" value="****"
                                                                class="form-control" placeholder="Phone"><br>
                                                            <input type="hidden" name="address" value="****"
                                                                class="form-control" placeholder="Address">
                                                            <input type="hidden" name="discount" class="form-control"
                                                                placeholder="discount">
                                                            <input type="hidden" name="order_status"
                                                                class="form-control" value="success">
                                                            <input type="hidden" name="pay"
                                                                value="{{ $total }}" class="form-control">
                                                            <input type="hidden" name="due" class="form-control"
                                                                value="0">
                                                            <input type="hidden" name="Payment_type"
                                                                class="form-control" value="Full Payment">
                                                            <input type="hidden" name="date"
                                                                value="{{ date('Y-d-m') }}">
                                                            <input type="hidden" name="location" value="MVC midwifery">
                                                            <input type="hidden" name="month"
                                                                value="{{ date('F') }}">
                                                            <input type="hidden" name="year"
                                                                value=" {{ date('Y') }}">
                                                            <input type="hidden" name="user_id"
                                                                value=" {{ auth()->user()->id }}">
                                                            {{-- </div> --}}
                                                        </div>
                                                    </form>
                                                @endif


                                                <form action="{{ route('Admin.Pos.Pos_store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <input type="hidden" name="fname" class="form-control"
                                                            value="****" placeholder="Full Name"><br>
                                                        <input type="hidden" name="phone" value="****"
                                                            class="form-control" placeholder="Phone"><br>
                                                        <input type="hidden" name="address" value="****"
                                                            class="form-control" placeholder="Address">
                                                        <input type="hidden" name="discount" class="form-control"
                                                            placeholder="discount">
                                                        <input type="hidden" name="order_status" class="form-control"
                                                            value="pending">
                                                        <input type="hidden" name="Mode_of_payment" class="form-control"
                                                            value="0">
                                                        <input type="hidden" name="pay" class="form-control"
                                                            value="0">
                                                        <input type="hidden" name="due" class="form-control"
                                                            value="0">
                                                        <input type="hidden" name="Payment_type" class="form-control"
                                                            value="0">
                                                        <input type="hidden" name="date"
                                                            value="{{ date('Y-d-m') }}">
                                                        <input type="hidden" name="location" value="MVC midwifery">
                                                        <input type="hidden" name="month"
                                                            value="{{ date('F') }}">
                                                        <input type="hidden" name="year"
                                                            value=" {{ date('Y') }}">
                                                        <input type="hidden" name="user_id"
                                                            value=" {{ auth()->user()->id }}">
                                                    </div>
                                            </div>
                                            @foreach ($get_post as $get_post)
                                                <input type="hidden" name="Quantity[]"
                                                    value="{{ $get_post->Quantity }}">
                                                <input type="hidden" name="Price[]" value="{{ $get_post->Price }}">
                                                <input type="hidden" name="Cost[]" value="{{ $get_post->Cost }}">
                                                <input type="hidden" name="subtotal[]"
                                                    value="{{ $get_post->Price * $get_post->Quantity }}">
                                            @endforeach
                                            @if ($total != '0.00')
                                                <div class="col-md-12 off col-md-1">
                                                    <center> <button type="submit"
                                                            class="btn btn-success btn-lg btn-block">Process double
                                                            payment section</button>
                                                    </center>
                                                </div>
                                            @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h6 class="card-title">Barcode: </h6>
                                            </div>
                                            <form id="barcodeForm" action="{{ route('Admin.Cart.barcode_scanner') }}"
                                                method="POST">
                                                @csrf
                                                <input type="text" disabled placeholder="barcode coming 2weeks ...." name="barcode_scanner"
                                                    class="form-control" id="barcode_scanner">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="Name" value="">
                                                <input type="hidden" name="Quantity" value="">
                                                <input type="hidden" name="Price" value="">
                                                <input type="hidden" name="product_id" value="">
                                                <input type="hidden" name="date" value="">
                                                <input type="hidden" name="month" value="">
                                                <input type="hidden" name="year" value="">
                                                <input type="hidden" name="Qty" value="">
                                                <input type="hidden" name="Cost" value="">
                                            </form>
                                        </div>


                                        <div class="input-group mb-6">
                                            <div class="col-lg-12">
                                                <br>
                                                <div class="table-responsive rounded mb-3">
                                                    <table class="data-table table mb-0 tbl-server-info">
                                                        <thead class="bg-white text-uppercase">
                                                            <tr class="ligth ligth-data">
                                                                {{-- <th>Image</th> --}}
                                                                <th>Description</th>
                                                                <th>Category</th>
                                                                <th>Quantity</th>
                                                                <th>Status</th>
                                                                <th>Price</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ligth-body">

                                                            @foreach ($product as $product)
                                                                <tr>
                                                                    <form action="{{ route('Admin.Cart.add_cart') }}"
                                                                        method="post" enctype="multipart/form-data" id="barcodeForm2">
                                                                        @csrf
                                                                        <input type="hidden" name="user_id"
                                                                            value="{{ auth()->user()->id }}">
                                                                        <input type="hidden"
                                                                            value="{{ $product->Name }}" name="Name">
                                                                        <input type="hidden" value="1"
                                                                            name="Quantity">
                                                                        <input type="hidden"
                                                                            value="{{ $product->Price }}" name="Price">
                                                                        <input type="hidden" name="product_id"
                                                                            value="{{ $product->id }}">
                                                                        <input type="hidden" value="{{ date('d/m/y') }}"
                                                                            name="date">
                                                                        <input type="hidden" name="month"
                                                                            value="{{ date('F') }}">
                                                                        <input type="hidden" value="{{ date('Y') }}"
                                                                            name="year">
                                                                        <input type="hidden" name="Qty"
                                                                            value="{{ $product->Quantity }}">
                                                                        <input type="hidden" name="Cost"
                                                                            value="{{ $product->Cost }}">
                                                                        <td>
                                                                            <center>{{ $product->Name }}</center>
                                                                        </td>
                                                                        <td>{{ $product->Category }}</td>
                                                                        <td>{{ $product->Quantity }}</td>
                                                                        <td>

                                                                            @php
                                                                                if (
                                                                                    $product->Quantity <=
                                                                                    $product->Quantity_level
                                                                                ) {
                                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">out of stock</button>';
                                                                                } elseif (
                                                                                    $product->Quantity >
                                                                                    $product->Quantity_level
                                                                                ) {
                                                                                    echo ' <button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                                                }

                                                                            @endphp
                                                                        </td>

                                                                        <td>{{ $product->Price }}</td>
                                                                        <td>
                                                                            @if ($product->Quantity <= 0)
                                                                                <button disabled><i
                                                                                        class="ri-mark-fill"></i></button>
                                                                            @else
                                                                                <button type="submit"
                                                                                    class="btn btn-link"><i
                                                                                      class="ri-check-line ri-lg fw-bold"></i></button>
                                                                            @endif
                                                                        </td>
                                                                </tr>
                                                                </form>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#barcode_scanner').on('change', function() {
                        $('#barcodeForm').submit(); // Submit the form when the barcode scanner changes
                    });

                    $("#barcodeForm").submit(function(e) {
                        e.preventDefault(); // Prevent default form submission
                        const formData = new FormData(this);

                        // Send AJAX request to handle the form submission
                        $.ajax({
                            url: '{{ route('Admin.Cart.barcode_scanner') }}',
                            method: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    $('#barcodeForm')[0].reset();
                                    $("#granttotal").load(location.href + ' #granttotal');
                                    $("#reload_content").load(location.href + ' #reload_content');
                                    $("#table").load(location.href + ' #table');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    });

                });
            </script>
        @endsection
</x-admin-master>
