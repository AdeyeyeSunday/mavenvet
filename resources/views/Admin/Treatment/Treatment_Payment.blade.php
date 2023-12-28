<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Full Treatment </h4>
                    </div>
                 </div>
                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Treatment.treatment_store',$Treatment_payment->id)}}" method="post" enctype="multipart/form-data">
                        @csrf


                          <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Diagnosis Test</label>
                             <select class="form-control" name="Diagnosis_Test" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="DHLPP vaccination">DHLPP vaccination</option>
                                <option value="Anti rabies vaccination">Anti rabies vaccination</option>
                                <option value="Boarding">Boarding</option>
                                <option value="Grooming">Grooming</option>
                                <option value="Bathing">Bathing</option>
                                <option value="Pavo">Pavo</option>
                                <option value="Nail clipping">Nail clipping</option>
                                <option value="Dog training">Dog training</option>
                                <option value="Other Treatment">Other Treatment</option>
                             </select>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Next Vaccination Appointment</label>
                             <input type="date" name="Next_Vaccination_Appointment" class="form-control" id="validationDefault02" >
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Next Appointments</label>
                             <input type="date" class="form-control" name="Next_Appointments" >
                          </div>
                       </div>


                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                           <label for="validationDefault02"> Payment Status</label>
                           <select class="form-control" name="Payment_Status" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Half Payment">Half Payment</option>
                         </select>
                        </div>




                        <div class="col-md-6 mb-3">
                           <label for="validationDefaultUsername">Amount Paid</label>
                           <div class="input-group">
                              <input type="number" class="form-control" name="Amount_Paid" aria-describedby="inputGroupPrepend2" required>
                           </div>

                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefault03">Outstanding Payment</label>
                           <input type="number" class="form-control" name="Outstanding_Payment" required>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02"> Mode Of Payment</label>
                            <select class="form-control" name="Mode_Of_Payment" required>
                             <option selected disabled value="">Choose...</option>
                             <option value="Cash">Cash</option>
                             <option value="Transfer">Transfer</option>
                             <option value="Pos">Pos</option>
                          </select>
                         </div>


                        <div class="col-md-6 mb-3">
                           <label for="validationDefault05">Veterinarian</label>
                           <input type="text" readonly
                            value="Dr. {{auth()->user()->name}}" class="form-control" name="Veterinarian" required>
                        </div>

                         <div class="col-md-6 mb-3">
                            <label for="validationDefault05">Status</label>
                            <select class="form-control" name="Status" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Alive">Alive</option>
                                <option value="Dead">Dead</option>
                             </select>
                         </div>
                     </div>

                     {{-- {{date('d/m/y')}} --}}

                     <div class="form-group">
                        <label>Case Note</label>
                        <textarea class="form-control" name="Case_Note"  rows="3">{{date('d/m/y')}}</textarea>
                     </div>
                        <input type="hidden" class="form-control" value="{{date('d/m/y')}}" name="date" required>
                        <input type="hidden" class="form-control" value="{{date('F')}}" name="month" required>
                        <input type="hidden" class="form-control" value="{{date('Y')}}" name="year" required>
                        <input type="hidden" class="form-control" value=" {{auth()->user()->id}}" name="user_id" required>
                       <div class="form-group">
                          <button class="btn btn-primary" type="submit">Submit form</button>
                       </div>
                    </form>
                 </div>
              </div>

    @endsection
</x-admin-master>
