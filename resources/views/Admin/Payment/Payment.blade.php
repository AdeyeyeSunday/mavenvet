<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Service cart</h6>
                            </div>

                            {{-- <div class="header-title">
                                <h6  style="color: red" class="card-title">Grand Total:
                             </div> --}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="">
                                        <th scope="col">Vaccination</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp </h6>

                                    <center>
                                        @if (Session::has('message'))
                                        <p style="color: red">{{ session('message') }}
                                        </p>
                                    @endif
                                        @if (Session::has('success'))
                                            <p style="color: rgb(9, 96, 9)">
                                                {{ session('success') }}</p>
                                        @endif
                                        @if (Session::has('error1'))
                                            <p style="color: red">{{ session('error1') }}
                                            </p>
                                        @endif

                                    </center>

                                    @foreach ($treat as $treat)
                                        @if ($treat->items_name)
                                            <tr>
                                                <td>{{ $treat->items_name }}</td>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('Admin.Store.service_item_update', $treat->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" value="{{ $treat->qty }}"
                                                            style="width: 80px" name="qty" id="">

                                                        <a
                                                            href="{{ route('Admin.Store.service_item_update', $treat->id) }}">
                                                            <button type="submit" class="btn btn-link"><i
                                                                    class="ri-check-line ri-lg fw-bold"></i></button></a>
                                                    </form>
                                                </td>
                                                <td>{{ $treat->selling_price * $treat->qty }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('Admin.Store.service_item_destory', $treat->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="badge bg-danger mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="Delete"
                                                            href="{{ route('Admin.Store.service_item_destory', $treat->id) }}">Remove</a>
                                                </td>
                                                </form>
                                            </tr>
                                            @php
                                                $total += $treat->selling_price * $treat->qty;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <center>
                                        <h6 style="color: red">Grand Total : {{ number_format($total + $amount2, 2) }}</h6>
                                    </center>
                                    <br>
                                </tbody>
                            </table>
                        </div>




                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="">

                                        <th scope="col">Services</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($treat_service as $treat_service)
                                        @if ($treat_service->service)
                                            <tr>
                                                <td>{{ $treat_service->service }}
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('Admin.Store.service_item_update2', $treat_service->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" value="{{ $treat_service->Amount }}"
                                                            style="width: 80px" name="Amount" id="">

                                                        <a
                                                            href="{{ route('Admin.Store.service_item_update', $treat_service->id) }}">
                                                            <button type="submit" class="btn btn-link"><i
                                                                    class="ri-check-line ri-lg fw-bold"></i></button></a>
                                                    </form>
                                                </td>
                                                <td>{{ $treat_service->Amount }}
                                                </td>


                                                <td>
                                                    <form
                                                        action="{{ route('Admin.Store.service_item_destory', $treat_service->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="badge bg-danger mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="Delete"
                                                            href="{{ route('Admin.Store.service_item_destory', $treat_service->id) }}">Remove</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                @if ($total + $amount2 != '0.00')
                                    <h6 class="card-title">Full direct payment section only </h6>
                                @endif
                            </div>

                            <a href="{{ route('Admin.Payment.direct_service') }}"><button
                                    class="btn btn-dark btn-lg btn-block">Print invoice</button></a>
                            <button class="btn sidebar-bottom-btn btn-lg bt " class="btn btn-dark mt-2 btn-lg btn-block"
                                data-toggle="modal" data-target="#exampleModalScrollable">Add other treatment
                            </button>
                        </div>
                        @if ($total + $amount2 == '0.00')
                            <div class="col-md-12">
                                <div class="warning">
                                    <p><strong style="color: red">Important Notice:</strong> Your account security is
                                        paramount. You are accountable for all actions performed using your login
                                        credentials.
                                        Please safeguard your account information and refrain from sharing it with others.
                                        Any misuse or unauthorized access may result in penalties. Your cooperation is
                                        appreciated. Thank you.</p>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead">

                                    @if ($total + $amount2 != '0.00')
                                        <form action="{{ route('Admin.Store.direct_service_item') }}"
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
                                                    <h6 class="card-title">Amount charged</h6>
                                                    <input type="text" disabled name=""
                                                        value="{{ $total + $amount2 }}" class="form-control"
                                                        id="">
                                                </div>

                                                <div class="col-md-4 off col-md-1">
                                                    {{-- <br> --}}
                                                    <h6 class="card-title">Mode of payment </h6>
                                                    <select name="Mode_of_payment" id="modeOfPayment" class="form-control"
                                                        required>
                                                        <option value="" selected>select</option>
                                                        <option value="Cash">Cash</option>
                                                        <option value="Pos">Pos</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="cash_transfer">Cash & Transfer </option>
                                                        <option value="cash_pos">Cash & Pos</option>
                                                    </select>

                                                </div>
                                                <br>
                                                <div class="col-md-4 off col-md-1">
                                                    <label for="">Owner name</label>
                                                    <input type="text" class="form-control"
                                                        name="Owner_name" id="" required>
                                                    <input type="hidden" class="form-control" value="MVC"
                                                        name="location" id="">
                                                    <input type="hidden" name="pay" value="{{ $total + $amount2 }}"
                                                        class="form-control">
                                                    <input type="hidden" name="due" class="form-control"
                                                        value="0">
                                                    <input type="hidden" name="Payment_type" class="form-control"
                                                        value="Full Payment">
                                                </div>

                                                <div class="col-md-4 off col-md-1">
                                                    <label for="">Phone No.</label>
                                                    <input type="number" class="form-control"
                                                        name="Phone" id="" required>
                                                </div>
                                                {{-- <div class="row"> --}}
                                                <div class="col-md-4 off col-md-1" id="cashField">
                                                    <label for="">Cash</label>
                                                    <input type="number" class="form-control" placeholder="Cash"
                                                        name="transfer_pay" id="cashInput" onblur="validatePayment()">
                                                </div>
                                                <div class="col-md-4 off col-md-1" id="transferField">
                                                    <label for="">Transfer</label>
                                                    <input type="number" class="form-control" placeholder="Transfer"
                                                        name="cash_transfer" id="transferInput"
                                                        onblur="validatePayment()">
                                                    <br>
                                                </div>


                                                <div class="col-md-4 off col-md-1" id="cashFieldPos">
                                                    <label for="">Cash</label>
                                                    <input type="number" class="form-control" placeholder="Cash"
                                                        name="pos_pay" id="cashInput">
                                                </div>
                                                <div class="col-md-4 off col-md-1" id="posField">
                                                    <label for="">Pos</label>
                                                    <input type="number" class="form-control" placeholder="Pos"
                                                        name="cash_pos" id="transferInput">
                                                    <br>
                                                </div>

                                                <div class="col-md-6 off col-md-1">
                                                    <br>
                                                    <div
                                                        class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">

                                                        <input type="checkbox" class="custom-control-input bg-dark"
                                                            name="checkbox_print" value="1" id="customCheck-5"
                                                            checked="">
                                                        <label class="custom-control-label" for="customCheck-5">Print
                                                            invoice after payment </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <center> <button
                                                            class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Process
                                                            payment</button></center>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    <br><br><br>
                                 @if ($total + $amount2 != '0.00')
                                        <div class="col-md-12">
                                            <p>
                                                <button class="btn btn-dark btn-lg btn-block" type="button"
                                                    data-toggle="collapse" data-target="#collapseExample"
                                                    aria-expanded="false" aria-controls="collapseExample">
                                                    Open flexible payment options with partial payment feature
                                                </button>
                                            </p>
                                        </div>
                                    @endif
                                 <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <form action="{{ route('Admin.Store.service_item') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <label for="" hidden>Pet name</label>
                                                <select hidden name="Pet_name" id="" class="form-control">
                                                    <option value="" disabled selected>******</option>
                                                    @foreach ($clinics as $clinics)
                                                        <option value="{{ $clinics->id }}">{{ $clinics->Pet_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for=""hidden>Unregister</label>
                                                <input type="hidden" class="form-control" value=""
                                                    placeholder="Unregister" name="Unregister" id="">
                                                <div class="row">
                                                    <div class="col-md-6 off col-md-1">
                                                        <label for="">Owner name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Owner name" name="Owner_name"
                                                            id="" required>
                                                    </div>
                                                    <div class="col-md-6 off col-md-1">
                                                        <label for="">Phone</label>
                                                        <input type="number" class="form-control"
                                                            name="Phone" id="" required>
                                                        <br>
                                                    </div>
                                                    <label for="" hidden>Next vaccination appointment</label>
                                                    <input type="hidden" class="form-control"
                                                        name="Next_vaccination_appointment" id="">
                                                    <label for=""hidden>Next appointments</label>
                                                    <input type="hidden" class="form-control" name="Next_appointments"
                                                        id=""><br>
                                                    <input type="hidden" class="form-control"
                                                        value="{{ date('d/m/y') }}" name="date" id="">
                                                    <input type="hidden" class="form-control" value="MVC"
                                                        name="location" id="">
                                                    <input type="hidden" class="form-control"
                                                        value="{{ date('Y') }}" name="year" id="">
                                                    <input type="hidden" class="form-control"
                                                        value="{{ date('F') }}" name="month" id="">
                                                    <input type="hidden" class="form-control" value="pending"
                                                        name="order_status" id="">
                                                    <input type="hidden" class="form-control" name="user_id"
                                                        value="{{ Auth()->user()->id }}" id="" required>
                                                    <br><br>
                                                    @foreach ($get_cart as $get_cart)
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth()->user()->id }}" id="">
                                                        <input type="hidden" name="prod_name"
                                                            value="{{ $get_cart->items_name }}" id="">
                                                        <input type="hidden" name="qty"
                                                            value="{{ $get_cart->qty }}" id="">
                                                        <input type="hidden" name="subtotal"
                                                            value="{{ $get_cart->qty * $get_cart->selling_price + $get_cart->Amount }}"
                                                            id="">
                                                        <input type="hidden" name="price"
                                                            value="{{ $get_cart->selling_price }}" id="">
                                                        <input type="hidden" name="service"
                                                            value="{{ $get_cart->service }}" id="">
                                                        <input type="hidden" name="service"
                                                            value="{{ $get_cart->qty }}" id="">
                                                        <input type="hidden" name="Amount"
                                                            value="{{ $get_cart->Amount }}" id="">
                                                        <input type="hidden" name="month" value="{{ date('F') }}"
                                                            id="">
                                                        <input type="hidden" name="date" value="{{ date('d/m/y') }}"
                                                            id="">
                                                        <input type="hidden" name="year" value="{{ date('Y') }}"
                                                            id="">
                                                        <input type="hidden" name="treatment"
                                                            value="{{ $get_cart->treatment }}" id="">
                                                    @endforeach

                                                </div>

                                                @if ($total + $amount2 != '0.00')
                                                    <center> <button class="btn btn-success btn-lg btn-block">Process
                                                            double
                                                            payment</button>
                                                    </center>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Vaccination</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="data-table table mb-0 tbl-server-info">
                                        <thead class="bg-white">
                                            <tr class=" -data">

                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="-body">
                                            @foreach ($vaccine as $item)
                                                <tr>
                                                    <form action="{{ route('Admin.Store.service_item_store') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth()->user()->id }}">
                                                        <input type="hidden" name="items_name"
                                                            value="{{ $item->Name }}">
                                                        <input type="hidden" name="qty" value="1">
                                                        <input type="hidden" name="selling_price"
                                                            value="{{ $item->Price }}">
                                                        <input type="hidden" name="vaccine_id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" name="subtotal" value="0"
                                                            id="">
                                                        <input type="hidden" name="Quantity"
                                                            value="{{ $item->Quantity }}" id="">

                                                        <input type="hidden" name="service" value="0"
                                                            id="">
                                                        <input type="hidden" name="Amount" value="0"
                                                            id="">
                                                        <input type="hidden" name="service_id" value="0">
                                                        {{-- <td><img src="{{asset('storage/'.$item->Image)}}" width="30px" height="30px" alt=""></td> --}}
                                                        <td>{{ $item->Name }}</td>
                                                        <td>{{ $item->brand }}</td>
                                                        <td>{{ $item->Price }}</td>
                                                        <td>{{ $item->Quantity }}</td>
                                                        {{-- // minimum start from here --}}
                                                        <td>
                                                            @php
                                                                if ($item->Quantity == '0') {
                                                                    echo '<button type="button" class="btn btn-dark btn-sm mr-2">Out Stock</button>';
                                                                } elseif ($item->Quantity <= $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock</button>';
                                                                } elseif ($item->Quantity > $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                                }

                                                            @endphp
                                                        </td>
                                                        <td>

                                                            @if ($item->Quantity <= 0)
                                                                <button disabled><i
                                                                        class="ri-marks-fill pr-0"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-link"><i
                                                                        class="ri-check-line ri-lg fw-bold"></i></button>
                                                            @endif

                                                        </td>
                                                </tr>
                                                </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </table>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">

                                                <h6>Service</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="data-table table mb-0 tbl-server-info">
                                                            <thead class="bg-white">
                                                                <tr class=" -data">
                                                                    <th style="margin-left: 10%">Description</th>
                                                                    <th>Amount</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody class="-body">
                                                                @foreach ($service as $item)
                                                                    <tr>
                                                                        <form
                                                                            action="{{ route('Admin.Store.item_store') }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="selling_price"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="vaccine_id"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="qty"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="items_name"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="subtotal"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="user_id"
                                                                                value="{{ Auth()->user()->id }}">
                                                                            <input type="hidden" name="service"
                                                                                value="{{ $item->service }}"
                                                                                id="">
                                                                            <input type="hidden" name="Amount"
                                                                                value="{{ $item->amount }}"
                                                                                id="">
                                                                            <input type="hidden" name="service_id"
                                                                                value="{{ $item->id }}">
                                                                            <td>{{ $item->service }}</td>
                                                                            <td>{{ $item->amount }}</td>
                                                                            <td>
                                                                                <button type="submit"
                                                                                    class="btn btn-link"><i
                                                                                        class="ri-check-line ri-lg fw-bold"></i></button>
                                                                            </td>
                                                                    </tr>
                                                                    </form>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="content-page">


                                                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title"
                                                                        id="exampleModalScrollableTitle"> Add new Treatment
                                                                    </h6>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('Admin.Store.item') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="row">

                                                                            <div class="col-md-6">
                                                                                <h6 class="card-title">Treatment
                                                                                    description</h6>
                                                                                <input type="text" class="form-control"
                                                                                    name="service" id=""
                                                                                    placeholder="Enter description"
                                                                                    required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h6 class="card-title">Amount</h6>
                                                                                <input type="number"
                                                                                    placeholder="Enter amount"
                                                                                    name="Amount" class="form-control"
                                                                                    id="" required>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="selling_price"
                                                                            value="0" id="">
                                                                        <input type="hidden" name="vaccine_id"
                                                                            value="0" id="">
                                                                        <input type="hidden" name="qty"
                                                                            value="0" id="">
                                                                        <input type="hidden" name="items_name"
                                                                            value="0" id="">
                                                                        <input type="hidden" name="subtotal"
                                                                            value="0" id="">

                                                                        <input type="hidden" name="user_id"
                                                                            value="{{ Auth()->user()->id }}">

                                                                        <br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button
                                                                        class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                                                                    {{-- <button type="button" class="btn btn-secondary btn-lg"
                                                                        data-dismiss="modal">Close</button> --}}
                                                                    </form>
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
                        </div>
                    </div>
                </div>
            @endsection
</x-admin-master>
