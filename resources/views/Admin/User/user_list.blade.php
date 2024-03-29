<x-admin-master>
    @section('content')

 <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h6 class="card-title">User Table</h6>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                           <thead>
                              <tr class="">
                                 <th>Id</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                  <th>Created At</th>
                                 <th>Last Update</th>
                                  <th>Role</th>
                                 <th>Delete</th>
                              </tr>
                           </thead>
                           <tbody>
                           @foreach ($user_list as $user_list)
                              <tr>
                              <td>{{$user_list->id}}</td>
                                 <td>{{$user_list->name}}</td>
                                 <td>{{$user_list->email}}</td>
                                 <td>{{$user_list->created_at->diffForHumans()}}</td>
                                 <td>Last {{$user_list->updated_at->diffForHumans()}}</td>
                                    <th>
                                     <a href="{{route('Admin.User.role_edit',$user_list->id)}}"><button class="btn btn-primary">Role</button></a>
                                    </th>
                                 <td>
                            <button class="btn btn-danger">Delete</button>
                                 </td>

                              </tr>
                              @endforeach

                        </table>
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
