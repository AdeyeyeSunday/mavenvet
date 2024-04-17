<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Registrations</h6>
                            </div>
                            <div class="header-title">
                                <button type="button" class="btn sidebar-bottom-btn mt-2" data-toggle="modal"
                                    data-target=".bd-example-modal-lgclinici">Register new pat</button>
                                <div class="modal fade bd-example-modal-lgclinici" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Register new patient</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form action="{{ route('Admin.Clinic.Clinic_store') }}" id="clinic_form"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-row">

                                                            <div class="col">
                                                                <label for="validationDefault01">Pet name</label>
                                                                <input type="file" class="form-control image-file"
                                                                    name="pic" accept="image/*">
                                                            </div>
                                                            <div class="col">
                                                                <label for="validationDefault01">Pet name</label>
                                                                <input type="text" name="Pet_name" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="validationDefault02">Breed</label>
                                                                <input type="text" name="Breed" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="validationDefaultUsername">Gender</label>
                                                                <select class="form-control" name="Gender" required>
                                                                    <option selected disabled value="">Choose...
                                                                    </option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="validationDefault03">Name of pet owner</label>
                                                                <input type="text" class="form-control"
                                                                    name="Name_Of_Pet_Owner" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="validationDefault04">Owner phone no.</label>
                                                                <input type="number" name="Owner_Phone_Number"
                                                                    class="form-control" id="validationDefault02" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="validationDefault05">Pet card no</label>
                                                                <input type="text" class="form-control"
                                                                    name="Pet_Card_Number" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="validationDefault04">Color</label>
                                                                <input type="test" class="form-control" name="Color"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label for="validationDefault02">
                                                                    Age</label>
                                                                <input type="date" class="form-control" name="Age"
                                                                    required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="validationDefault02">
                                                                    Allergy</label>
                                                                <input type="text" class="form-control" name="allergy"
                                                                    id="">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" class="form-control"
                                                            value="{{ date('d/m/y') }}" name="date" required>
                                                        <input type="hidden" class="form-control"
                                                            value="{{ date('F') }}" name="month" required>
                                                        <input type="hidden" class="form-control"
                                                            value="{{ date('Y') }}" name="year" required>
                                                        <input type="hidden" class="form-control"
                                                            value=" {{ auth()->user()->id }}" name="user_id" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="process_clnic"
                                                    class="btn sidebar-bottom-btn btn-lg btn-block">Save record</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="">
                                            <th>Pat name</th>
                                            <th>Pet parent</th>
                                            <th>Contact number.</th>
                                            <th>Registered by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clinic as $clinic)
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        {{ $clinic->Pet_name }}
                                                        <p class="mb-0"> Card no.: {{ $clinic->Pet_Card_Number }}</p>
                                                        <p class="mb-0">Breed: {{ $clinic->Breed }} </p>
                                                        <p class="mb-0">Color: {{ $clinic->Color }}</p>
                                                        @php
                                                            $birthdate = \Carbon\Carbon::parse($clinic->Age);
                                                            $age = $birthdate->age;
                                                            $months =
                                                                $birthdate->diffInMonths(\Carbon\Carbon::now()) % 12;
                                                            $years = floor(
                                                                $birthdate->diffInMonths(\Carbon\Carbon::now()) / 12,
                                                            );
                                                        @endphp
                                                        <p class="mb-0">Age: {{ $years }} years and
                                                            {{ $months }} months</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $clinic->Name_Of_Pet_Owner }}</td>
                                            <td>{{ $clinic->Owner_Phone_Number }}</td>
                                            <td>{{ $clinic->Veterinarian }}</td>
                                            <td>
                                                <button class="btn sidebar-bottom-btn btn-sm dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-caret-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <center>
                                                        <p> <a style="color: black"
                                                                href="{{ route('Admin.Clinic.encounter', $clinic->id) }}">Start Session</a></p>
                                                        {{-- <p> <a style="color: black" href="#">Pat history</a></p> --}}
                                                    </center>
                                                </div>
                            </div>
                            </td>
                            </tr>
                            </tbody>
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
        <script>
            $(document).ready(function() {
                // Check if toastr message exists
                @if (session()->has('toastr'))
                    toastr.{{ session('toastr') }}('{{ session('message') }}');
                @endif
            });


            // this submiting
            // this for instacting referring.....
            $(document).ready(function() {
                $('#clinic_form').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $('#process_clnic').text
                    $.ajax({
                        url: '{{ route('Admin.Clinic.Clinic_store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $('#process_clnic').text('Processing...');
                        },
                        success: function(response) {
                            toastr.success(response.message, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                timeOut: 3000
                            });
                            $('#clinic_form')[0].reset();
                            $('.bd-example-modal-lgclinici').modal('hide');
                            window.location.reload();
                            $('#process_clnic').text('Save record');
                        },
                        error: function(xhr, status, error) {
                            toastr.error('An error occurred. Please try again later.', 'Error!');
                            $('#process_clnic').text('Save record');
                        }
                    });
                });
            });
        </script>
    @endsection
</x-admin-master>
