<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title">Today Items Report </h6>
                        </div>

                  <a href="{{ route('Admin.Pos.today_items') }}"><button class="btn btn-primary">Back</button></a>
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
<th></th>
                                     <th>Item</th>
                                     <th>Qty</th>
                                     <th>Price</th>
                                    <th>Assigned</th>

                                 </tr>
                              </thead>
                              <tbody>


                                @foreach ($search  as $daily )
                                <td>{{$daily->id}}</td>
                                       <td>{{$daily->prod_id}}</td>
                                       <td>{{$daily->total_quantity}}</td>
                                       <td>{{$daily->price*$daily->total_quantity}}</td>
                                       <td>{{$daily->user->name}}</td>


                                       <td>


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
