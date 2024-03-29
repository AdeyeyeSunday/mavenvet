<x-admin-master>
    @section('content')

        {{-- <div class="container-fluid"> --}}
           <div class="row">
              <div class="col-sm-12 col-lg-6">
                 <div class="card">
                    <div class="card-header d-flex justify-content-between">
                       <div class="header-title">

                          <h6 class="card-title">Clinic Expense</h6>
                       </div>
                    </div>

                    @if (Session::has('message'))
                    <center> <div class="alert alert-primary" role="alert">
                   <div class="iq-alert-text">{{Session::get('message')}}</div>
                  </div>
                  </center>
                    @endif
                    <div class="card-body">
                       {{-- <p>Write out your monthly expenses. Start with food, shelter (your mortgage or rent plus utilities), clothing, and transportation. ...</p> --}}
                       <form method="post" enctype="multipart/form-data" action="{{route('Admin.Clinic.expenditure_store')}}">
                           @csrf
                           <input type="hidden" name="location" value="MVC" id="">
                          <div class="form-group">
                             <label for="">Name:</label>
                             <input type="text"  class="form-control" readonly name="name" value="{{Auth()->user()->name}}">
                          </div>
                          <div class="form-group">
                             <label for="">Amount:</label>
                             <input type="number"  name="amount" class="form-control" required >
                          </div>

                          <div class="form-group">
                            <label> Description</label>
                            <textarea class="form-control" name="description"  rows="3" required></textarea>
                         </div>

                         <div class="form-group">
                            <label hidden>Year:</label>
                            <input type="hidden" name="year"  value="{{date('Y')}}" class="form-control" >
                         </div>


                         <div class="form-group">
                            <label hidden>Month:</label>
                            <input type="hidden" name="month"  value="{{date('F')}}" class="form-control" >
                         </div>


                         <div class="form-group">
                            <label hidden>Date:</label>
                            <input type="hidden" name="date"  value="{{date("d/m/y")}}" class="form-control" >
                         </div>

                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="submit" class="btn bg-danger">Cancel</button>
                       </form>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h6 class="card-title">Expenditure List</h6>

                      </div>

                      <div class="header-title">
                        <h6 class="card-title">Select Month</h6>
                        <div class="col-sm-4">
                            <center> <div>
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#exampleModalScrollable">Search with Date
                                </button>
                            </div>
                        </center>

                     </div>
                  </div>
                   </div>

                   <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                   aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
                               <form action="{{ route('Admin.Clinic.clinic_monthly_expense') }}" enctype="multipart/form-data" method="post">
                                   @csrf
                                   <div class="form-row">
                                       <div class="col-md-4">
                                           <label for="validationDefault02">From a date</label>
                                           <input type="date" class="form-control" name="from" id="date">

                                           <label for="validationDefault02">To date</label>
                                           <input type="date" class="form-control" name="to" id="date">
                                       </div>
                                   </div>
                                   <br><br>
                                    <button type="submit" class="btn btn-primary">Search</button></center>
                               </form>
                               <br>
                           </div>
                       </div>
                   </div>
               </div>

                   <table class="table">

                      <thead>
                         <tr class="">
                            {{-- <th scope="col">#</th> --}}

                             <th scope="col">Name</th>
                             <th scope="col">Amount</th>
                             <th scope="col">Description</th>
                             <th scope="col">Month</th>
                             <th>Edit</th>
                         </tr>
                      </thead>
                      <tbody>
                          @foreach ($clinic_expense as $clinic_expense)


                         <tr>
                            <th scope="row">{{$clinic_expense->name}}</th>
                            <td>{{$clinic_expense->amount}}</td>
                            <td>{{$clinic_expense->description}}</td>
                            <td>{{$clinic_expense->month}}</td>
                            <td>
                               <a href="{{ route('Admin.Expense.Clinic',$clinic_expense->id) }}"><button class="btn btn-primary">Edit</button></a>
                            </td>
                         </tr>

                         @endforeach

                      </tbody>
                   </table>


                   </div>
                </div>




    @endsection
    </x-admin-master>
