<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 class="card-title">Due Report</h6>
                        </div>
                         <div class="header-title">
                          <a href="{{ route('Admin.Pos.balance') }}"><h6 style="color: blue" class="card-title">Paid Debts</h6></a>
                         </div>

                        <div class="header-title">
                            <h6 style="color: red" class="card-title">Due Total:{{$amount}}</h6>
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
                                    <th>Payment Type</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($daily  as $daily )
                                @if( $daily->due > 0)
                                <td>{{$daily->id}}</td>
                                    <td>{{$daily->fname}}</td>
                                    <td>{{$daily->phone}}</td>
                                    <td>{{$daily->address}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->pay}}</td>
                                    <td>{{$daily->due}}</td>
                                    <td>{{$daily->Payment_type}}</td>
                                    <td>



                                            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$daily->id}}">
    View
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$daily->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <h6 class="mb-0"> Items : {{$daily->orderIteams[0]->prod_id}}</h6>
            </p>

                            Qty : {{$daily->orderIteams[0]->qty}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

                                        </td>
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

    @endsection
</x-admin-master>
