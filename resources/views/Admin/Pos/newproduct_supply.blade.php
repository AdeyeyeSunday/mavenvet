<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>

                        <h4 class="mb-3">New Product List</h4>
                        <p class="mb-0">The product list effectively dictates product presentation and provides space<br> to list your products and offering in the most appealing way.</p>


                    </div>

                    <a href="{{route('Admin.Product.new_supply')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Back</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white">
                        <tr class=" -data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>
                            <th> Name</th>
                            <th>Cost</th>
                            <th>Price</th>
                            {{-- <th>Old Quantity</th> --}}
                            <th>New Quantity</th>
                            <th>Expiry Date</th>
                            <th>Date</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="-body">

                        @foreach ($new as $new)
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>

                            <td>{{$new->Name}}</td>
                            <td>{{$new->Cost}}</td>
                            <td>{{$new->Price}}</td>
                            <td>{{$new->new_supply}}</td>
                            <td>{{$new->expiry_date}}</td>
                            <td>{{$new->new_date}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>



    @endsection
</x-admin-master>
