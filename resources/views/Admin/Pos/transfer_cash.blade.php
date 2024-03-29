<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Transfer/Cash Transaction</h6>
                    </div>

                    <div class="header-title">
                        <h6 style="color: green" class="card-title">Total Transfer:{{$amount}}</h6>
                     </div>


                     <div class="header-title">
                        <h6 style="color: green" class="card-title">Total Cash:{{$cash}}</h6>
                     </div>

                     <div class="header-title">
                        <h6 style="color:red" class="card-title">Grand Cash-Transfer Total :{{$cash+$amount}}</h6>
                     </div>


                 </div>
                 <div class="card-body">

                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="">
                                 <th>Id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount Charge</th>

                                <th>Cash</th>
                                <th>Transfer</th>
                                <th>Mode of Payment</th>
                             </tr>
                          </thead>
                          <tbody>
                              @foreach ($transfer_cash as $transfer_cash)

                             <tr>
                                <td>{{$transfer_cash->id}}</td>
                                <td>{{$transfer_cash->fname}}</td>
                                <td>{{$transfer_cash->phone}}</td>
                                <td>{{$transfer_cash->total_price}}</td>

                                <td>₦: {{$transfer_cash->pay}}</td>
                                <td>₦: {{$transfer_cash->cash_transfer}}</td>
                                <td>    @php
                                    if ( $transfer_cash->Mode_of_payment == 'Cash')
                                    echo   '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                       elseif ($transfer_cash->Mode_of_payment == 'Transfer')
                                        echo   ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                        elseif ($transfer_cash->Mode_of_payment == 'Pos')
                                        echo   ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';

                                        elseif ($transfer_cash->Mode_of_payment == 'cash_pos')
                                        echo   ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';

                                        elseif ($transfer_cash->Mode_of_payment == 'cash_transfer')
                                        echo   ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                   @endphp
                                   </td>
                             </tr>
                             @endforeach

                          </tbody>
                          <tfoot>
                             <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount Charge</th>

                                <th>Cash</th>
                                <th>Transfer</th>
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
