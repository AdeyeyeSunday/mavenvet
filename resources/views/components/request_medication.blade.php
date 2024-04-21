
                                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Prescription(s)</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <button class="btn sidebar-bottom-btn mb-5 btn-lg addField2">Add Fields</button>
                                                                    <form action="" method="POST"
                                                                    enctype="multipart/form-data" id="medication_request">
                                                                    @csrf
                                                                    <div>
                                                                        <input type="hidden" value="{{ $token }}" name="token" id="">
                                                                        <input type="hidden" value="{{ $attribute2 }}" name="case_id" id="">
                                                                        <input type="hidden" name="tracking_no" value="{{ $uniqueNumber }}"
                                                                        id="">
                                                                        <div class="row firstRow2" id="medication-field">
                                                                            <div class="col-md-2 form-group">
                                                                              <h6 for="">Category</h6>
                                                                               <select name="med_category[]" id="med_category" class="form-control med_category" required>
                                                                                <option value="" selected></option>
                                                                                @foreach ($medication as $m)
                                                                                <option value="{{ $m->id }}">{{ $m->med_desc }}</option>
                                                                                @endforeach
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-3 form-group">
                                                                                <h6 for="">Medication</h6>
                                                                                <select name="medication[]" id="medication" class="form-control medication" required>
                                                                                    <option value="" selected></option>
                                                                               </select>
                                                                               <input type="hidden" name="main_name[]" class="form-control main_name" id="">
                                                                            </div>
                                                                            <div class="col-md-2 form-group" hidden>
                                                                                <h6 for="">Price</h6>
                                                                                <input type="text" class="form-control price-input" id="price" name="price[]" required
                                                                                    placeholder="Enter amount" class="w-100">
                                                                                    <input type="text" class="form-control allow_double_payment_input" id="allow_double_payment" name="allow_double_payment[]" required
                                                                                    placeholder="Enter amount">

                                                                            </div>



                                                                            <div class="col-md-1 form-group">
                                                                                <h6 for="">Dose</h6>
                                                                                <select name="qty[]" id="qty" class="form-control" required>
                                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                                    @endfor
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-2 form-group">
                                                                                <h6 for="">How offen</h6>
                                                                                <select name="how_offen[]" id="offen" class="form-control" required>
                                                                                   <option value="" selected></option>
                                                                                   <option value="Once daily">Once daily</option>
                                                                                   <option value="Hourly">Hourly</option>
                                                                                   <option value="Bd">Bd</option>
                                                                                   <option value="Tds">Tds</option>
                                                                                   <option value="Qds">Qds</option>
                                                                                   <option value="2 hourly">2 hourly</option>
                                                                                   <option value="3 hourly">3 hourly</option>
                                                                                   <option value="4 hourly">4 hourly</option>
                                                                                   <option value="5 hourly">5 hourly</option>
                                                                                   <option value="6 hourly">6 hourly</option>
                                                                                   <option value="7 hourly">7 hourly</option>
                                                                                   <option value="8 hourly">8 hourly</option>
                                                                                   <option value="12 hourly">12 hourly</option>
                                                                                   <option value="Nocte">Nocte</option>
                                                                                   <option value="Start">Start</option>
                                                                                   <option value="PRN">PRN</option>
                                                                                   <option value="Alternate days">Alternate days</option>
                                                                                   <option value="Weekly">Weekly</option>
                                                                                   <option value="Twice weekly">Twice weekly</option>
                                                                                   <option value="Monthly">Monthly</option>

                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-1 form-group">
                                                                                <h6 for="">Duration</h6>
                                                                                <select name="duration[]" id="duration" class="form-control" required>
                                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                                    @endfor
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-2 form-group">
                                                                                <h6 for="">Days/Weeks</h6>
                                                                                <select name="days_weeks[]" id="days_weeks" class="form-control" required>
                                                                                 <option value=""></option>
                                                                                 <option value="days">Day(s)</option>
                                                                                 <option value="hours">Hour(s)</option>
                                                                                 <option value="weeks">Week(s)</option>
                                                                                 <option value="months">Month(s)</option>
                                                                               </select>
                                                                            </div>

                                                                            <div class="col-md-1 form-group">
                                                                                <h6 for="">Unit</h6>
                                                                                <select name="unit[]" id="unit" class="form-control unit-input" required>
                                                                                    <option value="" selected></option>
                                                                                    <option value="mg">mg </option>
                                                                                    <option value="mcg">mcg </option>
                                                                                    <option value="ml">ml </option>
                                                                                    <option value="drops">drops</option>
                                                                                    <option value="tablets">tablets</option>
                                                                                    <option value="capsules">capsules</option>
                                                                                    <option value="inhalers">inhalers</option>
                                                                                    <option value="sprays">sprays</option>
                                                                                    <option value="patches">patches</option>
                                                                                    <option value="mEq">mEq </option>
                                                                                    <option value="mmol">mmol</option>
                                                                               </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" id="process_button" class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    //FOR ADD ROWS
                                                                    $('.addField2').click(function() {
                                                                        $('.firstRow2').parent().append(`
                                                                        <div class="row">
                                                                            <div class="col-md-2 form-group">
                                                                                <select name="med_category[]" id="med_category" class="form-control med_category" required>
                                                                                <option value="" selected></option>
                                                                                @foreach ($medication as $m)
                                                                                <option value="{{ $m->id }}">{{ $m->med_desc }}</option>
                                                                                @endforeach
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-3 form-group">
                                                                                <select name="medication[]" id="medication" class="form-control medication" required>
                                                                                    <option value="" selected></option>
                                                                               </select>
                                                                               <input type="hidden" name="main_name[]" class="form-control main_name" id="">
                                                                            </div>
                                                                            <div class="col-md-2 form-group" hidden>
                                                                                <input type="text" class="form-control price-input" id="price" name="price[]" required
                                                                                    placeholder="Enter amount" class="w-100">
                                                                                    <input type="text" class="form-control allow_double_payment_input" id="allow_double_payment" name="allow_double_payment[]" required
                                                                                    placeholder="Enter amount">
                                                                            </div>
                                                                            <div class="col-md-1 form-group">
                                                                                <select name="qty[]" id="qty" class="form-control" required>
                                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                                    @endfor
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-2 form-group">
                                                                                <select name="how_offen[]" id="how_offen" class="form-control" required>
                                                                                   <option value="" selected></option>
                                                                                   <option value="Once daily">Once daily</option>
                                                                                   <option value="Hourly">Hourly</option>
                                                                                   <option value="Bd">Bd</option>
                                                                                   <option value="Tds">Tds</option>
                                                                                   <option value="Qds">Qds</option>
                                                                                   <option value="2 hourly">2 hourly</option>
                                                                                   <option value="3 hourly">3 hourly</option>
                                                                                   <option value="4 hourly">4 hourly</option>
                                                                                   <option value="5 hourly">5 hourly</option>
                                                                                   <option value="6 hourly">6 hourly</option>
                                                                                   <option value="7 hourly">7 hourly</option>
                                                                                   <option value="8 hourly">8 hourly</option>
                                                                                   <option value="12 hourly">12 hourly</option>
                                                                                   <option value="Nocte">Nocte</option>
                                                                                   <option value="Start">Start</option>
                                                                                   <option value="PRN">PRN</option>
                                                                                   <option value="Alternate days">Alternate days</option>
                                                                                   <option value="Weekly">Weekly</option>
                                                                                   <option value="Twice weekly">Twice weekly</option>
                                                                                   <option value="Monthly">Monthly</option>

                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-1 form-group">
                                                                                <select name="duration[]" id="duration" class="form-control" required>
                                                                                    @for ($i = 1; $i <= 30; $i++)
                                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                                    @endfor
                                                                               </select>
                                                                            </div>
                                                                            <div class="col-md-2 form-group">

                                                                                <select name="days_weeks[]" id="days_weeks" class="form-control" required>
                                                                                    <option value="" selected></option>
                                                                                 <option value="days">Day(s)</option>
                                                                                 <option value="hours">Hour(s)</option>
                                                                                 <option value="weeks">Week(s)</option>
                                                                                 <option value="months">Month(s)</option>
                                                                               </select>
                                                                            </div>

                                                                            <div class="col-md-1 form-group">
                                                                                <select name="unit[]" id="unit" class="form-control unit-input" required>
                                                                                    <option value="" selected></option>
                                                                                    <option value="mg">mg </option>
                                                                                    <option value="mcg">mcg </option>
                                                                                    <option value="ml">ml </option>
                                                                                    <option value="drops">drops</option>
                                                                                    <option value="tablets">tablets</option>
                                                                                    <option value="capsules">capsules</option>
                                                                                    <option value="inhalers">inhalers</option>
                                                                                    <option value="sprays">sprays</option>
                                                                                    <option value="patches">patches</option>
                                                                                    <option value="mEq">mEq </option>
                                                                                    <option value="mmol">mmol</option>
                                                                               </select>
                                                                            </div>
                                                                                </div>
                                                                                `);
                                                                    });
                                                                    //FOR DELETE ROWS
                                                                    $(document).on('click', '.deleteRow', function() {
                                                                        $(this).parent().parent().remove();
                                                                    });
                                                                });



                                                                // this submiting
                                                                 // this for instacting document
                                                                    $(document).ready(function() {
                                                                        $('#medication_request').on('submit', function(e) {
                                                                            e.preventDefault();
                                                                            var formData = new FormData(this);
                                                                            $('#process_button').text
                                                                            $.ajax({
                                                                                url: '{{ route('Admin.Clinic.encounter_store_medication') }}',
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
                                                                                    // $('#process_button').hide();
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
                                                                </script>

                            {{-- this for inputing of medication --}}
                                            <script>
                                                $(document).ready(function() {
                                                    // Bind change event to the parent element that exists in the DOM when the page loads
                                                    $(document).on('change', '.med_category', function() {
                                                        var categoryId = $(this).val();
                                                        var medicationDropdown = $(this).closest('.row').find('.medication');

                                                        $.ajax({
                                                            url: '/Admin/Clinic/getSubcategories',
                                                            type: 'GET',
                                                            data: { category_id: categoryId },
                                                            success: function(response) {

                                                                medicationDropdown.empty();
                                                                $.each(response, function(index, subcategory) {
                                                                    medicationDropdown.append('<option value="' + subcategory.id + '">' + subcategory.desc + ' [' + subcategory.unit + ']</option>');
                                                                });
                                                            },
                                                            error: function() {
                                                                console.log('Error fetching subcategories');
                                                            }
                                                        });
                                                    });
                                                });


                                $(document).ready(function() {
                                    // Bind change event to the parent element that exists in the DOM when the page loads
                                    $(document).on('change', '.medication', function() {
                                        var medicationId = $(this).val();
                                        var priceInput = $(this).closest('.row').find('.price-input');
                                        var dosageInput = $(this).closest('.row').find('.dosage-input');
                                        var unitInput = $(this).closest('.row').find('.unit-input');
                                        var medicationMain_name = $(this).closest('.row').find('.main_name');
                                        var allowDoublePaymentInput = $(this).closest('.row').find('.allow_double_payment_input');

                                        $.ajax({
                                            url: '/Admin/Clinic/getMedicationPrice',
                                            type: 'GET',
                                            data: { medication_id: medicationId },
                                            success: function(response) {
                                                // console.log(response)
                                                priceInput.val(response.price);
                                                dosageInput.val(response.dosage);
                                                unitInput.val(response.unit);
                                                medicationMain_name.val(response.desc);
                                              allowDoublePaymentInput.val(response.allow_double_payment);
                                                // Assuming your input field has an id of "myInput"
                                                document.getElementById("").removeAttribute("readonly");

                                                if (response.allow_edit_price == 0) {
                                                        priceInput.prop('disabled', true);
                                                    } else {
                                                        priceInput.prop('disabled', false);
                                                    }
                                                    if (response.allow_edit_price == 1) {
                                                        priceInput.removeAttr('disabled');
                                                    }

                                                    if (response.allow_edit_unit == 0) {
                                                        unitInput.prop('disabled', true);
                                                    } else {
                                                        unitInput.prop('disabled', false);
                                                    }
                                                    if (response.allow_edit_unit == 1) {
                                                        unitInput.removeAttr('disabled');
                                                    }

                                                    if (response.allow_edit_dosage == 0) {
                                                        dosageInput.prop('disabled', true);
                                                    } else {
                                                        dosageInput.prop('disabled', false);
                                                    }
                                                    if (response.allow_edit_dosage == 1) {
                                                        dosageInput.removeAttr('disabled');
                                                    }
                                                 },
                                            error: function() {
                                                console.log('Error fetching subcategories');
                                            }
                                        });
                                    });
                                });
                            </script>



