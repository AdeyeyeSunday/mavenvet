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

                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with date
                        </button>



                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
<th></th>
                                     <th>Item</th>
                                     <th>Qty</th>
                                     <th>Price</th>
                                    <th>Assigned</th>

                                 </tr>
                              </thead>
                              <tbody>


                                @foreach ($today_items  as $daily )
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
                <form action="{{ route('Admin.Pos.today_search') }}" enctype="multipart/form-data" method="post">
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
    @endsection
</x-admin-master>
