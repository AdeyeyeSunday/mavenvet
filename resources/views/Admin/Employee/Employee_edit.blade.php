<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Employee</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.Employee.Employee_update',$employee_edit->id)}}" data-toggle="validator" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="text" class="form-control" name="email" value="{{$employee_edit->email}}" placeholder="Enter Email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <input type="text" class="form-control" name="number" value="{{$employee_edit->number}}" placeholder="Enter Phone Number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" value="" rows="4">{{$employee_edit->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Position *</label>
                                        <input type="text" class="form-control" name="position" value="{{$employee_edit->position}}" placeholder="Enter Position" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div><br><br>
                           <center> <button type="submit" class="btn btn-primary mr-2">Update Employee</button>
                            <button type="reset" class="btn btn-danger">Reset</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
    </div>

    @endsection
</x-admin-master>
