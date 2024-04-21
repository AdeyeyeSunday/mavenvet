
<div class="modal fade" id="exampleModalCenterUpdatePayment2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterUpdatePayment2" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalCenterTitle">Update
                    payment.</h6>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                        <div class="col-md-12">
                                <small> <p>You can only clear this payment once.</p></small>
                        <form action="" enctype="multipart/form-data" method="POST" id="updatePaymentForm">
                            @csrf
                            <input type="hidden" name="update_id" id="selected_id">
                            <input type="hidden" name="tracking_no" id="tracking_no">
                            <label for="">Outstanding payment</label>
                            <input type="text" class="form-control" readonly name="new__payment" id="due">
                            <label for="">Payment type</label>
                            <select name="payment_type" id="" class="form-control" required>
                            <option value="" selected></option>
                            @foreach ($paymentType as $p)
                            <option value="{{ $p->payment_type }}">{{ $p->payment_type }}</option>
                            @endforeach
                        </select>
                            <br>
                        </div>
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn sidebar-bottom-btn btn-lg btn-block"
                                id="submitForm">Update
                                payment</button>
                        </div>

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
            e.preventDefault();
            var id = $('#selected_id').val();
            var formData = new FormData(this);
            $('#process_button').text
            $.ajax({
                url: '{{ route('Admin.Clinic.encounter_payment_update') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#submitForm').text('Processing...');
                },
                success: function(response) {
                    toastr.success(response.message, 'Success!', {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        timeOut: 3000
                    });
                    $('#reloadAmount').load(location.href + ' #reloadAmount');
                    $('#updatePaymentForm')[0].reset();
                    $('#exampleModalCenterUpdatePayment2').modal('hide');
                    $('#submitForm').text('Update payment');
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred. Please try again later.', 'Error!');
                    $('#process_button').text('Process');
                }
            });
        });
    });
</script>
