<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 style="color: seagreen" class="card-title">Mavenvet Pending  </h6>
                        </div>
                        <center> <h6  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h6></center>
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
                                    <th>Invoice</th>
                                    @if (auth()->user()->userHasRole('Admin'))
                                    <th>Delete</th>
                                    @endif

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pending as $pos_view)
                                 <td>{{$pos_view->Pet_name}}{{$pos_view->Unregister}} </td>
                                <td>{{$pos_view->Phone}}</td>
                                <td><button type="button" class="btn btn-danger btn-sm mr-2">{{$pos_view->order_status}}</button></td>
                                <td>{{$pos_view->date}}</td>
                                <td>
                                   <a href="{{route('Admin.Payment.payment_invoice',$pos_view->id)}}"><button type="button" class="btn btn-primary btn-sm mr-2">Invoice</button></a>
                                 </td>

                                <td>
                                    @if (auth()->user()->userHasRole('Admin') || auth()->user()->userHasRole('Manager'))
                                    <a href="{{ route('Admin.Payment.payment_invoice_delete',$pos_view->id) }}" class="btn btn-danger">Delete</a>
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
