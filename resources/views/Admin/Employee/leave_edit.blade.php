<x-admin-master>
    @section('content')
    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12 col-lg-7">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h4 class="card-title"> Leave Application </h4>
                    </div>

                    <div class="header-title">
                        <h4 class="card-title btn btn-info"> {{$leave_edit->staff_id}} </h4>
                     </div>
                 </div>
                 <div class="card-body">
                    {{-- <form action="{{route('Admin.Employee.leave_store')}}" method="post" enctype="multipart/form-data"> --}}
                        @csrf
                       <div class="form-row">

                          <div class="col-md-4 mb-3">
                             <label for="validationDefault05">Type of Leave</label>
                             <input type="type" class="form-control" name="type" id="" value="{{$leave_edit->type}}" readonly>

                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="validationDefault01">From</label>
                            <input type="text" class="form-control" name="from"  value="{{$leave_edit->from}}" id="validationDefault01" required readonly>
                         </div>
                         <div class="col-md-3 mb-3">
                            <label for="validationDefault02">To</label>
                            <input type="text" class="form-control" name="to" value="{{$leave_edit->to}}" id="validationDefault02" required readonly>
                         </div>
                       </div>
                       <div class="mb-3">
                        <label for="validationTextarea">Description</label>
                        <textarea class="form-control " id="validationTextarea" name="description" placeholder="Required Reason " readonly required>{{$leave_edit->description}}</textarea>
                     </div>


                     <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                           <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Apporval
                           </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                              <a class="dropdown-item" href="{{route('Admin.Employee.leave_update',$leave_edit->id)}}">Approved</a>
                              <a class="dropdown-item" href="{{route('Admin.Employee.leave_decline',$leave_edit->id)}}">Rejected</a>
                           </div>
                        </div>
                     </div>
                 </div>
              </div>
        </div>
    </div>

    @endsection
</x-admin-master>
