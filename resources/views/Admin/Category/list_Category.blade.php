<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h6 class="mb-3">Category List</h6>
                        {{-- <p class="mb-0">Use category list as to describe your overall core business from the provided list. <br>
                        Click the name of the category where you want to add a list item. .</p> --}}
                    </div>
                    <a href="{{route('Admin.Category.add_Category')}}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Category</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>

                            {{-- @if ($message = Session::get('info'))
                            <strong>{{ $message }}</strong>
                            @endif --}}

                              @if (Session::has('message'))

                     <center> <div class="alert alert-primary" role="alert">
                    <div class="iq-alert-text">{{Session::get('message')}}</div>
                   </div>
                   </center>
                     @endif



                     @if (Session::has('delete'))

                     <center> <div class="alert alert-danger" role="alert">
                    <div class="iq-alert-text">{{Session::get('delete')}}</div>
                   </div>
                   </center>
                     @endif
                            <th>id</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">


                        @foreach ($Category as $key=>$Category)
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                    <label for="checkbox2" class="mb-0"></label>
                                </div>
                            </td>
                            <td>{{$key+1}} </td>
                            <td>{{$Category->Category}}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                        href=""><i class="ri-eye-line mr-0"></i></a>
                                    <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                        href="{{route('Admin.Category.edit_Category',$Category->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                        href="{{route('Admin.Category.destory',$Category->id)}}"><i class="ri-delete-bin-line mr-0"></i></a>
                                </div>
                            </td>
                        </tr>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
</x-admin-master>
