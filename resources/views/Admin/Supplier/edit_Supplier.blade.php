<x-admin-master>
    @section('content')

        <div class="container-fluid add-form-list">
           <div class="row">
               <div class="col-sm-12">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                               <h4 class="card-title">Update Supplier</h4>
                           </div>
                           <a href="{{ route("Admin.Supplier.list_Supplier") }}">   <button class="btn sidebar-bottom-btn btn-lg"> Back</button></a>
                       </div>
                       <div class="card-body">
                           <form action="{{route('Admin.Supplier.update_Supplier',$supplier->id)}}" enctype="multipart/form-data" method="post" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name *</label>
                                        <input type="text" value="{{$supplier->Company_Name}}" class="form-control" name="Company_Name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Name *</label>
                                           <input type="text" value="{{$supplier->Name}}" class="form-control" name="Name" placeholder="Enter Name" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Email *</label>
                                           <input type="text" class="form-control" value="{{$supplier->Email}}" name="Email" placeholder="Enter Email" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Phone Number *</label>
                                           <input type="text" class="form-control" value="{{$supplier->Phone_Number}}" name="Phone_Number" placeholder="Enter Phone Number" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   {{-- <div class="col-md-6">
                                       <div class="form-group">
                                           <label>GST Number *</label>
                                           <input type="text" class="form-control" name="GST_Number" placeholder="Enter GST Number" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div> --}}
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Address</label>
                                           <textarea class="form-control" name="Address" rows="4">{{$supplier->Address}}</textarea>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>City *</label>
                                           <input type="text" class="form-control" value="{{$supplier->City}}" name="City" placeholder="Enter City" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>State *</label>
                                           <input type="text" class="form-control" value="{{$supplier->State}}" name="State" placeholder="Enter State" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Country *</label>
                                           <input type="text" class="form-control" value="{{$supplier->Country}}" name="Country" placeholder="Enter Country" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                               </div>
                               <button type="submit" class="btn btn-primary mr-2">Add Supplier</button>
                               <button type="reset" class="btn btn-danger">Reset</button>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Page end  -->

    @endsection
</x-admin-master>
