<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title"> Pet registration </h6>
                    </div>
                 </div>
                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Clinic.Clinic_store')}}" id="cliinic_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control image-file" name="pic" accept="image/*">
                            </div>
                        </div>
                       <div class="form-row">
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault01">Pet name</label>
                             <input type="text" name="Pet_name" class="form-control"  required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault02">Breed</label>
                             <input type="text" name="Breed" class="form-control"  required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefaultUsername">Gender</label>
                             <select class="form-control" name="Gender" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                             </select>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Name Of Pet Owner</label>
                             <input type="text" class="form-control" name="Name_Of_Pet_Owner" required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Owner Phone Number</label>
                             <input type="number" name="Owner_Phone_Number" class="form-control" id="validationDefault02" required>
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Pet Card Number</label>
                             <input type="text" class="form-control" name="Pet_Card_Number" required>
                          </div>
                       </div>
                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault04">Color</label>
                            <input type="test" class="form-control" name="Color" required>
                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefault02">
                           Age</label>
                           <input type="date" class="form-control"  name="Age" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02">
                                Allergy</label>
                            <input type="text" class="form-control" name="allergy" id="">
                         </div>

                        <div class="col-md-6 mb-3">
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
                          <button class="btn sidebar-bottom-btn btn-lg btn-block" type="submit">Process registration</button>
                       </div>
                    </form>
                 </div>
              </div>
            </div>
        </div></div>
    </div></div>
</div>

    @endsection
</x-admin-master>
