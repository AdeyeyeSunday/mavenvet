<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add vaccine</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('Admin.Clinic.Clinic_add_vaccine_store')}}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            <div class="row">

                                <input type="hidden" name="location" value="MVC" id="">

                                <input type="hidden" name="user_id" value="{{Auth()->user()->id}}" id="">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" name="Name" class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vaccine Cost *</label>
                                        <input type="text" class="form-control" name="Cost" placeholder="Enter Cost" data-errors="Please Enter Cost." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Selling Price *</label>
                                        <input type="text" class="form-control" name="Price" placeholder="Enter Price" data-errors="Please Enter Price." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity *</label>
                                        <input type="text" class="form-control" name="Quantity" placeholder="Enter Quantity" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity minimum </label>
                                        <input type="number" name="minimum" class="form-control image-file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="Image" class="form-control image-file" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date *</label>
                                        <input type="date" name="expiry_date" class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand *</label>
                                       <select name="brand" id=""  class="form-control">
                                           <option value="" selected disabled> Select brand </option>
                                           @foreach ($brand as $item)
                                           <option value="{{$item->brand}}">{{$item->brand}}</option>
                                           @endforeach

                                       </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>supplier *</label>
                                       <select name="supplier" id="" class="form-control">
                                           <option value="" selected disabled> Select supplier </option>
                                           @foreach ($supplier as $item)
                                           <option value="{{$item->Name}}">{{$item->Name}}</option>
                                           @endforeach
                                       </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="new_supply" value="0" id="">
                                <input type="hidden" name="supply_date" value="{{date('d/m/y')}}" id="">
                            </div>
                            <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Add vaccine</button>

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
