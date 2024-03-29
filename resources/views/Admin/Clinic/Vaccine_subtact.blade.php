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
                                 <tr class="">

                                    <th>Vaccine</th>
                                    <th>Brand</th>
                                    <th>Cost</th>
                                    <th>selling Price</th>
                                    <th>Quantity</th>
                                    <th>Expiry Date</th>
                                    <th>Supply date</th>
                                       <th>Action By</th>

                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($vaccine as $vaccine)

                                @if ($vaccine->new_supply < 0 )
<tr>
                                    <td>{{$vaccine->Name}}</td>
                                    <td>{{$vaccine->brand}}</td>
                                    <td>{{$vaccine->Cost}}</td>
                                    <td>{{$vaccine->Price}}</td>
                                    <td>{{$vaccine->new_supply}}</td>
                                    <td>{{$vaccine->expiry_date}}</td>
                                    <td>{{$vaccine->supply_date	}}</td>
<td>{{$vaccine->user->name ?? ''}}</td>



</tr>
@else


                                    @endif
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
