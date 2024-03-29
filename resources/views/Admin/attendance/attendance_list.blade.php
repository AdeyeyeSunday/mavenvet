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
                    <thead class="bg-white">
                        <tr class=" -data">
                            {{-- <th>Id</th> --}}
                            <th>User Name</th>
                            <th>Time clocked In</th>
                            <th>Time clocked Out</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody class="-body">

                        @foreach ($attendance1 as $key=>$attendance)
                        <tr>
                            <td>{{$attendance->staff_name}}</td>
                            <td>{{$attendance->Time}}</td>
                            <td>{{$attendance->Timeout}}</td>
                            @if ($attendance->late_status == 1)
                            <td>Late coming</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{$attendance->date}}</td>
                            <td>

                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal{{  $attendance->id }}">
                                                            View
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{  $attendance->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Reason for coming late</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                      <p>  {{ $attendance->late_comment }}</p>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
