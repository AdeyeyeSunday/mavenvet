<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">





                        <div class="header-title">
                            <h6 style="color: green" class="card-title">Total Transfer:{{$tranfer}}</h6>
                         </div>


                         <div class="header-title">
                            <h6 style="color: black" class="card-title">Total Cash:{{$cash}}</h6>
                         </div>

                         <div class="header-title">
                            <h6 style="color:blue" class="card-title">Total Pos:{{$pos}}</h6>
                         </div>

                        <div class="header-title">
                           <h6 style="color: red" class="card-title">Grand Total: ₦ {{$amount}}</h6>
                        </div>




                        <div class="header-title">
                        <a href="{{route('Admin.Payment.due_payment')}}"><button class="btn btn-primary">Back</button></a>
                         </div>




                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <tr class="ligth">
                                        {{-- <th>Pet Name</th> --}}
                                       <th>Owner Name</th>
                                        {{-- <th>Phone No</th> --}}
                                        <th>Total bill</th>
                                        {{-- <th>Amount Paid</th> --}}
                                        <th>Balance</th>
                                        <th>Mode of Payment</th>
                                        <th>Grant Total</th>
                                        <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>




                                @foreach ($due_payment as $payment)
                                @if ($payment->due > 0)
                                {{-- <td>{{$payment->Pet_name}}</td> --}}
                                <td>{{$payment->Owner_name}}</td>
                                {{-- <td>{{$payment->Phone}}</td> --}}
                                <td>{{$payment->total_price}}</td>
                                {{-- <td>{{$payment->pay}}</td> --}}
                                <td> {{$payment->due}}</td>
                                <td>{{$payment->Mode_of_payment	}}</td>

                                <td>
                                    {{$payment->due+$payment->pay}}
                                 </td>

                                  <td>{{$payment->created_at->diffForHumans()}}</td>
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
