<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 col-lg-4">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title"> MVC Leave Application</h6>
                    </div>
                 </div>


                 @if (Session::has('leave'))
                 <center> <div class="alert alert-primary" role="alert">
                <div class="iq-alert-text">{{Session::get('leave')}}</div>
               </div>
               </center>
                 @endif
                 <div class="card-body">
                    <form action="{{route('Admin.Employee.leave_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-row">
                          <div class="col-md-6 mb-3">


                             <label for="validationDefault04">Staff Name</label>
                            <input type="text" class="form-control" readonly name="staff_id" id="" value="{{auth()->user()->name}}">
                          </div>
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Type of Leave</label>
                            <select class="form-control" id="validationDefault04" name="type" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="casual leave 12 Days">casual leave 12 Days </option>
                                <option value="Medical Leave">Medical Leave</option>
                                <option value="Loss Of Pay">Loss Of Pay</option>
                                <option value="Hospitalisation">Hospitalisation</option>
                                <option value="Paternity Leave">Paternity Leave</option>>
                             </select>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label for="validationDefault01">From</label>
                            <input type="date" class="form-control" name="from" id="validationDefault01" required>
                         </div>
                         <div class="col-md-6 mb-3">
                            <label for="validationDefault02">To</label>
                            <input type="date" class="form-control" name="to" id="validationDefault02" required>
                         </div>
                       </div>
                       <div class="mb-3">
                        <label for="validationTextarea">Description</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" name="description" placeholder="Required Reason " required></textarea>
                        <div class="invalid-feedback">
                           Please enter a message.
                        </div>
                     </div>
                     <input type="hidden" name="month" id="" value="{{date('F')}}">
                     <input type="hidden" name="year" id="" value="{{date('Y')}}">
                     <input type="hidden" name="user_id" id="" value="{{auth()->user()->id}}">
                     <input type="hidden" name="status" id="" value="Pending">
                       <div class="form-group">
                         <center> <button class="btn sidebar-bottom-btn mt-4 btn-lg btn-block" type="submit">Apply</button></center>
                       </div>
                    </form>
                 </div>
              </div>
        </div>


        {{-- //table start from here  --}}
        <div class="col-sm-12 col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h6 class="card-title">Leave Approval    </h6>
               </div>
               <div class="header-title">
                {{-- <h4 class="card-title">{{$leave->staff_name}}    </h4> --}}
             </div>
            </div>
            <div class="card-body">

               <table class="table">
                  <thead>
                     <tr class="">
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">To</th>
                        <th scope="col">From</th>
                        <th scope="col">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                      @foreach ($leave as $leave)


                    <tr>
                        <td>{{$leave->staff_id ?? 'No  Leave Requested'}}</td>
                        <td>{{$leave->type ?? 'No  Leave Requested'}}</td>
                        <td>{{$leave->from ?? 'No  Leave Requested'}}</td>
                        <td>{{$leave->to ?? 'No  Leave Requested'}}</td>




                         {{-- @php
                 if ( $leave->status ??'No  Leave Requested' == 'Approved'):{

                 }
                 $color = 'red';
                elseif ( $leave->status ?? 'No  Leave Requested' == 'Pending'):
                $color = 'blue';
                elseif ( $leave->status ??'No  Leave Requested' == 'Rejected'):
                $color = 'red';
                endif;
                @endphp --}}

                        <td>                    @php
                            if ( $leave->status == 'Approved')
                            echo   '<button type="button" class="btn btn-primary btn-sm mr-2">Approved</button>';
                               elseif ($leave->status == 'Pending')
                                echo   ' <button type="button" class="btn btn-danger btn-sm mr-2">Pending</button>';
                                elseif ($leave->status == 'Rejected')
                                echo   ' <button type="button" class="btn btn-warning btn-sm mr-2">Pending</button>';
                           @endphp</td>
                     </tr>
                     @endforeach

                  </tbody>
               </table>
            </div>
         </div>
     </div>
     </div>

   </div>

    @endsection
</x-admin-master>
