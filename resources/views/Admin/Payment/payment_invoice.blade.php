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
                                <a href="{{ route('Admin.Payment.paynent_pending') }}"><button type="button"
                                        class="btn btn-dark btn-lg  mr-2"><i class="las la-print"></i> Back
                                    </button></a>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">


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
                                                    <a href="{{ route('Admin.Payment.Payment_list') }}">
                                                        <i class="las la-minus"></i><span>Click here now</span>
                                                    </a>
                                                </li>

                                            </div>
                                        </div>
                                    </center>
                                @endif
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

                                        @php
                                            $price = ($Pos_invoice->discount / 100) * $Pos_invoice->total_price;
                                        @endphp
                                        <div class="mb-2" class="form-control">
                                            <h6>Sub Total</h6>
                                            <p>₦{{ $Pos_invoice->total_price }}</p>
                                        </div>

                                        @if ($Pos_invoice->pay > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Pos_invoice->total_price }} </h6><br>
                                        @elseif($Pos_invoice->cash_pos > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Pos_invoice->total_price }} </h6><br>
                                        @elseif ($Pos_invoice->cash_transfer > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Pos_invoice->total_price }} </h6><br>
                                        @else
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Pos_invoice->total_price - $Pos_invoice->discount }} </h6><br>
                                        @endif
                                        @if ($Pos_invoice->pay > 0 || $Pos_invoice->cash_transfer > 0 || $Pos_invoice->cash_pos > 0)
                                            <h6>Transaction completed</h6>
                                        @else
                                            <h6>Mode of Payment</h6>
                                            <a href="{{ route('Admin.Payment.order_cash', $Pos_invoice->id) }}"
                                                class="btn btn-success">Cash</a>
                                            <a href="{{ route('Admin.Payment.order_pos', $Pos_invoice->id) }}"
                                                class="btn btn-info">Pos</a>
                                            <a href="{{ route('Admin.Payment.order_transfer', $Pos_invoice->id) }}"
                                                class="btn btn-primary">Transfer</a>
                                            <a href="{{ route('Admin.Payment.cash_pos', $Pos_invoice->id) }}"
                                                class="btn btn-danger" style="padding: 1%">Cash & Pos</a>
                                            <a href="{{ route('Admin.Payment.cash_transfer', $Pos_invoice->id) }}"
                                                class="btn btn-warning" style="margin-right: 23px;">Cash & Transfer</a>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <form action="{{ route('Admin.Payment.order_update', $Pos_invoice->id) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="date" value="{{ gmdate(' jS \ F Y ') }}">
                                    <input type="hidden" name="total_price"
                                        value="{{ $Pos_invoice->total_price - $price }}">
                                    @php
                                        $payment = $payment = DB::table('service_orders')->first();
                                    @endphp



                                    <input type="hidden" class="form-control" name="Payment_type" value="Half Payment">

                                    <input type="hidden" class="form-control" value="0" name="due" readonly
                                        placeholder="Due">

                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                        @if ($Pos_invoice->Mode_of_payment == 'Cash')
                                            <label for="">Cash:</label>

                                            @if ($Pos_invoice->pay > 1)
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $Pos_invoice->pay }}" name="pay" style="width: 120px"
                                                    placeholder="Pay">

                                                <input type="hidden" class="form-control" value="0" name="cash_pos">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @else
                                                <input type="text" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">

                                                <input type="hidden" class="form-control" value="0" name="cash_pos">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @endif
                                            <div class="col-md-4">
                                                @if ($Pos_invoice->pay > 1)
                                                    <button type="submit" disabled
                                                        class="btn btn-primary btn-block btn-lg">Paid</button>
                                                @else($Pos_invoice->pay > 1 )
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block btn-lg">Pay</button>
                                                @endif
                                            </div>
                                        @elseif ($Pos_invoice->Mode_of_payment == 'Pos')
                                            <label for="">Select Bank</label>
                                            <select name="bankName" id="" class="form-control">
                                                <option value="" selected>~~ Select ~~</option>
                                                @foreach ($banklist as $banklist)
                                                    <option
                                                        value="{{ $banklist->name }}  {{ $banklist->accountNumber }}">
                                                        {{ $banklist->name }} {{ $banklist->accountNumber }}</option>
                                                @endforeach
                                            </select>
                                            <label for="" style="padding: 1%">Pos:</label>
                                            @if ($Pos_invoice->cash_pos > 1)
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $Pos_invoice->cash_pos }}" style="width: 120px"
                                                    name="cash_pos">

                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @else
                                                <input type="text" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">

                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @endif
                                            @if ($Pos_invoice->cash_pos > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Pos_invoice->cash_pos > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Pos_invoice->Mode_of_payment == 'Transfer')
                                            <label for="">Select Bank</label>
                                            <select name="bankName" id="" class="form-control">
                                                <option value="" selected>~~ Select ~~</option>
                                                @foreach ($banklist as $banklist)
                                                    <option
                                                        value="{{ $banklist->name }}  {{ $banklist->accountNumber }}">
                                                        {{ $banklist->name }} {{ $banklist->accountNumber }}</option>
                                                @endforeach

                                            </select>
                                            <label for="" style="padding: 1%">Transfer:</label>
                                            @if ($Pos_invoice->cash_transfer > 1)
                                                <input type="text" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Pos_invoice->cash_transfer }}" name="cash_transfer">
                                                <input type="hidden" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">
                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                            @else
                                                <input type="text" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="cash_transfer">
                                                <input type="hidden" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">
                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                            @endif
                                            @if ($Pos_invoice->cash_transfer > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Pos_invoice->cash_transfer > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Pos_invoice->Mode_of_payment == 'cash_pos')
                                            @if ($Pos_invoice->cash_pos > 1)
                                                <label for="" style="padding: 1%">Pos:</label>
                                                <input type="text" disabled class="form-control" style="width: 120px"
                                                    value="{{ $Pos_invoice->cash_pos }}" name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                                <label for="" style="padding: 1%">Cash</label>
                                                <input type="text" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Pos_invoice->pay }}" name="pay">
                                            @else
                                                <label for="" style="padding: 1%">Pos</label>
                                                <input type="text" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                                <label for="" style="padding: 1%">Cash</label>
                                                <input type="text" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="pay">
                                            @endif
                                            <div class="col-md-4">
                                                @if ($Pos_invoice->cash_pos > 1)
                                                    <button type="submit" disabled
                                                        class="btn btn-primary btn-block btn-lg">Paid</button>
                                                @else($Pos_invoice->cash_pos > 1 )
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block btn-lg">Pay</button>
                                                @endif
                                            </div>
                                        @elseif ($Pos_invoice->Mode_of_payment == 'cash_transfer')
                                            @if ($Pos_invoice->cash_transfer > 1)
                                                <label for="" style="padding: 1%">Transfer</label>
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="text" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Pos_invoice->cash_transfer }}" name="cash_transfer">
                                                <label for="">Cash:</label>
                                                <input type="text" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Pos_invoice->pay }}" name="pay">
                                            @else
                                                <label for=""style="padding: 1%">Transfer</label>
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="text" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="cash_transfer">
                                                <label for="" style="padding: 1%">Cash</label>
                                                <input type="text" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="pay">
                                            @endif
                                            <div class="col-md-4">
                                                @if ($Pos_invoice->cash_transfer > 1)
                                                    <button type="submit" disabled
                                                        class="btn btn-primary btn-block btn-lg">Paid</button>
                                                @else($Pos_invoice->cash_transfer > 1 )
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block btn-lg">Pay</button>
                                                @endif
                                            </div>
                                        @endif
                                </form>


                                @if (
                                    $Pos_invoice->cash_transfer != 0 ||
                                        $Pos_invoice->pay != 0 ||
                                        $Pos_invoice->cash_pos != 0 ||
                                        $Pos_invoice->cash_pos != 0)
                                    <div class="col-md-4">
                                        <a href="{{ route('Admin.Payment.order_status', $Pos_invoice->id) }}"
                                            class="btn btn-success btn-block btn-lg">Done</a>
                                    </div>
                            </div>
                            <script src="script.js"></script>
                            <div class="col-md-12">
                                <br>
                                <a href="{{ route('Admin.Payment.print_invoice', $Pos_invoice->id) }} " id="btnPrint"
                                    class="btn btn-dark btn-lg btn-block ">Print Invoice</a>

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
