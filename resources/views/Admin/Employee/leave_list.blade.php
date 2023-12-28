<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
           <div class="col-sm-12">
              <div class="card">
                 <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                       <h6 class="card-title">Leave Approval</h6>
                    </div>
                 </div>
                 <div class="card-body">

                    <div class="table-responsive">
                       <table id="datatable" class="table data-table table-striped">
                          <thead>
                             <tr class="ligth">
                                <th>Name</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Action</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach ($leave_list as $leave_list)
                             <tr>

                                <td>{{$leave_list->staff_id}}</td>
                                <td>{{$leave_list->type}}</td>
                                <td>{{$leave_list->from}}</td>
                                <td>{{$leave_list->to}}</td>
                                <td>{{ \Carbon\Carbon::parse($leave_list->created_at)->diffForHumans()}}</td>
                                <td>
                                   <a href="{{route('Admin.Employee.leave_edit',$leave_list->id)}}"> <button  class="btn btn-primary btn-sm mr-2">Action</button></a>
                                 </td>

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
