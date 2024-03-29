<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">

                       <div class="col-sm-12">


                        <center>       <div class="container-fluid">
                            <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Select Report Name / Month
                            </button><br><br>
                    </center>

                    </div>
                 </div>


                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                       <div class="modal-content">
                          <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             </button>
                          </div>
                          <div class="modal-body">
                             ...
                          </div>
                          <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>

             </div>
         </div>
      </div>






      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                <h5 class="modal-title" style="margin-left: 150px" id="exampleModalScrollableTitle"> </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
        <div class="col-lg-12">
         <form action="{{ route('Admin.Payment.search') }}" enctype="multipart/form-data" method="post">
                @csrf
               {{-- <div class="form-row">
                  <div class="col-md-6">
                 <label for="validationDefault02">Pick a date</label>
                    <input type="date" class="form-control" name="from" id="date">
                  </div>
           </div>

           <div class="form-row">
            <div class="col-md-6">
           <label for="validationDefault02">User</label>
           <select class="form-control" name="users">
            <option disabled selected ></option>
            @foreach ($emp as $emp)
        <option value="{{ $emp->id }}">{{$emp->user->name}} </option>
        @endforeach
 </select>
            </div>
     </div> --}}


     <label for="">User</label>
     <select class="form-control" name="user">
        <option disabled selected ></option>
        @foreach ($all as $emp)
        <option value="{{ $emp->id }}">{{$emp->name}} </option>
        @endforeach




</select>
<label for="">Month</label>
<select  class="form-control" name="month">
    <option disabled selected ></option>
   <option> <a href="January">January</a> </option>
   <option> <a href="February">February</a> </option>
   <option> <a href="March">March</a> </option>
   <option> <a href="April">April</a> </option>
   <option> <a href="May">May</a> </option>
   <option> <a href="June">June</a> </option>
   <option> <a href="July">July</a> </option>
   <option> <a href="August">August</a> </option>
   <option> <a href="September">September</a> </option>
   <option> <a href="October">October</a> </option>
   <option> <a href="November">November</a> </option>
   <option> <a href="December">December</a> </option>
</select>
<br>
<label for="">Year</label>
<input class="form-control" name="year" placeholder="Enter year">


               <br><br>
              <center> <button type="submit" class="btn btn-primary">Search</button></center>
            </form>
            <br>
        </div>
     </div>
    </div>
 </div>


                 {{-- <div class="card-body">
                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="">
                                <th>Name</th>
                                <th>Phone</th>
                             </tr>
                          </thead>
                          <tbody>
                                  @foreach ($user as $user)
                             <tr>
                                <td>{{$user->user->name}}</td>

                                <td>{{$user->number}}</td>
                             </tr>
                             @endforeach
                       </table>
                    </div>
                 </div> --}}
              </div>
           </div>
        </div>
     </div>
     </div>
   </div>

    @endsection
</x-admin-master>
