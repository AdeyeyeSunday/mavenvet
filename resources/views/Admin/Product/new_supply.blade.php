<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">New product list</h4>
                        <p class="mb-0">The product list effectively dictates product presentation and provides space<br> to list your products and offering in the most appealing way.</p>
                        <button type="button" class="btn sidebar-bottom-btn btn-lg" data-toggle="modal" data-target="#exampleModalScrollable">Search with date
                        </button>
                    </div>

                    <a href="{{route('Admin.Product.add_product')}}" class="btn sidebar-bottom-btn btn-lg "><i class="las la-plus mr-3"></i>Add product</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white">
                        <tr class="">
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>New quantity</th>
                            <th>Expiry date</th>
                              <th>Date</th>
                        </tr>
                    </thead>
                    <tbody >

                        @foreach ($new as $key=>$new)
                        <tr>


<td>{{$key+1}}</td>
                            <td>{{$new->Name}}</td>
                            <td>{{$new->Cost}}</td>
                            <td>{{$new->Price}}</td>

                            <td>{{$new->new_supply}}</td>
                            <td>{{$new->expiry_date}}</td>
                            <td>{{$new->new_date}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        <form action="{{ route('Admin.Pos.newproduct_supply') }}" enctype="multipart/form-data" method="post">
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
