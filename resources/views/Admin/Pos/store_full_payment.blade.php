<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Report</h4>
                        </div>
                        <div class="header-title">
                            <h6 style="color: green"  class="card-title">Today Sales Total:{{$amount}} </h6>
                         </div>

                        <div class="header-title">
                            <h6 style="color: red" class="card-title">Today Due Total:{{$amount_due}} </h6>
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
                                    <th>Due</th>
                                    <th>Payment Mode</th>
                                    {{-- <th>Action</th> --}}
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($daily  as $daily )
                                     <td>{{$daily->id}}</td>
                                    <td>{{$daily->fname}}</td>
                                    <td>{{$daily->phone}}</td>
                                    <td>{{$daily->address}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->pay}}</td>
                                    <td>{{$daily->due}}</td>
                                    <td>{{$daily->Mode_of_payment}}</td>
                                    {{-- <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow up"
                                                href=""><i class="ri-pencil-line mr-0"></i></a>

                                        </div>
                                    </td> --}}
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
