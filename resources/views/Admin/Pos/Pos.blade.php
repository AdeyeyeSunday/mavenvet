<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">MVC Pos (Point of Sale)</h6>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="input-group mb-4">

                                                <div class="card card-block card-stretch card-height blog pricing-details">
                                                    <div class="card-body text-center rounded">
                                                        <ul class="list-unstyled mb-0">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Qty</th>
                                                                        <th>Price</th>
                                                                        <th>Sub Total</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $total = 0;
                                                                    @endphp


                                                                    @if (Session::has('message'))
                                                                        <div class="btn btn-danger">{{ session('message') }}
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


                                                                                    <input type="number" name="Quantity[]"
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

                                                                                <a class="badge bg-warning mr-2"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top" title=""
                                                                                    data-original-title="Delete"
                                                                                    href="{{ route('Admin.Cart.destory_cart', $get_cart->id) }}"><i
                                                                                        class="r4
                                                                                            4i-delete-bin-line mr-0">Delete</i></a>
                                                                                {{-- </form> --}}
                                                                            </th>
                                                                        </tr>

                                                                        @php
                                                                            $total +=
                                                                                $get_cart->Price * $get_cart->Quantity;
                                                                        @endphp
                                                                    @endforeach

                                                                    <h6>Grand Total : {{ number_format($total, 2) }}</h6>
                                                                    <br>
                                                                </tbody>
                                                            </table>
                                                        </ul>
                                                        @if ($total != '0.00')
                                                            <button class="btn btn-dark btn-lg btn-block">Update
                                                                Cart</button>
                                                        @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class="header-title">
                                                        @if ($total != '0.00')
                                                            <h6 class="card-title">Full direct payment section only </h6>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route("Admin.Pos.direct_print") }}"><button class="btn btn-secondary btn-lg ">Print invoice</button></a>
                                                    <div class="header-title">
                                                        <div class="header-title">
                                                            <a href="{{ route('Admin.Pos.Pos_pending') }}">
                                                                View pending
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($total != '0.00')
                                                    <form action="{{ route('Admin.Pos.directPayment') }}"
                                                        enctype="multipart/form-data" method="post">
                                                        @csrf
                                                        <center>
                                                            <p>This section doesn't accept double payments; you can only use
                                                                a single payment method. For double payments, you can
                                                                utilize the "Process double payment" button below.</p>
                                                        </center>
                                                        <div class="row  col-md-12">
                                                            <div class="col-md-4 off col-md-4">
                                                                <br>
                                                                <label for="">Amount</label>
                                                                <input type="text" disabled name=""
                                                                    value="{{ $total }}" class="form-control"
                                                                    id="">
                                                                <br>
                                                            </div>
                                                            <div class="col-md-8 off col-md-1">
                                                                <br>
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
                                                            <div class="col-md-12">
                                                                <center> <button
                                                                        class="btn btn-dark btn-lg btn-block">Process direct
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
                                                            <input type="hidden" name="order_status" class="form-control"
                                                                value="success">
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
                                                <h6 class="card-title">All Product</h6>
                                            </div>
                                        </div>

                                        <div class="input-group mb-6">
                                            <div class="col-lg-12">
                                                <br>
                                                <div class="table-responsive rounded mb-3">
                                                    <table class="data-table table mb-0 tbl-server-info">
                                                        <thead class="bg-white text-uppercase">
                                                            <tr class="ligth ligth-data">
                                                                {{-- <th>Image</th> --}}
                                                                <th>Name</th>
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
                                                                        method="post" enctype="multipart/form-data">
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

                                                                        {{-- <td>
                                                      <img src="{{asset('storage/'.$product->Image)}}" style="width: 30px;" alt=""> </td> --}}
                                                                        <td>
                                                                            <center>{{ $product->Name }}</center>
                                                                        </td>
                                                                        <td>{{ $product->Category }}</td>

                                                                        <td>{{ $product->Quantity }}</td>

                                                                        <td>
                                                                            {{-- //Quantity_level start from here --}}
                                                                            @php
                                                                                if (
                                                                                    $product->Quantity <=
                                                                                    $product->Quantity_level
                                                                                ) {
                                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock</button>';
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
                                                                                        class="ri-moon-fill pr-0"></i></button>
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

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
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
