<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Follow up Case Note </h4>
                    </div>
                 </div>
                 <div class="card-body">
                    <p>Make Sure the Full Treatment is made well and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Casenote.Casenote_update',$Casenote->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                       <div class="form-row">


                          {{-- <div class="col-md-6 mb-3">
                             <label for="validationDefault03">Visual Evaluation</label>
                             <textarea class="form-control"  name="visual_evaluation"  rows="3">{{ $Casenote->visual_evaluation}}</textarea>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Physical Examination</label>
                             <textarea class="form-control" name="physical_examination"  rows="3">{{ $Casenote->physical_examination}}</textarea>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">other examination</label>
                             <textarea class="form-control" name="other_examination"  rows="3">{{ $Casenote->other_examination}}</textarea>
                          </div>
                       </div>


                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                           <label for="validationDefault02"> Result</label>
                           <textarea class="form-control" name="result"  rows="3">{{ $Casenote->result}}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                           <label for="validationDefaultUsername">Diagnosis</label>
                           <textarea class="form-control" name="diagnosis"  rows="3">{{ $Casenote->diagnosis}}</textarea>
                        </div> --}}


                        <div class="col-md-6 mb-3">
                           <label for="validationDefault03">Treatment</label>
                           <textarea class="form-control" name="treatment"  rows="3">{{ $Casenote->treatment}}</textarea>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02"> Temp °C</label>
                            <textarea class="form-control" name="temp"  rows="3">{{ $Casenote->temp}}</textarea>
                         </div>


                         <input type="hidden" name="syn_flag" value="0" id="">

                         <div class="col-md-6 mb-3">
                            <label for="validationDefault02">Pulse(/min)</label>
                            <textarea class="form-control" name="pulse"  rows="3">{{ $Casenote->pulse}}</textarea>
                         </div>

                         <div class="col-md-6 mb-3">
                            <label for="validationDefault02"> Resp(cycles/min)</label>
                            <textarea class="form-control" name="resp"  rows="3">{{ $Casenote->resp}}</textarea>
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
                          <button class="btn btn-primary" type="submit">Update</button>
                       </div>
                    </form>
                 </div>
              </div>

    @endsection
</x-admin-master>
