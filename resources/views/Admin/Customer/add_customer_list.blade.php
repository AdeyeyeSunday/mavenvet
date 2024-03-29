<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Customer List</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                     <th>Id</th>
                                     <th>Name</th>
                                     <th>Phone No</th>
                                     <th>Address</th>
                                     <th>Date</th>
                                     <th>Action</th>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($Customer as $Customer)
                                <td>{{$Customer->id}}</td>
                                    <td>{{$Customer->Name}}</td>
                                    <td>{{$Customer->Phone}}</td>
                                    <td>{{$Customer->Address}}</td>
                                    <td>{{$Customer->date}}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">

                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{route('Admin.Customer.add_customer_edit',$Customer->id)}}"><i class="ri-pencil-line mr-0"></i></a>

                                                <form action="{{route('Admin.Customer.add_customer_destory',$Customer->id)}}">
                                                    @method('DELETE')
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="{{route('Admin.Customer.add_customer_destory',$Customer->id)}}"><i class="ri-delete-bin-line mr-0"></i></a>
                                            </form>
                                        </div>
                                    </td>
                                 </tr>
                              </tbody>
                              @endforeach
                           </table>
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
