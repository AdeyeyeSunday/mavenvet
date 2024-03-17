<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Add Employee</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.Employee.Employee_store')}}" data-toggle="validator" method="post" enctype="multipart/form-data">
                            @csrf



                            <div class="row">


                                <div class="col-md-1">
                                    <div class="form-group">

                                        <label>Title*</label>
                                        <select name="Title" id="" class="form-control">

                                            <option disabled selected>Selected</option>
                                            <option value="Dr.">Dr</option>
                                            <option value="Mr.">Mr</option>
                                            <option value="Miss.">Miss</option>
                                       </select>


                                        {{-- <input type="text" class="form-control" name="name_id" placeholder="Enter Name" required> --}}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>



                                <div class="col-md-5">
                                    <div class="form-group">

                                        <label>Name*</label>
                                         <select name="name_id" id="" class="form-control">
                                             <option disabled selected>Selected</option>
                                               @foreach ($employee as $employee)
                                             <option value="{{$employee->id}}">{{$employee->name}}</option>
                                             @endforeach

                                        </select>
                                        {{-- <input type="text" class="form-control" name="name_id" placeholder="Enter Name" required> --}}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <input type="text" class="form-control" name="number" placeholder="Enter Phone Number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>GST Number *</label>
                                        <input type="text" class="form-control" value="0" name="gst_number" placeholder="Enter GST Number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>City *</label>
                                        <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>State *</label>
                                        <input type="text" class="form-control" name="state" placeholder="Enter State" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Country *</label>
                                        <input type="text" class="form-control" name="country" placeholder="Enter Country" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Position *</label>
                                        <input type="text" class="form-control" name="position" placeholder="Enter Position" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender *</label>
                                        <select  id="" class="form-control" name="gender" required>
                                            <option disabled selected></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Salary *</label>
                                        <input type="number" name="salary" class="form-control" id="">
                                    </div>
                                </div>

                                <input type="hidden" name="user_id"  value="{{Auth()->user()->id}}" id="">
                                <input type="hidden" name="staff_no" value="{{rand(1111,9999)}}" id="">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Image *</label>
                                        <input type="file" class="form-control" name="image" placeholder="Enter State" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div><br><br>
                           <center> <button type="submit" class="btn btn-primary mr-2">Add Employee</button>
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
