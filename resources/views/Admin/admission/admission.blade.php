<x-admin-master>
    @section('content')
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">MVC Admission Room</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('Admin.admission.admission_store') }}" method="post"
                                enctype="multipart/form-data" data-toggle="validator">
                                @csrf

                                <input type="hidden" name="location" value="MVC" id="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pet Name *</label>
                                            <select name="pet_id" class="form-control" id="">
                                                <option disabled selected></option>
                                                @foreach ($clinic as $clinic)
                                                    <option value="{{ $clinic->id }}">{{ $clinic->Pet_name }}
                                                        {{ $clinic->Pet_Card_Number }}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosis *</label>
                                            <input type="text" class="form-control" name="diagnosis"
                                                placeholder="Enter Diagnosis" data-errors="Please Enter Price." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amonut *</label>
                                        <select name="amount" id="" class="form-control" required>
                                            <option value="" disabled selected> ***** </option>
                                            <option value="2500">Adult 2500</option>
                                            <option value="2000"> Puppy 2000</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" value="{{ date('m/d/Y') }}" name="date" id="">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->name }}" id="">
                        <input type="hidden" value="{{ date('F') }}" name="month" id="">
                        <input type="hidden" value="{{ date('Y') }}" name="year" id="">
                        <input type="hidden" value="On admission" name="staus" id="">
                        <center> <button type="submit" class="btn sidebar-bottom-btn btn-lg btn-block">Admission</button></center><br>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
        </div>
        </div>
        </div>



        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Admission Space</h6>
                            </div>
                            <div class="header-title">
                                <h6 class="card-title" style="color: green">Adult Price = ₦:2500 Per Day</h6>
                            </div>
                            <div class="header-title">
                                <h6 class="card-title" style="color:red">Puppy Price = ₦:2000 Per Day</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="">
                                        <th>Name</th>
                                        <th>Diagnosis</th>
                                        <th>Number of days</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Session::has('room'))
                                        <center>
                                            <div class="alert alert-danger" role="alert">
                                                <div class="iq-alert-text">{{ Session::get('room') }}</div>
                                            </div>
                                        </center>
                                    @endif
                                    @if (Session::has('message'))
                                        <center>
                                            <div class="alert alert-primary" role="alert">
                                                <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                            </div>
                                        </center>
                                    @endif


                                    @foreach ($admission as $admission)
                                        <tr>

                                            <td>

                                                @php
                                                    $petname = App\Models\Clinic::where(
                                                        'Pet_Card_Number',
                                                        $admission->pet_id,
                                                    )->first();
                                                @endphp
                                                {{ $petname->Pet_name }}
                                                <p class="mb-0"><small>Breed: {{ $petname->Breed }} </small></p>
                                                <p class="mb-0">Gender: {{ $petname->Gender }} </p>
                                                <p class="mb-0">Color: {{ $petname->Color }} </p>
                                                @php
                                                $birthdate = \Carbon\Carbon::parse($petname->Age);
                                                $age = $birthdate->age;
                                                $months = $birthdate->diffInMonths(\Carbon\Carbon::now()) % 12;
                                                $years = floor($birthdate->diffInMonths(\Carbon\Carbon::now()) / 12);
                                                @endphp
                                                <p class="mb-0">Age: {{ $years }} years and {{ $months }} months</p>
                                            </td>
                                            <td>{{ $admission->diagnosis }}</td>
                                            <th>
                                                {{ floor((time() - +strtotime($admission->date)) / 86400) }}</th>
                                                @if ($admission->staus == 0)
                                                <td>On addminssion</td>
                                                @endif

                                            <td>
                                                <a
                                                    href="{{ route('Admin.admission.admission_payment_edit', $admission->id) }}">
                                                    <button class="btn sidebar-bottom-btn btn-sm">Payment</button> </a>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('Admin.admission.admission_update', $admission->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-danger btn-sm">Discharge</button>
                                                </form>

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
