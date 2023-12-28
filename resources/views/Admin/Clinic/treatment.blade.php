<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Vaccination </h4>
                    </div>
                 </div>
                 <div class="card-body">
                    {{-- <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p> --}}
                    <form action="{{route('Admin.Treatment.treatment_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-row">
                          <div class="col-md-4 mb-3">
                             <label for="validationDefault01">Pet name</label>
                             <select class="form-control" name="Pet_id" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($treatment as $treatment)
                                <option value="{{$treatment->id}}">{{$treatment->Pet_name}} Card No:{{$treatment->Pet_Card_Number}}</option>
                                @endforeach
                             </select>
                          </div>




                          <div class="col-md-4 mb-3">
                            <label for="validationDefault03">Vaccine</label>
                            <select class="form-control" name="pro_id" required>
                               <option selected disabled value="">Choose...</option>
                               @foreach ($vaccine as $item)
                               <option value="{{$item->id}}">{{$item->Name}}</option>
                               @endforeach
                            </select>
                         </div>



                          <div class="col-md-4 mb-3">
                             <label for="validationDefault03">Services</label>
                             <select class="form-control" name="Diagnosis_Test" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="DHLPP_vaccination">DHLPP vaccination</option>
                                <option value="Anti_rabies_vaccination">Anti rabies vaccination</option>
                                <option value="Boarding">Boarding</option>
                                <option value="Grooming">Grooming</option>
                                <option value="Bathing">Bathing</option>
                                <option value="Pavo">Pavo</option>
                                <option value="Nail_clipping">Nail clipping</option>
                                <option value="Dog_training">Dog training</option>
                                <option value="Other_Treatment">Other Treatment</option>
                             </select>
                          </div>



                          <div class="col-md-4 mb-3">
                             <label for="validationDefault04">Next Vaccination Appointment</label>
                             <input type="date" name="Next_Vaccination_Appointment" class="form-control" id="validationDefault02" >
                          </div>




                          <div class="col-md-4 mb-3">
                             <label for="validationDefault05">Next Appointments</label>
                             <input type="date" class="form-control" name="Next_Appointments" >
                          </div>


                        <div class="col-md-4 mb-3">
                           <label for="validationDefault05">Veterinarian</label>
                           <input type="text" readonly
                            value="Dr. {{auth()->user()->name}}" class="form-control" name="Veterinarian" required>
                        </div>

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
