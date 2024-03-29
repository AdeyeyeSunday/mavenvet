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
                        <a href="{{ route('Admin.Clinic.Clinic_add_vaccine') }}"><button class="btn btn-primary">Add New Vaccin</button></a>
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
                                 <tr class="">
                                     {{-- <th>Image</th> --}}
                                    <th>Vaccine</th>
                                    <th>Cost</th>
                                    <th>selling Price</th>
                                    <th>New Qty</th>
                                    <th>Old Qty</th>
                                    <th>Expiry Date</th>
                                    <th>Supply date</th>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($vaccine as $vaccine)
                                <td>{{$vaccine->Name}}</td>
                                    <td>{{$vaccine->Cost}}</td>
                                    <td>{{$vaccine->Price}}</td>
                                    <td>{{$vaccine->new_supply}}</td>
                                    <td>{{$vaccine->Quantity}}</td>
                                    <td>{{$vaccine->expiry_date}}</td>
                                    <td>{{$vaccine->supply_date	}}</td>
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
