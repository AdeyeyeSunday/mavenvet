d<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       {{-- <h4 class="card-title">Bootstrap Datatables</h4> --}}
                    </div>
                 </div>
                 <div class="card-body">
                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="ligth">
                                  <th>Id</th> 
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Item</th>
<th>Date</th>
                                
                               
                                    {{-- <th>view</th> --}}
                             </tr>
                          </thead>
                          <tbody>

                            @foreach ($store_view_details as $key=> $get)
                             <tr>

				<td>{{$key+1}}</td>
                                <td>{{$get->prod_name}} </td>
                                <td>{{$get->status}}</td>
                                <td>{{$get->qty}}</td>
                                 <td>{{$get->date}}</td>
                                
                                
                             </tr>



                             @endforeach
                          </tbody>
                          <tfoot>
                             <tr>
<th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Item</th>
                                <th>Date</th>
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
