<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">MVC midwifery Pos (Point of Sale)</h6>
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
                                                                                        value="{{ $get_cart->Quantity }}" style="width: 100px">

                                                                                        <input type="hidden" name="Name[]"
                                                                                        value="{{ $get_cart->Name }}">

                                                                                        <input type="hidden" name="Price[]"
                                                                                        value="{{ $get_cart->Price }}">

                                                                                        <input type="hidden" name="product_id[]"
                                                                                        value="{{ $get_cart->product_id }}">

                                                                            </th>

                                                                            <th>{{ $get_cart->Price }}</th>

                                                                            <th>{{ $get_cart->Price * $get_cart->Quantity }}
                                                                            </th>
                                                                            <th>
                                                                                {{-- <form
                                                                                    action="{{ route('Admin.Cart.destory_cart', $get_cart->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('DELETE') --}}
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
                                                                            $total += $get_cart->Price * $get_cart->Quantity;
                                                                        @endphp
                                                                    @endforeach

                                                                    <h6>Grand Total : {{ $total }}</h6>
                                                                </tbody>
                                                            </table>
                                                        </ul>
                                                    <button class="btn btn-dark" style="margin-left: 90%;">Update Cart</button>
                                                </form>
                                                    </div>
                                                </div>
                                            </div>






                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div class="header-title">
                                                        <h6 class="card-title">Basic Details</h6>
                                                    </div>


                                                    <div class="header-title">
                                                        <div class="header-title">
                                                            <a href="{{ route('Admin.Pos.Pos_pending') }}">
                                                                <h6 class="card-title">View pending</h6>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>

                                                <form action="{{ route('Admin.Pos.Pos_store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">

                                                        <input type="text" name="fname" class="form-control"
                                                            value="****" placeholder="Full Name"><br>
                                                        <input type="text" name="phone" value="****"
                                                            class="form-control" placeholder="Phone"><br>
                                                        <input type="text" name="address" value="****"
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
                                                        <input type="hidden" name="date" value="{{ date('Y-d-m') }}">
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

                                            <center> <button type="submit" class="btn btn-primary">Place Order</button>
                                            </center>
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
                                                                                if ($product->Quantity <= $product->Quantity_level) {
                                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock restock it</button>';
                                                                                } elseif ($product->Quantity > $product->Quantity_level) {
                                                                                    echo ' <button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                                                }

                                                                            @endphp
                                                                        </td>

                                                                        <td>{{ $product->Price }}</td>
                                                                        <td>


                                                                            @if ($product->Quantity <= 0)
                                                                                <button disabled><i
                                                                                        class="ri-moon-fill pr-0"></i></button>
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
