<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h6 style="color: seagreen" class="card-title">Mavenvet Pos  </h6>
                        </div>
                        <center> <h6  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h6></center>
                     </div>


                     @if (Session::has('message'))
                 <center> <div class="alert alert-danger" role="alert">
                <div class="iq-alert-text">{{Session::get('message')}}</div>
               </div>
               </center>
                 @endif


                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="ligth">
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Tracking No</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Make payment</th>
                                    <th>View</th>
                                    {{-- <th>Actions</th> --}}
                                    @if (auth()->user()->userHasRole('Admin'))
                                    <th>Actions</th>
                                    @endif
                                    @if (auth()->user()->userHasRole('Cashier'))
                                    <th>Actions</th>
                                    @endif
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pending as $pos_view)

                                {{-- @if (auth()->user()->id == $pos_view->user_id) --}}
                                 <td>{{$pos_view->fname}} </td>
                                <td>{{$pos_view->phone}}</td>
                                <td>Mavenvet{{$pos_view->trackking_id}}</td>
                                <td><button type="button" class="btn btn-danger btn-sm mr-2">{{$pos_view->order_status}}</button></td>
                                <td>{{$pos_view->date}}</td>
                                <td>
                                   <a href="{{route('Admin.Pos.Pos_invoice',$pos_view->id)}}"><button type="button" class="btn btn-dark btn-sm mr-2">make payment</button></a>
                                </td>

                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2"  data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                                href="{{route('Admin.Pos.Pos_invoice_view',$pos_view->id)}}"><i class="ri-eye-line mr-0"></i></a>
                                        </div>
                                     </td>

                                    <td>
                                        @if (auth()->user()->userHasRole('Admin'))
                                        <form action="{{ route('Admin.Pos.Pos_pending_delete',$pos_view->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                        <div class="d-flex align-items-center list-action">
                                          <a href="{{ route('Admin.Pos.Pos_pending_delete',$pos_view->id) }}"> <button class="btn btn-danger" >Delete</button></a>
                                        </div>
                                    </form>
                                    @elseif (auth()->user()->userHasRole('Manager'))
                                    <form action="{{ route('Admin.Pos.Pos_pending_delete',$pos_view->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                    <div class="d-flex align-items-center list-action">
                                      <a href="{{ route('Admin.Pos.Pos_pending_delete',$pos_view->id) }}"> <button class="btn btn-danger">Delete</button></a>
                                    </div>
                                </form>
                                @else
                                    @endif

                                    @if (auth()->user()->userHasRole('Cashier'))

                                  <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Delete
                                   </button>
                                </form>
                                @else

                                @endif
                                    </td>
                                 </tr>
                                 {{-- @elseif (auth()->user()->id !== $pos_view->user_id)


                                 @endif --}}
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
       @if (auth()->user()->userHasRole('Cashier'))
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
        <h6>Please contact admin to delete and add iteam back to store</h6>
           <br>
       </div>
    </div>
   </div>
</div>
@endif


    @endsection
</x-admin-master>
