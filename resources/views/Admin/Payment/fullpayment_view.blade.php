<x-admin-master>
    @section('content')
    <div class="container-fluid">
        <div class="row">
           <div class="col-lg-12">
              <div class="card card-block card-stretch card-height print rounded">
                 <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                       <div class="iq-header-title">
                          {{-- <h4 class="card-title mb-0">Invoice#{{$Pos_invoice->trackking_id}}</h4> --}}
                       </div>
                       <div class="invoice-btn">
                        <a href="{{route('Admin.Pos.Pos_view')}}">  <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Back</button></a>
                          {{-- <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button> --}}
                       </div>
                 </div>
                 <div class="card-body">
                       <div class="row">
                          <div class="col-sm-12">
                             {{-- <img src="{{asset('../assets/images/logo.png')}}" class="logo-invoice img-fluid mb-3"> --}}

                             {{-- <h5 class="mb-0">Hello,{{$Pos_invoice->fname}}</h5> --}}

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
                                               <th class="text-center" scope="col">Price</th>
                                               <th class="text-center" scope="col">Service</th>
                                               <th class="text-center" scope="col">Amount</th>

                                         </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($invoice->service_item as $invoice)

                                         <tr>
                                               <th class="text-center" scope="row">#</th>
                                               <td>
                                                  <h6 class="mb-0">{{$invoice->prod_name}}</h6>
                                                  </p>
                                               </td>
                                               <td class="text-center">{{$invoice->qty}}</td>
                                               <td class="text-center">₦{{$invoice->price}}</td>
                                               <td class="text-center">{{$invoice->service}}</td>
                                               <td class="text-center">{{$invoice->Amount}}</td>

                                         </tr>
                                         @endforeach
                                         </tbody>
                                   </table>
                             </div>
                          </div>

                       </div>

                       <div class="row mt-4 mb-3">
                          <div class="offset-lg-8 col-lg-4">
                             <div class="or-detail rounded">
                                   <div class="p-3">
                                      <h5 class="mb-3">Order Details</h5>

                                      <div class="mb-2">
                                         <h6>Due Date</h6>
                                         <p>12 August 2020</p>
                                      </div>

                                      <div class="mb-2">
                                         <h6>Total</h6>
                                         <p>₦{{$total->total_price}}</p>
                                      </div>
                                   </div>
                                   <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                      <h6>Grand Total</h6>
                                      <h3 class="text-primary font-weight-700">₦{{$total->total_price}}</h3>
                                   </div>

                                   <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    <h6>Amount paid</h6>
                                    <h6 >₦{{$total->pay}}</h6>
                                 </div>
                                 <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    <h6>outstanding</h6>
                                    <h6 >₦{{$total->due}}</h6>
                                 </div>
                             </div>
                          </div>
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
