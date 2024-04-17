<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Other service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn sidebar-bottom-btn mb-5 btn-lg addField3">Add Fields</button>
                <form action="" method="POST" enctype="multipart/form-data" id="service_request">
                    @csrf
                    <div>
                        <input type="hidden" value="{{ $attribute1 }}" name="token" id="">
                        <input type="hidden" value="{{ $attribute2 }}" name="case_id" id="">
                        <div class="row firstRow3" id="medication-field">
                            <input type="hidden"  name="ser_category" id="ser_category" class="form-control category-input">
                            <div class="col-md-5 form-group">
                                <h6 for="">Service</h6>
                                <select name="service[]" id="service" class="form-control service"
                                    required>
                                    <option value="" selected></option>
                                    @foreach ($services as $m)
                                        <option value="{{ $m->service_id }}">{{ $m->service }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="main_name[]" class="form-control main_name" id="">
                            </div>
                            <div class="col-md-3 form-group">
                                <h6 for="">Price</h6>
                                <input type="number" class="form-control price-input" id="price" name="price[]"
                                    required placeholder="Enter amount" class="w-100">
                            </div>
                            <div class="col-md-4 form-group">
                                <h6 for="">Qty</h6>
                                <select name="qty[]" id="qty" class="form-control" required>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <br>
                        <button type="submit" id="process_button1"
                            class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            //FOR ADD ROWS
            $('.addField3').click(function() {
                $('.firstRow3').parent().append(`
            <div class="row">
                          <div class="col-md-5 form-group">
                                <select name="service[]" id="service" class="form-control service"
                                    required>
                                    <option value="" selected></option>
                                    @foreach ($services as $m)
                                        <option value="{{ $m->service_id }}">{{ $m->service }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="main_name[]" class="form-control main_name" id="">
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control price-input" id="price" name="price[]"
                                    required placeholder="Enter amount" class="w-100">

                            </div>
                            <div class="col-md-2 form-group">
                                <select name="qty[]" id="qty" class="form-control" required>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                            <button type="button" class="btn btn-danger btn-sm deleteRow">Remove</button>
                            </div>
                           </div>
                    `);
            });
            //FOR DELETE ROWS
            $(document).on('click', '.deleteRow', function() {
                $(this).parent().parent().remove();
            });
        });

        $(document).ready(function() {
            // Bind change event to the parent element that exists in the DOM when the page loads
            $(document).on('change', '.service', function() {
                var categoryId = $(this).val();
                var ser_categoryInput = $(this).closest('.row').find('.category-input');
                var main_nameInput = $(this).closest('.row').find('.main_name');
                var priceInput = $(this).closest('.row').find('.price-input');
                $.ajax({
                    url: '/Admin/Clinic/getSubservices',
                    type: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // alert(response.amount);
                        priceInput.val(response.amount);
                        ser_categoryInput.val(response.service_category);
                        main_nameInput.val(response.service);
                    },
                    error: function() {
                        console.log('Error fetching subcategories');
                    }
                });
            });
        });

        // this submiting
        // this for instacting document
        $(document).ready(function() {
            $('#service_request').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $('#process_button1').text
                $.ajax({
                    url: '{{ route('Admin.Clinic.service_store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#process_button1').text('Processing...');
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
                        $('.bd-example-modal-lg2').modal('hide');
                        $('#process_button1').text('Process');
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred. Please try again later.', 'Error!');
                        $('#process_button1').text('Process');
                    }
                });
            });
        });
    </script>
    </script>
