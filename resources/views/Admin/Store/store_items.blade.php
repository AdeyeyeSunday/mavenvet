<x-admin-master>
    @section('content')
   <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
          <div class="card card-block card-stretch card-height print rounded">
             <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                   <div class="iq-header-title">
                      <h4 class="card-title mb-0">Invoice#{{$Pos_invoice->trackking_id}}</h4>
                   </div>
                   <div class="invoice-btn">
                    <a href="{{route('Admin.Store.store_view')}}">  <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Back</button></a>
                      {{-- <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button> --}}
                   </div>
             </div>
             <div class="card-body">
                   <div class="row">
                      <div class="col-sm-12">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-12">
                         <h5 class="mb-3">  {{$Pos_invoice->status}} Items</h5>
                         <hr>
                         <div class="table-responsive-sm">
                               <table class="table">
                                  <thead>
                                     <tr>
                                           <th >#</th>
                                           <th >Item</th>
                                           <th >Date</th>
                                           <th >Quantity</th>
                                           <th >Price</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($Pos_invoice->Shop_item as $items)
                                     <tr>
                                         <td>#</td>
                                         <td>{{$items->prod_name}}</td>
                                         <td>{{$Pos_invoice->date}}</td>
                                         <td>{{$items->qty}}</td>
                                         <td>₦{{$items->price}}</td>
                                           {{-- <th class="text-center" scope="row">#</th>

                                           <td>
                                              <h6 class="mb-0">{{$items->prod_name}}</h6>
                                           </td>

                                           <td class="text-center">{{$Pos_invoice->date}}</td>
                                           <td class="text-center">{{$items->qty}}</td>
                                           <td class="text-center">₦{{$items->price}}</td> --}}
                                     </tr>
                                     @endforeach
                                     </tbody>
                               </table>
                         </div>


    @endsection
</x-admin-master>
