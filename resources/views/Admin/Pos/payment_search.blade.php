<x-admin-master>
    @section('content')

         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">


                        <div class="header-title">
                            <h6 style="color: green" class="card-title"> Cash:
                                ₦:{{ $cash + $cash_cash + $cash_cash_pos + $new_cash }}</h6>
                        </div>

                        <div class="header-title">
                            <h6 style="color: green" class="card-title"> Transfer:
                                ₦:{{ $tranfer + $cash_transfer + $new_transfer }}
                            </h6>
                        </div>


                        <div class="header-title">
                            <h6 style="color: green" class="card-title"> Pos: ₦:{{ $pos + $cash_pos + $new_pos }}
                            </h6>
                        </div>

                        <div class="header-title">
                            <h6 style="color: red" class="card-title">Today Grand Total:
                                ₦:{{ $cash +$tranfer +$pos +$cash_transfer +$cash_cash +$cash_pos +$cash_cash_pos +$new_transfer +$new_pos +$new_cash }}
                            </h6>
                        </div>
                         <div class="header-title">
                           <a href="{{ route('Admin.Payment.Account_cash') }}"> <button class="btn btn-primary">Back</button></a>
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
                                 <tr class="ligth">
                                    <tr class="ligth">
                                        {{-- <th>Id</th> --}}
                                        <th>Name</th>
                                        <th>Total Bill</th>
                                        <th>Cash</th>
                                       <th>Pos</th>
                                       <th>Tranfer</th>
                                       <th>Due</th>
                                       <th>Payment Mode</th>
                                       <th>Assinged</th>
                                    </tr>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pay  as $daily )
                                <td>{{$daily->Pet_name}} {{$daily->Unregister}}</td>
                               {{-- <td>{{$daily->fname}}</td> --}}
                               <td>{{$daily->total_price}}</td>
                               <td>{{$daily->pay}}</td>
                               <td>{{$daily->cash_pos}}</td>
                               <td>{{$daily->cash_transfer}}</td>
                               <td>{{$daily->due}}</td>
                               <td>  @php
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
                               @endphp</td>
                               <th>{{$daily->user->name}}</th>
                            </tr>
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

</div>
    @endsection
</x-admin-master>
