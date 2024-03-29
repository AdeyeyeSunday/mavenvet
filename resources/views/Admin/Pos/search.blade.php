<x-admin-master>

    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">


                        </div>
                        <div class="header-title">
                        <a href="{{ route('Admin.Pos.store_cash') }}">  <h6 style="color: green"  class="card-title"> Cash: ₦: {{   $cash+$cash_cash_pos+$cash_cash +$new_cash  }}</h6></a>
                         </div>

                         <div class="header-title">
                         <a href="{{ route('Admin.Pos.store_transfer') }}"> <h6 style="color: green"  class="card-title"> Transfer:{{ $tranfer+$cash_transfer + $new_transfer }} </h6></a>
                         </div>


                         <div class="header-title">
                       <a href="{{ route('Admin.Pos.store_pos') }}"><h6 style="color: green"  class="card-title"> Pos: {{ $pos+$cash_pos+$new_pos }} </h6></a>
                         </div>

                         <div class="header-title">
                            <h6 style="color: red"  class="card-title">Today Grand Total: ₦:{{$cash + $tranfer + $pos + $cash_transfer + $cash_cash + $cash_pos + $cash_cash_pos + $new_transfer + $new_pos + $new_cash}} </h6>
                         </div>

                         <div class="header-title">
                          <a href="{{ route('Admin.Pos.sales_history') }}"> <button class="btn btn-primary">Back</button></a>
                         </div>

                     </div>

                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">

                              <thead>

                                 <tr class="">
                                     <th>Id</th>
                                     <th>Name</th>
                                      <th>Total Bill</th>
                                     <th>Cash</th>
                                    <th>Pos</th>
                                    <th>Tranfer</th>
                                    <th>Due</th>
                                    <th>Bank</th>
                                    <th>Payment Mode</th>
                                    <th>Date</th>
<th>View</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($search  as $daily )
                                     <td>{{$daily->id}}</td>
                                    <td>{{$daily->fname}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->pay}}</td>
                                    <td>{{$daily->cash_pos}}</td>
                                    <td>{{$daily->cash_transfer}}</td>
                                    <td>{{$daily->due}}</td>
                                    <td>{{ $daily->bankName }}</td>
                                    <td>    @php
                                        if ( $daily->Mode_of_payment == 'Cash')
                                        echo   '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                           elseif ($daily->Mode_of_payment == 'Transfer')
                                            echo   ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                            elseif ($daily->Mode_of_payment == 'Pos')
                                            echo   ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';

                                            elseif ($daily->Mode_of_payment == 'cash_pos')
                                            echo   ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';

                                            elseif ($daily->Mode_of_payment == 'cash_transfer')
                                            echo   ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                       @endphp
                                       </td>
                                       <td>{{$daily->date}}</td>
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
	                                                             @foreach($daily->orderIteams as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item:{{$daily->prod_id}}</h6>
                                                                        <h6>Item:{{$daily->qty}}</h6>
                                                                    </div>
                                                                    @endforeach
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    {{-- <div class="d-flex align-items-center list-action">
                                                        <a class="badge badge-info mr-2" data-toggle="tooltip"
                                                            data-placement="top" title="" data-original-title="View"
                                                            href="{{ route('Admin.Pos.daily_sales_view', $daily->id) }}"><i
                                                                class="ri-eye-line mr-0"></i></a>
                                                    </div> --}}
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
        <form action="{{ route('Admin.search.search') }}" enctype="multipart/form-data" method="post">
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
</div>
  </div>
 </div>
</div>

    @endsection
</x-admin-master>
