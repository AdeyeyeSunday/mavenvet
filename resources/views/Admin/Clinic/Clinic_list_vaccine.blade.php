<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title">Vaccine List</h6>
                        </div>
                @if (auth()->user()->userHasRole('Admin'))
                        <div class="header-title">
                        <a href="{{ route('Admin.Clinic.Clinic_add_vaccine') }}"><button class="btn sidebar-bottom-btn mt-4 btn-lg">Add new vaccin</button></a>
                         </div>
                     </div>
                     @endif
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
                                 <tr class="ligth">
                                     {{-- <th>Image</th> --}}
                                    <th>Vaccine</th>
                                    <th>Brand</th>
                                    <th>supplier</th>
                                    <th>Cost</th>
                                    <th>selling Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                    <th>Supply date</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($vaccine as $vaccine)
                                 {{-- <td>

                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$vaccine->Image)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                     </div>
                                </td> --}}
                                <td>{{$vaccine->Name}}</td>
                                <td>{{$vaccine->brand}}</td>
                                    <td>{{$vaccine->supplier}}</td>
                                    <td>{{$vaccine->Cost}}</td>
                                    <td>{{$vaccine->Price}}</td>
                                    <td>{{$vaccine->Quantity}}</td>
                                    <td>{{$vaccine->expiry_date}}</td>
                                    <td>{{$vaccine->supply_date	}}</td>
                                    {{-- <td>{{$vaccine->Veterinarian}}</td> --}}
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="update vaccine"
                                                href="{{route('Admin.Clinic.Clinic_edit_vaccine',$vaccine->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                            {{-- <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="{{route('Admin.Clinic.destory',$clinic->id)}}"><i class="ri-delete-bin-line mr-0"></i></a> --}}
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
