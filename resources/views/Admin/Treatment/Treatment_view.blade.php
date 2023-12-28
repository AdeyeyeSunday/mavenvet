<x-admin-master>
    @section('content')

    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
           <div class="card card-block card-stretch card-height print rounded">
              <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                    <div class="iq-header-title">
                       <h4 class="card-title mb-0">{{$Treatment_view->clinic->Pet_name}} Health Record </h4>
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
                          <h5 class="mb-0">Hello, {{$Treatment_view->clinic->Pet_name}}</h5>
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
                                          <td><img src="{{asset('storage/'.$Treatment_view->clinic->pic)}}" style="width: 250px; " alt=""></td>

                                            {{-- <td>Pet Name: {{$Clinic_view->Pet_name}}</td> --}}


                                            <td>
                                               <p class="mb-0">
                                                 Pet Name: {{$Treatment_view->clinic->Pet_name}} <br>
                                                 Pet Age:  {{$Treatment_view->clinic->Age}}
                                                 <br>
                                                 Gender:   {{$Treatment_view->clinic->Gender}}<br>
                                                 Breed:  {{$Treatment_view->clinic->Breed}} <br>
                                                 Color:  {{$Treatment_view->clinic->Color}} <br>
                                                 {{-- Next Vaccination: {{$Treatment_view->Next_Vaccination_Appointment}}  <br>
                                                 Next Appointments: {{$Treatment_view->Next_Appointments}}  <br> --}}
                                                 Owner Name: {{$Treatment_view->clinic->Name_Of_Pet_Owner}}  <br>
                                                 Owner Phone: {{$Treatment_view->clinic->Owner_Phone_Number}} <br>

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
                                            <h4 class="card-title mb-0">Vaccination History </h4>
                                         </div>
                                   </div>
                                  </tr>
                               </thead>
                               <tbody>
                                  <tr>

                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="table-responsive-sm">
                                                <table class="table">
                                                   <thead>
                                                      <tr>
                                                            <th scope="col"> Next Vaccination Appointment </th>
                                                            <th scope="col"> Next Appointments Vaccination</th>
                                                            <th scope="col"> Month</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                    @foreach ($treatment as $treatment)
                                                      <tr>
                                                              <td>  <p class="mb-0">{{$treatment->Next_Vaccination_Appointment}} <br>
                                                                 <br>
                                                              </p></td>
                                                              <td>  <p class="mb-0">{{$treatment->Next_Appointments}} <br>
                                                              </p></td>
                                                              <td>  <p class="mb-0">{{$treatment->month}} <br>
                                                              </p></td>
                                                          </tr>
                                              @endforeach
                                  </tr>
                               </tbody>
                            </table>
                      </div>


                      </div>
                   </div>

                    <center>  <a href="{{route('Admin.Treatment.treatment_list')}}"> <button class="btn btn-primary">Return</button></a></center>

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
