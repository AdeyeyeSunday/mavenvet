<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">

                @if (Session::has('message'))
                <center> <div class="alert alert-primary" role="alert">
               <div class="iq-alert-text">{{Session::get('message')}}</div>
              </div>
              </center>
                @endif
                <div >
                    <div class="header-title card-header d-flex justify-content-between">
                        <h4 class="card-title"></h4>
                   <a href="{{route('Admin.Expense.Monthly')}}"><button class="btn btn-primary">Back</button></a>
                    </div>

                 <div class="card-body">
                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                        <center> <h6 style="color: red">Today Total Amount: ₦   {{ number_format( $amount, 2, '.', ',') }}</h6></center>
                          <thead>
                             <tr class="ligth">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th>Edit</th>
                             </tr>
                          </thead>
                          <tbody>
                                  @foreach ($new as $Exp)
                             <tr>
                                <td>{{$Exp->name}}</td>
                                <td>{{$Exp->description}}</td>
                                <td> ₦{{$Exp->amount}}</td>
                                <td>{{$Exp->date}}</td>
                                <td>{{$Exp->month}}</td>

                                <td><a href="{{route('Admin.Expense.Monthly_edit',$Exp->id)}}" class="btn btn-primary">Edit</a></td>
                             </tr>

                             @endforeach
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
