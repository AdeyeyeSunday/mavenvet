
<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update product</h4>
                        </div>
                     <a href="{{ route("Admin.Product.Product_list") }}">   <button class="btn sidebar-bottom-btn btn-lg"> Back</button></a>
                    </div>

                    @if (Session::has('error'))
                    <center> <div class="alert alert-danger" role="alert">
                   <div class="iq-alert-text">{{Session::get('error')}}</div>
                  </div>
                  </center>
                    @endif


                    <div class="card-body">
                        <form action="{{route('Admin.Product.update_product',$Product->id)}}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{Auth()->user()->id}}" id="">
                                 <input type="hidden" name="location" value="MVC" id="">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" name="Name"  value="{{$Product->Name}}" class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                        {{-- <div class="help-block with-errors"></div> --}}
                                    </div>
                                </div>


                                <input type="hidden" value="0" name="syn_flag" id="">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cost *</label>
                                        <input type="text" class="form-control" value="{{$Product->Cost}}" name="Cost" placeholder="Enter Cost" data-errors="Please Enter Cost." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price *</label>
                                        <input type="text" class="form-control"  value="{{$Product->Price}}"  name="Price" placeholder="Enter Price" data-errors="Please Enter Price." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity *</label>
                                        <input type="text" class="form-control" readOnly value="{{$Product->Quantity }}" name="Quantity" placeholder="Enter Quantity" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New supply *</label>
                                        <input type="number" class="form-control" name="new_supply" value="0"  placeholder="Enter New Supply" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry date *</label>
                                        <input type="text" name="expiry_date" value="{{$Product->expiry_date}}"  class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>



                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Update quantity level *</label>
                                        <input type="text" name="Quantity_level" value="{{$Product->Quantity_level}}"  class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description & Product details *</label>
                                        <textarea class="form-control" name="Description" rows="4">{{$Product->Description}}</textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="new_date" value="{{date('d/m/y')}}" id="">
                                <input type="hidden" name="month" value="{{date('F')}}" id="">
                                <input type="hidden" name="year" value="{{date('Y')}}" id="">

                            </div>
                            <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Update product</button>
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


