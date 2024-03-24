<x-admin-master>
    @section('content')

        <div class="container-fluid add-form-list">
           <div class="row">
               <div class="col-sm-12">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                               <h6 class="card-title">Add Supplier</h6>
                           </div>
                           <a href="{{ route("Admin.Supplier.list_Supplier") }}">   <button class="btn sidebar-bottom-btn btn-lg"> Back</button></a>
                       </div>

                       @if (Session::has('message'))
                       <center> <div class="alert alert-primary" role="alert">
                      <div class="iq-alert-text">{{Session::get('message')}}</div>
                     </div>
                     </center>
                       @endif
                       <div class="card-body">
                           <form action="{{route('Admin.Supplier.store_Supplier')}}" enctype="multipart/form-data" method="post" data-toggle="validator">
                            @csrf
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name *</label>
                                        <input type="text" class="form-control" name="Company_Name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Name *</label>
                                           <input type="text" class="form-control" name="Name" placeholder="Enter Name" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>

                                   {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Item name *</label>
                                        <input type="text" class="form-control" name="Item_name" placeholder="Enter Item name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> --}}

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Email *</label>
                                           <input type="text" class="form-control" name="Email" placeholder="Enter Email" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label>Phone Number *</label>
                                           <input type="text" class="form-control" name="Phone_Number" placeholder="Enter Phone Number" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label hidden >Date *</label>
                                           <input type="hidden" value="{{date('d/m/y')}}" class="form-control" name="date" placeholder="Enter GST Number">
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>

                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Address</label>
                                           <textarea class="form-control" name="Address" rows="4"></textarea>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>City *</label>
                                           <input type="text" class="form-control" name="City" placeholder="Enter City" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>State *</label>
                                           <input type="text" class="form-control" name="State" placeholder="Enter State" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <div class="form-group">
                                           <label>Country *</label>
                                           <input type="text" class="form-control" name="Country" placeholder="Enter Country" required>
                                           <div class="help-block with-errors"></div>
                                       </div>
                                   </div>
                               </div>
                               <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Add Supplier</button>

                           </form>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Page end  -->

    @endsection
</x-admin-master>
