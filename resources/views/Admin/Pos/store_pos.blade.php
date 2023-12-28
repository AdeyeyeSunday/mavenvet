<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title"> Pos Report</h4>
                        </div>
                        <div class="header-title">
                            <h6 style="color: green"  class="card-title">Total Pos :{{$amount}} </h6>
                         </div>

                         <div class="header-title">
                            <a href="{{ route('Admin.Pos.sales_history') }}"><button class="btn btn-primary">Back</button></a>
                           </div>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                     <th>Id</th>
                                     <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    {{-- <th>Due</th> --}}
                                    <th>Payment Mode</th>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($daily  as $daily )
                                     <td>{{$daily->id}}</td>
                                    <td>{{$daily->fname}}</td>
                                    <td>{{$daily->phone}}</td>
                                    <td>{{$daily->address}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->cash_pos}}</td>
                                    {{-- <td>{{$daily->due}}</td> --}}
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
