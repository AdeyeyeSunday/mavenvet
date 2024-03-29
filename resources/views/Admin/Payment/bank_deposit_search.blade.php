<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">

                        <center> <h6  style="color: red" class="card-title">{{gmdate(" jS \ F Y ")}} </h6></center>
                        <div class="header-title">

                                      <a href="{{ route('Admin.Payment.bank_deposit') }}"><button class="btn btn-primary">Back</button></a>
                            </div>
                            <div class="header-title">
                               <h6 style="color: blue" class="card-title">Grand Total:{{   $amount }} </h6></a>
                                </div>






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
                                @foreach ($new as $item)
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


    @endsection
</x-admin-master>
