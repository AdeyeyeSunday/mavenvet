<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title">Registration List</h6>
                        </div>


                        <div class="header-title">
                           <a href="{{route('Admin.Clinic.Clinic')}}"><button class="btn btn-primary">Add New Pet</button></a>
                         </div>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                     {{-- <th>Image</th> --}}
                                    <th>Pet Owner</th>
                                    <th>Phone No</th>
                                    <th>Color</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Veterinarian</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($clinic as $clinic)
                                 <td>

                                    {{-- <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$clinic->pic)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div> --}}
                                            {{$clinic->Pet_name}}
                                            <p class="mb-0"><small>This is {{$clinic->Breed}} </small></p>
                                        </div>
                                    </div>
                                </td>
                                    <td>{{$clinic->Name_Of_Pet_Owner}}</td>
                                    <td>{{$clinic->Owner_Phone_Number}}</td>
                                    <td>{{$clinic->Color}}</td>
                                    <td>{{$clinic->Age}}</td>
                                    <td>{{$clinic->date}}</td>
                                    <td>{{$clinic->Veterinarian}}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Clinic.Clinic_view',$clinic->id)}}"><i class="ri-eye-line mr-0"></i></a>
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{route('Admin.Clinic.Clinic_edit',$clinic->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="{{route('Admin.Clinic.destory',$clinic->id)}}"><i class="ri-delete-bin-line mr-0"></i></a>
                                        </div>
                                    </td>
                                 </tr>
                              </tbody>
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
