<x-admin-master>
    @section('content')

        <div class="container-fluid add-form-list">
           <div class="row">
               <div class="col-sm-5">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                               <h6 class="card-title">Update</h6>
                           </div>
                       </div>


                       <div class="card-body">

    <form action="{{route('Admin.Clinic.vaccin_update2',$vaccin_edit->id)}}" enctype="multipart/form-data" method="post">
           @csrf
           @method('PATCH')
          <input type="hidden" name="date" value="{{gmdate(" jS \ F Y ")}}">
          <input type="hidden" name="total" value="{{$vaccin_edit->total-$vaccin_edit->discount }}">

          <div class="form-row">
             <div class="col">
              <label for="validationDefault02">Mode of Payment</label>
              <select class="form-control" name="Mode_of_payment" required>
               <option selected disabled value="">Choose...</option>
               <option value="Transfer">Transfer</option>
               <option value="Pos">Pos</option>
               <option value="Cash">Cash</option>
            </select>
             </div>

             <div class="col-md-6">
                 <label for="">Pay</label>
                <input type="text" class="form-control" value="{{ $vaccin_edit->pay}}" name="pay" placeholder="Pay" >
             </div>
             @php
                 $payment =  $payment = DB::table('vaccineorders')->first();
             @endphp



                 <label for="" hidden>Outstanding</label>
              <input type="hidden" class="form-control" value="0" name="due" readonly placeholder="Due">






          <div class="col-md-6">
              <label for="">Transfer</label>
             <input type="text" class="form-control" value="{{ $vaccin_edit->cash_transfer}}" name="cash_transfer" >
          </div>


          <div class="col-md-6">
              <label for="">Pos</label>
             <input type="text" class="form-control" value="{{ $vaccin_edit->cash_pos}}" name="cash_pos" >
          </div>

      </div>


      <input type="hidden" name="Payment_type" value="Half Payment" id="">

          <br><br>
         <center> <button type="submit" class="btn btn-primary">Update</button></center>
       </form>
           <!-- Page end  -->
                       </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
