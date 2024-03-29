<x-admin-master>
    @section('content')
        <div class="card-body">
            <div class="input-group mb-4">
                <div class="card card-block card-stretch card-height blog pricing-details">
                    <div class="card-body text- rounded">
                        <ul class="list-unstyled mb-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vaccine name</th>
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
                                        <div class="btn btn-danger">{{ session('message') }}</div>
                                    @endif
                                    @foreach ($clinic_cart as $key => $clinic_cart)
                                        <tr>
                                            <th>{{ $key + 1 }}</th>
                                            <th>{{ $clinic_cart->items_name }}</th>
                                            <th>
                                                <form
                                                    action="{{ route('Admin.Clinic.Clinic_cart_update', $clinic_cart->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="number" name="qty" style="width: 70px;"
                                                        value="{{ $clinic_cart->qty }}">
                                                    <button type="submit" class="btn btn-link"><i
                                                            class="ri-check-line ri-lg fw-bold"></i></button>
                                                </form>
                                            </th>
                                            <th>{{ $clinic_cart->selling_price }}</th>
                                            <th>{{ $clinic_cart->qty * $clinic_cart->selling_price }}</th>
                                            <th>
                                                <form action="{{ route('Admin.Clinic.Clinic_destory', $clinic_cart->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="badge bg-danger mr-2" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Delete"
                                                        href="{{ route('Admin.Clinic.Clinic_destory', $clinic_cart->id) }}">Remove</a>
                                                </form>
                                            </th>
                                            </th>
                                        </tr>
                                        @php
                                            $total += $clinic_cart->qty * $clinic_cart->selling_price;
                                        @endphp
                                    @endforeach
                                 <center>     <h6 style="color: red" class="card-title"> Grand Total : {{ number_format($total, 2, '.', ',') }} </h6></center>
                                </tbody>
                            </table>
                        </ul>
                        <hr>
                        {{-- <br> --}}
                        @if ($total != '0.00')


                        <form action="{{ route('Admin.Clinic.drect_clinic_payment') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="location" value="MVC" id="">
                        <input type="hidden" name="pay" class="form-control" value="{{ $total }}">
                            <div class="row">
                                <div class="col-md-6 off col-md-4">
                                    <label for="">Name</label>
                                        <input type="text" placeholder="Name" name="name" value=""
                                        class="form-control" id="">
                                        <br>
                                    <h6 class="card-title">Amount charged</h6>
                                    <input type="text" disabled name="" value="{{ $total }}"
                                        class="form-control" id="">
                                </div>

                                <div class="col-md-6 off col-md-1">
                                    <label for="">Phone</label>
                                    <input type="text" placeholder="Phone number"  name="phone" value=""
                                    class="form-control" id="">
                                    <br>
                                    <h6 class="card-title">Mode of payment </h6>
                                    <select name="Mode_of_payment" id="" class="form-control" required>
                                        <option value="" selected>select</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Pos">Pos</option>
                                        <option value="Transfer">Transfer</option>
                                        {{-- <option value="cash_transfer">Cash & Transfer</option>
                                        <option value="cash_pos">Cash & Pos</option> --}}
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <center> <button class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Process payment</button></center>
                                </div>
                            </div>
                        </form>

                        <br>
                        <hr>
                        <p>
                            <button class="btn btn-dark btn-lg btn-block" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Open flexible payment options with partial payment feature
                            </button>
                        </p>
                        @endif
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form action="{{ route('Admin.Clinic.Clinic_inventory') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Full name">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Phone no.</label>
                                            <input type="text" name="phone" class="form-control" required
                                                placeholder="Phone">
                                        </div>
                                    </div>
                                    <input type="hidden" name="discount" class="form-control" value="0"><br>
                                    <input type="hidden" name="address" class="form-control" value="0"
                                        placeholder="Address">
                                    <input type="hidden" name="order_status" class="form-control" value="pending">
                                    <input type="hidden" name="Mode_of_payment" class="form-control" value="0">
                                    <input type="hidden" name="pay" class="form-control" value="0">
                                    <input type="hidden" name="due" class="form-control" value="0">
                                    <input type="hidden" name="location" value="MVC" id="">
                                    <input type="hidden" name="Payment_type" class="form-control" value="0">
                                    <input type="hidden" name="date" value="{{ date('d/m/y') }}">
                                    <input type="hidden" name="month" value="{{ date('F') }}">
                                    <input type="hidden" name="year" value=" {{ date('Y') }}">
                                    <input type="hidden" name="user_id" value=" {{ auth()->user()->id }}">
                            </div>
                            @foreach ($clinic_get as $clinic_get)
                                <input type="hidden" name="vaccine_id" value="{{ $clinic_get->id }}" id="">
                                <input type="hidden" name="qty" value="{{ $clinic_get->qty }}" id="">
                                <input type="hidden" name="price" value="{{ $clinic_get->selling_price }}"
                                    id="">
                            @endforeach
                            <button type="submit" class="btn btn-success btn-lg btn-block">Process double
                                payment</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">All Vaccine</h6>
                            </div>
                        </div>

                        <div class="input-group mb-6">
                            <div class="col-lg-12">
                                <div class="table-responsive rounded mb-3">
                                    <table class="data-table table mb-0 tbl-server-info">
                                        <thead class="bg-white">
                                            <tr class=" -data">
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Expire</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="-body">
                                            @foreach ($Vaccinestore as $item)
                                                <tr>
                                                    <form action="{{ route('Admin.Clinic.Clinic_cart') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth()->user()->id }}">
                                                        <input type="hidden" name="items_name"
                                                            value="{{ $item->Name }}">
                                                        <input type="hidden" name="qty" value="1">
                                                        <input type="hidden" name="Quantity"
                                                            value="{{ $item->Quantity }}" id="">
                                                        <input type="hidden" name="selling_price"
                                                            value="{{ $item->Price }}">
                                                        <input type="hidden" name="vaccine_id"
                                                            value="{{ $item->id }}">
                                                        <td>{{ $item->Name }}</td>
                                                        <td>{{ $item->brand }}</td>
                                                        <td>{{ $item->Price }}</td>
                                                        <td>{{ $item->Quantity }}</td>
                                                        <td>
                                                            @php
                                                            if ($item->Quantity == 0){
                                                                echo '<button type="button" class="btn btn-dark btn-sm mr-2">Out of stock </button>';
                                                            }
                                                                elseif ($item->Quantity <= $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock </button>';
                                                                } elseif ($item->Quantity > $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @if ($item->Quantity <= 0)
                                                                <button disabled><i
                                                                        class="ri-moons-fill pr-0"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-link"><i
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
        @endsection
</x-admin-master>
