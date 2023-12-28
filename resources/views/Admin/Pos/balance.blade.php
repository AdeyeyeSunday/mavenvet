<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title"> Update Due Report</h6>
                        </div>



                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with Date
                        </button>

                        <div class="header-title">
                            <a href="{{ route('Admin.Pos.store_cash') }}">  <h6 style="color: green"  class="card-title"> Cash: ₦:{{ $cash }}</h6></a>
                             </div>

                             <div class="header-title">
                             <a href="{{ route('Admin.Pos.store_transfer') }}"> <h6 style="color: green"  class="card-title"> Transfer: ₦:{{ $tranfer }} </h6></a>
                             </div>


                             <div class="header-title">
                           <a href="{{ route('Admin.Pos.store_pos') }}"><h6 style="color: green"  class="card-title"> Pos: ₦:{{ $pos }} </h6></a>
                             </div>



                        <div class="header-title">
                            <h6 style="color: blue" class="card-title">New Due Payment Update List Total:{{$amount}}</h6>
                         </div>
                     </div>
                     <div class="card-body">


                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                     <th>Id</th>
                                     <th>Name</th>
                                    <th>Mode of Payment</th>
                                     {{-- <th>Address</th> --}}
                                    <th>Total</th>
                                    {{-- <th>Payment</th> --}}
                                    <th>Paid</th>
                                    <th>Payment Type</th>
                                    <th>Total</th>
                                    <th>Outstanding</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($balance  as $daily )
                                @if( $daily->due > 0)
                                <td>{{$daily->id}}</td>
                                    <td>{{$daily->fname}}</td>
                                    <td>{{$daily->Mode_of_payment}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->due}}</td>
                                    <td>{{$daily->Payment_type}}</td>
                                     <td>{{$daily->due + $daily->pay}}</td>
                                     <td>{{ $daily->total_price-$daily->due-$daily->pay }}</td>
                                     <td>{{$daily->created_at->diffForHumans() }}</td>
                                    {{-- <td>
                                        <div class="d-flex align-items-center list-action">

                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Follow up"
                                                href=""><i class="ri-pencil-line mr-0"></i></a>

                                        </div>
                                    </td> --}}
                                 </tr>
                              </tbody>
                              @endif
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
        <form action="{{ route('Admin.Pos.search_dubts') }}" enctype="multipart/form-data" method="post">
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
