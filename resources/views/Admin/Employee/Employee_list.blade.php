<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: seagreen" class="card-title">Personal Information</h6>
                           {{-- <h3></h3> --}}
                        </div>
                     </div>

                     @if (Session::has('message'))
                     <center> <div class="alert alert-primary" role="alert">
                    <div class="iq-alert-text">{{Session::get('message')}}</div>
                   </div>
                   </center>
                     @endif
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    {{-- <th>Image</th> --}}
                                    <th>Name</th>
                                    <th>Phone no</th>
                                    <th>Address</th>
                                    <th>email</th>
                                    <th>Position</th>
                                    <th>Sex</th>
                                    <th>Generate Id</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($employee as $employee)
                                 {{-- <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$employee->image)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                        </div>
                                    </div>
                                </td> --}}
                                <td> {{$employee->Title}} {{$employee->user->name}}</td>
                                <td> {{$employee->number}}</td>
                                <td> {{$employee->address}}</td>
                                <td> {{$employee->email}}</td>
                                <td>{{$employee->position}}</td>
                                <td>{{$employee->gender}}</td>
                                <td><a href="{{route('Admin.Employee.Employee_view',$employee->id)}}">
                                    <button type="button" class="btn btn-primary btn-sm mr-2"> Id Card</button></a></td>

                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            {{-- <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href=""><i class="ri-eye-line mr-0"></i></a> --}}

                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{route('Admin.Employee.Employee_edit',$employee->id)}}"><i class="ri-pencil-line mr-0"></i></a>


                                        </div>
                                    </td>
                                 </tr>


                                @endforeach
                              </tbody>

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
