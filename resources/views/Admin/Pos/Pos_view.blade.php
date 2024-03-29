<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 style="color: seagreen" class="card-title">Mavenvet Pos  </h4>
                        </div>
                        <center> <h4  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h4></center>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Tracking No</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>view</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pos_view as $pos_view)
                                 <td>{{$pos_view->fname}} </td>
                                <td>{{$pos_view->phone}}</td>
                                <td>Mavenvet{{$pos_view->trackking_id}}</td>
                                <td><button type="button" class="btn btn-danger btn-sm mr-2">{{$pos_view->order_status}}</button></td>
                                <td>{{$pos_view->order_date}}</td>
                                <td>
                                   <a href="{{route('Admin.Pos.Pos_invoice',$pos_view->id)}}"><button type="button" class="btn btn-primary btn-sm mr-2">Invoice</button></a>
                                </td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Pos.Pos_invoice_view',$pos_view->id)}}"><i class="ri-eye-line mr-0"></i></a>
                                        </div>
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
