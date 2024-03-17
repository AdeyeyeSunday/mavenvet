<x-admin-master>
    @section('content')



    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 col-lg-4">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Salary Payment</h4>
                    </div>
                 </div>
                 <div class="card-body">
                    <form action="{{route('Admin.Employee.salary_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="form-row">
                          <div class="col-md-6 mb-3">
                             <label for="validationDefault04">Staff Name</label>
                             <select class="form-control" id="validationDefault04" name="user_id" required>
                                <option selected disabled value="">Choose...</option>
                                {{-- @foreach ($emp as $employee)
                                <option value="{{$employee->id}}">{{$employee->user->name}}</option>
                                @endforeach --}}
                             </select>
                          </div>

                          <div class="col-md-6 mb-3">
                             <label for="validationDefault05">Month</label>
                             <select class="form-control" id="validationDefault04" name="Month" required>
                                <option selected disabled value="">Choose...</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March </option>
                                        <option value="April">April </option>
                                        <option value="May">May </option>
                                        <option value="June">June </option>
                                        <option value="">July </option>
                                        <option value="August ">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                             </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="validationDefault01">Amount</label>
                            <input type="number" class="form-control" name="Amount" id="validationDefault01" required>
                         </div>

                         <div class="col-md-6 mb-3">
                            <label for="validationDefault01">Days</label>
                            <input type="number" class="form-control" name="days" id="validationDefault01" required>
                         </div>
                       </div>
                       <div class="mb-6">
                        <label for="validationTextarea">Description</label>
                        <textarea class="form-control" id="validationTextarea" name="description" placeholder="Required Reason " required></textarea>
                     </div>
                       <br>
                     <input type="hidden" name="year" id="" value="{{date('Y')}}">
                       <div class="form-group">
                       <center>   <button class="btn btn-primary" type="submit">Submit Payment</button></center>
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
                  <h4 class="card-title">Salary List    </h4>
               </div>
               <div class="header-title">
                {{-- <h4 class="card-title">{{$leave->staff_name}}    </h4> --}}
             </div>
            </div>
            <div class="card-body">

               <table class="table">
                <thead>
                    <tr class="ligth">
                        <th>Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Absent days</th>
                        <th scope="col">Days in month</th>
                        <th scope="col">Days Late</th>
                        <th scope="col">Late Charge</th>
                        <th scope="col">Take home</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $salary->id }}</td>
                        <td>{{ $salary->name }}</td>
                        <td>{{ $salary->salary }}</td>
                        <td>{{ $attendanceCounts[$salary->id] ?? 0 }}</td>
                        <td>{{ $daysInMonth }}</td>
                        <td>{{ $lateCounts[$salary->id] ?? 0 }}</td>
                        <td>  {{ ($lateCounts[$salary->id] ?? 0) * $salary->late_charge }}  </td>
                        <td>{{ ($attendanceCounts[$salary->id] ?? 0) * $salary->salary  - ($lateCounts[$salary->id] ?? 0) * $salary->late_charge  }}</td>
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
