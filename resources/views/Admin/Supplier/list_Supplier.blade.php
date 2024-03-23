<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        @if (Session::has('message'))
                        <center> <div class="alert alert-primary" role="alert">
                       <div class="iq-alert-text">{{Session::get('message')}}</div>
                      </div>
                      </center>
                        @endif
                        <h6 class="mb-3">Suppliers List</h6>
                    </div>
                    <a href="{{route('Admin.Supplier.add_Supplier')}}" class="btn sidebar-bottom-btn mt-4 btn-lg "><i class="las la-plus mr-3"></i>Add Supplier</a>
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
                            <th>Company Name</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">

                        @foreach ($supplier as $supplier)
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td>{{$supplier->Company_Name}}</td>
                            <td>{{$supplier->Name}}</td>
                            <td>{{$supplier->Email}}</td>
                            <td>{{$supplier->Phone_Number}}</td>
                            <td>{{$supplier->Address}}</td>
                            <td>{{$supplier->date}}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                        href="#"><i class="ri-eye-line mr-0"></i></a>
                                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                        href="{{route('Admin.Supplier.edit_Supplier',$supplier->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                        href="{{route('Admin.Supplier.destory',$supplier->id)}}"><i class="ri-delete-bin-line mr-0"></i></a>
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
