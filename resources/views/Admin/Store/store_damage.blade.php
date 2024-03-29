<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Expired/Damage Items</h6>
                    </div>

                    <a href="{{ route('Admin.Store.store_view') }}"><button class="btn btn-primary">Back</button></a>
                 </div>
                 <div class="card-body">

                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="">
                                 <th>#</th>
                                {{-- <th>Name</th> --}}
                                <th>Product Name</th>
<th>Quantity</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Month</th>

                             </tr>
                          </thead>
                          <tbody>
                              @foreach ($shop_orders as $item)
                             <tr>
                                 <td>{{$item->id}}</td>
                                {{-- <td>{{$item->fname}}</td> --}}

                                @php
                                if ( $item->status == 'Damage'):
                                 $color = 'red';
                                  elseif ( $item->status== 'Breach Office / Head Office'):
                                  $color = 'green';
                                 elseif ( $item->status == 'Head Office / Breach Office'):
                                 $color = 'blue';
                                  else:
                                $color = 'black';
                                   endif;
                                 @endphp
                                 {{-- <td>{{ $item->user->name }}</td> --}}
                                 <td>{{ $item->prod_name }}</td>
<td>{{$item->qty}}</td>
                                 <td><button  style="background-color: {{$color}}" type="button" class="btn btn-danger btn-sm mr-2">{{$item->status}}</button></td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->month}}</td>
                             </tr>
                             @endforeach
                          </tbody>
                          <tfoot>
                             <tr>
                                <th>#</th>
                                {{-- <th>Name</th> --}}
                                <th>Product Name</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Month</th>

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
