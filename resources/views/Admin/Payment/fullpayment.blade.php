<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 style="color: seagreen" class="card-title">All full Payment: ₦ {{$amount}}</h4>
                        </div>

                        {{-- <center> <h4  style="color: red" class="card-title">Outstanding Payment: ₦ {{$Outstanding_Payment}}</h4></center> --}}
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <th>Image</th>
                                    <th>Owner Name</th>
                                    <th>Phone No</th>
                                    <th>Amount</th>
                                    <th>Outstanding</th>
                                    <th>Veterinarian</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                                @foreach ($payment as $payment)
                                 <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$payment->clinic->pic)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            {{$payment->clinic->Pet_name}}
                                            <p class="mb-0"><small>This is {{$payment->clinic->Pet_name}}  </small></p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$payment->clinic->Name_Of_Pet_Owner}}</td>
                                <td>{{$payment->clinic->Owner_Phone_Number}}</td>
                                <td>{{$payment->Amount_Paid}}</td>
                                <td>{{$payment->Outstanding_Payment	}}</td>
                                <td>{{$payment->Veterinarian}}</td>

                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href=""><i class="ri-eye-line mr-0"></i></a>

                                            {{-- <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                                href=""><i class="ri-pencil-line mr-0"></i></a> --}}

                                            {{-- <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                href="#"><i class="ri-delete-bin-line mr-0"></i></a> --}}
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
