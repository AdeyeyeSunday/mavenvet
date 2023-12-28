<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Services</h6>
                            </div>

                            {{-- <div class="header-title">
                                <h6  style="color: red" class="card-title">Grand Total:
                             </div> --}}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="ligth">
                                        <th scope="col">Vaccination</th>
                                        <th scope="col">Qty</th>
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
                                            <div class="btn btn-danger">{{ session('message') }}</div>
                                        @endif
                                    </center>


                                    @foreach ($treat as $treat)
                                        @if ($treat->items_name)
                                            <tr>
                                                <td>{{ $treat->items_name }}</td>
                                                </td>
                                                <td>
                                                    <form action="{{ route('Admin.Store.service_item_update', $treat->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" value="{{ $treat->qty }}" style="width: 80px"
                                                            name="qty" id="">

                                                        <a href="{{ route('Admin.Store.service_item_update', $treat->id) }}">
                                                            <button type="submit" class="btn btn-link"><i
                                                                    class="ri-moon-fill pr-0"></i></button></a>
                                                    </form>
                                                </td>
                                                <td>{{ $treat->selling_price * $treat->qty }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('Admin.Store.service_item_destory', $treat->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="badge bg-warning mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="Delete"
                                                            href="{{ route('Admin.Store.service_item_destory', $treat->id) }}"><i
                                                                class="ri-delete-bin-line mr-0"></i></a>
                                                </td>
                                                </form>
                                            </tr>
                                            @php
                                                $total += $treat->selling_price * $treat->qty;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <center>
                                        <h6 style="color: red">Grand Total : {{ $total + $amount2 }}</h6>
                                    </center>
                                </tbody>
                            </table>
                        </div>




                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="ligth">

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
                                                                    class="ri-moon-fill pr-0"></i></button></a>
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
                                                        <a class="badge bg-warning mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="Delete"
                                                            href="{{ route('Admin.Store.service_item_destory', $treat_service->id) }}"><i
                                                                class="ri-delete-bin-line mr-0"></i></a>
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
                                <h6 class="card-title">Client Information</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead">
                                    <form action="{{ route('Admin.Store.service_item') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <tr>
                                            <label for="">Pet name</label>
                                            <select name="Pet_name" id="" class="form-control">
                                                <option value="" disabled selected>******</option>
                                                @foreach ($clinics as $clinics)
                                                    <option value="{{ $clinics->id }}">{{ $clinics->Pet_name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="">Unregister</label>
                                            <input type="text" class="form-control" value="" placeholder="Unregister"
                                                name="Unregister" id="">
                                            <label for="">Owner name</label>
                                            <input type="text" class="form-control" value="*******" name="Owner_name"
                                                id="" required>
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control" value="*******" name="Phone" id=""
                                                required>
                                            <label for="">Next vaccination appointment</label>
                                            <input type="date" class="form-control" name="Next_vaccination_appointment"
                                                id="">
                                            <label for="">Next appointments</label>
                                            <input type="date" class="form-control" name="Next_appointments" id=""><br>
                                            <input type="hidden" class="form-control" value="{{ date('d/m/y') }}"
                                                name="date" id="">
                                            <input type="hidden" class="form-control" value="MVC midwifery" name="location"
                                                id="">
                                            <input type="hidden" class="form-control" value="{{ date('Y') }}"
                                                name="year" id="">
                                            <input type="hidden" class="form-control" value="{{ date('F') }}"
                                                name="month" id="">
                                            <input type="hidden" class="form-control" value="pending" name="order_status"
                                                id="">
                                            <input type="hidden" class="form-control" name="user_id"
                                                value="{{ Auth()->user()->id }}" id="" required>

                                            @foreach ($get_cart as $get_cart)
                                                <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}" id="">
                                                <input type="hidden" name="prod_name" value="{{ $get_cart->items_name }}"
                                                    id="">
                                                <input type="hidden" name="qty" value="{{ $get_cart->qty }}" id="">
                                                <input type="hidden" name="subtotal"
                                                    value="{{ $get_cart->qty * $get_cart->selling_price + $get_cart->Amount }}"
                                                    id="">
                                                <input type="hidden" name="price" value="{{ $get_cart->selling_price }}"
                                                    id="">
                                                <input type="hidden" name="service" value="{{ $get_cart->service }}" id="">
                                                <input type="hidden" name="service" value="{{ $get_cart->qty }}" id="">
                                                <input type="hidden" name="Amount" value="{{ $get_cart->Amount }}" id="">
                                                <input type="hidden" name="month" value="{{ date('F') }}" id="">
                                                <input type="hidden" name="date" value="{{ date('d/m/y') }}" id="">
                                                <input type="hidden" name="year" value="{{ date('Y') }}" id="">

                                                <input type="hidden" name="treatment" value="{{ $get_cart->treatment }}"
                                                    id="">
                                            @endforeach
                                            <center> <button class="btn btn-primary">Submit</button></center>
                                        </tr>
                                    </form>
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
                                        <thead class="bg-white text-uppercase">
                                            <tr class="ligth ligth-data">
                                                {{-- <th>Image</th> --}}
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ligth-body">
                                            @foreach ($vaccine as $item)
                                                <tr>
                                                    <form action="{{ route('Admin.Store.service_item_store') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth()->user()->id }}">
                                                        <input type="hidden" name="items_name" value="{{ $item->Name }}">
                                                        <input type="hidden" name="qty" value="0">
                                                        <input type="hidden" name="selling_price"
                                                            value="{{ $item->Price }}">
                                                        <input type="hidden" name="vaccine_id" value="{{ $item->id }}">
                                                        <input type="hidden" name="subtotal" value="0" id="">
                                                        <input type="hidden" name="Quantity" value="{{ $item->Quantity }}"
                                                            id="">
                                                        <input type="hidden" name="service" value="0" id="">
                                                        <input type="hidden" name="Amount" value="0" id="">
                                                        <input type="hidden" name="service_id" value="0">
                                                        {{-- <td><img src="{{asset('storage/'.$item->Image)}}" width="30px" height="30px" alt=""></td> --}}
                                                        <td>{{ $item->Name }}</td>
                                                        <td>{{ $item->brand }}</td>
                                                        <td>{{ $item->Price }}</td>
                                                        <td>{{ $item->Quantity }}</td>


                                                        {{-- // minimum start from here --}}
                                                        <td>
                                                            @php
                                                                if ($item->Quantity <= $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock restock it</button>';
                                                                } elseif ($item->Quantity > $item->minimum) {
                                                                    echo '<button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>

                                                            @if ($item->Quantity <= 0)
                                                                <button disabled><i class="ri-moon-fill pr-0"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-link"><i
                                                                        class="ri-moon-fill pr-0"></i></button>
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
                                                <div class="header-title">
                                                    <h6 class="card-title">Other Services</h6>
                                                </div>
                                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                                    data-target="#exampleModalScrollable">
                                                    Other Treatment
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="data-table table mb-0 tbl-server-info">
                                                            <thead class="bg-white text-uppercase">
                                                                <tr class="ligth ligth-data">
                                                                    <th>Name</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody class="ligth-body">
                                                                @foreach ($service as $item)
                                                                    <tr>
                                                                        <form
                                                                            action="{{ route('Admin.Store.item_store') }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="selling_price"
                                                                                value="0" id="">
                                                                            <input type="hidden" name="vaccine_id" value="0"
                                                                                id="">
                                                                            <input type="hidden" name="qty" value="0" id="">
                                                                            <input type="hidden" name="items_name" value="0"
                                                                                id="">
                                                                            <input type="hidden" name="subtotal" value="0"
                                                                                id="">
                                                                            <input type="hidden" name="user_id"
                                                                                value="{{ Auth()->user()->id }}">
                                                                            <input type="hidden" name="service"
                                                                                value="{{ $item->service }}" id="">
                                                                            <input type="hidden" name="Amount" value="0"
                                                                                id="">
                                                                            <input type="hidden" name="service_id"
                                                                                value="{{ $item->id }}">
                                                                            <td>{{ $item->service }}</td>
                                                                            <td>
                                                                                <button type="submit"
                                                                                    class="btn btn-link"><i
                                                                                        class="ri-moon-fill pr-0"></i></button>
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
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalScrollableTitle">Other Treatment
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('Admin.Store.item') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <h6 class="card-title">Treatment</h6>
                                                                        <input type="text" class="form-control"
                                                                            name="service" id=""
                                                                            placeholder="Enter Treatment">

                                                                        <input type="hidden" name="selling_price" value="0"
                                                                            id="">
                                                                        <input type="hidden" name="vaccine_id" value="0"
                                                                            id="">
                                                                        <input type="hidden" name="qty" value="0" id="">
                                                                        <input type="hidden" name="items_name" value="0"
                                                                            id="">
                                                                        <input type="hidden" name="subtotal" value="0"
                                                                            id="">

                                                                        <input type="hidden" name="user_id"
                                                                            value="{{ Auth()->user()->id }}">
                                                                        <input type="hidden" name="Amount" value="0" id="">
                                                                        <br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-primary">Submit</button>
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
