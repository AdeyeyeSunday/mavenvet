<x-admin-master>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Mavenvet Store</h6>
                        </div>
                    </div>
                    @if (Session::has('message'))

                    <center> <div class="alert alert-primary" role="alert">
                   <div class="iq-alert-text">{{Session::get('message')}}</div>
                  </div>
                  </center>
                    @endif
                    <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12 col-lg-6 col-md-8">
                              <div class="card">
                                 <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                       </select>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="input-group mb-4">

                                        <div class="card card-block card-stretch card-height blog pricing-details">
                                            <div class="card-body text-center rounded">
{{-- <button class="btn btn-primary" >sample</button> --}}
                                               <ul class="list-unstyled mb-0">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                              <th>Name</th>
                                                              <th>Qty</th>
                                                              <th>Price</th>
                                                              <th>Status</th>

                                                              <th>Action</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                         @php
                                                        $total = 0;
                                                    @endphp

                                                          @foreach ($get_cart as $get_cart)
                                                          <tr>
                                                              <th>{{$get_cart->Name}}</th>
                                                        <form action="{{ route('Admin.Store.update_cart_all', $get_cart->id) }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PATCH')
                                                              <th>

                                                                <input type="hidden" name="Price[]"
                                                                value="{{ $get_cart->Price }}">

                                                                <input type="hidden" name="Name[]"
                                                                value="{{ $get_cart->Name }}">

                                                                <input type="hidden" name="prod_id[]"
                                                                value="{{ $get_cart->prod_id }}">



                                                                <input type="number" value="{{$get_cart->Quantity}}" name="Quantity[]" class="form-control" name="" id="">

                                                            </th>

                                                              <th >{{$get_cart->Price}}</th>

                                                              {{-- <input type="hidden" name="" value="{{ $get_cart->status }}" id=""> --}}
                                                              <th>
                                                                <select name="status[]" id="" class="form-control" required>
                                                                    <option value="{{ $get_cart->status }}">{{ $get_cart->status }}</option>
                                                                    <option value="Head_Office_Breach_Office">Head Office Breach Office</option>
                                                                    <option value="Clinic_use">Clinic use</option>
                                                                    <option value="Retails">Retails</option>
                                                                    <option value="Damage">Damage</option>
                                                                </select>
                                                              </th>

                                                              <input type="hidden" name="subtotal[]" value="{{$get_cart->Price * $get_cart->Quantity}}" id="">

                                                              <th>

                                                                  <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                                href="{{route('Admin.Store.destory2',$get_cart->id)}}">Remove</a>

                                                        </th>
                                                          </tr>
                                                          @php
                                                          $total += $get_cart->Price * $get_cart->Quantity;
                                                      @endphp
                                                          @endforeach

                                                          <h6>Grand Total : {{ number_format($total, 2) }}</h6>
                                                      </tbody>
                                                  </table>
                                               </ul>
                                               @if ($total != '0.00')
                                               <button class="btn btn-dark btn-lg btn-block">Update Cart</button>
                                               @endif

                                            </form>
                                            </div>
                                         </div>


                    <form action="{{route('Admin.Store.store_order')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                    </div>
                 </div>
                 @foreach ($get as $get_cart)
                 <input type="hidden" name="Quantity" value="{{$get_cart->Quantity}}">
                 <input type="hidden" name="Price" value="{{$get_cart->Price}}">
                 <input type="hidden" name="Name" value="{{$get_cart->Name}}">
                 <input type="hidden" name="pro_id" value="{{$get_cart->prod_id}}">
                 <input type="hidden" name="status" value="{{$get_cart->status}}">
                 <input type="hidden" name="user_id" value="{{$get_cart->user_id}}">
                 <input type="hidden" name="subtotal" value="{{$get_cart->Price * $get_cart->Quantity}}">
                 @endforeach
                 @if ($total != '0.00')
                   <center>  <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Transfer</button></center>
                   @endif
                </form>


                 </div>
                        </div>
                           </div>
                           <div class="col-sm-12 col-lg-6 col-md-4">
                              <div class="card">
                                 <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                       <h6 class="card-title">All Product</h6>
                                    </div>
                                 </div>

                                    <div class="input-group mb-6">
                                    <div class="col-lg-12">
                                        <div class="table-responsive rounded mb-3">
                                        <table class="data-table table mb-0 tbl-server-info">
                                            <thead class="bg-white">
                                                <tr class=" -data">
                                                    {{-- <th>Image</th> --}}
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="-body">


                                                @foreach ($pro as $pro)
                                                <tr>
                                                    <form action="{{route('Admin.Store.store_cart')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
                                                        <input type="hidden" value="{{$pro->Name}}" name="Name">
                                                        <input type="hidden" value="1" name="Quantity">
                                                        <input type="hidden" value="{{$pro->Price}}" name="Price">
                                                        <input type="hidden" name="prod_id" value="{{$pro->id}}">
                                                        <input type="hidden" name="qty" value="{{$pro->Quantity}}">
                                                        <input type="hidden" name="date" value="{{date('d/m/y')}}">
                                                        <input type="hidden" name="month" value="{{date('F')}}">
                                                        <input type="hidden" name="year" value="{{date('Y')}}">

                                                    {{-- <td>
                                                      <img src="{{asset('storage/'.$pro->Image)}}" style="width: 30px;" alt=""> </td> --}}
                                                    <td>{{$pro->Name}}</td>
                                                    <td>{{$pro->Category}}</td>
                                                    <td>{{$pro->Quantity}}</td>
                                                    <td>
                                                         @php
                                                         if ( $pro->Quantity <= $pro->Quantity_level){
                                                            echo   '<button type="button" class="btn btn-dark btn-sm mr-2">Out of stock</button>';
                                                         }
                                                        elseif ( $pro->Quantity <= $pro->Quantity_level)
                                                            echo   '<button type="button" class="btn btn-danger btn-sm mr-2">Low stock restock it</button>';
                                                           elseif ($pro->Quantity > $pro->Quantity_level)
                                                            echo   ' <button type="button" class="btn btn-primary btn-sm mr-2">In Stock</button>';
                                                       @endphp
                                                       </td>
                                                    <td>

                                                    {{-- <button type="submit" class="btn btn-link"><i class="ri-moon-fill pr-0"></i></button> --}}

                                                    @if ($pro->Quantity <= 0)
                                                    <button disabled ><i class="ri-moons-fill pr-0"></i></button>
                                                    @else
                                                    <button type="submit" class="btn btn-link"><i
                                                        class="ri-check-line ri-lg fw-bold"></i></button>
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
                            </div>
                        </div>
                    </div>
                </div>
    @endsection
</x-admin-master>
