<x-admin-master>
    @section('content')


  <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-8">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> Update Information</h4>
                     </div>
                  </div>
                  <div class="card-body">

                       <form action="{{route('Admin.User.role_update',$user->id)}}" id="form1" class="form-horizontal"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                        <div class="form-row">
                           <div class="col-md-6 mb-3">
                              <label for="validationDefault01">Name</label>
                              <input type="text" name="name" value="{{$user->name}}" class="form-control" id="validationDefault01" required>
                           </div>
                           <div class="col-md-6 mb-3">
                              <label for="validationDefault02">Email</label>
                              <input type="text" name="email" value="{{$user->email}}" class="form-control" id="validationDefault02" required>
                           </div>
                        </div>

                        <div class="form-group">
                           <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                     </form>
                  </div>
               </div>

</div> <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title"> Roles</h4>
                     </div>
                  </div>


                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                           <thead>
                              <tr class="">

                                 <th>Id</th>
                                 <th>Name</th>
                                 <th>Slug</th>
                                  <th>Attach</th>
                                   <th>Detach</th>
                              </tr>
                           </thead>
                           <tbody>

                           @foreach ($role as $role)
                              {{-- </td> --}}
                                 <td>{{$role->id}}</td>
                                 <td>{{$role->name}}</td>
                                 <td>{{$role->slug}}</td>
                                 <td>
                                   <form action="{{route('admin.role.attach',$user->id)}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            @method('PATCH')
                                         <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-primary
                                        @if ($user->roles->contains($role))
                                        disabled
                                        @endif
                                        ">Attach</button>
                                    </form>
                                 </td>
                                    <td>



                                  <form action="{{route('admin.role.detach',$user->id)}}" method="post" enctype="multipart/form-data" >
                                  @csrf

                                     @method('PATCH')
                                     <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger
                                        @if (!$user->roles->contains($role))
                                        disabled   @endif ">Detach</button>

                                </td>

                              </tr>

                            </form>

                              @endforeach
                        </table>
                  </div>
               </div>
            </div>

         </div>
      </div>
      </div>
    </div>





    @endsection
</x-admin-master>
