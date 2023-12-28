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
                        <a href="{{route('Admin.Pos.daily_sales_report')}}">  <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Back</button></a>
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
                             <h5 class="mb-3">Order Details</h5>
                             <hr>
                             <div class="table-responsive-sm">
                                   <table class="table">
                                      <thead>
                                         <tr>
                                               <th class="text-center" scope="col">#</th>
                                               <th scope="col">Item</th>
                                               <th class="text-center" scope="col">Quantity</th>


                                         </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($Pos_invoice->orderIteams as $items)

                                         <tr>
                                               <th class="text-center" scope="row">#</th>
                                               <td>
                                                  <h6 class="mb-0">{{$items->prod_id}}</h6>
                                                  </p>
                                               </td>
                                               <td class="text-center">{{$items->qty}}</td>
                                               {{-- <td class="text-center">{{$items->discount}}</td> --}}
                                               {{-- <td class="text-center">₦{{$items->price}}</td> --}}
                                         </tr>
                                         @endforeach
                                         </tbody>
                                   </table>
                             </div>
                          </div>

                       </div>
{{--
                       <div class="row mt-4 mb-3">
                          <div class="offset-lg-8 col-lg-4">
                             <div class="or-detail rounded">
                                   <div class="p-3">
                                      <h5 class="mb-3">Order Details</h5>

                                      <div class="mb-2">
                                         <h6>Due Date</h6>
                                         <p>12 August 2020</p>
                                      </div>

                                      @php
                                      $price = (($Pos_invoice->discount/100))*$Pos_invoice->total_price
                                  @endphp

                                      <div class="mb-2">
                                         <h6>Sub Total</h6>
                                         <p>₦{{$Pos_invoice->total_price}}</p>
                                      </div>
                                      <div>
                                         <h6>Discount</h6>
                                         <p>₦{{$price}}</p>
                                      </div>
                                   </div>
                                   <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                      <h6>Grand Total</h6>
                                      <h3 class="text-primary font-weight-700">₦{{$Pos_invoice->total_price-$price}}</h3>
                                   </div>

                                   <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    <h6>Amount paid</h6>
                                    <h6 >₦{{$Pos_invoice->pay}}</h6>
                                 </div>
                                 <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    <h6>Due</h6>
                                    <h6 >₦{{$Pos_invoice->due}}</h6>
                                 </div>
                             </div>
                          </div>
                       </div> --}}
                 </div>
              </div>
           </div>
        </div>
     </div>
     </div>
   </div>

    @endsection
</x-admin-master>
