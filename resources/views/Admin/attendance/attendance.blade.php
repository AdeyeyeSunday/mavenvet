<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">MVC Attendance </h6>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                </div>
                            </center>
                        @endif

                        <div class="row">
                            <div id="my_camera" hidden class="pre_capture_frame"></div>
                            <input type="hidden" name="captured_image_data" id="captured_image_data">

                        </div>

                        <div class="card-body">
                            <form id="attendanceForm" action="{{ route('Admin.attendance.attendance_store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                @php
                                    $check_tmer = App\Models\Attendance::where('Time', '!=', null)->where('staff_name', auth()->user()->name)->latest()->first();
                                @endphp


                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Staff name</label>
                                        <input type="text" class="form-control" readonly name="staff_name"
                                            value="{{ auth()->user()->name }}" id="">
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Clock</label>
                                            <select class="form-control mb-3" name="clockin" required>
                                                <option selected disabled>Select</option>
                                                <option value="Clockin">Clockin</option>
                                                <option value="clockout">Clock out</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    date_default_timezone_set('Africa/Lagos');
                                @endphp
                                <input type="hidden" name="Time" value=" {{ date('H:i A') }}">
                                <input type="hidden" name="date" value="{{ date('d/m/y') }}">
                                <input type="hidden" name="month" value="{{ date('F') }}">
                                <input type="hidden" name="year" value="{{ date('Y') }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
                                @if (strtotime(date('H:i')) > strtotime(Auth::user()->resumption_time ?? ''))
                                @if (!$check_tmer || $check_tmer->late_comment == null)
                               <center> <p style="color: red"> You're late. The charge: {{ number_format(Auth::user()->late_charge, 2) }}.Deducted from your salary.</p></center>
                                    <label for="lateReason">Reason for late coming</label>
                                    <textarea name="late_comment" class="form-control" id="lateReason" cols="3" rows="3" required></textarea>

                                @endif
                            @endif
                                <br>
                                <button type="submit" class="btn sidebar-bottom-btn  btn-lg btn-block">Process</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-lg-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Today Attendance</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped">
                                        <thead>
                                            <tr class="">
                                                {{-- <th>Id</th> --}}
                                                <th>Name</th>
                                                <th>Clockin</th>
                                                <th>Clockout</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance as $attendance)
                                                <tr>
                                                    {{-- <td>{{ $attendance->id }}</td> --}}
                                                    <td>{{ $attendance->staff_name }}</td>
                                                    <td>{{ $attendance->Time }}</td>
                                                    <td>{{ $attendance->Timeout }}</td>
                                                    @if ($attendance->late_status == 1)
                                                        <td><span class="mt-2 badge badge-pill badge-danger">Late</span> </td>
                                                    @else
                                                    @endif
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
        </div>
        </div>

        {{-- <script>
            document.getElementById('attendanceForm').addEventListener('submit', function(event) {
                // Check if the image is captured or not
                var imageSrc = document.querySelector('.after_capture_frame').src;
                if (imageSrc.includes('image_placeholder.jpg')) {
                    // Prevent form submission if the image placeholder is still displayed
                    event.preventDefault();
                    alert('Please capture your picture before submitting.');
                }
            });
        </script> --}}

        {{-- <script language="JavaScript">
            // Configure a few settings and attach camera 250x187
            Webcam.set({
                width: 350,
                height: 287,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');

            function take_snapshot() {
                // play sound effect
                //shutter.play();
                // take snapshot and get image data
                Webcam.snap(function(data_uri) {
                    // display results in page
                    document.getElementById('results').innerHTML =
                        '<img class="after_capture_frame" src="' + data_uri + '"/>';
                    $("#captured_image_data").val(data_uri);
                });
            }

            function saveSnap() {
                var base64data = $("#captured_image_data").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "capture_image_upload.php",
                    data: {
                        image: base64data
                    },
                    success: function(data) {
                        alert(data);
                    }
                });
            }
        </script> --}}
    @endsection
</x-admin-master>
