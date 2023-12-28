<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Add category</h6>
                        </div>
                    </div>


                    <div class="card-body">
                        <form action="{{route('Admin.Category.store_Category')}}" method="post" data-toggle="validator">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control image-file" name="pic" accept="image/*">
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name *</label>
                                        <input type="text" class="form-control" name="Category" placeholder="Enter Product Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Barcode Symbology *</label>
                                        <input type="text" class="form-control" name="Barcode_Symbology" placeholder="Enter Barcode Symbology" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Add category</button>
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
