<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: red" class="card-title">Total Outstanding Payment: ₦ {{$amount}}</h6>
                        </div>





                        <div class="header-title">
                        <a href="{{route('Admin.Payment.Payment_list')}}"><button class="btn btn-primary">Back</button></a>
                         </div>



                        {{-- <center> <h4  style="color: red" class="card-title">Outstanding Payment: ₦ {{$Outstanding_Payment}}</h4></center> --}}
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <tr class="ligth">
                                        <th>Pet Name</th>
                                       
                                        <th>Phone No</th>
                                        <th>Total bill</th>
                                        <th>Amount Paid</th>
                                        <th>Outstanding</th>
<th>Date</th>

                                        
                                        <th>Action</th>
<th>View</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pay as $payment)
                                @if ($payment->due > 0)
                                <td> {{$payment->Unregister}}</td>
                           
                                <td>{{$payment->Phone}}</td>
                                <td>{{$payment->total_price}}</td>
                                <td>{{$payment->pay + $payment->new_due}}</td>
                                <td> {{$payment->due}}</td>
                                <td> {{$payment->date}}</td>

                                 

                                <td>
                                    <div class="d-flex align-items-center list-action">

                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="update payment"
                                            href="{{route('Admin.Payment.Payment_edit',$payment->id)}}"><i class="ri-pencil-line mr-0"></i></a>
                                    </div>
                                </td>


   <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal{{  $payment->id }}">
                                            View
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{  $payment->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Details</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
@foreach($payment->service_item as $payment)

                                                            <div class="modal-body">
                                                                <h6>Item: {{ $payment->prod_name }}</h6>
                                                                <h6>Qty:{{ $payment->qty }} </h6>
                                                                <h6>Price: {{ $payment->price }}</h6>
                                                                <h6>Total Amount: {{ $payment->price * $payment->qty }}</h6>
                                                                <h6>Service : {{ $payment->service }}</h6>
                                                                <h6>Amount: {{ $payment->Amount }}</h6>
                                                            </div>
 @endforeach



                                                  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                 </tr>
                                 @endif
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
