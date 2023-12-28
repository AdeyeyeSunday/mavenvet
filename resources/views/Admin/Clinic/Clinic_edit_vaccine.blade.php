<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Vaccine</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.Clinic.Clinic_update_vaccine',$edit_vaccine->id)}}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{Auth()->user()->id}}" id="">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vaccine Name *</label>
                                        <input type="text" name="Name" class="form-control" value="{{$edit_vaccine->Name}}" readonly required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <input type="hidden" name="syn_flag" value="0" id="">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vaccine Cost *</label>
                                        <input type="text" class="form-control" name="Cost" value="{{$edit_vaccine->Cost}}"  placeholder="Enter Cost" data-errors="Please Enter Cost." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Selling Price *</label>
                                        <input type="text" class="form-control" name="Price"  value="{{$edit_vaccine->Price}}"   data-errors="Please Enter Price." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity *</label>
                                        <input type="text" name="" class="form-control" value="{{ $edit_vaccine->Quantity }}" id="">
                                         <input type="hidden" class="form-control" name="Quantity" value="{{$edit_vaccine->Quantity+$edit_vaccine->new_supply}}" readonly placeholder="Enter Quantity" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New Supply *</label>
                                        <input type="text" class="form-control" name="new_supply" value=""  placeholder="Enter Quantity" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date *</label>
                                        <input type="date" name="expiry_date" value="{{$edit_vaccine->expiry_date}}"  class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Update	Minimum *</label>
                                        <input type="text" name="minimum" value="{{$edit_vaccine->minimum}}"  class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="supply_date" value="{{date('d/m/y')}}" id=""> --}}
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Update Vaccine</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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

