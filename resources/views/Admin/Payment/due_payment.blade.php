<x-admin-master>
    @section('content')

        <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModalScrollable">Search with Date
                        </button>
                        <div class="header-title">
                        <a href="{{route('Admin.Payment.Account_cash')}}"><button class="btn btn-primary">Back</button></a>
                         </div>
                     </div>
                     <div class="card-body">

                        <div class="table-responsive">
                           <table id="datatable" class="table data-table table-striped">
                              <thead>
                                 <tr class="">
                                    <tr class="">
                                        {{-- <th>Pet Name</th> --}}
                                       <th>Owner Name</th>
                                        {{-- <th>Phone No</th> --}}
                                        <th>Total bill</th>
                                        <th>Balance</th>
                                        <th>Mode of Payment</th>
                                        <th>Grant Total</th>
                                        <th>Outstanding</th>
                                        <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>




                                @foreach ($due_payment as $payment)
                                @if ($payment->due > 0)
                                {{-- <td>{{$payment->Pet_name}}</td> --}}
                                <td>{{$payment->Owner_name}}</td>
                                {{-- <td>{{$payment->Phone}}</td> --}}
                                <td>{{$payment->total_price}}</td>
                                {{-- <td>{{$payment->pay}}</td> --}}
                                <td> {{$payment->due}}</td>
                                <td>{{$payment->Mode_of_payment	}}</td>
                                <td> {{$payment->due+$payment->pay}}  </td>
                                <td>{{$payment->total_price-$payment->due-$payment->pay}}</td>
                                 <td>{{$payment->created_at->diffForHumans()}}</td>
                                 </tr>
                                 @endif
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
        <form action="{{ route('Admin.Pos.search_payment') }}" enctype="multipart/form-data" method="post">
               @csrf

              <div class="form-row">
                 <div class="col-md-6">
                <label for="validationDefault02">Pick a date</label>
                   <input type="date" class="form-control" name="from" id="date">
                 </div>
          </div>
              <br><br>
             <center> <button type="submit" class="btn btn-primary">Search</button></center>
           </form>
           <br>
       </div>
    </div>
   </div>
</div>

    @endsection
</x-admin-master>
