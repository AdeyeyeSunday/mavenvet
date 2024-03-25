<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <button type="button" class="btn sidebar-bottom-btn btn-lg" data-toggle="modal" data-target="#exampleModalScrollable">Search with Date
                            </button>
                            </div>
                        <center> <h6  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h6></center>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                <tr class="ligth">

                                   <th>Transaction Details</th>
                                   <th>Mode</th>
                                   <th>Amount</th>
                                   <th>Date</th>
                                   <th>Action</th>

                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($bank_deposit as $cash)
                                     <tr>
                                         {{-- <td>{{$cash->id}}</td> --}}
                                        <td>{{$cash->customer_name}}</td>
                                        <td>{{$cash->mode}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>{{$cash->date}}</td>
                                        <td>{{$cash->name}}</td>
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
        <form action="{{ route('Admin.Payment.bank_deposit_search') }}" enctype="multipart/form-data" method="post">
               @csrf

              <div class="form-row">
                 <div class="col-md-6">
                <label for="validationDefault02">Pick a date</label>
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
