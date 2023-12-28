<x-admin-master>
    @section('content')
    <x-admin-master>
        @section('content')

            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12 col-lg-6">
                     <div class="card">
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title">Update Expense</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <p>Write out your monthly expenses. Start with food, shelter (your mortgage or rent plus utilities), clothing, and transportation. ...</p>
                           <form method="post" enctype="multipart/form-data" action="{{route('Admin.Expense.Monthly_update',$Expense->id)}}">
                               @csrf
                               @method('PATCH')
                              <div class="form-group">
                                 <label for="">Name:</label>
                                 <input type="text" value="{{$Expense->name}}" class="form-control" name="name">
                              </div>
                              <div class="form-group">
                                 <label for="">Amount:</label>
                                 <input type="number" value="{{$Expense->amount}}" name="amount" class="form-control" >
                              </div>


                              <div class="form-group">
                                <label> Description</label>
                                <textarea class="form-control" name="description"  rows="3">{{$Expense->description}}</textarea>
                             </div>

                              <button type="submit" class="btn btn-primary">Update</button>
                              <button type="submit" class="btn bg-danger">Cancel</button>
                           </form>
                        </div>
                     </div>
        @endsection
        </x-admin-master>

    @endsection
</x-admin-master>
