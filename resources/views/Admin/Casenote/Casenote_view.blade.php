<x-admin-master>
    @section('content')

    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">
           <div class="card card-block card-stretch card-height print rounded">
              <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                    <div class="iq-header-title">



                       <h4 class="card-title mb-0">{{$clinic->Pet_name}} Health Record </h4>
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
                          <h5 class="mb-0">Hello, {{$clinic->Pet_name}}</h5>
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
                                          <td><img src="{{asset('storage/'.$clinic->pic)}}" style="width: 250px; " alt=""></td>

                                            {{-- <td>Pet Name: {{$Clinic_view->Pet_name}}</td> --}}


                                            <td>
                                               <p class="mb-0">
                                                 Pet Name: {{$clinic->Pet_name}}<br>
                                                 Pet Age: {{$clinic->Breed}}
                                                 <br>
                                                 Gender: {{$clinic->Gender}}<br>
                                                 Breed: {{$clinic->Breed}}<br>
                                                 Owner Name: {{$clinic->Owner_Phone_Number}}<br>
                                                 Card Number: {{$clinic->Pet_Card_Number}}<br>



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
                                                    @foreach ($Service_order as $Service_order)
                                                      <tr>
                                                              <td>  <p class="mb-0">{{$Service_order->Next_vaccination_appointment}} <br>
                                                                 <br>
                                                              </p></td>
                                                              <td>  <p class="mb-0">{{$Service_order->Next_appointments}} <br>
                                                              </p></td>
                                                              <td>  <p class="mb-0">{{$Service_order->month}} <br>
                                                              </p></td>
                                                          </tr>
                                              @endforeach
                                  </tr>
                               </tbody>
                            </table>
                      </div>
{{--
                      <div class="table-responsive-sm">
                        <table class="table">
                           <thead>
                              <tr>

                                 <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                                     <div class="iq-header-title">
                                        <h4 class="card-title mb-0">Service History </h4>
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
                                                        <th scope="col"> Vaccination Name </th>
                                                        <th scope="col"> Service</th>
                                                        <th scope="col"> Month</th>
                                                  </tr>
                                               </thead>
                                               <tbody>
                                                @foreach ($Service as $Service_order)
                                                  <tr>
                                                          <td>  <p class="mb-0">{{$Service_order->prod_name}} <br>
                                                             <br>
                                                          </p></td>
                                                          <td>  <p class="mb-0">{{$Service_order->service}} <br>
                                                          </p></td>
                                                          <td>  <p class="mb-0">{{$Service_order->month}} <br>
                                                          </p></td>
                                                      </tr>
                                          @endforeach
                              </tr>
                           </tbody>
                        </table>
                  </div>
                      </div>
                   </div> --}}


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
                                   <tr>
                                     {{-- <b class="text-danger">Case Notes:</b><br> --}}
                                     <div class="row">
                                        <div class="col-lg-12">
                                           <div class="table-responsive-sm">
                                                 <table class="table">
                                                    <thead>
                                                       <tr>
                                                             <th scope="col">Date</th>
                                                             <th scope="col">Clinical Examination</th>
                                                             <th scope="col"> Laboratory</th>
                                                             <th scope="col">Note</th>

                                                       </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Casenote_view as $Casenote_view)
                                                       <tr>

                                                           <td >  <p class="mb-0">{{$Casenote_view->date}} <br>
                                                          <br></td>


                                                             <td>  <p class="mb-0">Visual Evaluation: {{$Casenote_view->visual_evaluation}}<br>
                                                                Physical Examination:  {{$Casenote_view->physical_examination}}<br>
                                                                Other Examination:  {{$Casenote_view->other_examination}}<br>
                                                                <br>

                                                                <br>

                                                             </p></td>
                                                             <td>  <p class="mb-0">Diagnosis:{{$Casenote_view->diagnosis}}
                                                                 <br>Treatment:{{$Casenote_view->treatment}}<br>

                                                                Result: {{$Casenote_view->result}} <br>

                                                             </p></td>
                                                             <td>
                                                                <p class="mb-0">  Temp: {{$Casenote_view->temp}}°C <br>
                                                                       pulse: {{$Casenote_view->pulse}}<br>  resp(cycles/min): {{$Casenote_view->resp}}
                                                                       <br>Veterinarian:{{$Casenote_view->Veterinarian}}<br>
                                                                    Status: <br>

                                                                </p>
                                                             </td>

                                                       </tr>
                                                        @endforeach



                                   </tr>
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
