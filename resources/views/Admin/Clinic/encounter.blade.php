<x-admin-master>
    @section('content')
        <br><br><br><br><br>
        @php
            $system_config = App\Models\Systemconfiguration::first();
        @endphp
        <div class="container-fluid">
            <div class="row m-sm-0 px-0">
                <div class="col-lg-8 card-profile">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="pill" href="#profile1" role="tab"
                                        aria-selected="false"> Pet history</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#profile2" role="tab"
                                        aria-selected="false">Commence assessment </a>
                                </li>
                            </ul>
                            <div class="profile-content tab-content">
                                <div id="profile1" class="tab-pane fade active show">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('assets/images/logo.png') }}"
                                                class="logo-invoice img-fluid mb-3">
                                            <h5 class="mb-0">Hello, {{ Auth::user()->name ?? '' }}</h5>
                                            <p>For <strong> [{{ $encounterId->Pet_name ?? '' }} ] [Card
                                                    no.{{ $encounterId->Pet_Card_Number ?? '' }} ] </strong>, document every
                                                vet
                                                visit since
                                                birth, including dates,
                                                weight, vaccinations, medications, surgeries, and hospital visits. Also,
                                                note any tests conducted and their outcomes.</p>
                                            @if ($case_note)
                                                <h5>Past health status</h5>
                                                <br>
                                                <ul class="list-inline p-0 m-0 w-100">
                                                    <li>
                                                        <div class="row align-items-top">
                                                            <div class="col-md-3">
                                                                <h6 class="mb-2">{{ $case_note->date ?? '' }} - present
                                                                </h6>
                                                                <h6>Time: {{ $case_note->created_at->format('h:i A') }}</h6>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="media profile-media align-items-top">
                                                                    <div class="profile-dots border-primary mt-1"></div>
                                                                    <div class="ml-4">
                                                                        <h6 class=" mb-0">Presenting complain symptoms</h6>
                                                                        <p class="mb-0 font-size-15">{!! nl2br(e($case_note->presenting_complain_symptoms ?? '')) !!}
                                                                        </p>

                                                                        <h6 class=" mb-0">History presenting illness</h6>
                                                                        <p class="mb-0 font-size-15">
                                                                            {!! nl2br(e($case_note->history_presenting_illness ?? '')) !!}.
                                                                        </p>
                                                                        <h6 class=" mb-0">Physical examination
                                                                        </h6>
                                                                        <p class="mb-0 font-size-15">{!! nl2br(e($case_note->physical_examination ?? '')) !!}
                                                                        </p>
                                                                        </h6>
                                                                        <h6 class="mb-0 font-size-15">Temperature:
                                                                            {{ $case_note->temp ?? '' }}&deg;</h6>
                                                                        <h6 class="mb-0 font-size-15">Pulse:
                                                                            {{ $case_note->pulse ?? '' }}BPM;</h6>
                                                                        <h6 class="mb-0 font-size-15">Resp(cycles/min):
                                                                            {{ $case_note->resp ?? '' }} cycles/min;</h6>
                                                                        <h6 class="mb-0 font-size-15">Next appointment:
                                                                            {{ $case_note->next_appointment ?? '' }} </h6>
                                                                        <h6 class="mb-0 font-size-15">Next vaccination:
                                                                            {{ $case_note->next_vaccination ?? '' }} </h6>
                                                                        @if ($case_note->follow_up_status ?? '' != null)
                                                                            <h6 class="mb-0 font-size-15">Pet status:
                                                                                {{ $case_note->follow_up_status ?? '' }}
                                                                            </h6>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row align-items-top">
                                                            <div class="col-md-3">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="media profile-media align-items-top">
                                                                    <div class="profile-dots border-primary mt-1"></div>
                                                                    <div class="ml-4">

                                                                        @php
                                                                            $test = App\Models\TestRequest::where(
                                                                                'token',
                                                                                $case_note->token ?? '',
                                                                            )->get();
                                                                            $testcount = App\Models\TestRequest::where(
                                                                                'token',
                                                                                $case_note->token ?? '',
                                                                            )->count();
                                                                        @endphp

                                                                        @if ($case_note->diagnosis ?? '' != null)
                                                                            <h6 class=" mb-1">Pet Diagnosed</h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {{ $case_note->diagnosis ?? '' }}
                                                                            </p>
                                                                        @else
                                                                            <h6 class=" mb-1">Other diagnosis exmination
                                                                            </h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {!! nl2br(e($case_note->other_examination)) !!}</p>
                                                                        @endif
                                                                        @if ($testcount > 0)
                                                                            @if ($test != null)
                                                                                <h6 class=" mb-1">Laboratory test required
                                                                                </h6>
                                                                                @foreach ($test as $t)
                                                                                    <p class="mb-0 font-size-15">
                                                                                        {!! nl2br(e($t->test_request ?? '')) !!}</p>
                                                                                @endforeach
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="row align-items-top">
                                                            <div class="col-md-3">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="media profile-media align-items-top">
                                                                    <div class="profile-dots border-primary mt-1"></div>
                                                                    <div class="ml-4">
                                                                        @if ($case_note->visual_evaluation ?? '' != null)
                                                                            <h6 class=" mb-1">Visual evaluation</h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {!! nl2br(e($case_note->visual_evaluation ?? '')) !!}
                                                                            </p>
                                                                        @endif

                                                                        <h6 class=" mb-1">Treatment & Others</h6>
                                                                        <button class="btn sidebar-bottom-btn btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalCenter">View
                                                                            medication</button>

                                                                        @if ($refer->pet_card_no ?? '' != null)
                                                                            <button class="btn sidebar-bottom-btn btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModalCenter3">View
                                                                                refer</button>
                                                                        @endif

                                                                        @if ($case_note->file ?? '' != null)
                                                                            <button class="btn sidebar-bottom-btn btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModalCenterdocument">View
                                                                                attached document</button>
                                                                        @endif

                                                                        @if ($case_note && $case_note->created_at->diffInHours(now()) < $system_config->update_case_note_time)
                                                                            <button class="btn sidebar-bottom-btn btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModalCenter4"> Modify
                                                                                case note</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    @if ($case_note->result ?? '' != null)
                                                        <li>
                                                            <div class="row align-items-top">
                                                                <div class="col-3">

                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="media profile-media pb-0 align-items-top">
                                                                        <div class="profile-dots border-primary mt-1"></div>
                                                                        <div class="ml-4">
                                                                            <h6 class=" mb-1">Veterinary Report</h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {!! nl2br(e($case_note->result ?? '')) !!}</p>

                                                                            @php
                                                                                $admission = App\Models\Admission::where(
                                                                                    'pet_id',
                                                                                    $case_note->case_id ?? '',
                                                                                )
                                                                                    ->where(
                                                                                        'token',
                                                                                        $case_note->token ?? '',
                                                                                    )
                                                                                    ->where('status', 0)
                                                                                    ->first();
                                                                            @endphp
                                                                            @if ($admission)
                                                                                <h6 class=" mb-1">Admission</h6>
                                                                                @if ($admission->status == 0)
                                                                                    <p class="mb-0 font-size-15">On
                                                                                        admission</p>
                                                                                @else
                                                                                    <p class="mb-0 font-size-15">Discharge
                                                                                    </p>
                                                                                @endif
                                                                                @if (floor((time() - +strtotime($admission->date)) / 86400) == 0)
                                                                                    <p class="mb-0 font-size-15"> Today</p>
                                                                                @elseif (floor((time() - +strtotime($admission->date)) / 86400) == 1)
                                                                                    <p class="mb-0 font-size-15">
                                                                                        {{ floor((time() - +strtotime($admission->date)) / 86400) }}
                                                                                        day</p>
                                                                                @else
                                                                                    <p class="mb-0 font-size-15">
                                                                                        {{ floor((time() - +strtotime($admission->date)) / 86400) }}
                                                                                        days</p>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    @if ($case_note->follow_up_status ?? '' != null)
                                                        <li>
                                                            <div class="row align-items-top">
                                                                <div class="col-3">

                                                                </div>
                                                                <div class="col-9">
                                                                    <div class="media profile-media pb-0 align-items-top">
                                                                        <div class="profile-dots border-primary mt-1">
                                                                        </div>
                                                                        <div class="ml-4">
                                                                            @if ($case_note->diseases_type != 'Non')
                                                                                <h6 class=" mb-1">Diseases </h6>
                                                                                <p class="mb-0 font-size-15">
                                                                                    {!! nl2br(e($case_note->diseases_type ?? '')) !!}</p>
                                                                            @endif
                                                                            <h6 class=" mb-1">Treatment progress </h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {!! nl2br(e($case_note->follow_up_status ?? '')) !!}</p>

                                                                            <h6 class=" mb-1">Drug compliance</h6>
                                                                            <p class="mb-0 font-size-15">
                                                                                {!! nl2br(e($case_note->follow_up_status ?? '')) !!}</p>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    <li>
                                                        <div class="row align-items-top">

                                                            <div class="col-9">
                                                                <div class="media profile-media pb-0 align-items-top">
                                                                    <div class="profile-dots border-primary mt-1"></div>
                                                                    <div class="ml-4">
                                                                        <h6 class=" mb-1">Veterinary Doctor</h6>
                                                                        @php
                                                                            $username = App\Models\User::where(
                                                                                'id',
                                                                                $case_note->user_id ?? '',
                                                                            )->first();
                                                                        @endphp
                                                                        <p class="mb-0 font-size-14">
                                                                            {!! nl2br(e($username->name ?? '')) !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            @else
                                                <br><br><br> <br><br><br>
                                                <p class="mb-0 font-size-15" style="color: red">Regrettably, it seems that
                                                    there are currently
                                                    no records available for this specific pet within our system. While we
                                                    diligently maintain
                                                    comprehensive data for all pets in our care, it appears that this pet's
                                                    information has not yet
                                                    been logged into our system</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    function generate_uuid()
                                    {
                                        return sprintf(
                                            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                                            mt_rand(0, 0xffff),
                                            mt_rand(0, 0xffff),
                                            mt_rand(0, 0xffff),
                                            mt_rand(0, 0x0fff) | 0x4000,
                                            mt_rand(0, 0x3fff) | 0x8000,
                                            mt_rand(0, 0xffff),
                                            mt_rand(0, 0xffff),
                                            mt_rand(0, 0xffff),
                                        );
                                    }

                                    $token = generate_uuid();
                                @endphp

                                {{-- medical history start from here --}}
                                <div id="profile2" class="tab-pane fade">
                                    <img src="{{ asset('assets/images/logo.png') }}" class="logo-invoice img-fluid mb-3">
                                    <h5>Assesssment note for {{ $encounterId->Pet_name }} <strong>-</strong>

                                        [ {{ $encounterId->Pet_Card_Number }}] <strong>-</strong>
                                        {{ $encounterId->Gender }} <strong>-</strong> {{ $encounterId->Breed }}</h5>

                                    {{-- <br> --}}
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Visit type </h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div
                                                    class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input bg-warning"
                                                        id="customCheck-4" checked="">
                                                    <label class="custom-control-label" for="customCheck-4">New
                                                        case</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customCheck6">

                                                    @if ($case_note)
                                                        <label class="custom-control-label" for="customCheck6">Follow
                                                            up</label>
                                                    @endif
                                                </div>
                                                <br>
                                                <div id="progressDropdown" style="display: none;">
                                                    <br>
                                                    <div class="col-md-312">
                                                        <center>
                                                            <h5>Recent assesssment </h5>
                                                        </center>
                                                        <h6 class="mb-0 font-size-14">
                                                            Presenting complain symptom </h6>
                                                        <p> {{ $case_note->presenting_complain_symptoms ?? '' }}. </p>


                                                        <h6 class="mb-0 font-size-14">
                                                            History presenting illness </h6>
                                                        <p> {{ $case_note->history_presenting_illness ?? '' }}
                                                            <strong>-</strong>
                                                            {{ $case_note ? $case_note->created_at->diffForHumans() : '' }}
                                                        </p>

                                                        <h6 class="mb-0 font-size-14">Physical examination:
                                                            {!! nl2br(e($case_note->physical_examination ?? '')) !!} <strong>-</strong> Temperature:
                                                            {{ $case_note->temp ?? '' }}&deg; <strong>-</strong> Pulse:
                                                            {{ $case_note->pulse ?? '' }}BPM <strong>-</strong>
                                                            Resp(cycles/min):
                                                            {{ $case_note->resp ?? '' }} cycles/min.
                                                        </h6>
                                                        <br>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form action="{{ route('Admin.Clinic.encounter_store') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <h6>Treatment progress</h6>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault1" value="Better"
                                                                        id="flexRadioDefault1">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault1">
                                                                        Better
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault2" value="Good"
                                                                        id="flexRadioDefault2">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault2">
                                                                        Good
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault3" value="Bad"
                                                                        id="flexRadioDefault3">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault3">
                                                                        Bad
                                                                    </label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault4" value="Worse"
                                                                        id="flexRadioDefault4">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault4">
                                                                        Worse
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault5" value="About the same"
                                                                        id="flexRadioDefault5">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault5">
                                                                        About the same
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault6" value="Not applicable"
                                                                        id="flexRadioDefault6">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault6">
                                                                        Not applicable
                                                                    </label>
                                                                </div>
                                                        </div>

                                                        {{-- drug start from here --}}
                                                        <div class="col-md-6">
                                                            <h6>Drug compliance</h6>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault7" value="Better"
                                                                    id="flexRadioDefault7">
                                                                <label class="form-check-label" for="flexRadioDefault7">
                                                                    Better
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault8" value="Good"
                                                                    id="flexRadioDefault8">
                                                                <label class="form-check-label" for="flexRadioDefault8">
                                                                    Good
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault9" value="Bad"
                                                                    id="flexRadioDefault9">
                                                                <label class="form-check-label" for="flexRadioDefault9">
                                                                    Bad
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault10" value="Worse"
                                                                    id="flexRadioDefault10">
                                                                <label class="form-check-label" for="flexRadioDefault10">
                                                                    Worse
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault11" value=" About the same"
                                                                    id="flexRadioDefaul11">
                                                                <label class="form-check-label" for="flexRadioDefault11">
                                                                    About the same
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault12" value=" Not applicable"
                                                                    id="flexRadioDefault12">
                                                                <label class="form-check-label" for="flexRadioDefault12">
                                                                    Not applicable
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Presenting complaints </h6>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row"> --}}
                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Search symptoms</h6>
                                            <select name="presenting_complain_symptoms" aria-label="Search symptoms"
                                                id="presentingComplaint" class="form-control" required>

                                                <option value="" selected> ~~ Select symptoms ~~</option>
                                                @foreach ($syptoms as $s)
                                                    <option value="{{ $s->symptoms }}"
                                                        data-description="{{ $s->desc }}">
                                                        {{ $s->symptoms }}</option>
                                                @endforeach
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="hide_sytoms_other" style="display: none">
                                            <br>
                                            <a style="color: black" data-toggle="collapse" href="#collapseExample"
                                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <p style="color: green"class="mb-0 font-size-14">Click to enter symptom</p>
                                                {{-- <h6 style="font: 20px"> + Others</h6> --}}
                                            </a>
                                            <hr>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <input type="text" class="form-control" name="symptoms_template"
                                                        id="">
                                                    {{-- <hr> --}}
                                                    <div class="checkbox d-inline-block mr-1">
                                                        <center> <input type="checkbox" class="checkbox-input"
                                                                value="1" name="save_checkbox_template"
                                                                id="checkbox2">
                                                            <h6 id="checkbox2">Save as symptom</h6>
                                                        </center>
                                                        {{-- <h1>Ok</h1> --}}

                                                        <h6 data-toggle="collapse" href="#collapseExample" role="button"
                                                            aria-expanded="false" aria-controls="collapseExample"> + Ok
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6>History of presenting illness</h6>
                                            <textarea name="history_presenting_illness" id="presentingIllness" class="form-control font-size-15" cols="3"
                                                rows="3" placeholder="History of presenting illness"></textarea>
                                            <br>
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Physical examination </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">

                                            <input type="hidden" value="{{ $token }}" name="token"
                                                id="token">
                                            <input type="hidden" value="{{ $encounterId->Pet_Card_Number }}"
                                                name="case_id" id="">
                                            @php
                                                $randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // Generate a random 6-digit number
                                                $timestamp = time() % 100; // Get last 2 digits of current timestamp (seconds)
                                                $uniqueNumber = $randomNumber . sprintf('%02d', $timestamp);
                                            @endphp
                                            <input type="hidden" name="tracking_no" value="{{ $uniqueNumber }}"
                                                id="">
                                            <h6 class=" mb-1">Physical examination</h6>
                                            <select class="form-control" aria-label="Physical Examination"
                                                name="physical_examination" required>
                                                <option value="" disabled selected>Select physical examination
                                                </option>
                                                @foreach ($phy_exam as $p)
                                                    <option value="{{ $p->desc }}">{{ $p->desc }}</option>
                                                @endforeach
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Temp °C</h6>
                                            <input type="text" name="temp" placeholder="37.5°C"
                                                class="form-control" id="" required>
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Pulse(/min)</h6>
                                            <input type="text" name="pulse" placeholder="20/min"
                                                class="form-control" id="" required>

                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Resp(cycles/min)</h6>
                                            <input type="text" name="resp" placeholder="20/min"
                                                class="form-control" id="" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Visual evaluation</h6>
                                            <textarea class="form-control" placeholder="Visual evaluation" name="visual_evaluation" cols="4"
                                                rows="4" required></textarea>
                                        </div>

                                        <div class="col-md-6 mb-6">
                                            <h6 class=" mb-1">Veterinary note</h6>
                                            <textarea name="result" id="" placeholder="Veterinary note" class="form-control" cols="4"
                                                rows="4" required></textarea>
                                            <br>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">
                                                        Supplementary diagnosis</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Pet diagnoses</h6>
                                            <select class="form-control" aria-label="Pet Diagnoses" name="diagnosis"
                                                id="diagnosis" required>
                                                <option value="" disabled selected>Select a diagnosis</option>
                                                @foreach ($dia as $d)
                                                    <option value="{{ $d->desc }}">{{ $d->desc }}</option>
                                                @endforeach
                                                <option value="Other">Other
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3" id="otherDiagnosis" style="display: none;">
                                            <h6 class="mb-1">Other diagnoses <small>If any applicable</small></h6>
                                            <textarea name="other_examination" id="other_examination" cols="2" placeholder="Other diagnoses"
                                                class="form-control" rows="2"></textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <h6 class=" mb-1">Diagnoses comment</h6>
                                            <textarea name="diagnoses_comment" id="" placeholder="Diagnoses comment or remark" class="form-control"
                                                cols="2" rows="2" required></textarea>
                                        </div>


                                        <div class="col-md-12 mb-3" id="hide_treatment_header" style="display: none;">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Recommended Treatment</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3" id="hide_lab_request" style="display: none;">
                                            <h6 class=" mb-1"> Request for laboratory </h6>
                                            <select class="form-control" aria-label="Select a test" name="test_request"
                                                id="test_request">
                                                <option value="" disabled selected>Select tests requested</option>
                                                @foreach ($lab as $l)
                                                    <option
                                                        value="{{ $l->lab_category . '|' . $l->lab_desc . '|' . $l->price }}">
                                                        {{ $l->lab_desc }}</option>
                                                @endforeach
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3" id="hidde_treatment" style="display: none;">
                                            <br>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <a href="" data-toggle="modal" data-toggle="modal"
                                                        data-target=".bd-example-modal-xl">Write
                                                        prescription</a>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="" data-toggle="modal"
                                                        data-target=".bd-example-modal-lg2">Other
                                                        Service</a>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="" data-toggle="modal"
                                                        data-target="#exampleModalCenter2Upload_load"> Upload document
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3" id="otherTestDiv" style="display: none;">
                                            <h6 class=" mb-1"> Supplementary procedure </h6>
                                            <textarea name="other_test_request" class="form-control" id="" cols="2" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Diseases status</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault23" value="Communicate disease"
                                                            id="flexRadioDefault23">
                                                        <label class="form-check-label" for="flexRadioDefault23">
                                                            Communicate disease ?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault20" value="Non"
                                                            id="flexRadioDefault20" checked>
                                                        <label class="form-check-label" for="flexRadioDefault20">
                                                            Non
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault31" value="Complicated case"
                                                            id="flexRadioDefault31">
                                                        <label class="form-check-label" for="flexRadioDefault31">
                                                            Complicated case ?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault41" value="Notifiable disease"
                                                            id="flexRadioDefault41">
                                                        <label class="form-check-label" for="flexRadioDefault41">
                                                            Notifiable disease?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault42" value="Pregnant pet"
                                                            id="flexRadioDefault42">
                                                        <label class="form-check-label" for="flexRadioDefault42">
                                                            Pregnant pet?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault43" value="Suspected diagnosis"
                                                            id="flexRadioDefault43">
                                                        <label class="form-check-label" for="flexRadioDefault43">
                                                            Suspected diagnosis ?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault44" value="Multiple diseases"
                                                            id="flexRadioDefault44">
                                                        <label class="form-check-label" for="flexRadioDefault44">
                                                            Multiple diseases ?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 style="color: white" class=" mb-1">Required follow up</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Next appointment</h6>
                                            <input type="date" name="next_appointment" placeholder="Naxt appointment"
                                                class="form-control" id="" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Next vaccination</h6>
                                            <input type="date" name="next_vaccination" placeholder="20/min"
                                                class="form-control" id="" required>
                                        </div>

                                        @php
                                            $admission2 = App\Models\Admission::where(
                                                'pet_id',
                                                $case_note->case_id ?? '',
                                            )
                                                ->where('status', 0)
                                                ->first();
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            @if ($admission2)
                                                <h6 style="color: red">Pet is already on admission', 'Warning!</h6>
                                            @else
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" value="1" class="custom-control-input"
                                                        name="admit_to_ward" id="customCheck5">
                                                    <label class="custom-control-label" for="customCheck5">To be admited
                                                        ?</label>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <button type="submit"
                                                class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-4 card-profile">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">

                            {{-- {{ $outstandingPayment-> }}; --}}
                            @if ($outstandingPayment-> isNotEmpty())
                            <x-paymentSecton    :attribute1="$system_config" :attribute2="$outstandingPayment"></x-paymentSecton>
                            @endif


                        <div class="d-flex align-items-center mb-3">
                            <div class="col-md-8">
                                <h6 class="mb-0"> {{ $encounterId->Pet_name }} [<small>
                                        {{ $encounterId->Pet_Card_Number }}</small>]</h6>
                                <p class="mb-0">Breed: {{ $encounterId->Breed }}</p>
                                <p class="mb-0">Gender: {{ $encounterId->Gender }}</p>
                            </div>
                            <div class="col-md-4">
                                @if ($checkIfExit != null)
                                    <img src="{{ asset('assets/images/icons8-hospital-bed-64.png') }}"
                                        class="logo-invoice img-fluid mb-3">
                                    <h6 style="color: red">On admission</h6>
                                @endif
                            </div>
                        </div>

                        @if ($encounterId->allergy ?? '' != null)
                            <div class="alert text-white bg-secondary" role="alert">
                                <div class="iq-alert-icon">
                                    <i class="ri-information-line"></i>
                                </div>
                                <div class="iq-alert-text">Allergy to <b> {{ $encounterId->allergy ?? '' }}</b> Please
                                    check it out!</div>
                            </div>
                        @endif

                        <ul class="list-inline p-0 m-0">
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="mb-0">{{ $encounterId->address ?? '' }}</p>
                                </div>
                            </li>

                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                                    </svg>
                                    <p class="mb-0">Date of birth : {{ $encounterId->Age ?? '' }}</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <p class="mb-0">{{ $encounterId->Owner_Phone_Number ?? '' }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <svg class="svg-icon mr-3" height="16" width="16"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mb-0">{{ $encounterId->Name_Of_Pet_Owner }}</p>
                                </div>
                            </li>
                            <hr>

                            @if ($case_note)
                                <p>
                                    Last visit: {{ $case_note->date ?? '' }}

                                <h6 class=" mb-1">Veterinary Doctor</h6>
                                @php
                                    $username = App\Models\User::where('id', $case_note->user_id ?? '')->first();
                                @endphp
                                <p class="mb-0 font-size-14">{!! nl2br(e($username->name ?? '')) !!}</p>
                                </p>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <button class="btn sidebar-bottom-btn btn-lg btn-block" data-toggle="modal"
                                            data-target="#exampleModalLong">Pet medical history</button>
                                    </div>
                                </li>
                            @endif
                        </ul>

                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="">Request for Imaging</a>
                            </div>

                            <div class="col-md-6">
                                <a href="">Request Others</a>
                            </div>

                        </div>
                        <br>
                        {{-- <br> --}}
                        {{-- refer pat start from here --}}
                        <p>You have the option to transfer the pet to another clinic for treatment</p>
                        <form action="{{ route('Admin.Clinic.refer_store') }}" id="referred_form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $encounterId->Pet_Card_Number }}" name="case_id"
                                id="case_id">



                            <h6 class=" mb-1">Refer to a different clinic</h6>
                            <input type="text" placeholder="Refer to a different clinic" class="form-control"
                                name="clinic_name" id="clinic_name">
                            <br>
                            <h6 class=" mb-1">Medical practitioner's name</h6>
                            <input type="text" class="form-control" placeholder="Medical practitioner's name"
                                name="practitioner_name" id="practitioner_name">
                            <br>
                            <h6 class=" mb-1">Purpose of referral</h6>
                            <textarea id="" class="form-control" name="purpose_of_referral" cols="3" rows="3"></textarea>
                            <br>
                            @if ($system_config->disable_refer == 1)
                                <button type="submit" id="process_button"
                                    class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                            @else
                                <button type="submit" disabled id="process_button"
                                    class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>


        {{-- ViewMedicalHistory modal --}}
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $encounterId->Pet_name ?? '' }} medical
                            history
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($case_note_get_all as $c)
                            <ul class="list-inline p-0 m-0 w-100">
                                <li>
                                    <div class="row align-items-top">
                                        <div class="col-md-3">
                                            <h6 class="mb-2">{{ $c->date ?? '' }}</h6>
                                            <h6>{{ $c->created_at->format('h:i A') }}</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="media profile-media align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    <h6 class=" mb-0">Presenting complain symptoms</h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($c->presenting_complain_symptoms ?? '')) !!}</p>

                                                    <h6 class=" mb-0">History presenting illness</h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($c->history_presenting_illness ?? '')) !!}.</p>

                                                    <h6 class=" mb-0">Physical examination
                                                    </h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($c->physical_examination ?? '')) !!}</p>
                                                    <h6 class="mb-0 font-size-15">Temperature:
                                                        {{ $c->temp ?? '' }}&deg;,Pulse:
                                                        {{ $c->pulse ?? '' }}BPM.</h6>
                                                    <h6 class="mb-0 font-size-15">Resp(cycles/min):
                                                        {{ $c->resp ?? '' }} cycles/min</h6>
                                                    <h6 class="mb-0 font-size-15">Next appointment:
                                                        {{ $c->next_appointment ?? '' }} </h6>
                                                    <h6 class="mb-0 font-size-15">Next vaccination:
                                                        {{ $c->next_vaccination ?? '' }} </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="row align-items-top">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="media profile-media align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    @if ($c->diagnosis ?? '' != null)
                                                        <h6 class=" mb-1">Pet Diagnosed</h6>
                                                        <p class="mb-0 font-size-15">
                                                            {{ $c->diagnosis ?? '' }}
                                                        </p>
                                                    @else
                                                        <h6 class=" mb-1">Other diagnosis exmination</h6>
                                                        <p class="mb-0 font-size-15">{!! nl2br(e($c->other_examination)) !!}</p>
                                                    @endif
                                                    @if ($testcount > 0)
                                                        @if ($test != null)
                                                            <h6 class=" mb-1">Laboratory test required
                                                            </h6>
                                                            @foreach ($test as $t)
                                                                <p class="mb-0 font-size-15">
                                                                    {!! nl2br(e($t->test_request ?? '')) !!}</p>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                @if ($c->visual_evaluation ?? '' != null)
                                    <li>
                                        <div class="row align-items-top">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="media profile-media align-items-top">
                                                    <div class="profile-dots border-primary mt-10"></div>
                                                    <div class="ml-4">
                                                        {{-- <h6 class=" mb-1">Treatment</h6> --}}
                                                        <h6 class=" mb-1">Prescription & Services
                                                        </h6>
                                                        @php
                                                            $history = App\Models\Medication_request::where(
                                                                'request_medication_token',
                                                                $c->token,
                                                            )->get();
                                                        @endphp
                                                        @if ($history->isNotEmpty())
                                                            @foreach ($history as $h)
                                                                @php
                                                                    $cat = App\Models\Medicationcategoty::find(
                                                                        $h->med_category,
                                                                    );
                                                                @endphp
                                                                <p class="mb-0"><strong>Description:</strong>
                                                                    {!! nl2br(e($cat->med_desc ?? '')) !!}</p>
                                                                <p class="mb-0">{!! nl2br(e($h->medication ?? '')) !!}</p>
                                                                @if ($h->dosage)
                                                                    <p class="mb-0"><strong>Dosage:</strong>
                                                                        {!! nl2br(e($h->dosage)) !!}</p>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <p class="mb-0"><em>No prescription was given to the pet</em>
                                                            </p>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif


                                @if ($c->visual_evaluation ?? '' != null)
                                    <li>
                                        <div class="row align-items-top">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="media profile-media align-items-top">
                                                    <div class="profile-dots border-primary mt-10"></div>
                                                    <div class="ml-4">
                                                        <h6 class=" mb-1">Visual evaluation</h6>
                                                        <p class="mb-0 font-size-15">{!! nl2br(e($c->visual_evaluation ?? '')) !!}</p>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif


                                @if ($c->result ?? '' != null)
                                    <li>
                                        <div class="row align-items-top">
                                            <div class="col-3">

                                            </div>
                                            <div class="col-9">
                                                <div class="media profile-media pb-0 align-items-top">
                                                    <div class="profile-dots border-primary mt-1"></div>
                                                    <div class="ml-4">
                                                        <h6 class=" mb-1">Veterinary Report</h6>
                                                        <p class="mb-0 font-size-15">{!! nl2br(e($c->result ?? '')) !!}</p>
                                                        @php
                                                            $admit = App\Models\Admission::where(
                                                                'pet_id',
                                                                $c->case_id ?? '',
                                                            )
                                                                ->where('token', $c->token)
                                                                ->where('status', 0)
                                                                ->get();
                                                            $admit2 = App\Models\Admission::where(
                                                                'pet_id',
                                                                $c->case_id ?? '',
                                                            )
                                                                ->where('token', $c->token)
                                                                ->where('status', 0)
                                                                ->count();
                                                        @endphp
                                                        @if ($admit2)
                                                            <h6 class=" mb-1">Admission</h6>
                                                            @foreach ($admit as $v)
                                                                @if ($v->status == 0)
                                                                    <p class="mb-0 font-size-15">On admission</p>
                                                                @else
                                                                    <p class="mb-0 font-size-15">Discharge</p>
                                                                @endif
                                                                @if (floor((time() - +strtotime($v->date ?? '')) / 86400) == 0)
                                                                    <p class="mb-0 font-size-15"> Today</p>
                                                                @elseif (floor((time() - +strtotime($v->date ?? '')) / 86400) == 1)
                                                                    <p class="mb-0 font-size-15">
                                                                        {{ floor((time() - +strtotime($v->date ?? '')) / 86400) }}
                                                                        day</p>
                                                                @else
                                                                    <p class="mb-0 font-size-15">
                                                                        {{ floor((time() - +strtotime($v->date ?? '')) / 86400) }}
                                                                        days</p>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <div class="row align-items-top">

                                        <div class="col-9">
                                            <div class="media profile-media pb-0 align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    <h6 class=" mb-1">Veterinary Doctor</h6>
                                                    @php
                                                        $username = App\Models\User::where(
                                                            'id',
                                                            $c->user_id ?? '',
                                                        )->first();
                                                    @endphp
                                                    <p class="mb-0 font-size-15"> {!! nl2br(e($username->name ?? '')) !!}
                                                    </p>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>




        {{-- //this calling upload document function --}}
        <x-image_request :attribute1="$token" :attribute2="$encounterId->Pet_Card_Number" />f
        </div>

        {{-- view medication --}}
        <x-viewMedication :attribute1="$req_medicaton"></x-viewMedication>

        {{-- medication request --}}
        <x-request_medication :var="$var" :medication="$medication" :token="$token" :attribute2="$encounterId->Pet_Card_Number"
            :uniqueNumber="$uniqueNumber"></x-request_medication>

        {{-- view Others request --}}
        <x-other_service :attribute1="$token" :attribute2="$encounterId->Pet_Card_Number" :services="$services" :uniqueNumber="$uniqueNumber"></x-other_service>



        <x-refer :refer="$refer"></x-refer>




        {{-- this section is for document --}}
        <div class="modal fade" id="exampleModalCenterdocument" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalCenterTitle">Attached document</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <img src="{{ asset('storage/' . $case_note->file ?? '') }}" class="img-fluid rounded"
                            alt="Responsive image"> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- this section is for refer --}}
        <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalCenterTitle">Modify case entry</h6>
                    </div>
                    <div class="modal-body">
                        @if ($case_note && $case_note->created_at->diffInHours(now()) < $system_config->update_case_note_time)
                            <form action="{{ route('Admin.Clinic.encounter_update', $case_note->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $case_note->id }}" id="">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
                                <textarea name="case_note_edit" class="form-control" id="" cols="5" rows="5">{{ $case_note->result ?? '' }}</textarea>
                                <br>
                                <center><button type="submit" class="btn sidebar-bottom-btn btn-lg">Update case note
                                    </button></center>
                            </form>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
            document.getElementById('diagnosis').addEventListener('change', function() {
                var otherDiagnosis = document.getElementById('otherDiagnosis');
                var otherExamination = document.getElementById('other_examination');
                var hidde_treatment = document.getElementById('hidde_treatment');
                var hide_treatment_header = document.getElementById('hide_treatment_header');
                var hide_lab_request = document.getElementById('hide_lab_request');

                if (this.value === 'Other') {
                    otherDiagnosis.style.display = 'block';
                    otherExamination.required = true;

                } else {
                    otherDiagnosis.style.display = 'none';
                    otherExamination.required = false;
                }

                if (this.value === '') {
                    hidde_treatment.style.display = 'none';
                    hide_treatment_header.style.display = 'none';
                    hide_lab_request.style.display = 'none';
                } else {
                    hidde_treatment.style.display = 'block'
                    hide_treatment_header.style.display = 'block';
                    hide_lab_request.style.display = 'block';
                }

            });

            document.getElementById('test_request').addEventListener('change', function() {
                var otherTestDiv = document.getElementById('otherTestDiv');

                if (this.value === 'Other') {
                    otherTestDiv.style.display = 'block';
                } else {
                    otherTestDiv.style.display = 'none';
                }
            });

            document.getElementById('customCheck6').addEventListener('change', function() {
                var progressDropdown = document.getElementById('progressDropdown');

                if (this.checked) {
                    progressDropdown.style.display = 'block';
                } else {
                    progressDropdown.style.display = 'none';
                }
            });

            document.getElementById('customCheck-4').addEventListener('change', function() {
                var progressDropdown = document.getElementById('progressDropdown');

                if (this.checked) {
                    progressDropdown.style.display = 'none';
                }
            });


            // Listen for click event on the "Follow up" checkbox
            $('#customCheck6').on('click', function() {
                // Uncheck the "New case" checkbox
                $('#customCheck-4').prop('checked', false);
            });

            // Listen for click event on the "Follow up" checkbox
            $('#customCheck-4').on('click', function() {
                // Uncheck the "New case" checkbox
                $('#customCheck6').prop('checked', false);
            });



            $('#presentingComplaint').on('change', function() {
                // Get the selected symptom's description
                var selectedSymptom = $(this).find(':selected');
                var description = selectedSymptom.data('description');
                var hide_sytoms_other = document.getElementById('hide_sytoms_other');

                if (this.value === 'Other') {
                    hide_sytoms_other.style.display = 'block';
                    hide_sytoms_other.required = true;

                } else {
                    hide_sytoms_other.style.display = 'none';
                    hide_sytoms_other.required = false;
                }


                // Update the textarea with the description
                $('#presentingIllness').val(description);
            });


            // this submiting
            // this for instacting referring.....
            $(document).ready(function() {
                $('#referred_form').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $('#process_button').text
                    $.ajax({
                        url: '{{ route('Admin.Clinic.refer_store') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $('#process_button').text('Processing...');
                        },
                        success: function(response) {
                            toastr.success(response.message, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                hideMethod: 'slideUp',
                                timeOut: 3000
                            });
                            $('#referred_form')[0].reset();
                            $('.bd-example-modal-xl').modal('hide');
                            $('#process_button').text('Process');
                        },
                        error: function(xhr, status, error) {
                            toastr.error('An error occurred. Please try again later.', 'Error!');
                            $('#process_button').text('Process');
                        }
                    });
                });
            });


            // this for updaing case note
        </script>
    @endsection
</x-admin-master>
