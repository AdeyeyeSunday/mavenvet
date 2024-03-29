<x-admin-master>
    @section('content')
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">MVC Admission Room</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Admin.admission.admission_store')}}" method="post" enctype="multipart/form-data" data-toggle="validator">
                            @csrf

                            <input type="hidden" name="location" value="MVC" id="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pet Name *</label>
                                        <select name="pet_id" class="form-control" id="">
                                            <option  disabled selected></option>
                                            @foreach ($clinic as $clinic)
                                            <option value="{{$clinic->id}}">{{$clinic->Pet_name}} {{$clinic->Pet_Card_Number}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Diagnosis *</label>
                                        <input type="text" class="form-control" name="diagnosis" placeholder="Enter Diagnosis" data-errors="Please Enter Price." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amonut *</label>
                                        <select name="amount" id="" class="form-control" required>
                                            <option value="" disabled selected> *****  </option>
                                            <option value="2500">Adult  2500</option>
                                            <option value="2000"> Puppy  2000</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{date('m/d/Y')}}"  name="date" id="">
                            <input type="hidden" name="user_id" value="{{auth()->user()->name}}" id="">
                            <input type="hidden" value="{{date('F')}}"  name="month" id="">
                            <input type="hidden" value="{{date('Y')}}"  name="year" id="">
                            <input type="hidden" value="On admission"  name="staus" id="">
                         <center>   <button type="submit" class="btn btn-primary mr-2">Admission</button></center><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
    </div>



    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Admission Space</h6>
                    </div>
                    <div class="header-title">
                        <h6 class="card-title" style="color: green">Adult Price = ₦:2500 Per Day</h6>
                     </div>
                     <div class="header-title">
                        <h6 class="card-title" style="color:red">Puppy Price =  ₦:2000 Per Day</h6>
                     </div>
                 </div>
                 <div class="card-body">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="">
                                 <th>Image</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Diagnosis</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                             </tr>
                          </thead>
                          <tbody>



                            @if (Session::has('room'))

                            <center> <div class="alert alert-danger" role="alert">
                           <div class="iq-alert-text">{{Session::get('room')}}</div>
                          </div>
                          </center>
                            @endif


                            @if (Session::has('message'))
                            <center> <div class="alert alert-primary" role="alert">
                           <div class="iq-alert-text">{{Session::get('message')}}</div>
                          </div>
                          </center>
                            @endif


                              @foreach ($admission as $admission)
                             <tr>

                                <td>

                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('storage/'.$admission->clinic->pic)}}" class="img-fluid rounded avatar-50 mr-3" alt="image">
                                        <div>
                                            {{$clinic->Pet_name}}
                                            <p class="mb-0"><small>This is {{$clinic->Breed}} </small></p>
                                        </div>
                                    </div>
                                </td>

                                <td>{{$admission->clinic->Pet_name}}</td>
                                <td>{{$admission->clinic->Breed}}</td>
                                <td>{{$admission->diagnosis}}</td>
                                <th>
                                    {{ floor((time() -+ strtotime($admission->date)) / 86400) }}</th>

                                <td>{{$admission->staus}}</td>

                                <td>
                                    <a href="{{route('Admin.admission.admission_payment_edit',$admission->id)}}">  <button class="btn btn-primary">Payment</button> </a>
                                </td>


                                <td>
                                    <form action="{{route('Admin.admission.admission_update',$admission->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                          <button class="btn btn-danger">Discharge</button>
                                    </form>

                                </td>

                             </tr>
                             @endforeach
                          </tbody>
                          <tfoot>
                             <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Diagnosis</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                             </tr>
                          </tfoot>
                       </table>
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
