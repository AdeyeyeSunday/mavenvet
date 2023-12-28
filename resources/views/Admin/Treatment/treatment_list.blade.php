<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Vaccination Record</h4>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <th>Image</th>
                                    <th>Owner Name</th>
                                    <th>Vaccine</th>
                                    <th>Vaccination Appointment</th>
                                    <th>Next Appointments</th>
                                    <th>Veterinarian</th>
                                    {{-- <th>Case Note</th> --}}
                                    {{-- <th>Status</th> --}}
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                                @foreach ($treatment as $treatment)
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$treatment->clinic->pic)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            {{$treatment->clinic->Pet_name}}
                                            <p class="mb-0"><small>This is {{$treatment->clinic->Breed}} </small></p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$treatment->clinic->Name_Of_Pet_Owner}}</td>
                                    <td>{{$treatment->Diagnosis_Test}}</td>
                                    <td>{{$treatment->Next_Vaccination_Appointment}}</td>
                                    <td>{{$treatment->Next_Appointments}}</td>
                                    <td>{{$treatment->Veterinarian}}</td>
                                    {{-- <td><a href="{{route('Admin.Treatment.Treatment_case_note',$treatment->id)}}" class="btn btn-primary">Case Note</a></td> --}}
                                    {{-- <td>{{$treatment->Status}}</td> --}}
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Treatment.Treatment_view',$treatment->id)}}"><i class="ri-eye-line mr-0"></i></a>

                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href="{{route('Admin.Treatment.Treatment_edit',$treatment->id)}}"><i class="ri-pencil-line mr-0"></i></a>

                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="#"><i class="ri-delete-bin-line mr-0"></i></a>
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
