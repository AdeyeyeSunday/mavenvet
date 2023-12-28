<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Update Registration </h4>
                    </div>
                 </div>
                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Clinic.Clinic_update',$Clinic_edit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')



                       <div class="form-row">
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault01">Pet name</label>
                             <input type="text" name="Pet_name" value="{{$Clinic_edit->Pet_name}}" class="form-control"  required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault02">Breed</label>
                             <input type="text" name="Breed" value="{{$Clinic_edit->Breed}}" class="form-control"  required>
                          </div>

                          <input type="hidden" name="syn_flag" value="0" id="">

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Name Of Pet Owner</label>
                             <input type="text" class="form-control" value="{{$Clinic_edit->Name_Of_Pet_Owner}}" name="Name_Of_Pet_Owner" required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Owner Phone Number</label>
                             <input type="number" name="Owner_Phone_Number" value="{{$Clinic_edit->Owner_Phone_Number}}" class="form-control" id="validationDefault02" required>
                          </div>
                          {{-- <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Pet Card Number</label>
                             <input type="text" class="form-control" name="Pet_Card_Number" required>
                          </div> --}}
                       </div>


                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault04">Color</label>
                            <input type="test" class="form-control" value="{{$Clinic_edit->Color}}" name="Color" required>
                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefault02">
                           Age</label>
                           <input type="text" class="form-control"   value="{{$Clinic_edit->Age}}" name="Age" required>
                        </div>


                        {{-- <div class="col-md-6 mb-3">
                           <label for="validationDefault01">Registration Payment</label>
                           <input type="number" class="form-control"  value="{{$Clinic_edit->Registration_Payment}}" name="Registration_Payment" required>
                        </div> --}}
                     </div>

                       <div class="form-group">
                          <button class="btn btn-primary" type="submit">Update form</button>
                       </div>
                    </form>
                 </div>
              </div>

    @endsection
</x-admin-master>
