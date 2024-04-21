
<div class="modal fade" id="exampleModalCenterUpdatePayment2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterUpdatePayment2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalCenterTitle">Update
                    payment</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <form action="" enctype="multipart/form-data" method="POST" id="updatePaymentForm">
                            @csrf
                            <input type="hidden" name="update_id" id="selected_id">
                            <input type="text" name="tracking_no" id="tracking_no">
                            <input type="text" class="form-control" readonly name="new__payment" id="due">
                            <button type="submit" class="btn sidebar-bottom-btn btn-lg btn-block"
                                id="submitForm">Update
                                payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#updatePaymentForm').on('submit', function(e) {
            alert("am here");
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
</script>
