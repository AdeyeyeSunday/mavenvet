<x-admin-master>
   @section('content')

   <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12">
          <div class="card card-block card-stretch card-height print rounded">
             <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                   <div class="iq-header-title">
                      <h4 class="card-title mb-0">{{$Clinic_view->Pet_name}} Health Record </h4>
                   </div>
                   <div class="invoice-btn">
                      {{-- <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Print
                         Print</button>
                      <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button> --}}
                   </div>
             </div>
             <div class="card-body">
                   <div class="row">
                      <div class="col-sm-12">
                         <img src="{{asset('../assets/images/logo.png')}}" class="logo-invoice img-fluid mb-3">
                         <h5 class="mb-0">Hello, {{$Clinic_view->Pet_name}}</h5>
                         <p>A complete medical history should include a record of every veterinary visit from your pet’s birth onward. It should not only include the date of the visit and a record of basics, such as length, weight, and vaccination history, but it should also include a thorough record of any medications prescribed, surgeries, and hospital visits. If your pet needs tests or
                             blood work administered by the veterinarian, there should be both a record of that test being performed and the outcome of those tests..</p>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="table-responsive-sm">
                               <table class="table">
                                  <thead>
                                     <tr>

                                        <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                                            <div class="iq-header-title">
                                               <h4 class="card-title mb-0">Pet / Owner Information </h4>
                                            </div>
                                      </div>
                                     </tr>
                                  </thead>
                                  <tbody>
                                     <tr>
                                         <td><img src="{{asset('storage/'.$Clinic_view->pic)}}" style="width: 250px; " alt=""></td>

                                           {{-- <td>Pet Name: {{$Clinic_view->Pet_name}}</td> --}}


                                           <td>
                                              <p class="mb-0">
                                                Pet Name: {{$Clinic_view->Pet_name}}<br>
                                                Pet Age: {{$Clinic_view->Breed}}
                                                <br>
                                                Gender: {{$Clinic_view->Gender}}<br>
                                                Breed: {{$Clinic_view->Breed}}<br>
                                                Next Vaccination:  {{$Clinic_view->Name_Of_Pet_Owner}}<br>
                                                Owner Name: {{$Clinic_view->Owner_Phone_Number}}<br>
                                                Owner Name: {{$Clinic_view->Pet_Card_Number}}<br>

                                              </p>
                                           </td>
                                     </tr>
                                  </tbody>
                               </table>
                         </div>

                         <div class="table-responsive-sm">
                            <table class="table">
                               <thead>
                                  <tr>

                                     <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                                         <div class="iq-header-title">
                                            <h4 class="card-title mb-0">Medical History </h4>
                                         </div>
                                   </div>
                                  </tr>
                               </thead>
                               <tbody>
                                  {{-- <tr>
                                    <b class="text-danger">Case Notes:</b><br>
                                    {{$Clinic_view->Case_Note}}


                                  </tr> --}}
                               </tbody>
                            </table>
                      </div>


                      </div>
                   </div>
                   <center>  <a href="{{route('Admin.Clinic.Clinic_list')}}"> <button class="btn btn-primary">Return</button></a></center>

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
