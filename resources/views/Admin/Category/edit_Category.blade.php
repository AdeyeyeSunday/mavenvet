<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update category</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.Category.update_Category',$Category->id)}}" method="post" data-toggle="validator">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control image-file" name="pic" accept="image/*">
                                    </div> --}}
                                </div>
                                <input type="hidden" name="syn_flag" value="0" id="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name *</label>
                                        <input type="text" class="form-control" value="{{$Category->Category}}" name="Category" placeholder="Enter Product Name" required>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg ">Update category</button>
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
