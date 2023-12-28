<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>

                        @if (Session::has('message'))
                        <center> <div class="alert alert-primary" role="alert">
                       <div class="iq-alert-text">{{Session::get('message')}}</div>
                      </div>
                      </center>
                        @endif



                        @if (Session::has('update'))
                        <center> <div class="alert alert-primary" role="alert">
                       <div class="iq-alert-text">{{Session::get('update')}}</div>
                      </div>
                      </center>
                        @endif


                       @if (Session::has('delete'))
                        <center> <div class="alert alert-danger" role="alert">
                       <div class="iq-alert-text">{{Session::get('delete')}}</div>
                      </div>
                      </center>
                        @endif

                        <h6 class="mb-3">Product List</h6>
                        <p class="mb-0">The product list effectively dictates product presentation and provides space<br> to list your products and offering in the most appealing way.</p>


                    </div>

                    <a href="{{route('Admin.Product.add_product')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Product</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>
                            {{-- <th>Product</th> --}}
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">

                        @foreach ($Product as $Product)
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>

                            <td>{{$Product->Name}}</td>
                            <td>{{$Product->Category}}</td>
                            <td>{{$Product->Price}}</td>
                            <td>{{$Product->Cost}}</td>
                            <td>{{$Product->Quantity}}</td>
                            <td>{{$Product->expiry_date}}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Supply"
                                        href="{{route('Admin.Product.edit_product',$Product->id)}}"><i class="ri-pencil-line mr-0"></i></a>




                                                                            
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
