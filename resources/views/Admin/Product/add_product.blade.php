<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Add Product</h6>
                        </div>
                    </div>
                    <div class="card-body">
                         <form action="{{route('Admin.Product.store_product')}}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf
                            <div class="row">
                                {{-- <input type="hidden" name="location" value="MVC" id=""> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" name="Name" class="form-control" placeholder="Enter Name" data-errors="Please Enter Name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category *</label>
                                        <select  name="Category" class="selectpicker form-control" data-style="py-0">
                                            <option disabled selected></option>
                                            @foreach ($Category as $Category)
                                            <option value="{{$Category->Category}}">{{$Category->Category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cost *</label>
                                        <input type="text" class="form-control" name="Cost" placeholder="Enter Cost" data-errors="Please Enter Cost." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Selling price *</label>
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
                                        <label>Minimum  quantity *</label>
                                        <input type="text" class="form-control" name="Quantity_level" placeholder="Enter Quantity" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Supplier *</label>
                                        <select  name="supplier" class="selectpicker form-control"  data-style="py-0">
                                            <option disabled selected>Select supplier</option>
                                            @foreach ($suplier as $suplier)
                                            <option value="{{$suplier->Name}}">{{$suplier->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="Image"  value="0"  class="form-control image-file" accept="image/*">
                                    </div>
                                 </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry date *</label>
                                        <input type="text" name="expiry_date" value="0000-00-00"  class="form-control" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description / Product details *</label>
                                        <textarea class="form-control"   name="Description" rows="4" >****</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="month" value="{{date('F')}}" id="">
                                <input type="hidden" name="year" value="{{date('Y')}}" id="">

                                <input type="hidden" name="new_date" value="0" id="">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Add Product</button>
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
