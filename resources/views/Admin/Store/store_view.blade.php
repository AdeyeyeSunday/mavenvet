<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">

                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with Date
                            </button>
                            </div>
                        <div class="header-title">
                        <a href="{{route('Admin.Store.store_damage')}}">  <h6 style="color: red" class="card-title"> Store Expired/Damage Item </h6></a>
                         </div>


                         <div class="header-title">
                            <a href="{{route('Admin.Store.store_move')}}">  <h6 style="color: green" class="card-title"> Store Move Item </h6></a>
                             </div>



                             <div class="header-title">
                                 <a href="{{route('Admin.Store.Retail')}}">  <h6 style="color: blue" class="card-title">Retails Item </h6></a>
                                 </div>


                                 <div class="header-title">
                                    <a href="{{route('Admin.Store.clinicuse')}}">  <h6 style="color: black" class="card-title">Clinic Use Item </h6></a>
                                     </div>



                        <center> <h6  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h6></center>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <th>#</th>
                                    {{-- <th>Name</th> --}}
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Month</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($pos_view as $item)
                             <tr>
                                 <td>{{$item->id}}</td>
                                @php
                                if ( $item->status == 'Damage'):
                                 $color = 'red';
                                  elseif ( $item->status== 'Head_Office_Breach_Office'):
                                  $color = 'green';
                                 elseif ( $item->status == 'Clinic_use'):
                                 $color = 'blue';
                                 elseif ( $item->status == 'Retails'):
                                 $color = 'lemon';
                                  else:
                                $color = 'black';
                                   endif;
                                 @endphp
                                 {{-- <td>{{ $item->user->name }}</td> --}}
                                 <td>{{ $item->prod_name }}</td>
                                 <td><button  style="background-color: {{$color}}" type="button" class="btn btn-danger btn-sm mr-2">{{$item->status}}</button></td>
                                 <td>{{$item->qty}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->month}}</td>
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
