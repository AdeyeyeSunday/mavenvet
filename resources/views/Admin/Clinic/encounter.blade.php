<x-admin-master>
    @section('content')
        <br><br><br><br>
        <div class="container-fluid">
            <div class="row m-sm-0 px-3">

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
                                            <h5 class="mb-0">Hello, {{ Auth::user()->name ?? ''}}</h5>
                                            <p>For <strong> [{{ $encounterId->Pet_name  ?? ''}} ] [Card
                                                    no.{{ $encounterId->Pet_Card_Number ?? '' }} ] </strong>, document every vet
                                                visit since
                                                birth, including dates,
                                                weight, vaccinations, medications, surgeries, and hospital visits. Also,
                                                note any tests conducted and their outcomes.</p>
                                                @if($case_note)
                                            <h5>Past health status</h5>
                                            <br>
                                            <ul class="list-inline p-0 m-0 w-100">
                                                <li>
                                                    <div class="row align-items-top">
                                                        <div class="col-md-3">
                                                            <h6 class="mb-2">{{ $case_note->date  ?? ''}} - present</h6>
                                                            <h6>Time: {{ $case_note->created_at->format('h:i A') }}</h6>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="media profile-media align-items-top">
                                                                <div class="profile-dots border-primary mt-1"></div>
                                                                <div class="ml-4">
                                                                    <h6 class=" mb-0">Presenting complain symptoms</h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->presenting_complain_symptoms ?? '')) !!}</p>

                                                                    <h6 class=" mb-0">History presenting illness</h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->history_presenting_illness ?? '')) !!}.
                                                                    </p>
                                                                    <h6 class=" mb-0">Physical examination
                                                                    </h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->physical_examination ?? '')) !!}</p>
                                                                    </h6>
                                                                    <h6 class="mb-0 font-size-15">Temperature:
                                                                        {{ $case_note->temp ?? '' }}&deg;</h6>
                                                                    <h6 class="mb-0 font-size-15">Pulse:
                                                                        {{ $case_note->pulse  ?? ''}}BPM;</h6>
                                                                    <h6 class="mb-0 font-size-15">Resp(cycles/min):
                                                                        {{ $case_note->resp ?? '' }} cycles/min;</h6>
                                                                    <h6 class="mb-0 font-size-15">Next appointment:
                                                                        {{ $case_note->next_appointment ?? '' }} </h6>
                                                                    <h6 class="mb-0 font-size-15">Next vaccination:
                                                                        {{ $case_note->next_vaccination  ?? ''}} </h6>
                                                                    @if ($case_note->follow_up_status  ?? '' != null)
                                                                        <h6 class="mb-0 font-size-15">Pet status:
                                                                            {{ $case_note->follow_up_status  ?? ''}} </h6>
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
                                                                            $case_note->token  ?? '',
                                                                        )->get();
                                                                        $testcount = App\Models\TestRequest::where(
                                                                            'token',
                                                                            $case_note->token  ?? '',
                                                                        )->count();
                                                                    @endphp
                                                                    @if ($testcount > 0)
                                                                        @if ($test != null)
                                                                            <h6 class=" mb-1">Veterinary examination</h6>
                                                                            @foreach ($test as $t)
                                                                                <p class="mb-0 font-size-15">
                                                                                    {!! nl2br(e($t->test_request  ?? '')) !!}</p>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    @if ($case_note->diagnosis ?? '' != null)
                                                                    <h6 class=" mb-1">Pet diagnosis</h6>
                                                                        <p class="mb-0 font-size-15">
                                                                            {{ $case_note->diagnosis  ?? '' }}
                                                                        </p>
                                                                     @else
                                                                     <h6 class=" mb-1">Other diagnosis exmination</h6>
                                                                     <p class="mb-0 font-size-15">{!! nl2br(e($case_note->other_examination)) !!}</p>
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
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->visual_evaluation  ?? '')) !!}</p>
                                                                    @endif

                                                                    <h6 class=" mb-1">Medcation</h6>
                                                                    <button class="btn sidebar-bottom-btn btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModalCenter">View
                                                                        medication</button>
                                                                    <button class="btn sidebar-bottom-btn btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModalCenter2">View
                                                                        treatment</button>

                                                                    @if ($refer->pet_card_no ?? '' != null)
                                                                        <button class="btn sidebar-bottom-btn btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalCenter3">View
                                                                            refer</button>
                                                                    @endif

                                                                    @if ($case_note && $case_note->created_at->diffInHours(now()) < 6)
                                                                        <button class="btn sidebar-bottom-btn btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalCenter4">View & Update
                                                                            veterinary case note</button>
                                                                    @else
                                                                        <button class="btn sidebar-bottom-btn btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalCenter4">View doctor
                                                                            report</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @if ($case_note->result ?? '' != null)
                                                <li>
                                                    <div class="row align-items-top">
                                                        <div class="col-md-3">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="media profile-media align-items-top">
                                                                <div class="profile-dots border-primary mt-1"></div>
                                                                <div class="ml-4">
                                                                    @if ($case_note->result ?? '' != null)
                                                                        <h6 class=" mb-1">Veterinary case note</h6>
                                                                        <p class="mb-0 font-size-15">
                                                                            {{ $case_note->result ?? ''}}
                                                                        </p>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif

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
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->result ?? '')) !!}</p>

                                                                    @php
                                                                        $admission = App\Models\Admission::where(
                                                                            'pet_id',
                                                                            $case_note->case_id?? '',
                                                                        )
                                                                            ->where('token', $case_note->token?? '')
                                                                            ->where('status', 0)
                                                                            ->first();
                                                                    @endphp
                                                                    @if ($admission)
                                                                        <h6 class=" mb-1">Admission</h6>
                                                                        @if ($admission->status == 0)
                                                                            <p class="mb-0 font-size-15">On admission</p>
                                                                        @else
                                                                            <p class="mb-0 font-size-15">Discharge</p>
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
                                                                <div class="profile-dots border-primary mt-1"></div>
                                                                <div class="ml-4">
                                                                    @if ($case_note->diseases_type != "Non")
                                                                    <h6 class=" mb-1">Diseases  </h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->diseases_type ?? '')) !!}</p>
                                                                    @endif
                                                                    <h6 class=" mb-1">Treatment progress </h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->follow_up_status ?? '')) !!}</p>

                                                                    <h6 class=" mb-1">Drug compliance</h6>
                                                                    <p class="mb-0 font-size-15">{!! nl2br(e($case_note->follow_up_status ?? '')) !!}</p>

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
                                                                            $case_note->user_id?? '',
                                                                        )->first();
                                                                    @endphp
                                                                    <p class="mb-0 font-size-14">{!! nl2br(e($username->name ?? '')) !!}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                            </ul>
                                            @else
                                            <br><br><br>
                                        <h5 style="color: red">Unfortunately, there are no records available for this pet at the moment.
                                             Please proceed with commencing treatment or feel free to contact us for further assistance.</h5>
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
                                    <img src="{{ asset('assets/images/logo.png') }}"
                                    class="logo-invoice img-fluid mb-3">
                                  <h5>Assesssment note for {{ $encounterId->Pet_name }} <strong>-</strong>

                                     [ {{ $encounterId->Pet_Card_Number }}] <strong>-</strong> {{ $encounterId->Gender }}</h5>

                                     <br>
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
                                                        <p> {{ $case_note->presenting_complain_symptoms ?? ''}}. </p>


                                                        <h6 class="mb-0 font-size-14">
                                                            History presenting illness </h6>
                                                        <p> {{ $case_note->history_presenting_illness ?? '' }} <strong>-</strong>
                                                            {{ $case_note ? $case_note->created_at->diffForHumans() : '' }} </p>

                                                        <h6 class="mb-0 font-size-14">Physical examination:
                                                            {!! nl2br(e($case_note->physical_examination ?? '')) !!} <strong>-</strong> Temperature:
                                                            {{ $case_note->temp ?? '' }}&deg; <strong>-</strong> Pulse:
                                                            {{ $case_note->pulse ?? '' }}BPM <strong>-</strong> Resp(cycles/min):
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
                                                                    name="flexRadioDefault1" value="Better" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Better
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault2" value="Good" id="flexRadioDefault2">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Good
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault3" value="Bad" id="flexRadioDefault3">
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    Bad
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault4" value="Worse" id="flexRadioDefault4">
                                                                <label class="form-check-label" for="flexRadioDefault4">
                                                                    Worse
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault5" value="About the same" id="flexRadioDefault5">
                                                                <label class="form-check-label" for="flexRadioDefault5">
                                                                    About the same
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault6" value="Not applicable" id="flexRadioDefault6">
                                                                <label class="form-check-label" for="flexRadioDefault6">
                                                                    Not applicable
                                                                </label>
                                                            </div>
                                                        </div>

                                                        {{-- drug start from here --}}
                                                        <div class="col-md-6">
                                                            <h6>Drug compliance</h6>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault7" value="Better" id="flexRadioDefault7">
                                                                <label class="form-check-label" for="flexRadioDefault7">
                                                                    Better
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault8" value="Good" id="flexRadioDefault8">
                                                                <label class="form-check-label" for="flexRadioDefault8">
                                                                    Good
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault9" value="Bad" id="flexRadioDefault9">
                                                                <label class="form-check-label" for="flexRadioDefault9">
                                                                    Bad
                                                                </label>
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault10" value="Worse" id="flexRadioDefault10">
                                                                <label class="form-check-label" for="flexRadioDefault10">
                                                                    Worse
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault11" value=" About the same" id="flexRadioDefaul11">
                                                                <label class="form-check-label" for="flexRadioDefault11">
                                                                    About the same
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault12" value=" Not applicable" id="flexRadioDefault12">
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
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <h6 class=" mb-1">Search symptoms</h6>

                                                    <select name="presenting_complain_symptoms" id="presentingComplaint"
                                                        class="form-control" required>
                                                        <option value="" selected> ~~ Select symptoms ~~</option>
                                                        @foreach ($syptoms as $s)
                                                            <option value="{{ $s->symptoms }}"
                                                                data-description="{{ $s->desc }}">
                                                                {{ $s->symptoms }}</option>
                                                        @endforeach
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <br>
                                                    <a style="color: black" data-toggle="collapse"
                                                        href="#collapseExample" role="button" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        <h6> + Others</h6>
                                                    </a>
                                                    <hr>
                                                    <div class="collapse" id="collapseExample">
                                                        <div class="card card-body">
                                                            <input type="text" class="form-control"
                                                                name="symptoms_template" id="">
                                                            {{-- <hr> --}}
                                                            <div class="checkbox d-inline-block mr-1">
                                                            <center> <input type="checkbox" class="checkbox-input"
                                                                        value="1" name="save_checkbox_template"
                                                                        id="checkbox2">
                                                                        <h6 id="checkbox2">Save as symptom</h6>
                                                                    </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h6>History of presenting illness</h6>
                                                    <textarea name="history_presenting_illness" id="presentingIllness" class="form-control font-size-15" cols="3"
                                                        rows="3" placeholder="History of presenting illness"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white">Physical examination &
                                                        Supplementary diagnosis</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">

                                            <input type="hidden" value="{{ $token }}" name="token"
                                                id="token">
                                            <input type="hidden" value="{{ $encounterId->Pet_Card_Number }}"
                                                name="case_id" id="">
                                            {{-- <label for="validationDefault04">Physical examination</label> --}}
                                            <h6 class=" mb-1">Physical examination</h6>
                                            <select class="form-control" aria-label="Physical Examination"
                                                name="physical_examination" required>
                                                <option value="" disabled selected>Select physical examination
                                                </option>
                                                <option value="Body condition score">Body condition score</option>
                                                <option value="Temperature">Temperature</option>
                                                <option value="Heart rate (pulse)">Heart rate (pulse)</option>
                                                <option value="Respiratory rate">Respiratory rate</option>
                                                <option value="Mucous membrane color">Mucous membrane color (e.g.,
                                                    pink,
                                                    pale, yellow)</option>
                                                <option value="Capillary refill time">Capillary refill time</option>
                                                <option value="Hydration status">Hydration status</option>
                                                <option value="Coat and skin condition">Coat and skin condition
                                                </option>
                                                <option value="Eyes">Eyes (e.g., clarity, discharge, redness)
                                                </option>
                                                <option value="Ears">Ears (e.g., cleanliness, odor, discharge)
                                                </option>
                                                <option value="Nose">Nose (e.g., moisture, discharge, symmetry)
                                                </option>
                                                <option value="Mouth and teeth">Mouth and teeth (e.g., dental health,
                                                    tartar
                                                    buildup, gum color)</option>
                                                <option value="Lymph nodes">Lymph nodes (e.g., size, symmetry,
                                                    tenderness)
                                                </option>
                                                <option value="Abdominal palpation">Abdominal palpation (e.g., organ
                                                    size,
                                                    masses, pain)</option>
                                                <option value="Musculoskeletal system">Musculoskeletal system (e.g.,
                                                    gait,
                                                    muscle tone, joint range of motion)</option>
                                                <option value="Neurological evaluation">Neurological evaluation (e.g.,
                                                    reflexes, coordination, sensation)</option>
                                                <option value="Rectal examination">Rectal examination (e.g., presence
                                                    of
                                                    feces, rectal tone)</option>
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
                                            <textarea class="form-control" placeholder="Visual evaluation" name="visual_evaluation" rows="2" required></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Pet diagnoses</h6>
                                            <select class="form-control" aria-label="Pet Diagnoses" name="diagnosis"
                                                id="diagnosis" required>
                                                <option value="" disabled selected>Select a diagnosis</option>
                                                <option value="Allergies">Allergies</option>
                                                <option value="Arthritis">Arthritis</option>
                                                <option value="Bladder stones">Bladder stones</option>
                                                <option value="Cataracts">Cataracts</option>
                                                <option value="Congestive heart failure">Congestive heart failure</option>
                                                <option value="Dental disease">Dental disease</option>
                                                <option value="Diarrhea">Diarrhea</option>
                                                <option value="Ear mites">Ear mites</option>
                                                <option value="Feline leukemia virus (FeLV)">Feline leukemia virus (FeLV)
                                                </option>
                                                <option value="Feline immunodeficiency virus (FIV)">Feline immunodeficiency
                                                    virus (FIV)</option>
                                                <option value="Gastric dilatation-volvulus (GDV or bloat)">Gastric
                                                    dilatation-volvulus (GDV or bloat)</option>
                                                <option value="Hip dysplasia">Hip dysplasia</option>
                                                <option value="Inflammatory bowel disease (IBD)">Inflammatory bowel disease
                                                    (IBD)</option>
                                                <option value="Lymphoma">Lymphoma</option>
                                                <option value="Otitis externa">Otitis externa</option>
                                                <option value="Pancreatitis">Pancreatitis</option>
                                                <option value="Parvovirus">Parvovirus</option>
                                                <option value="Pyometra">Pyometra</option>
                                                <option value="Renal failure">Renal failure</option>
                                                <option value="Upper respiratory infections">Upper respiratory infections
                                                </option>
                                                <option value="Other">Other
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3" id="otherDiagnosis" style="display: none;">
                                            <h6 class="mb-1">Other diagnoses <small>If any applicable</small></h6>
                                            <textarea name="other_examination" id="other_examination" cols="2" placeholder="Other diagnoses"
                                                class="form-control" rows="2"></textarea>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Diagnoses comment</h6>
                                            <textarea name="diagnoses_comment" id="" placeholder="Diagnoses comment or remark" class="form-control"
                                                cols="2" rows="2" required></textarea>
                                        </div>


                                        <div class="col-md-12 mb-6">
                                            <h6 class=" mb-1">Veterinary case note</h6>
                                            <textarea name="result" id="" placeholder="Veterinary case note" class="form-control" cols="4"
                                                rows="4" required></textarea>
                                            <br>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            {{-- <div class="card card-block card-stretch card-height print rounded"> --}}
                                            <div
                                                class="card-header d-flex justify-content-between btn sidebar-bottom-btn header-invoice">
                                                <div class="iq-header-title">
                                                    <h6 class=" mb-1" style="color: white"> Procedure request</h6>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1"> Select procedure </h6>
                                            <select class="form-control" aria-label="Select a test" name="test_request"
                                                id="test_request">
                                                <option value="" disabled selected>Select a procedure</option>
                                                <optgroup label="Veterinary Examinations">
                                                    <option value="Routine physical examinations">Routine physical
                                                        examinations</option>
                                                    <option value="Dental check-ups">Dental check-ups</option>
                                                    <option value="Vaccination assessments">Vaccination assessments
                                                    </option>
                                                    <option value="Heartworm testing">Heartworm testing</option>
                                                    <option value="Fecal examinations for parasites">Fecal examinations for
                                                        parasites</option>
                                                </optgroup>
                                                <optgroup label="Laboratory Tests">
                                                    <option value="Complete blood count (CBC)">Complete blood count (CBC)
                                                    </option>
                                                    <option value="Blood chemistry profile">Blood chemistry profile
                                                    </option>
                                                    <option value="Urinalysis">Urinalysis</option>
                                                    <option value="Fecal analysis for parasites">Fecal analysis for
                                                        parasites</option>
                                                    <option value="Heartworm testing">Heartworm testing</option>
                                                    <option
                                                        value="Feline leukemia virus (FeLV) and feline immunodeficiency virus (FIV) testing for cats">
                                                        Feline leukemia virus (FeLV) and feline immunodeficiency virus (FIV)
                                                        testing for cats</option>
                                                </optgroup>
                                                <optgroup label="Imaging">
                                                    <option value="X-rays (radiography)">X-rays (radiography)</option>
                                                    <option value="Ultrasound">Ultrasound</option>
                                                    <option value="Magnetic resonance imaging (MRI)">Magnetic resonance
                                                        imaging (MRI)</option>
                                                    <option value="Computed tomography (CT) scans">Computed tomography (CT)
                                                        scans</option>
                                                </optgroup>
                                                <optgroup label="Behavior Assessments">
                                                    <option value="Temperament testing">Temperament testing</option>
                                                    <option
                                                        value="Behavioral consultations for anxiety, aggression, or other issues">
                                                        Behavioral consultations for anxiety, aggression, or other issues
                                                    </option>
                                                    <option value="Training evaluations">Training evaluations</option>
                                                </optgroup>
                                                <optgroup label="Allergy Testing">
                                                    <option value="Skin prick tests">Skin prick tests</option>
                                                    <option value="Intradermal allergy testing">Intradermal allergy testing
                                                    </option>
                                                    <option value="Blood tests for specific antibodies (e.g., IgE levels)">
                                                        Blood tests for specific antibodies (e.g., IgE levels)</option>
                                                </optgroup>
                                                <optgroup label="Cardiac Testing">
                                                    <option value="Electrocardiogram (ECG or EKG)">Electrocardiogram (ECG
                                                        or EKG)</option>
                                                    <option value="Echocardiogram (ultrasound of the heart)">Echocardiogram
                                                        (ultrasound of the heart)</option>
                                                    <option value="Holter monitoring for arrhythmias">Holter monitoring for
                                                        arrhythmias</option>
                                                </optgroup>
                                                <optgroup label="Ophthalmic Examinations">
                                                    <option value="Eye pressure measurement (tonometry)">Eye pressure
                                                        measurement (tonometry)</option>
                                                    <option value="Fluorescein staining for corneal ulcers">Fluorescein
                                                        staining for corneal ulcers</option>
                                                    <option value="Ophthalmoscopy (examination of the inside of the eye)">
                                                        Ophthalmoscopy (examination of the inside of the eye)</option>
                                                </optgroup>
                                                <optgroup label="Dermatological Tests">
                                                    <option value="Skin scrapings for mites or fungal infections">Skin
                                                        scrapings for mites or fungal infections</option>
                                                    <option value="Skin cytology (examination of skin cells)">Skin cytology
                                                        (examination of skin cells)</option>
                                                    <option value="Allergy testing (intradermal or blood tests)">Allergy
                                                        testing (intradermal or blood tests)</option>
                                                </optgroup>
                                                <optgroup label="Neurological Evaluations">
                                                    <option value="Neurological examinations">Neurological examinations
                                                    </option>
                                                    <option value="MRI or CT scans of the brain and spine">MRI or CT scans
                                                        of the brain and spine</option>
                                                    <option value="Cerebrospinal fluid analysis">Cerebrospinal fluid
                                                        analysis</option>
                                                </optgroup>
                                                <optgroup label="Endocrine Testing">
                                                    <option value="Thyroid hormone testing">Thyroid hormone testing
                                                    </option>
                                                    <option value="Adrenal hormone testing (e.g., cortisol levels)">Adrenal
                                                        hormone testing (e.g., cortisol levels)</option>
                                                    <option value="Insulin testing for diabetes mellitus">Insulin testing
                                                        for diabetes mellitus</option>
                                                </optgroup>
                                                <optgroup label="Genetic Testing">
                                                    <option
                                                        value="DNA testing for inherited diseases (e.g., breed-specific genetic disorders)">
                                                        DNA testing for inherited diseases (e.g., breed-specific genetic
                                                        disorders)</option>
                                                    <option
                                                        value="Genetic screening for carrier status of certain diseases">
                                                        Genetic screening for carrier status of certain diseases</option>
                                                </optgroup>
                                                <optgroup label="Nutrition Assessments">
                                                    <option value="Nutritional consultations">Nutritional consultations
                                                    </option>
                                                    <option value="Body condition scoring">Body condition scoring</option>
                                                    <option value="Dietary trials for food allergies or intolerances">
                                                        Dietary trials for food allergies or intolerances</option>
                                                </optgroup>
                                                <optgroup label="Parasite Control">
                                                    <option value="Fecal examinations for intestinal parasites">Fecal
                                                        examinations for intestinal parasites</option>
                                                    <option value="Heartworm testing and prevention">Heartworm testing and
                                                        prevention</option>
                                                    <option value="Flea and tick control measures">Flea and tick control
                                                        measures</option>
                                                </optgroup>
                                                <optgroup label="Geriatric Screenings">
                                                    <option value="Senior wellness examinations">Senior wellness
                                                        examinations</option>
                                                    <option value="Bloodwork to assess organ function">Bloodwork to assess
                                                        organ function</option>
                                                    <option value="Joint evaluations for arthritis">Joint evaluations for
                                                        arthritis</option>
                                                    <option value="Other">Other
                                                    </option>
                                                </optgroup>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h6 class="btn sidebar-bottom-btn" data-toggle="modal"  data-toggle="modal" data-target=".bd-example-modal-xl">Request Medication</h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6>Request vaccinaton</h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6>Other services</h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6  class="btn sidebar-bottom-btn "
                                                    data-toggle="modal"
                                                    data-target="#exampleModalCenter2Upload_load">  Upload document</h6>
                                                </div>

                                                    {{-- upload document --}}
                                                    <div class="modal fade" id="exampleModalCenter2Upload_load" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Upload document</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="custom-file">
                                                                    <input type="file" name="document_name" class="custom-file-input" id="customFile">
                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                 </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                                                                    data-dismiss="modal">Close when finished</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- medication start from here --}}
                                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"   aria-hidden="true">
                                                   <div class="modal-dialog modal-xl">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title">Medications</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div id="medicationFields">
                                                                <div class="form-row medication-field">
                                                                    <div class="col-md-3">
                                                                        <h6>Category</h6>
                                                                        <select class="form-control medication-category"name="med_category[]" id="med-category">
                                                                            <option value="" selected></option>
                                                                            @foreach ($medication as $m)
                                                                            <option value="{{ $m->id }}">{{ $m->med_desc }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <h6>Medication</h6>
                                                                        <select class="form-control medication-select" name="medication[]" id="medication-select">
                                                                            <option value="" selected></option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <h6>Price</h6>
                                                                        <input type="number" name="price[]" class="form-control medication-price"  placeholder="Price">
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <h6>Qty</h6>
                                                                        <select name="qty[]" id="qty" class="form-control medication-qty">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                            <option value="13">13</option>
                                                                            <option value="14">14</option>
                                                                            <option value="15">15</option>
                                                                            <option value="16">16</option>
                                                                            <option value="17">17</option>
                                                                            <option value="18">18</option>
                                                                            <option value="19">19</option>
                                                                            <option value="20">20</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <h6>Dosage</h6>
                                                                        <select class="form-control medication-dosage" name="dosage[]">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                            <option value="13">13</option>
                                                                            <option value="14">14</option>
                                                                            <option value="15">15</option>
                                                                            <option value="16">16</option>
                                                                            <option value="17">17</option>
                                                                            <option value="18">18</option>
                                                                            <option value="19">19</option>
                                                                            <option value="20">20</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <h6>Unit</h6>
                                                                        {{-- <input type="text" name="unit[]" class="form-control medication-unit" placeholder="Unit"> --}}
                                                                        <select class="form-control medication-unit" style="width: 80%;" name="unit[]">
                                                                        <option value="mg">mg</option>
                                                                        <option value="mcg">mcg </option>
                                                                        <option value="ml">ml</option>
                                                                        <option value="inhalers">inhalers</option>
                                                                        <option value="sprays">sprays</option>
                                                                        <option value="patches">patches</option>
                                                                        <option value="mEq">mEq</option>
                                                                        <option value="mmol">mmol</option>
                                                                        <option value="capsules">capsules </option>
                                                                        <option value="tablets">tablets </option>
                                                                        <option value="drops">drops </option>
                                                                    </select>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <h6>Remove</h6>
                                                                        <button type="button" class="btn btn-danger btn-sm remove-medication" style="margin-bottom: 3%">Remove</button>
                                                                    </div>
                                                                    <div id="medicationSuggestions"></div>
                                                                </div>
                                                         </div>
                                                         <br>
                                                         <h6>Total: <span id="totalPrice">0</span></h6>
                                                         <button type="button" class="btn sidebar-bottom-btn btn-lg" style="margin-left: 95%"  id="add-medication">+</button>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h6>Comment <small>(Optional)</small></h6>
                                                            <textarea class="form-control" placeholder="Suggestions: If there are any comments available for this medication.." name="medication_comment" id="" cols="5" rows="5"></textarea>
                                                        </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block" data-dismiss="modal">Close when finished</button>
                                                         </div>
                                                      </div>
                                                   </div>
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
                                                            name="flexRadioDefault23" value="Communicate disease" id="flexRadioDefault23">
                                                        <label class="form-check-label" for="flexRadioDefault23">
                                                            Communicate disease ?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault20" value="Non" id="flexRadioDefault20" checked>
                                                        <label class="form-check-label" for="flexRadioDefault20">
                                                            Non
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault31" value="Complicated case" id="flexRadioDefault31">
                                                        <label class="form-check-label" for="flexRadioDefault31">
                                                            Complicated case ?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault41" value="Notifiable disease" id="flexRadioDefault41">
                                                        <label class="form-check-label" for="flexRadioDefault41">
                                                            Notifiable disease?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault42" value="Pregnant pet" id="flexRadioDefault42">
                                                        <label class="form-check-label" for="flexRadioDefault42">
                                                            Pregnant pet?
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault43" value="Suspected diagnosis" id="flexRadioDefault43">
                                                        <label class="form-check-label" for="flexRadioDefault43">
                                                            Suspected diagnosis ?
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="flexRadioDefault44" value="Multiple diseases" id="flexRadioDefault44">
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
                                            $admission2 = App\Models\Admission::where('pet_id', $case_note->case_id ?? '')
                                                ->where('status', 0)
                                                ->first();
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            @if ($admission2)
                                                <h6 style="color: red">On admission</h6>
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
                                        <p class="mb-0">Date of birth : {{ $encounterId->Age ?? ''}}</p>
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
                                        <p class="mb-0">{{ $encounterId->Owner_Phone_Number ?? ''}}</p>
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
                                    Last visit: {{ $case_note->date ?? ''}}

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
                            <p>You have the option to transfer the pet to another clinic for treatment</p>
                            <form action="{{ route('Admin.Clinic.refer_store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $encounterId->Pet_Card_Number }}" name="case_id"
                                    id="">
                                <h6 class=" mb-1">Refer to a different clinic</h6>
                                <input type="text" placeholder="Refer to a different clinic" class="form-control"
                                    name="clinic_name" id="">
                                <br>
                                <h6 class=" mb-1">Medical practitioner's name</h6>
                                <input type="text" class="form-control" placeholder="Medical practitioner's name"
                                    name="practitioner_name" id="">
                                <br>
                                <h6 class=" mb-1">Purpose of referral</h6>
                                <textarea id="" class="form-control" name="purpose_of_referral" cols="3" rows="3"></textarea>
                                <br>
                                <button type="submit" class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>


        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $encounterId->Pet_name ?? ''}} medical history
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
                                            <h6 class="mb-2">{{ $c->date ?? ''}}</h6>
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
                                                        {{ $c->temp ?? ''}}&deg;,Pulse:
                                                        {{ $c->pulse ?? ''}}BPM.</h6>
                                                    <h6 class="mb-0 font-size-15">Resp(cycles/min):
                                                        {{ $c->resp ?? ''}} cycles/min</h6>
                                                    <h6 class="mb-0 font-size-15">Next appointment:
                                                        {{ $c->next_appointment?? '' }} </h6>
                                                    <h6 class="mb-0 font-size-15">Next vaccination:
                                                        {{ $c->next_vaccination?? '' }} </h6>
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
                                                    @if ($testcount > 0)
                                                        @if ($test != null)
                                                            <h6 class=" mb-1">Veterinary examination</h6>
                                                            @foreach ($test as $t)
                                                                <p class="mb-0 font-size-15">{!! nl2br(e($t->test_request)) !!}</p>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    @if ($c->diagnosis ?? '' != null)
                                                    <h6 class=" mb-1">Pet diagnosis</h6>
                                                        <p class="mb-0 font-size-15">
                                                            {{ $c->diagnosis  ?? '' }}
                                                        </p>
                                                     @else
                                                     <h6 class=" mb-1">Other diagnosis exmination</h6>
                                                     <p class="mb-0 font-size-15">{!! nl2br(e($c->other_examination)) !!}</p>
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
                                                    <h6 class=" mb-1">Visual evaluation</h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($c->visual_evaluation ?? '')) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif




