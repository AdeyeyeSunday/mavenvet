<x-admin-master>
    @section('content')

               <div class="container-fluid">
                <div class="row">
                   <div class="col-sm-12">
                      <div class="card">
                         <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                               <h6 class="card-title">Cash Transaction History</h6>
                            </div>

                            <div class="header-title">
                                <h6 class="card-title" style="color: green">Total amount: {{   number_format($amount, 2, '.', ',')}}</h6>
                             </div>

                            <div class="header-title">
                          <a href="{{ route('Admin.Payment.cash_report') }}"><button class="btn sidebar-bottom-btn btn-lg ">Back</button></a>
                             </div>
                         </div>
                         <div class="card-body">
                               <table id="datatable" class="table data-table table-striped">
                                  <thead>
                                     <tr class="ligth">
                                         <th>Id</th>
                                        <th>Customet Name</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($new as $cash)
                                     <tr>
                                         <td>{{$cash->id}}</td>
                                        <td>{{$cash->customer_name}}</td>
                                        <td>{{$cash->mode}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>{{$cash->date}}</td>
                                        <td>{{$cash->name}}</td>
                                     </tr>
                                     @endforeach
                                  </tbody>
                                  <tfoot>
                                     <tr>
                                        <th>Id</th>
                                        <th>Customet Name</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>

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



    @endsection
</x-admin-master>
