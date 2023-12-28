<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title">Pet Case Note</h6>
                        </div>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                     <th>Image</th>
                                    <th>Owner Name</th>
                                    <th>Phone No</th>
                                    <th>Color</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Veterinarian</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($Casenote_list  as $Casenote_list )
                                 <td>

                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$Casenote_list->clinic->pic)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            {{$Casenote_list->clinic->Pet_name}}
                                            <p class="mb-0"><small>This is {{$Casenote_list->clinic->Breed}} </small></p>
                                        </div>
                                    </div>
                                </td>
                                    <td>{{$Casenote_list->clinic->Name_Of_Pet_Owner}}</td>
                                    <td>{{$Casenote_list->clinic->Owner_Phone_Number}}</td>
                                    <td>{{$Casenote_list->clinic->Color}}</td>
                                    <td>{{$Casenote_list->clinic->Age}}</td>
                                    <td>{{$Casenote_list->clinic->date}}</td>
                                    <td>{{$Casenote_list->clinic->Veterinarian}}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Casenote.Casenote_view',$Casenote_list->case_id)}}"><i class="ri-eye-line mr-0"></i></a>
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow up"
                                                href="{{route('Admin.Casenote.Casenote_edit',$Casenote_list->case_id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href=""><i class="ri-delete-bin-line mr-0"></i></a>
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
