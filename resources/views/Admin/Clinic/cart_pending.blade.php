<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: seagreen" class="card-title">Mavenvet Special Vaccine Pos  </h6>
                        </div>
{{--
                        <div class="header-title">
                            <h6 style="color: seagreen" class="card-title">Total Full Payment:  </h6>
                         </div> --}}


                         <div class="header-title">
                            <h6 style="color: red" class="card-title">Total Oustanding:{{$amount}}</h6>
                         </div>


                        <div class="header-title">
                          <a href="{{route('Admin.Payment.Payment_list')}}"> <button class="btn btn-primary">Back</button></a>
                         </div>

                        {{-- <center> <h4  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h4></center> --}}
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Update  Payment Record</th>
                                    @if (auth()->user()->userHasRole('Admin'))
                                    <th>Delete</th>
                                    @endif
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($cart_pending as $cart_pending)
                                 <td>{{$cart_pending->name}} </td>
                                <td>{{$cart_pending->phone}}</td>
                                <td><button type="button" class="btn btn-danger btn-sm mr-2">{{$cart_pending->order_status}}</button></td>
                                <td>{{$cart_pending->date}}</td>

                                <td>
                                   <a href="{{route('Admin.Clinic.Clinic_inventory_invoice',$cart_pending->id)}}"><button type="button" class="btn btn-primary btn-sm mr-2">Update  Payment Record</button></a>
                                </td>
                                    <td>
                                        @if (auth()->user()->userHasRole('Admin') || auth()->user()->userHasRole('Manager') )
                                        <div class="d-flex align-items-center list-action">
                                          <a href="{{ route('Admin.Clinic.destory_pending',$cart_pending->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                        @endif
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
