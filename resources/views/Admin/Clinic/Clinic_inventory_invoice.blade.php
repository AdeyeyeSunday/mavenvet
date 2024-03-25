<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-height print rounded">
                        <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                            <div class="iq-header-title">
                                <h4 class="card-title mb-0">Invoice#1234567</h4>
                            </div>
                            <div class="invoice-btn">

                                <a href="{{ route('Admin.Clinic.cart_pending') }}"> <button type="button"
                                        class="btn btn-dark btn-lg"><i class="las la-file-download"></i>Back</button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset('assets/images/logo.png') }}" class="logo-invoice img-fluid mb-3">
                                    <h5 class="mb-0">Hello, {{ $Clinic_inventory_invoice->name }}</h5>
                                    @if (Session::has('payment'))
                                        <center>
                                            <div class="alert alert-danger" role="alert">
                                                <div class="iq-alert-text">{{ Session::get('payment') }}</div>
                                            </div>
                                        </center>
                                    @endif
                                </div>
                            </div>

                            @if (Session::has('message'))
                                <center>
                                    <div class="alert alert-primary" role="alert">
                                        <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                    </div>
                                </center>
                            @endif
                            @if (Session::has('success'))
                                <center>
                                    <div class="alert alert-primary" role="alert">
                                        <div class="iq-alert-text">{{ Session::get('success') }} </div>
                                    </div>
                                </center>
                            @endif

                            @if (Session::has('error'))
                                <center>
                                    <div class="alert alert-danger" role="alert">
                                        <div class="iq-alert-text">{{ Session::get('error') }}

                                            <li class="">
                                                <a href="{{ route('Admin.Payment.oustanding') }}">
                                                    <i class="las la-minus"></i><span>Click here now</span>
                                                </a>
                                            </li>

                                        </div>
                                    </div>
                                </center>
                            @endif



                            @if (Session::has('Discount'))
                                <center>
                                    <div class="alert alert-primary" role="alert">
                                        <div class="iq-alert-text">{{ Session::get('Discount') }} Is
                                            {{ $Clinic_inventory_invoice->discount }} !!!!</div>
                                    </div>

                                </center>
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">#</th>
                                                    <th scope="col">Item</th>
                                                    <th class="text-center" scope="col">Quantity</th>
                                                    <th class="text-center" scope="col">Price</th>
                                                    <th class="text-center" scope="col">Totals</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($Clinic_inventory_invoice->vaccineiteams as $key => $item)
                                                    <tr>
                                                        <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                                        <td>
                                                            @php
                                                                $vaccine = App\Models\Vaccinestore::where('id',$item->vaccine_id)->first()
                                                            @endphp
                                                            <p class="mb-0">{{ $vaccine->Name }}
                                                            </p>
                                                        </td>
                                                        <td class="text-center">{{ $item->qty }}</td>
                                                        <td class="text-center">₦ {{ $item->price }}</td>
                                                        <td class="text-center"><b>₦ {{ $item->price * $item->qty }}</b>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @php
                            //   $price = (($Clinic_inventory_invoice->discount/100))*$Clinic_inventory_invoice->total

                            $price = $Clinic_inventory_invoice->discount - $Clinic_inventory_invoice->total;
                        @endphp

                        <div class="row mt-4 mb-3">
                            <div class="offset-lg-8 col-lg-4">
                                <div class="or-detail rounded">
                                    <div class="p-3">
                                        <h5 class="mb-3">Order Details</h5>
                                        <div class="mb-2">
                                            <h6>Order Date</h6>
                                            <p>{{ $Clinic_inventory_invoice->date }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>Sub Total</h6>
                                            <p> ₦: {{ $Clinic_inventory_invoice->total }}</p>
                                        </div>
                                        <div>
                                            @if (
                                                $Clinic_inventory_invoice->pay > 0 ||
                                                    $Clinic_inventory_invoice->cash_transfer > 0 ||
                                                    $Clinic_inventory_invoice->cash_pos > 0)
                                            @else
                                                <h6>Discount</h6>
                                                <form
                                                    action="{{ route('Admin.Clinic.vaccin_discount', $Clinic_inventory_invoice->id) }}">
                                                    @csrf

                                                    @if ($Clinic_inventory_invoice->discount > 1)
                                                        <button disabled>
                                                            <h6>{{ $Clinic_inventory_invoice->discount }}</h6>
                                                        </button>
                                                    @else
                                                        ₦: <input type="text" name="discount" id=""
                                                            value="{{ $Clinic_inventory_invoice->discount }}"
                                                            style="width: 80px;">

                                                        <button type="submit" class="btn btn-link"><i
                                                                class="ri-check-line ri-lg fw-bold"></i></button>
                                                    @endif

                                                </form>
                                            @endif
                                        </div><br>


                                        @if ($Clinic_inventory_invoice->pay > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Clinic_inventory_invoice->total }} </h6><br>
                                        @elseif($Clinic_inventory_invoice->cash_pos > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Clinic_inventory_invoice->total }} </h6><br>
                                        @elseif ($Clinic_inventory_invoice->cash_transfer > 0)
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Clinic_inventory_invoice->total }} </h6><br>
                                        @else
                                            <h6>Grant total </h6>
                                            <h6>₦{{ $Clinic_inventory_invoice->total - $Clinic_inventory_invoice->discount }}
                                            </h6><br>
                                        @endif
                                        @if (
                                            $Clinic_inventory_invoice->pay > 0 ||
                                                $Clinic_inventory_invoice->cash_transfer > 0 ||
                                                $Clinic_inventory_invoice->cash_pos > 0)
                                            <h6>Transaction completed</h6>
                                        @else
                                            <h6>Mode of Payment</h6>
                                            <a href="{{ route('Admin.Clinic.order_cash', $Clinic_inventory_invoice->id) }}"
                                                class="btn btn-success">Cash</a>
                                            <a href="{{ route('Admin.Clinic.order_pos', $Clinic_inventory_invoice->id) }}"
                                                class="btn btn-info">Pos</a>
                                            <a href="{{ route('Admin.Clinic.order_transfer', $Clinic_inventory_invoice->id) }}"
                                                class="btn btn-primary">Transfer</a>
                                            <a href="{{ route('Admin.Clinic.cash_pos', $Clinic_inventory_invoice->id) }}"
                                                class= "btn btn-danger">Cash/Pos</a>
                                            <a href="{{ route('Admin.Clinic.cash_transfer', $Clinic_inventory_invoice->id) }}"
                                                class="btn btn-warning" style="margin-right: 26px;">Cash/Transfer</a>
                                    </div>
                                </div>
                                @endif




                                <form action="{{ route('Admin.Clinic.vaccine_update', $Clinic_inventory_invoice->id) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="date" value="{{ gmdate(' jS \ F Y ') }}">
                                    <input type="hidden" name="total"
                                        value="{{ $Clinic_inventory_invoice->total - $Clinic_inventory_invoice->discount }}">


                                    @php
                                        $payment = $payment = DB::table('vaccineorders')->first();
                                    @endphp

                                    <input type="hidden" class="form-control" name="Payment_type" value="Half Payment">
                                    <input type="hidden" class="form-control" value="0" name="due" readonly
                                        placeholder="Due">
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                        @if ($Clinic_inventory_invoice->Mode_of_payment == 'Cash')
                                            @if ($Clinic_inventory_invoice->pay > 1)
                                                <label for="">Cash:</label>
                                                <input type="number" disabled class="form-control"
                                                    value="{{ $Clinic_inventory_invoice->pay }}" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                                <input type="hidden" class="form-control" value="0"
                                                    name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @else
                                                <label for="">Cash:</label>
                                                <input type="number" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                                <input type="hidden" class="form-control" value="0"
                                                    name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @endif
                                            @if ($Clinic_inventory_invoice->pay > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Clinic_inventory_invoice->pay > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Clinic_inventory_invoice->Mode_of_payment == 'Pos')
                                            @if (
                                                $Clinic_inventory_invoice->pay > 0 ||
                                                    $Clinic_inventory_invoice->cash_transfer > 0 ||
                                                    $Clinic_inventory_invoice->cash_pos > 0)
                                            @else
                                                <label for="">Select Bank</label>
                                                <select name="bankName" id="" class="form-control">
                                                    <option value="" selected>~~ Select ~~</option>
                                                    @foreach ($banklist as $banklist)
                                                        <option
                                                            value="{{ $banklist->name }}  {{ $banklist->accountNumber }}">
                                                            {{ $banklist->name }} {{ $banklist->accountNumber }}</option>
                                                    @endforeach

                                                </select>
                                            @endif
                                            <label for="">Pos:</label>
                                            @if ($Clinic_inventory_invoice->cash_pos > 1)
                                                <input type="number" disabled class="form-control"
                                                    value="{{ $Clinic_inventory_invoice->cash_pos }}"
                                                    style="width: 120px" name="cash_pos">

                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @else
                                                <input type="number" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">

                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">

                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                            @endif

                                            @if ($Clinic_inventory_invoice->cash_pos > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Clinic_inventory_invoice->cash_pos > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Clinic_inventory_invoice->Mode_of_payment == 'Transfer')
                                        @if (
                                                $Clinic_inventory_invoice->pay > 0 ||
                                                    $Clinic_inventory_invoice->cash_transfer > 0 ||
                                                    $Clinic_inventory_invoice->cash_pos > 0)
                                            @else
                                            <div>
                                                <label for="">Select Bank</label>
                                                <select name="bankName" id="" class="form-control">
                                                    <option value="" selected>~~ Select ~~</option>
                                                    @foreach ($banklist as $banklist)
                                                        <option
                                                            value="{{ $banklist->name }}  {{ $banklist->accountNumber }}">
                                                            {{ $banklist->name }} {{ $banklist->accountNumber }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @endif
                                            @if ($Clinic_inventory_invoice->cash_transfer > 1)
                                                <label for="">Transfer:</label>
                                                <input type="number" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px" value="0"
                                                    name="cash_transfer">
                                                <input type="hidden" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">
                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                            @else
                                                <label for="">Transfer:</label>
                                                <input type="number" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="cash_transfer">
                                                <input type="hidden" class="form-control" value="0"
                                                    style="width: 120px" name="cash_pos">
                                                <input type="hidden" class="form-control" value="0" name="pay"
                                                    style="width: 120px" placeholder="Pay">
                                            @endif
                                            @if ($Clinic_inventory_invoice->cash_transfer > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Clinic_inventory_invoice->cash_transfer > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Clinic_inventory_invoice->Mode_of_payment == 'cash_pos')
                                            @if ($Clinic_inventory_invoice->cash_pos > 1)
                                                <label for="">Pos:</label>
                                                <input type="number" disabled class="form-control" style="width: 120px"
                                                    value="{{ $Clinic_inventory_invoice->cash_pos }}" name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                                <label for="">Cash:</label>
                                                <input type="number" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Clinic_inventory_invoice->pay }}" name="pay">
                                            @else
                                                <label for="">Pos:</label>
                                                <input type="number" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_transfer">
                                                <label for="">Cash:</label>
                                                <input type="number" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="pay">
                                            @endif
                                            @if ($Clinic_inventory_invoice->cash_pos > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Clinic_inventory_invoice->cash_pos > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @elseif ($Clinic_inventory_invoice->Mode_of_payment == 'cash_transfer')
                                            @if ($Clinic_inventory_invoice->cash_transfer > 1)
                                                <label for="">Transfer:</label>
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="number" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Clinic_inventory_invoice->cash_transfer }}"
                                                    name="cash_transfer">
                                                <label for="">Cash:</label>
                                                <input type="number" disabled placeholder="Transfer"
                                                    class="form-control" style="width: 120px"
                                                    value="{{ $Clinic_inventory_invoice->pay }}" name="pay">
                                            @else
                                                <label for="">Transfer:</label>
                                                <input type="hidden" class="form-control" style="width: 120px"
                                                    value="0" name="cash_pos">
                                                <input type="text" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="cash_transfer">
                                                <label for="">Cash:</label>
                                                <input type="number" placeholder="Transfer" class="form-control"
                                                    style="width: 120px" value="0" name="pay">
                                            @endif
                                            @if ($Clinic_inventory_invoice->cash_transfer > 1)
                                                <button type="submit" disabled
                                                    class="btn btn-primary btn-block btn-lg">Paid</button>
                                            @else($Clinic_inventory_invoice->cash_transfer > 1 )
                                                <button type="submit"
                                                    class="btn btn-primary btn-block btn-lg">Pay</button>
                                            @endif
                                        @endif

                                </form>
                                @if (
                                    $Clinic_inventory_invoice->cash_transfer != 0 ||
                                        $Clinic_inventory_invoice->pay != 0 ||
                                        $Clinic_inventory_invoice->cash_pos != 0 ||
                                        $Clinic_inventory_invoice->cash_pos != 0)
                                    <div class="col-md-4">
                                        <a href="{{ route('Admin.Clinic.order_status', $Clinic_inventory_invoice->id) }}"
                                            class="btn btn-success btn-lg btn-block">Done</a>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('Admin.Clinic.vaccine_print', $Clinic_inventory_invoice->id) }} "
                                    id="btnPrint" class="btn btn-dark btn-lg btn-block">Print Invoice</a>
                            </div>
                            @endif
                        </div>


                        <script src="script.js"></script>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>





        {{-- </div>
                                   </div>

                                   <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                    @if ($Clinic_inventory_invoice->pay > 1)
                                    <button disabled class="btn btn-primary">Payment made</button>
                                    @elseif (($Clinic_inventory_invoice->cash_transfer > 1 ))
                                    <button disabled class="btn btn-primary">Payment made</button>
                                    @elseif (($Clinic_inventory_invoice->cash_pos > 1 ))
                                    <button disabled class="btn btn-primary">Payment made</button>
                                    @else
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Payment
                                </button>
                                @endif

                                    <a href="{{ route('Admin.Clinic.vaccine_print',$Clinic_inventory_invoice->id) }} " id="btnPrint" class="btn btn-warning">Print Invoice</a>

                                    <script src="script.js"></script>
                                    <a href="{{route('Admin.Clinic.order_status',$Clinic_inventory_invoice->id)}}" class="btn btn-success">Done</a>
                                    </div>

                                    <br>








                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-scrollable" role="document">
                   <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Invoice of {{$Clinic_inventory_invoice->name}}</h5>
                  <h5 class="modal-title" style="margin-left: 150px" id="exampleModalScrollableTitle">Total:₦{{$Clinic_inventory_invoice->total- $Clinic_inventory_invoice->discount }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>


<br>

<div class="col-lg-12">
    <form action="{{route('Admin.Clinic.vaccine_update',$Clinic_inventory_invoice->id)}}" enctype="multipart/form-data" method="post">
           @csrf
           @method('PATCH')
          <input type="hidden" name="date" value="{{gmdate(" jS \ F Y ")}}">
          <input type="hidden" name="total" value="{{$Clinic_inventory_invoice->total-$Clinic_inventory_invoice->discount }}">

          <div class="form-row">
             <div class="col">
              <label for="validationDefault02">Mode of Payment</label>
              <select class="form-control" name="Mode_of_payment" required>
               <option selected disabled value="">Choose...</option>
               <option value="Transfer">Transfer</option>
               <option value="Pos">Pos</option>
               <option value="Cash">Cash</option>
               <option value="Cash/Pos">Cash/Pos</option>
               <option value="Cash/Transfer">Cash/Transfer</option>
            </select>
             </div>

             <div class="col-md-6">
                 <label for="">Pay</label>
                <input type="text" class="form-control" value="0" name="pay" placeholder="Pay" >
             </div>
             @php
                 $payment =  $payment = DB::table('vaccineorders')->first();
             @endphp



                 <label for="" hidden>Outstanding</label>
              <input type="hidden" class="form-control" value="0" name="due" readonly placeholder="Due">



          <div class="col-md-6">
              <label for="">Transfer</label>
             <input type="text" class="form-control" value="0" name="cash_transfer" >
          </div>


          <div class="col-md-6">
              <label for="">Pos</label>
             <input type="text" class="form-control" value="0" name="cash_pos" >
          </div>

      </div>


      <input type="hidden" name="Payment_type" value="Half Payment" id="">

          <br><br>
         <center> <button type="submit" class="btn btn-primary">Pay</button></center>
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
                          </div>
                       </div>
                 </div>
              </div>
           </div> --}}

    @endsection

</x-admin-master>
