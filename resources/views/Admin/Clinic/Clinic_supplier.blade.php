<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add vaccine Supplier</h4>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                </div>
                            </center>
                        @endif

                        @if (Session::has('error'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('error') }}</div>
                                </div>
                            </center>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('Admin.Clinic.Clinic_supplier_store') }}" enctype="multipart/form-data"
                                method="post" data-toggle="validator">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Name *</label>
                                            <input type="text" class="form-control" name="Company_Name"
                                                placeholder="Enter Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}" id="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input type="text" class="form-control" name="Name"
                                                placeholder="Enter Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <input type="text" class="form-control" name="Email"
                                                placeholder="Enter Email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" class="form-control" name="Phone_Number"
                                                placeholder="Enter Phone Number" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <label hidden>Date *</label>
                                    <input type="hidden" value="{{ date('d/m/y') }}" class="form-control" name="date"
                                        placeholder="Enter GST Number">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="Address" rows="4"></textarea>
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
