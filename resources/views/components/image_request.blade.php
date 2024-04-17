{{-- upload document --}}
<div class="modal fade" id="exampleModalCenter2Upload_load" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">
                    Upload document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn sidebar-bottom-btn  btn-lg mb-5 addField">Add Fields</button>
                <form action="{{ route('Admin.Clinic.encounter_store_image') }}" method="POST"
                    enctype="multipart/form-data" id="image_request">
                    @csrf
                    <div>
                        <div class="row firstRow">
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" name="names[]" required
                                    placeholder="Enter file description" class="w-100">
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="file" name="filess[]" required class="w-100">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="{{  $attribute1 }}" name="token" id="">
                    <input type="hidden" value="{{  $attribute2 }}" name="case_id" id="">
                    <div class="modal-footer">
                        <button type="submit" id="process_button" class="btn sidebar-bottom-btn btn-lg btn-block">Process</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        //FOR ADD ROWS
        $('.addField').click(function() {
            $('.firstRow').parent().append(`
                    <div class="row">
                    <div class="col-md-6 form-group">
                    <input type="text" name="names[]" class="form-control" required placeholder="Enter file description" class="w-100">
                    </div>
                    <div class="col-md-4 form-group">
                    <input type="file" name="filess[]" required class="w-100">
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

    // this for instacting document
    $(document).ready(function() {
        $('#image_request').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#process_button').text
            $.ajax({
                url: '{{ route('Admin.Clinic.encounter_store_image') }}',
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
                    $('#exampleModalCenter2Upload_load').modal('hide');
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
