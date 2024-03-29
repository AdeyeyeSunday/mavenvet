<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Pos/Cash Transaction</h6>
                    </div>


                    <div class="header-title">
                        <h6 style="color: green" class="card-title">Total Pos:{{$amount}}</h6>
                     </div>


                     <div class="header-title">
                        <h6 style="color: green" class="card-title">Total Cash:{{$cash}}</h6>
                     </div>

                     <div class="header-title">
                        <h6 style="color:red" class="card-title">Grand Pos-Cash Total :{{$cash+$amount}}</h6>
                     </div>
                 </div>
                 <div class="card-body">

                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="">
                                 {{-- <th>Id</th> --}}
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount Charge</th>
                                <th>Cash</th>
                                <th>Pos</th>
                                <th>Mode of Payment</th>
                             </tr>
                          </thead>
                          <tbody>
                              @foreach ($pos_cash as $pos_cash)
                             <tr>
                                {{-- <td>{{$pos_cash->id}}</td> --}}
                                <td>{{$pos_cash->fname}}</td>
                                <td>{{$pos_cash->phone}}</td>
                                <td>{{$pos_cash->total_price}}</td>
                                {{-- <td>{{$pos_cash->Mode_of_payment}}</td> --}}
                                <td> {{$pos_cash->pay}}</td>
                                <td> {{$pos_cash->cash_pos}}</td>

                                <td>    @php
                                    if ( $pos_cash->Mode_of_payment == 'Cash')
                                    echo   '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                       elseif ($pos_cash->Mode_of_payment == 'Transfer')
                                        echo   ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                        elseif ($pos_cash->Mode_of_payment == 'Pos')
                                        echo   ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';

                                        elseif ($pos_cash->Mode_of_payment == 'cash_pos')
                                        echo   ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';

                                        elseif ($pos_cash->Mode_of_payment == 'cash_transfer')
                                        echo   ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                   @endphp
                                   </td>
                             </tr>
                             @endforeach

                          </tbody>
                          <tfoot>
                             <tr>
                                {{-- <th>Id</th> --}}
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount Charge</th>
                                <th>Cash</th>
                                <th>Pos</th>
                                <th>Mode of Payment</th>
                             </tr>
                          </tfoot>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     </div>
   </div>
   <!-- Wrapper End-->

    @endsection
</x-admin-master>
