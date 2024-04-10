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
                                        aria-selected="false"> Medical case note </a>
                                </li>
                            </ul>
                            <div class="profile-content tab-content">
                                <div id="profile1" class="tab-pane fade active show">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('../assets/images/logo.png') }}"
                                                class="logo-invoice img-fluid mb-3">
                                            <h5 class="mb-0">Hello, {{ Auth::user()->name }}</h5>
                                            <p>For [{{ $encounterId->Pet_name }} ] [Card no.{{ $encounterId->Pet_Card_Number }} ], document every vet visit since birth, including dates,
                                                weight, vaccinations, medications, surgeries, and hospital visits. Also,
                                                note any tests conducted and their outcomes.</p>
                                            <br>
                                            <h4>Last medical History</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- medical history start from here --}}
                                <div id="profile2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <form action="{{ route("Admin.Clinic.encounter_store") }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <input type="hidden" value="{{ $encounterId->Pet_Card_Number }}" name="case_id" id="">
                                            {{-- <label for="validationDefault04">Physical examination</label> --}}
                                            <h6 class=" mb-1">Physical examination</h6>
                                            <select class="form-control" aria-label="Physical Examination"
                                                name="physical_examination">
                                                <option value="" disabled selected>Select physical examination
                                                </option>
                                                <option value="Body condition score">Body condition score</option>
                                                <option value="Temperature">Temperature</option>
                                                <option value="Heart rate (pulse)">Heart rate (pulse)</option>
                                                <option value="Respiratory rate">Respiratory rate</option>
                                                <option value="Mucous membrane color">Mucous membrane color (e.g., pink,
                                                    pale, yellow)</option>
                                                <option value="Capillary refill time">Capillary refill time</option>
                                                <option value="Hydration status">Hydration status</option>
                                                <option value="Coat and skin condition">Coat and skin condition</option>
                                                <option value="Eyes">Eyes (e.g., clarity, discharge, redness)</option>
                                                <option value="Ears">Ears (e.g., cleanliness, odor, discharge)</option>
                                                <option value="Nose">Nose (e.g., moisture, discharge, symmetry)</option>
                                                <option value="Mouth and teeth">Mouth and teeth (e.g., dental health, tartar
                                                    buildup, gum color)</option>
                                                <option value="Lymph nodes">Lymph nodes (e.g., size, symmetry, tenderness)
                                                </option>
                                                <option value="Abdominal palpation">Abdominal palpation (e.g., organ size,
                                                    masses, pain)</option>
                                                <option value="Musculoskeletal system">Musculoskeletal system (e.g., gait,
                                                    muscle tone, joint range of motion)</option>
                                                <option value="Neurological evaluation">Neurological evaluation (e.g.,
                                                    reflexes, coordination, sensation)</option>
                                                <option value="Rectal examination">Rectal examination (e.g., presence of
                                                    feces, rectal tone)</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Temp °C</h6>
                                            <input type="text" name="temp" placeholder="37.5°C" class="form-control"
                                                id="">
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Pulse(/min)</h6>
                                            <input type="text" name="pulse" placeholder="20/min" class="form-control" id="">

                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <h6 class=" mb-1">Resp(cycles/min)</h6>
                                            <input type="text" name="resp" placeholder="20/min" class="form-control"
                                                id="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Visual evaluation</h6>
                                            <textarea class="form-control" placeholder="Visual evaluation" name="visual_evaluation" rows="2"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Pet diagnoses</h6>
                                            <select class="form-control" aria-label="Pet Diagnoses" name="diagnosis">
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
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h6 class=" mb-1">Case report</h6>
                                            <textarea name="result" id="" placeholder="Case report" class="form-control" cols="2"
                                                rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5 class=" mb-1"> Request for test </h5>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1"> Select test </h6>
                                            <select class="form-control" aria-label="Select a test" name="pet_tests">
                                                <option value="" disabled selected>Select a test</option>
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
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1"> Other test </h6>
                                            <input type="text" placeholder="Other test" class="form-control"
                                                name="" id="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5 class="mb-1">Other diagnoses <small>If any applicable</small></h5>
                                            <textarea name="other_examination" id="" cols="2" placeholder="Other diagnoses" class="form-control"
                                                rows="2"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <h5 class=" mb-1">Treatment</h5>
                                        </div>

                                        {{-- <div class="row"> --}}
                                            <div class="col-sm-3">
                                               <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                  <a style="color: black"class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Medication</a>
                                                  <a style="color: black"class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Vaccination</a>
                                                  <a style="color: black" class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Service</a>
                                               </div>
                                            </div>
                                            <div class="col-sm-9">
                                               <div class="tab-content mt-0" id="v-pills-tabContent">
                                                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div id="medicationFields">
                                                        <div class="medication">

                                                            <div class="form-row">
                                                                <div class="form-group " >
                                                                <label for="medication">Medication</label>
                                                                <input type="text" class="form-control" style="width: 100%;" name="medication" placeholder="Medication">
                                                                </div>

                                                            <div class="form-group">
                                                                <label for="Price">Price</label>
                                                                <input type="number" name="price" class="form-control" style="width: 100%;" placeholder="Price">
                                                            </div>

                                                            <div class="form-group" >
                                                                <label for="Dosage">Dosage</label>
                                                                <select class="form-control" style="width: 100%;" name="dosage">
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
                                                                <div class="form-group">
                                                                    <label for="Unit">Unit</label>
                                                                    <select class="form-control" style="width: 100%;" name="unit">
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

                                                            </div>



                                                        </div>
                                                    </div><br>
                                                    <center> <button class="btn sidebar-bottom-btn btn-bg" id="addMedication">+
                                                            New</button></center>
                                                    </select>
                                                    <br>
                                                  </div>
                                                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
dfsgfs
                                                </div>
                                                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                                  </div>
                                               </div>
                                            </div>
                                         {{-- </div> --}}


                                        <script>
                                            document.getElementById('addMedication').addEventListener('click', function() {
                                                var medicationFields = document.getElementById('medicationFields');
                                                var newMedicationField = document.createElement('div');
                                                newMedicationField.classList.add('medication');
                                                newMedicationField.innerHTML = `
                                                <div class="form-row">
                                                                <div class="form-group " >

                                                                <input type="text" class="form-control" style="width: 100%;" name="medication" placeholder="Medication">
                                                                </div>

                                                            <div class="form-group">

                                                                <input type="number" name="price" class="form-control" style="width: 100%;" placeholder="Price">
                                                            </div>

                                                            <div class="form-group" >

                                                                <select class="form-control" style="width: 100%;" name="dosage">
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
                                                                <div class="form-group">

                                                                    <select class="form-control" style="width: 100%;" name="unit">
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

                                                `;
                                                medicationFields.appendChild(newMedicationField);
                                            });
                                        </script>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Next appointment</h6>
                                            <input type="date" name="next_appointment" placeholder="Naxt appointment"
                                                class="form-control" id="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <h6 class=" mb-1">Next vaccination</h6>
                                            <input type="date" name="next_vaccination" placeholder="20/min"
                                                class="form-control" id="">
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <div
                                                class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                <input type="checkbox" class="custom-control-input bg-primary"
                                                    id="customCheck-1">
                                                <h6 class="custom-control-label" for="customCheck-1">New case</h6>

                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <div
                                                class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                <input type="checkbox" class="custom-control-input bg-primary"
                                                    id="customCheck-2">
                                                <h6 class="custom-control-label" for="customCheck-2">Follow up</h6>

                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <div
                                                class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                                <input type="checkbox" class="custom-control-input bg-primary"
                                                    id="customCheck-3">
                                                <h6 class="custom-control-label" for="customCheck-3">Admit pet</h6>

                                            </div>
                                        </div>
                                        <button type="submit" class="btn sidebar-bottom-btn btn-block btn-bg">Process</button>
                                    </form>
                                    </div>
                                </div>

                                <div id="profile3" class="tab-pane fade">

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <h6>Service</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="data-table table mb-0 tbl-server-info">
                                                                    <thead class="bg-white">
                                                                        <tr class=" -data">
                                                                            <th style="margin-left: 10%">Description</th>
                                                                            <th>Amount</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="-body">
                                                                        @foreach ($service as $item)
                                                                            <tr>
                                                                                <form
                                                                                    action="{{ route('Admin.Store.item_store') }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden"
                                                                                        name="selling_price"
                                                                                        value="0" id="">
                                                                                    <input type="hidden"
                                                                                        name="vaccine_id" value="0"
                                                                                        id="">
                                                                                    <input type="hidden" name="qty"
                                                                                        value="0" id="">
                                                                                    <input type="hidden"
                                                                                        name="items_name" value="0"
                                                                                        id="">
                                                                                    <input type="hidden" name="subtotal"
                                                                                        value="0" id="">
                                                                                    <input type="hidden" name="user_id"
                                                                                        value="{{ Auth()->user()->id }}">
                                                                                    <input type="hidden" name="service"
                                                                                        value="{{ $item->service }}"
                                                                                        id="">
                                                                                    <input type="hidden" name="Amount"
                                                                                        value="{{ $item->amount }}"
                                                                                        id="">
                                                                                    <input type="hidden"
                                                                                        name="service_id"
                                                                                        value="{{ $item->id }}">
                                                                                    <td>{{ $item->service }}</td>
                                                                                    <td>{{ $item->amount }}</td>
                                                                                    <td>
                                                                                        <button type="submit"
                                                                                            class="btn btn-link"><i
                                                                                                class="ri-check-line ri-lg fw-bold"></i></button>
                                                                                    </td>
                                                                            </tr>
                                                                            </form>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="content-page">


                                                            <div class="modal fade" id="exampleModalScrollable"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="exampleModalScrollableTitle"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable"
                                                                    role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h6 class="modal-title"
                                                                                id="exampleModalScrollableTitle"> Add new
                                                                                Treatment
                                                                            </h6>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('Admin.Store.item') }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row">

                                                                                    <div class="col-md-6">
                                                                                        <h6 class="card-title">Treatment
                                                                                            description</h6>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="service" id=""
                                                                                            placeholder="Enter description"
                                                                                            required>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <h6 class="card-title">Amount</h6>
                                                                                        <input type="number"
                                                                                            placeholder="Enter amount"
                                                                                            name="Amount"
                                                                                            class="form-control"
                                                                                            id="" required>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name="selling_price"
                                                                                    value="0" id="">
                                                                                <input type="hidden" name="vaccine_id"
                                                                                    value="0" id="">
                                                                                <input type="hidden" name="qty"
                                                                                    value="0" id="">
                                                                                <input type="hidden" name="items_name"
                                                                                    value="0" id="">
                                                                                <input type="hidden" name="subtotal"
                                                                                    value="0" id="">

                                                                                <input type="hidden" name="user_id"
                                                                                    value="{{ Auth()->user()->id }}">

                                                                                <br>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button
                                                                                class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>

                                                                            </form>
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
                                </div>
                                <div id="profile4" class="tab-pane fade">
                                    <div
                                        class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                        <ul class="list-inline p-0 m-0 w-100">
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2020 - present</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Software Engineer at Mathica Labs</h6>
                                                                <p class="mb-0 font-size-14">Total : 02 + years of
                                                                    experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2018 - 2019</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Zimcore
                                                                    Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : 1.5 + years of
                                                                    experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2017 - 2018</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Skycare Ptv.
                                                                    Ltd</h6>
                                                                <p class="mb-0 font-size-14">Total : 0.5 + years of
                                                                    experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-3">
                                                        <h6 class="mb-2">06 Months</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="media profile-media pb-0 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Infosys
                                                                    Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : Freshers</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="profile5" class="tab-pane fade">
                                    <center>
                                        <div class="col-lg-4">
                                            <label for="document_description">Document description</label>
                                            <input type="text" class="form-control" id="document_description"
                                                name="document_description">
                                        </div>
                                        <br>
                                        <input type="file" name="" id="">
                                        <button>Upload document</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 card-profile">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="ml-3">
                                    <h6 class="mb-0"> {{ $encounterId->Pet_name }}</h6>
                                    <p class="mb-0">Breed: {{ $encounterId->Breed }}</p>
                                    <p class="mb-0">Gender: {{ $encounterId->Gender }}</p>
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
                                        <p class="mb-0">{{ $encounterId->address }}</p>
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
                                        <p class="mb-0">Date of birth : {{ $encounterId->Age }}</p>
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
                                        <p class="mb-0">{{ $encounterId->Owner_Phone_Number }}</p>
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
                                <p>
                                    Last visit: 20/1/2024 attended by Adeyeye Sunday
                                </p>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <button class="btn sidebar-bottom-btn btn-block">View full medical history</button>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <h6 class=" mb-1">Refer to a different clinic</h6>
                            <input type="text" placeholder="Refer to a different clinic" class="form-control"
                                name="different_clinic" id="">
                            <br>
                            <h6 class=" mb-1">Medical practitioner's name</h6>
                            <input type="text" class="form-control" placeholder="Medical practitioner's name"
                                name="practitioner_name" id="">
                            <br>
                            <h6 class=" mb-1">Purpose of referral</h6>
                            <textarea name="" id="" class="form-control" name="purpose_of_referral" cols="3"
                                rows="3"></textarea>
                            <br>
                            {{-- <button class="btn sidebar-bottom-btn btn-block">Process</button> --}}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        </div>
        {{-- <div> --}}

        {{-- </div> --}}
        </div>
    @endsection
</x-admin-master>
