<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-5">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       {{-- <h4 class="card-title"> Update Outstanding Vaccine Payment </h4> --}}
                    </div>
                 </div>
                 @if (Session::has('valid'))
                 <center> <div class="alert alert-danger" role="alert">
                <div class="iq-alert-text">{{Session::get('valid')}}</div>
               </div>
               </center>
                 @endif


                 <div class="card-body">


                        <form action="{{route('Admin.Payment.Payment_list_update',$Payment_list_edit->id)}}" enctype="multipart/form-data" method="post">
                             @csrf
                             @method('PATCH')
                            {{-- <input type="hidden" name="date" value="{{gmdate(" jS \ F Y ")}}"> --}}
                            <input type="hidden" name="total_price" value="{{$Payment_list_edit->total_price}}">
                            <div class="form-row">
                               <div class="col-md-6">
                                <label for="validationDefault02">Mode Of Payment</label>
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
                                   <label for="">Cash</label>
                                  <input type="text" class="form-control" value="{{ $Payment_list_edit->pay }}" name="pay" placeholder="Pay" >
                               </div>
                               @php
                                   $payment =  $payment = DB::table('service_orders')->first();
                               @endphp

                                   <label for="" hidden>Outstanding</label>
                                <input type="hidden" class="form-control" value="0" name="due" readonly placeholder="Due">



                            <div class="col-md-6">
                                <label for="">Transfer</label>
                               <input type="text" class="form-control" value="{{ $Payment_list_edit->cash_transfer }}" name="cash_transfer" >
                            </div>


                            <div class="col-md-6">
                                <label for="">Pos</label>
                               <input type="text" class="form-control" value="{{ $Payment_list_edit->cash_pos }}" name="cash_pos" >
                            </div>

                        </div>
                        <input type="hidden" name="Payment_type" value="Half Payment" id="">

                            <br><br>
                           <center> <button type="submit" class="btn btn-primary">Update</button></center>
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




    @endsection
</x-admin-master>
