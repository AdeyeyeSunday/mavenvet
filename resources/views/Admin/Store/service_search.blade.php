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

                        <div class="header-title">
                            <a href="">  <h6 style="color: green"  class="card-title"> Cash: ₦:{{ $cash }}</h6></a>
                             </div>

                             <div class="header-title">
                             <a href=""> <h6 style="color: green"  class="card-title"> Transfer: ₦:{{ $tranfer }} </h6></a>
                             </div>


                             <div class="header-title">
                           <a href=""><h6 style="color: green"  class="card-title"> Pos: ₦:{{ $pos }} </h6></a>
                             </div>






                        <div class="header-title">
                            <h6 style="color: blue" class="card-title">New Due Payment Update List Total:{{$amount}}</h6>
                         </div>



                         <div class="header-title">
                            <a href="{{ route('Admin.Store.service_due') }}"><button class="btn btn-primary">Back</button></a>
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
                                    <th>Balance</th>
                                    <th>Payment Type</th>
                                    <th>Grant Total</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($balance  as $daily )
                                @if( $daily->due > 0)
                                <td>{{$daily->id}}</td>
                                <td>{{$daily->Pet_name}} {{$daily->Unregister}}</td>
                                    <td>{{$daily->Mode_of_payment}}</td>
                                    <td>{{$daily->total_price}}</td>
                                    <td>{{$daily->due}}</td>
                                    <td>{{$daily->Payment_type}}</td>
                                     <td>{{$daily->due + $daily->pay}}</td>
                                     <td>{{$daily->created_at->diffForHumans() }}</td>
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
