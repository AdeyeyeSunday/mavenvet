<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with date
                            </button>
                        </div>

                         <div class="header-title">
                          <a href="{{route('Admin.Payment.Payment_admin_outstanding')}}"> <h6 style="color: red" class="card-title">Oustanding Payment list</h6></a>
                         </div>

                           <div class="header-title">
                            <a href="{{ route('Admin.Payment.vaccine_report') }}"> <h6 style="color:#6495ED " class="card-title">Vaccine Payment List</h6></a>
                           </div>


                           <div class="header-title">
                            <h6 style="color: green"  class="card-title"> Cash: ₦:{{$cash+$cash_cash+$cash_cash_pos}}</h6>
                         </div>

                         <div class="header-title">
                            <h6 style="color: green"  class="card-title"> Transfer: ₦:{{$tranfer+$cash_transfer}} </h6>
                         </div>


                         <div class="header-title">
                            <h6 style="color: green"  class="card-title"> Pos: ₦:{{  $pos+$cash_pos}} </h6>
                         </div>

                         <div class="header-title">
                            <h6 style="color: red"  class="card-title">Today Grand Total: ₦:{{$amount+$tranfer+$pos+$cash_pos+$cash_cash+$cash_transfer+$cash_cash_pos}} </h6>
                         </div>
                     </div>

                     @if (Session::has('payment'))
                    <center> <div class="alert alert-success" role="alert">
                   <div class="iq-alert-text">{{Session::get('payment')}}</div>
                  </div>
                  </center>
                    @endif

                    @if (Session::has('due'))
                    <center> <div class="alert alert-success" role="alert">
                   <div class="iq-alert-text">{{Session::get('due')}}</div>
                  </div>
                  </center>
                    @endif

                    <div class="card-header d-flex justify-content-between">

                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <tr class="">
                                        <th>Name</th>
                                                <th>Total Bill</th>
                                                <th>Cash</th>
                                                <th>Pos</th>
                                                <th>Tranfer</th>
                                                <th>Due</th>
                                                <th>Bank</th>
                                                <th>Payment Mode</th>
                                                <th>Assinged</th>
                                                <th>Paid Debt</th>
                                                <th>Action</th>
                                    </tr>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pay as $daily)


                                @if ($daily->new_due > 0)
                                <td style="color: red">New due payment</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="badge badge-danger">
                                        {{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                </td>

                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal{{  $daily->id }}">
                                        View
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{  $daily->id }}" tabindex="-1"
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




@foreach($daily->service_item as $daily)

                                                <div class="modal-body">
                                                    <h6>Item: {{ $daily->prod_name }}</h6>
                                                    <h6>Qty:{{ $daily->qty }} </h6>
                                                    <h6>Price: {{ $daily->price }}</h6>

                                                    <h6>Service : {{ $daily->service }}</h6>
                                                    <h6>Amount: {{ $daily->Amount }}</h6>
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
                                @else
                                <td>{{ $daily->Pet_name }}{{ $daily->Unregister }}</td>
                                <td>{{ $daily->total_price }}</td>
                                <td>{{ $daily->pay }}</td>
                                <td>{{ $daily->cash_pos }}</td>
                                <td>{{ $daily->cash_transfer }}</td>
                                <td>{{ $daily->due }}</td>
                                <td>{{ $daily->bankName }}</td>
                                <td>
                                    @php
                                        if ($daily->Mode_of_payment == 'Cash') {
                                            echo '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                        } elseif ($daily->Mode_of_payment == 'Transfer') {
                                            echo ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                        } elseif ($daily->Mode_of_payment == 'Pos') {
                                            echo ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';
                                        } elseif ($daily->Mode_of_payment == 'cash_pos') {
                                            echo ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';
                                        } elseif ($daily->Mode_of_payment == 'cash_transfer') {
                                            echo ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                        }
                                    @endphp
                                </td>

                                <td>Dr. {{ $daily->user->name }}</td>

                                <td>
                                    <span class="badge badge-danger">
                                        {{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal{{  $daily->id }}">
                                        View
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{  $daily->id }}" tabindex="-1"
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
                                             @foreach($daily->service_item as $daily)

                                                <div class="modal-body">
                                                    <h6>Item: {{ $daily->prod_name }}</h6>
                                                    <h6>Qty:{{ $daily->qty }} </h6>
                                                    <h6>Price: {{ $daily->price }}</h6>
                                                    <h6>Total Amount: {{ $daily->price * $daily->qty }}</h6>
                                                    <h6>Service : {{ $daily->service }}</h6>
                                                    <h6>Amount: {{ $daily->Amount }}</h6>
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
                                @endif
                            </tbody>
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

       <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
               <h5 class="modal-title" style="margin-left: 150px" id="exampleModalScrollableTitle"> </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                 </button>
              </div>

               <div class="col-lg-12">
                <form action="{{ route('Admin.Pos.payment_search') }}" enctype="multipart/form-data" method="post">
               @csrf
              <div class="form-row">
                 <div class="col-md-6">
                <label for="validationDefault02">Search Date</label>
                   <input type="date" class="form-control" name="from" id="date">
                 </div>
          </div>
              <br><br>
             <center> <button type="submit" class="btn btn-primary">Search</button></center>
           </form>
           <br>
       </div>
  </div>
</div>
</div>
    @endsection
</x-admin-master>
