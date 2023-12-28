<x-admin-master>
    @section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h6 class="mb-3">Attendance List</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">

                            <th>Id</th>
                            <th>User Name</th>
                            <th>Time clocked In</th>
                            <th>Time clocked Out</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">

                        @foreach ($attendance as $key=>$attendance)
                        <tr>

                            <td>{{$key+1}}</td>
                            <td>{{$attendance->staff_name}}</td>
                            <td>{{$attendance->Time}}</td>
                            <td>{{$attendance->Timeout}}</td>
                            <td>{{$attendance->date}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
