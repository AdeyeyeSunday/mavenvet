<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <th>#</th>
                                    {{-- <th>Name</th> --}}
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    {{-- <th>Date</th>
                                    <th>Month</th> --}}
                                    <th>Add</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($get as $key=> $item)
                             <tr>  <td>{{ $key+1 }}</td>
                                 <td>{{ $item->prod_name }}</td>
                                <td>{{ $item->qty }}</td>
                         <td><a href="{{route('Admin.Store.fatchonlineGood',$item->id)  }}"><button  class="btn btn-primary">Add</button></a></td>

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
        <form action="{{ route('Admin.Pos.storekseach') }}" enctype="multipart/form-data" method="post">
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
</div>
  </div>
 </div>
</div>

    @endsection
</x-admin-master>
