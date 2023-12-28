<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                        <div>

                            <h6 class="mb-3">Subtract Product List</h6>

                        </div>


                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth">

                                    <th>Product Name</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Quantity</th>
					                 <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                        @foreach ($sub_product as $Product)
                        <tr>
                            @if ($Product->new_supply < 0)


                            <td>{{$Product->Name}}</td>
                            <td>{{$Product->user->name ?? ''}}</td>
                            <td>{{$Product->Price}}</td>
                            <td>{{$Product->Cost}}</td>
                            <td>{{$Product->new_supply}}</td>
                            <td>{{$Product->new_date}}</td>

                        </tr>

                        @endif
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
</x-admin-master>
