<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 style="color: seagreen" class="card-title"> Salary Summary : ₦ {{$amount}} </h4>
                        </div>


                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                     <th>Id</th>
                                    <th>Amount</th>

                                    <th>Description	</th>
                                    <th>Month</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach ($salary_details as $salary_details)
                                <td>{{$salary_details->id}}</td>
                                <td>{{$salary_details->Amount}}</td>
                                <td>{{$salary_details->description}}</td>
                                <td>{{$salary_details->Month}}</td>
                                 </tr>
                                @endforeach
                              </tbody>

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
