<x-admin-master>
    @section('content')

    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 ">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Update Outstanding Payment </h4>
                    </div>
                 </div>
                 <div class="card-body">
                     <p>Update Outstanding Payment and input the amount and the outstanding payment</p>
                    <form action="{{route('Admin.Pos.due_update',$due_edit->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03"> Total Bill</label>
                            <input  type="number" value="{{$due_edit->total_price}}" class="form-control" name="total_price" readonly>
                         </div>

                         <input type="hidden" name="fname" id="" value="{{ $due_edit->fname }}">
                            <div class="col-md-6 mb-3">
                               <label for="validationDefault02"> Payment Status</label>
                               <input type="text" class="form-control" readonly value="Full Payment" name="Payment_type" id="">

                            </div>
                        </div>

                       <div class="form-row">
                        <div class="col-md-6 mb-3">
                             <label for="validationDefault02"> Mode Of Payment</label>
                            <select class="form-control" name="Mode_Of_Payment" required>
                             <option selected disabled value="">Choose...</option>
                             <option value="Cash">Cash</option>
                             <option value="Transfer">Transfer</option>
                             <option value="Pos">Pos</option>
                          </select>
                         </div>
                        <div class="col-md-6 mb-3">
                           <label for="validationDefaultUsername">Amount Paid</label>
                           <div class="input-group">
                              <input type="number"  value="{{$due_edit->pay +$due_edit->cash_transfer+$due_edit->cash_pos +-$due_edit->new_due}}" class="form-control" name="pay" aria-describedby="inputGroupPrepend2" readonly required>
                           </div>
                        </div>


                        <input type="hidden" name="location" value="MVC" id="">

                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">Outstanding Payment*</label>
                            <input type="number" value="{{$due_edit->total_price - $due_edit->pay - $due_edit->cash_pos-  $due_edit->cash_transfer +-$due_edit->new_due}}" readonly   class="form-control" name="due" required>
                         </div>


                         <input type="hidden" name="new_due"  id="">

                    </div>

                       <center><button class="btn btn-primary" type="submit">Update Payment</button></center>
                    </form>
                 </div>
              </div>
            </div>
        </div>


    @endsection
</x-admin-master>
