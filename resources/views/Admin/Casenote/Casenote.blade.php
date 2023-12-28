<x-admin-master>
    @section('content')
    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Case Note </h4>
                    </div>
                 </div>

                 @if (Session::has('message'))

                 <center> <div class="alert alert-primary" role="alert">
                <div class="iq-alert-text">{{Session::get('message')}}</div>
               </div>
               </center>
                 @endif

                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Casenote.Casenote_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-row">
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault01">Pet name</label>
                             <select class="form-control" name="case_id" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($treatment as $treatment)
                                <option value="{{$treatment->id}}">{{$treatment->Pet_name}}{{$treatment->Pet_Card_Number}}  </option>
                                @endforeach
                             </select>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Visual Evaluation</label>
                             <textarea class="form-control" name="visual_evaluation"  rows="3"></textarea>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Physical Examination</label>
                             <textarea class="form-control" name="physical_examination"  rows="3"></textarea>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">other examination</label>
                             <textarea class="form-control" name="other_examination"  rows="3"></textarea>
                          </div>
                       </div>


                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                           <label for="validationDefault02"> Result</label>
                           <textarea class="form-control" name="result"  rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefaultUsername">Diagnosis</label>
                           <textarea class="form-control" name="diagnosis"  rows="3"></textarea>
                        </div>


                        <div class="col-md-6 mb-3">
                           <label for="validationDefault03">Treatment</label>
                           <textarea class="form-control" name="treatment"  rows="3"></textarea>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02"> Temp °C</label>
                            <textarea class="form-control" name="temp"  rows="3"></textarea>
                         </div>


                         <div class="col-md-6 mb-3">
                            <label for="validationDefault02">Pulse(/min)</label>
                            <textarea class="form-control" name="pulse"  rows="3"></textarea>
                         </div>

                         <div class="col-md-6 mb-3">
                            <label for="validationDefault02"> Resp(cycles/min)</label>
                            <textarea class="form-control" name="resp"  rows="3"></textarea>
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

            </div>
        </div>

    @endsection
</x-admin-master>
