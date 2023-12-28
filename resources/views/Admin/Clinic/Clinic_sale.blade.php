<x-admin-master>
    @section('content')

          <div class="card-body">
            <div class="input-group mb-4">
                <div class="card card-block card-stretch card-height blog pricing-details">
                    <div class="card-body text-center rounded">
                       <ul class="list-unstyled mb-0">

                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                    <th>Vaccine Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                $total = 0;
                            @endphp


@if(Session::has('message'))
<div class="btn btn-danger">{{session('message')}}</div>
 @endif
                                  @foreach ($clinic_cart as $key=>$clinic_cart)
                                  <tr>
                                    <th>{{$key+1}}</th>
                                    <th>{{$clinic_cart->items_name}}</th>
                                    <th>
                                        <form action="{{route('Admin.Clinic.Clinic_cart_update',$clinic_cart->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <input type="number" name="qty" style="width: 70px;"  value="{{$clinic_cart->qty}}" >
                                      <button type="submit" class="btn btn-link"><i class="ri-moon-fill pr-0"></i></button>
                                      </form>
                                  </th>
                                  <th>{{$clinic_cart->selling_price}}</th>
                                  <th>{{$clinic_cart->qty*$clinic_cart->selling_price}}</th>


                                  <th>
                                      <form action="{{route('Admin.Clinic.Clinic_destory',$clinic_cart->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                     <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                         href="{{route('Admin.Clinic.Clinic_destory',$clinic_cart->id)}}"><i class="ri-delete-bin-line mr-0"></i></a>
                                </form>
                                </th>
                                </th>
                                  </tr>
                                  @php
                                  $total += $clinic_cart->qty*$clinic_cart->selling_price;
                              @endphp
                                  @endforeach

                                  <h6>Grand Total :{{ $total}} </h6>
                              </tbody>
                          </table>
                       </ul>

                       <form action="{{route('Admin.Clinic.Clinic_inventory')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <input type="text" name="name" class="form-control"  placeholder="Full Name"><br>
                       <input type="hidden" name="discount" class="form-control" value="0" ><br>
                       <input type="text" name="phone" class="form-control" required placeholder="Phone" ><br>
                       <input type="text" name="address"  class="form-control" value="0"  placeholder="Address">
                       <input type="hidden" name="order_status"  class="form-control" value="pending">
                       <input type="hidden" name="Mode_of_payment"  class="form-control" value="0">
                       <input type="hidden" name="pay"  class="form-control" value="0">
                       <input type="hidden" name="due"  class="form-control" value="0">
                       <input type="hidden" name="location" value="MVC midwifery" id="">
                       <input type="hidden" name="Payment_type"  class="form-control" value="0">
                       <input type="hidden" name="date" value="{{date('d/m/y')}}">
                       <input type="hidden" name="month" value="{{date('F')}}">
                       <input type="hidden" name="year" value=" {{date('Y')}}">
                       <input type="hidden" name="user_id" value=" {{auth()->user()->id}}">
                    </div>
                    @foreach ($clinic_get as $clinic_get)
                    <input type="hidden" name="vaccine_id" value="{{$clinic_get->id}}" id="">
                    <input type="hidden" name="qty" value="{{$clinic_get->qty}}" id="">
                    <input type="hidden" name="price" value="{{$clinic_get->selling_price}}" id="">
                    @endforeach
                    <button type="submit" class="btn btn-primary">Place Order</button>
                     </form>
                 </div>






                        <div class="col-sm-12 col-lg-6 col-md-6">
                            <div class="card">
                               <div class="card-header d-flex justify-content-between">
                                  <div class="header-title">
                                     <h6 class="card-title">All Vaccine</h6>
                                  </div>
                               </div>

                                  <div class="input-group mb-6">
                                  <div class="col-lg-12">
                                      <div class="table-responsive rounded mb-3">
                                      <table class="data-table table mb-0 tbl-server-info">
                                          <thead class="bg-white text-uppercase">
                                              <tr class="ligth ligth-data">
                                              {{-- m  <th>Image</th> --}}
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Expire</th>

                                                <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody class="ligth-body">
                                            @foreach ($Vaccinestore as $item)
                                              <tr>
                                                  <form action="{{route('Admin.Clinic.Clinic_cart')}}" method="post" enctype="multipart/form-data">
                                                      @csrf
                                                      <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                                      <input type="hidden" name="items_name" value="{{$item->Name}}">
                                                      <input type="hidden" name="qty" value="1">
                                                      <input type="hidden" name="Quantity" value="{{$item->Quantity}}" id="">
                                                      <input type="hidden" name="selling_price" value="{{$item->Price}}">
                                                      <input type="hidden" name="vaccine_id" value="{{$item->id}}">
                                                    {{-- <td><img src="{{URL::asset('storage/'.$item->Image)}}" width="30px" height="30px" alt=""></td> --}}
                                                    <td>{{$item->Name}}</td>
                                                    <td>{{$item->brand}}</td>
                                                    <td>{{$item->Price}}</td>
                                                    <td>{{$item->Quantity}}</td>





                                                    {{-- // minimum start from here --}}
                                                    <td>
                                                         @php
                                                        if ( $item->Quantity <= $item->minimum)
                                                        echo   '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock restock it</button>';
                                                           elseif ($item->Quantity >  $item->minimum)
                                                            echo   '<button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                       @endphp
                                                    </td>
                                                  <td>

                                                    @if ($item->Quantity <= 0)
                                                    <button disabled><i class="ri-moon-fill pr-0"></i></button>
                                                    @else
                                                    <button type="submit" class="btn btn-link"><i class="ri-moon-fill pr-0"></i></button>
                                                    @endif

                                                  </td>
                                              </tr>
                                          </form>
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




    @endsection
</x-admin-master>