@if ( $c->result ?? '' != null)
<li>
    <div class="row align-items-top">
        <div class="col-md-3">
        </div>
        @php
            $test = App\Models\TestRequest::where('token', $c->token)->get();
            $testcount = App\Models\TestRequest::where('token', $c->token)->count();
        @endphp

        <div class="col-md-9">
            <div class="media profile-media align-items-top">
                <div class="profile-dots border-primary mt-1"></div>
                <div class="ml-4">
                    @if ($c->result?? '' != null)
                        <h6 class=" mb-1">Veterinary case note</h6>
                        <p class="mb-0 font-size-15">
                            {{ $c->result ?? ''}}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
@endif


                                @if ($c->result?? '' != null)
                                <li>
                                    <div class="row align-items-top">
                                        <div class="col-3">

                                        </div>
                                        <div class="col-9">
                                            <div class="media profile-media pb-0 align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    <h6 class=" mb-1">Veterinary Report</h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($c->result?? '')) !!}</p>
                                                    @php
                                                        $admit = App\Models\Admission::where('pet_id', $c->case_id?? '')
                                                            ->where('token', $c->token)
                                                            ->where('status', 0)
                                                            ->get();
                                                        $admit2 = App\Models\Admission::where('pet_id', $c->case_id ?? '')
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
                                                        $username = App\Models\User::where('id', $c->user_id?? '')->first();
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




        {{-- view medication --}}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Medication</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        {{-- view treatment --}}
        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Treatment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn sidebar-bottom-btn btn-lg btn-block"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- this section is for refer --}}
        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalCenterTitle">Last recommendation</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-inline p-0 m-0 w-100">
                            <li>
                                <div class="row align-items-top">
                                    <div class="col-md-3">
                                        <h6 class="mb-2">{{ $refer->date ?? ''}}</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="media profile-media align-items-top">
                                            <div class="profile-dots border-primary mt-1"></div>
                                            <div class="ml-4">
                                                <h6 class=" mb-1">Tranfer to
                                                </h6>
                                                <h6 class="mb-0 font-size-15">{!! nl2br(e($refer->clinic_name ?? '')) !!}</h6>
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
                                                <h6 class=" mb-1">Practitioner name</h6>
                                                <p class="mb-0 font-size-15">{{ $refer->practitioner_name ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row align-items-top">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-9">
                                        <div class="media profile-media pb-0 align-items-top">
                                            <div class="profile-dots border-primary mt-1"></div>
                                            <div class="ml-4">
                                                <h6 class=" mb-1">Purpose</h6>
                                                <p class="mb-0 font-size-15">{!! nl2br(e($refer->purpose_of_referral)) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row align-items-top">
                                    <div class="col-9">
                                        <div class="media profile-media pb-0 align-items-top">
                                            <div class="profile-dots border-primary mt-1"></div>
                                            <div class="ml-4">
                                                <h6 class=" mb-1">Veterinary Doctor</h6>
                                                @php
                                                    $username = App\Models\User::where('id', $refer->user_id?? '')->first();
                                                @endphp
                                                <p class="mb-0 font-size-15">{!! nl2br(e($username->name ?? '')) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
                        @if ($case_note && $case_note->created_at->diffInHours(now()) < 6)
                            <h6 class="modal-title" id="exampleModalCenterTitle">Modify case entry</h6>
                        @else
                            <h6 class="modal-title" id="exampleModalCenterTitle">Veterinary case note</h6>
                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($case_note && $case_note->created_at->diffInHours(now()) < 6)
                            <form action="{{ route('Admin.Clinic.encounter_update', $case_note->id) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $case_note->id }}" id="">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
                                <textarea name="case_note_edit" class="form-control" id="" cols="5" rows="5">{{ $case_note->result ?? '' }}</textarea>
                                <br>
                                <center><button type="submit" class="btn sidebar-bottom-btn btn-lg">Modify case entry
                                    </button></center>
                            </form>
                        @else
                            <ul class="list-inline p-0 m-0 w-100">
                                <li>
                                    <div class="row align-items-top">
                                        <div class="col-3">
                                        </div>
                                        <div class="col-9">
                                            <div class="media profile-media pb-0 align-items-top">
                                                <div class="profile-dots border-primary mt-1"></div>
                                                <div class="ml-4">
                                                    <h6 class=" mb-1">Veterinary case note</h6>
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($refer->purpose_of_referral)) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
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
                                                            $refer->user_id?? '',
                                                        )->first();
                                                    @endphp
                                                    <p class="mb-0 font-size-15">{!! nl2br(e($username->name ?? '')) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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

                if (this.value === 'Other') {
                    otherDiagnosis.style.display = 'block';
                    otherExamination.required = true;
                } else {
                    otherDiagnosis.style.display = 'none';
                    otherExamination.required = false;
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
                // Update the textarea with the description
                $('#presentingIllness').val(description);
            });
        </script>



{{-- this for inputing of medication --}}

<script>
    $(document).ready(function() {
      // Function to attach change event listener to select element
      function attachSelectListener(selectElement) {
          selectElement.change(function() {
              var medicationId = $(this).val();
              var priceInput = $(this).closest('.medication-field').find('.medication-price');
              var dosageInput = $(this).closest('.medication-field').find('.medication-dosage');
              var unitInput = $(this).closest('.medication-field').find('.medication-unit');
              var qty = $(this).closest('.medication-qty').find('.medication-qty');

              $.ajax({
                  url: '/Admin/Clinic/getMedicationPrice',
                  type: 'GET',
                  data: { medication_id: medicationId },
                  success: function(response) {
                      priceInput.val(response.price);
                      dosageInput.val(response.dosage);
                      unitInput.val(response.unit);


                      // Disable unit input if response.unit equals 1
                      if (response.allow_edit_price == 0) {
                              priceInput.prop('disabled', true);
                          } else {
                              priceInput.prop('disabled', false);
                          }
                          if (response.allow_edit_price == 1) {
                              priceInput.removeAttr('readonly');
                          }

                          if (response.allow_edit_unit == 0) {
                              unitInput.prop('disabled', true);
                          } else {
                              unitInput.prop('disabled', false);
                          }
                          if (response.allow_edit_unit == 1) {
                              unitInput.removeAttr('readonly');
                          }

                          if (response.allow_edit_dosage == 0) {
                              dosageInput.prop('disabled', true);
                          } else {
                              dosageInput.prop('disabled', false);
                          }
                          if (response.allow_edit_dosage == 1) {
                              dosageInput.removeAttr('readonly');
                          }

                      updateTotalPrice();
                  },
                  error: function() {
                      priceInput.val('');
                      updateTotalPrice();
                  }
              });
          });
      }

      // Function to attach change event listener to category dropdown
      function attachCategoryChange() {
          $('.medication-category').change(function() {
              var categoryId = $(this).val();
              var medicationSelect = $(this).closest('.medication-field').find('.medication-select');
              var medicationPrice = $(this).closest('.medication-field').find('.medication-price');

              $.ajax({
                  url: '/Admin/Clinic/getSubcategories',
                  type: 'GET',
                  data: { category_id: categoryId },
                  success: function(response) {

                      medicationSelect.empty();
                      medicationPrice.val('');

                      $.each(response, function(index, subcategory) {
                          medicationSelect.append('<option value="' + subcategory.id + '">' + subcategory.desc + '</option>');
                      });
                      medicationSelect.trigger('change');
                  },
                  error: function() {
                      console.log('Error fetching subcategories');
                  }
              });
          });
      }

      // Add medication fields
      $('#add-medication').click(function() {
          var newMedicationField = $('#medicationFields .medication-field').first().clone();
          newMedicationField.find('input, select').val('');

          $('#medicationFields').append(newMedicationField);
          attachCategoryChange();
          attachSelectListener(newMedicationField.find('.medication-select'));
          attachSelectListener(newMedicationField.find('.medication-category'));
          attachSelectListener(newMedicationField.find('.medication-price'));

      });

      attachCategoryChange();
      $('.medication-select').each(function() {
          attachSelectListener($(this));
      });


      //   attachCategoryChange();
      // $('.medication-price').each(function() {
      //     attachSelectListener($(this));
      // });


      // Remove medication fields
      $(document).on('click', '.remove-medication', function() {
          $(this).closest('.medication-field').remove();
          updateTotalPrice();
      });

      // Function to update total price
      function updateTotalPrice() {
          var totalPrice = 0;
          $('.medication-price').each(function() {
              var price = parseFloat($(this).val());
              if (!isNaN(price)) {
                  totalPrice += price;
              }
          });
          $('#totalPrice').text(totalPrice.toFixed(2));
      }
      $('.medication-qty').change(function() {
      var qtyInput = $(this);
      var medicationField = qtyInput.closest('.medication-field');
      var priceInput = medicationField.find('.medication-price');
      var unitPrice = parseFloat(priceInput.val());

      if (!isNaN(unitPrice)) {
          var qty = parseInt(qtyInput.val());
          var totalPrice = unitPrice * qty;
          priceInput.val(totalPrice.toFixed(2));
          updateTotalPrice();
      }
  });
  });
  </script>
    @endsection
</x-admin-master>
