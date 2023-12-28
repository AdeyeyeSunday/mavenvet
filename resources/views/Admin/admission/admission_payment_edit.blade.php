<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title" style="color: green">Pet Name: {{$admission_payment_edit->clinic->Pet_name}} </h4>

                    </div>
                    <div class="header-title">
                        <h4 class="card-title">Admission  Payment: {{$admission_payment_edit->amount * floor((time() -+ strtotime($admission_payment_edit->date)) / 86400) }}</h4>
                     </div>
                 </div>
                 <div class="card-body">
                    {{-- <p> Discharge After Payment</p> --}}
                    <form action="{{route('Admin.admission.admission_payment',$admission_payment_edit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-row">

                         <input type="hidden" name="syn_flag" value="0" id="">
                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                             <label for="validationDefault02"> Mode Of Payment</label>
                            <select class="form-control" name="mode" required>
                             <option selected disabled value="">Choose...</option>
                             <option value="Cash">Cash</option>
                             <option value="Transfer">Transfer</option>
                             <option value="Pos">Pos</option>
                          </select>
                         </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefaultUsername">Amount</label>
                           <div class="input-group">
                              <input type="number"  value="{{$admission_payment_edit->amount * floor((time() -+ strtotime($admission_payment_edit->date)) / 86400) }}"  readonly class="form-control" name="payment" aria-describedby="inputGroupPrepend2"  required>
                           </div>
                        </div>

                    </div>


                        <div class="col-md-6 mb-3">
                           <label for="validationDefault05">Veterinarian</label>
                           <input type="text" readonly
                            value="Dr. {{auth()->user()->name}}" class="form-control" name="user_id" required>
                        </div>
                    </div>

                       <center><button class="btn btn-primary" type="submit">Payment</button></center>
                    </form>

                </div>
            </div>

        </div>
    </div>




    @endsection
</x-admin-master>
