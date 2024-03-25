<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-height print rounded">
                        <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Invoice#{{ $Pos_invoice->trackking_id }}</h4>

                            </div>
                            <div class="invoice-btn">
                                <a href="{{ route('Admin.Pos.Pos_pending') }}"><button type="button"
                                        class="btn btn-dark btn-lg mr-2"><i class="las la-print"></i> Back
                                    </button></a>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                </div>
                            </center>
                        @endif
                        @if (Session::has('payment'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('payment') }}</div>
                                </div>
                            </center>
                        @endif


                        @if (Session::has('Discount'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('Discount') }} Is
                                        {{ $Pos_invoice->discount }} !!!!</div>
                                </div>
                            </center>
                        @endif


                        @if (Session::has('success'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('success') }} </div>
                                </div>
                            </center>
                        @endif

                        @if (Session::has('error'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('error') }}

                                        <li class="">
                                            <a href="{{ route('Admin.Pos.daily_sales_report') }}">
                                                <i class="las la-minus"></i><span>Click here now</span>
                                            </a>
                                        </li>

                                    </div>
                                </div>
                            </center>
                        @endif




                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset('../assets/images/logo.png') }}" class="logo-invoice img-fluid mb-3">

                                    <h5 class="mb-0">Hello,{{ $Pos_invoice->fname }}</h5>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="offset-lg-8 col-lg-4">
                                    <div class="or-detail rounded">
                                        <div class="p-6">
                                            <h5 class="mb-3">Order details</h5>
                                            <hr>
                                            <div class="mb-2">
                                                <h6>Due Date</h6>
                                                <p>{{ $Pos_invoice->date }}</p>
                                            </div>
                                            <div class="mb-2" class="form-control">
                                                @if ($Pos_invoice->pay > 0 || $Pos_invoice->cash_transfer > 0 || $Pos_invoice->cash_pos > 0)
                                                @else
                                                    <h6>Discount</h6>
                                                    <form
                                                        action="{{ route('Admin.Pos.Pos_invoice_discount', $Pos_invoice->id) }}">
                                                        @csrf
                                                        @if ($Pos_invoice->discount > 1)
                                                            <button disabled>
                                                                <h6>{{ number_format($Pos_invoice->discount, 2) }}</h6>
                                                            </button>
                                                        @else
                                                            ₦: <input type="number" name="discount" id=""
                                                                style="width: 80px;">
                                                            <button type="submit" class="btn btn-link"><i
                                                                    class="ri-check-line ri-lg fw-bold"></i></button>
                                                        @endif
                                                @endif
                                                </form>
                                            </div>

                                            @if ($Pos_invoice->pay > 0)
                                                <h6>Grant total </h6>
                                                <h6>₦{{ number_format($Pos_invoice->total_price, 2) }} </h6>
                                            @elseif($Pos_invoice->cash_pos > 0)
                                                <h6>Grant total </h6>
                                                <h6>₦{{ number_format($Pos_invoice->total_price, 2) }} </h6>
                                            @elseif ($Pos_invoice->cash_transfer > 0)
                                                <h6>Grant total </h6>
                                                <h6>₦{{ number_format($Pos_invoice->total_price, 2) }} </h6>
                                            @else
                                                <h6>Grant total </h6>
                                                <h6>₦{{ number_format($Pos_invoice->total_price - $Pos_invoice->discount, 2) }}
                                                </h6>
                                            @endif
                                            <br>
                                            @if ($Pos_invoice->pay > 0 || $Pos_invoice->cash_transfer > 0 || $Pos_invoice->cash_pos > 0)
                                                <h6>Transaction completed</h6>
                                            @else
                                                <h6>Mode of Payment</h6>
                                                <a  href="{{ route('Admin.Pos.order_cash', $Pos_invoice->id) }}"
                                                    class="btn btn-success">Cash</a>
                                                <a
                                                    href="{{ route('Admin.Pos.order_pos', $Pos_invoice->id) }}"class="btn btn-info">Pos</a>
                                                    <a  href="{{ route('Admin.Pos.order_transfer', $Pos_invoice->id) }}"
                                                        class="btn btn-primary">Transfer</a>
                                                            <a href="{{ route('Admin.Pos.cash_pos', $Pos_invoice->id) }}"
                                                                class="btn btn-danger">Cash & Pos</a>
                                                        <a href="{{ route('Admin.Pos.cash_transfer', $Pos_invoice->id) }}"
                                                            class="btn btn-warning " style="margin-right: 26px;">Cash & Transfer</a>

                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <form action="{{ route('Admin.Pos.Pos_update', $Pos_invoice->id) }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if (
                                            $Pos_invoice->Mode_of_payment == 'Transfer' ||
                                                $Pos_invoice->Mode_of_payment == 'cash_transfer' ||
                                                $Pos_invoice->Mode_of_payment == 'Pos' ||
                                                $Pos_invoice->Mode_of_payment == 'cash_pos')
                                            <div>
                                                <label for="">Select Bank</label>
                                                <div class="col-md-6">
                                                    <select name="bankName" id="" class="form-control">
                                                        <option value="" selected>~~ Select ~~</option>
                                                        @foreach ($banklist as $banklist)
                                                            <option
                                                                value="{{ $banklist->name }}  {{ $banklist->accountNumber }}">
                                                                {{ $banklist->name }} {{ $banklist->accountNumber }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <input type="hidden" name="date" value="{{ gmdate(' jS \ F Y ') }}">
                                        <input type="hidden" name="total_price"
                                            value="{{ $Pos_invoice->total_price - $Pos_invoice->discount }}">


                                        @php
                                            $payment = $payment = DB::table('orders')->first();
                                        @endphp
                                        <input type="hidden" class="form-control" name="Payment_type" value="Half Payment">

                                        <input type="hidden" class="form-control" value="0" name="due" readonly
                                            placeholder="Due">

                                        <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">

                                            @if ($Pos_invoice->Mode_of_payment == 'Cash')
                                                <label for="" style="padding: 1%">Cash </label>
                                                @if ($Pos_invoice->pay > 1)
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $Pos_invoice->pay }}" name="pay" style="width: 120px"
                                                        placeholder="Pay">

                                                    <input type="hidden" class="form-control" value="0"
                                                        name="cash_pos">

                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                @else
                                                    <input type="number" class="form-control" value="0"
                                                        name="pay" style="width: 120px" placeholder="Pay">
                                                    <input type="hidden" class="form-control" value="0"
                                                        name="cash_pos">
                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                @endif
                                                <div class="col-md-4">
                                                    @if ($Pos_invoice->pay > 1)
                                                        <button type="submit" disabled
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Paid</button>
                                                    @else($Pos_invoice->pay > 1 )
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Pay</button>
                                                    @endif
                                                </div>
                                            @elseif ($Pos_invoice->Mode_of_payment == 'Pos')
                                                <label for="">Pos:</label>

                                                @if ($Pos_invoice->cash_pos > 1)
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $Pos_invoice->cash_pos }}" style="width: 120px"
                                                        name="cash_pos">

                                                    <input type="hidden" class="form-control" value="0"
                                                        name="pay" style="width: 120px" placeholder="Pay">

                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                @else
                                                    <input type="number" class="form-control" value="0"
                                                        style="width: 120px" name="cash_pos">

                                                    <input type="hidden" class="form-control" value="0"
                                                        name="pay" style="width: 120px" placeholder="Pay">

                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                @endif
                                                <div class="col-md-4">
                                                    @if ($Pos_invoice->cash_pos > 1)
                                                        <button type="submit" disabled
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Paid</button>
                                                    @else($Pos_invoice->cash_pos > 1 )
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Pay</button>
                                                    @endif
                                                </div>
                                            @elseif ($Pos_invoice->Mode_of_payment == 'Transfer')
                                                <label for="" style="padding: 1%">Transfer:</label>

                                                @if ($Pos_invoice->cash_transfer > 1)
                                                    <input type="text" disabled placeholder="Transfer"
                                                        class="form-control" style="width: 120px"
                                                        value="{{ $Pos_invoice->cash_transfer }}" name="cash_transfer">
                                                    <input type="hidden" class="form-control" value="0"
                                                        style="width: 120px" name="cash_pos">
                                                    <input type="hidden" class="form-control" value="0"
                                                        name="pay" style="width: 120px" placeholder="Pay">
                                                @else
                                                    <input type="number" placeholder="Transfer" class="form-control"
                                                        style="width: 120px" value="0" name="cash_transfer">
                                                    <input type="hidden" class="form-control" value="0"
                                                        style="width: 120px" name="cash_pos">
                                                    <input type="hidden" class="form-control" value="0"
                                                        name="pay" style="width: 120px" placeholder="Pay">
                                                @endif
                                                <div class="col-md-4">
                                                    @if ($Pos_invoice->cash_transfer > 1)
                                                        <button type="submit" disabled
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Paid</button>
                                                    @else($Pos_invoice->cash_transfer > 1 )
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Pay</button>
                                                    @endif
                                                </div>
                                            @elseif ($Pos_invoice->Mode_of_payment == 'cash_pos')
                                                <label for="" style="padding: 1%">Pos</label>
                                                @if ($Pos_invoice->cash_pos > 1)
                                                    <input type="text" disabled class="form-control"
                                                        style="width: 120px" value="{{ $Pos_invoice->cash_pos }}"
                                                        name="cash_pos">
                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                    <label for=""style="padding: 1%">Cash</label>
                                                    <input type="text" disabled placeholder="Transfer"
                                                        class="form-control" style="width: 120px"
                                                        value="{{ $Pos_invoice->pay }}" name="pay">
                                                @else
                                                    <input type="number" class="form-control" style="width: 120px"
                                                        value="0" name="cash_pos">
                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_transfer">
                                                    <label for=""style="padding: 1%">Cash</label>
                                                    <input type="number" placeholder="Transfer" class="form-control"
                                                        style="width: 120px" value="0" name="pay">
                                                @endif
                                                <div class="col-md-4">
                                                    @if ($Pos_invoice->cash_pos > 1)
                                                        <button type="submit" disabled
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Paid</button>
                                                    @else($Pos_invoice->cash_pos > 1 )
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Pay</button>
                                                    @endif
                                                </div>
                                            @elseif ($Pos_invoice->Mode_of_payment == 'cash_transfer')
                                                <label for="" style="padding: 1%">Transfer</label>
                                                @if ($Pos_invoice->cash_transfer > 1)
                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_pos">
                                                    <input type="text" disabled placeholder="Transfer"
                                                        class="form-control" style="width: 120px"
                                                        value="{{ $Pos_invoice->cash_transfer }}" name="cash_transfer">
                                                    <label for="" style="padding: 1%">Cash</label>
                                                    <input type="text" disabled placeholder="Transfer"
                                                        class="form-control" style="width: 120px"
                                                        value="{{ $Pos_invoice->pay }}" name="pay">
                                                @else
                                                    <input type="hidden" class="form-control" style="width: 120px"
                                                        value="0" name="cash_pos">
                                                    <input type="number" placeholder="Transfer" class="form-control"
                                                        style="width: 120px" value="0" name="cash_transfer">
                                                    <label for="" style="padding: 1%">Cash</label>
                                                    <input type="text" placeholder="Transfer" class="form-control"
                                                        style="width: 120px" value="0" name="pay">
                                                @endif
                                                <div class="col-md-4">
                                                    @if ($Pos_invoice->cash_transfer > 1)
                                                        <button type="submit" disabled
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Paid</button>
                                                    @else($Pos_invoice->cash_transfer > 1 )
                                                        <button type="submit"
                                                            class="btn btn-primary btn-lg btn-block btn-lg">Pay</button>
                                                    @endif
                                                </div>
                                            @endif
                                    </form>
                                    <br><br>
                                    <script src="script.js"></script>
                                    @if ( $Pos_invoice->cash_transfer != 0 || $Pos_invoice->pay != 0 || $Pos_invoice->cash_pos != 0 || $Pos_invoice->cash_pos != 0)
                                        <div class="col-md-4">
                                            <a href="{{ route('Admin.Pos.order_status', $Pos_invoice->id) }}"
                                                class="btn btn-success btn-lg btn-block">Done</a>
                                        </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <a href="{{ route('Admin.Pos.print_invoice', $Pos_invoice->id) }}" id="btnPrint"
                                        class="btn btn-dark btn-lg btn-block">Print Invoice</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endsection
</x-admin-master>
