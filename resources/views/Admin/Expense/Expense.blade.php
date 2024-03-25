<x-admin-master>
@section('content')

    {{-- <div class="container-fluid"> --}}
       <div class="row">
          <div class="col-sm-12 col-lg-6">
             <div class="card">
                <div class="card-header d-flex justify-content-between">
                   <div class="header-title">

                      <h5 class="card-title">MVC Expense</h5>
                   </div>
                </div>
                <div class="card-body">
                   <p>Write out your monthly expenses. Start with food, shelter (your mortgage or rent plus utilities), clothing, and transportation. ...</p>
                   <form method="post" enctype="multipart/form-data" action="{{route('Admin.Expense.Expense_store')}}">
                       @csrf
                       <input type="hidden" name="location"  value="MVC" id="">
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

                      <button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Submit</button>

                   </form>
                </div>
            </div>
        </div>

@endsection
</x-admin-master>
