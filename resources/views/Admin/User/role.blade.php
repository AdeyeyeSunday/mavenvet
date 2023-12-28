<x-admin-master>
    @section('content')


    <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-4">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h6 class="card-title"> Add Role</h6>
                     </div>
                  </div>
                  <div class="card-body">

                      <form action="{{route('Admin.User.role_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                           <div class="col-md-12 mb-3">
                              <label for="validationDefault01">Role</label>
                              <input type="text" name="name" class="form-control" id="validationDefault01" required>
                           </div>
                     </div>
                        <div class="form-group">
                           <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                     </form>
                  </div>
               </div>

            </div>
            <div class="col-sm-12 col-lg-8">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h6 class="card-title">Roles Table</h6>
                     </div>
                  </div>
                  <div class="card-body">




                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                           <thead>
                              <tr class="ligth">
                                 <th>Id</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                  <th>Delete</th>
                              </tr>
                           </thead>
                           <tbody>

                           @foreach ($role as $role)
                              <tr class="ligth">
                                 <td>{{$role->id}}</td>
                                 <td>{{$role->name}}</td>
                                 <td>{{$role->slug}}</td>
                                 <td>
                                     <form action="{{ route('Admin.User.destory',$role->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                 <button class="btn btn-danger">Delete</button>
                                </form>
                                 </td>
                              </tr>
                           @endforeach
                           <tfoot>
                              <tr>
                                 <th>Id</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                 <th>Delete</th>
                              </tr>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
    </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
      </div>
    </div>

    @endsection
</x-admin-master>
