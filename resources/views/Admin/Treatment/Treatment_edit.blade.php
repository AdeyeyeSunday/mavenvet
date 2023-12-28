<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title">  New Treatment </h4>
                    </div>

                    {{-- <div class="header-title">
                      <a href=""> <h4 class="card-title">Make Payment </h4></a>
                     </div> --}}
                 </div>
                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Treatment.Treatment_update',$Treatment_edit->id)}}" method="post" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                       <div class="form-row">


                          <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Diagnosis Test</label>
                             <input type="text" name="Diagnosis_Test" value="{{$Treatment_edit->Diagnosis_Test}}"  class="form-control" id="validationDefault02" required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Next Vaccination Appointment</label>
                             <input type="date" name="Next_Vaccination_Appointment" value="{{$Treatment_edit->Next_Vaccination_Appointment}}" class="form-control" id="validationDefault02" required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Next Appointments</label>
                             <input type="date" class="form-control"  value="{{$Treatment_edit->Next_Appointments}}" name="Next_Appointments" required>
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
                     {{-- <div class="form-group">
                        <label>Case Note</label>
                        <textarea class="form-control" name="Case_Note"  rows="7">{{$Treatment_edit->Case_Note}}</textarea>
                     </div> --}}

                       <div class="form-group">
                          <button class="btn btn-primary" type="submit">Update Case Note</button>
                       </div>
                    </form>
                 </div>
              </div>

    @endsection
</x-admin-master>
