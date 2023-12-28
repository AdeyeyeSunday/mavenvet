<x-admin-master>
    @section('content')

        <div class="container-fluid add-form-list">
           <div class="row">
               <div class="col-sm-12">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                               <h4 class="card-title">Add Customer</h4>
                           </div>
                       </div>




                       <div class="card-body">
                           <form action="{{route('Admin.Customer.add_customer_update',$add_customer_edit->id)}}" enctype="multipart/form-data" method="post" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" class="form-control" value="{{$add_customer_edit->Name}}" name="Name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Phone Number *</label>
                                           <input type="text" class="form-control" name="Phone" value="{{$add_customer_edit->Phone}}" placeholder="Enter Phone Number" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Address *</label>
                                           <input type="text" class="form-control" name="Address" value="{{$add_customer_edit->Address}}" placeholder="Enter Address" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Update Customer</button>
                               <button type="reset" class="btn btn-danger">Reset</button>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Page end  -->

    @endsection
</x-admin-master>
