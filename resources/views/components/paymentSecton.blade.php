<form action="{{ route('Admin.Clinic.encounter_payment', $attribute3) }}" enctype="multipart/form-data" id="payment_form" method="POST">
    @csrf
    @if (
        ($attribute1->allow_doc__to_recieve_payment == 1 && $attribute1->allow_doc_see_paid_recent_only == 0) ||
            ($attribute1->allow_doc__to_recieve_payment == 0 && $attribute1->allow_doc_see_paid_recent_only == 1))

<div id="reloadAmount">
      <div class="col-md-12"  >
            <ul class="nav nav-" id="myTab-three" role="tablist" >
                <li class="nav-item">
                    <br>
                    <h5 id="home-tab-three" data-toggle="tab" href="#home-three" role="tab" aria-controls="home"
                        aria-selected="true">Most recent doctor order(s)</h5>
                    <hr>
                </li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ref. Number</th>
                        <th>Details</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                {{-- <tbody id="reloadAmount"> --}}
                    @foreach ($attribute2 as $o)
                        {{-- this update payment --}}
                        <tr>
                            <td>
                                @if ($o->payment_status == 1)
                                    <div style="border-left: 5px solid green; padding-left: 10px;">
                                        <p>{{ $o->tracking_no }} <strong>-</strong>{{ $o->date }}</p>
                                    </div>
                                @else
                                    <div style="border-left: 5px solid orange; padding-left: 10px;">
                                        <p>{{ $o->tracking_no }} <strong>-</strong> {{ $o->date }}</p>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $category_name = App\Models\Medicationcategoty::where(
                                        'id',
                                        $o->med_category,
                                    )->first();
                                @endphp


                                @if ($attribute1->allow_doc_see_paid_recent_only == 1)
                                    {{ $category_name->med_desc }} <br>
                                    <p> {{ $o->medication }}
                                        @if ($o->payment_status == 1)
                                            <span class="mt-2 badge border border-success text-success mt-2">Paid</span>
                                        @else
                                            <span class="mt-2 badge border border-danger text-danger mt-2">Not
                                                paid</span>
                                        @endif
                                    </p>
                                @else
                                    <div class="checkbox d-inline-block mr-3">
                                        {{ $category_name->med_desc }} <br>
                                        @if ($o->payment_status == 1)
                                            {{ $o->medication }}<span
                                                class="mt-2 badge border border-success text-success mt-2">Paid</span>

                                        @else
                                            <input type="checkbox" name="checked_items[]" value="{{ $o->id }}"
                                                class="checkbox-input checkbox-item" data-cost="{{ $o->total_cost }}">
                                            {{ $o->medication }}
                                        @endif
                                    </div>
                                @endif
                            </td>

                            <td  >
                                @if ($o->payment_status == 1)


                                    @if ($o->amount_paid != $o->total_cost)

                                        <strike>
                                            <p>{{ number_format($o->total_cost, 2) }}</p>
                                        </strike>

                                        {{-- <div id="reloadAmount"> --}}
                                        @if ($o->due > 0)
                                            <p style="color: maroon">Balance: {{ number_format($o->due, 2) }}</p>
                                        @endif
                                        {{-- </div> --}}
                                        <button type="button" class="btn btn-sm"
                                            onclick="updatePayment({{ $o->id }}, {{ $o->due }} ,{{ $o->tracking_no }})"
                                            data-toggle="modal" data-target="#exampleModalCenterUpdatePayment2"
                                            style="color: red">Update payment</button>

                                    @else
                                        <p>{{ number_format($o->amount_paid, 2) }}</p>
                                    @endif
                                @else
                                    <p>{{ number_format($o->total_cost, 2) }}</p>
                                @endif
                                <input type="hidden" value="{{ number_format($o->total_cost, 2) }}"
                                    name="price_cost[{{ $o->id }}]" style="width: 90%">
                                @if ($attribute1->allow_doc_see_paid_recent_only != 1)
                                    @if ($o->payment_status != 1)
                                        <input type="hidden" value="{{ $o->total_cost }}"
                                            name="price_cost[{{ $o->id }}]" class="form-control"
                                            style="width: 100%">

                                        @if ($o->allow_double_payment == 1)
                                            <input type="number" value="{{ $o->total_cost }}"
                                                name="amount_inputed[{{ $o->id }}]" class="form-control"
                                                style="width: 100%">
                                            <small style="color: maroon">Part payment (optional) </small>
                                        @else
                                            <input type="hidden" value="{{ $o->total_cost }}"
                                                name="amount_inputed[{{ $o->id }}]" class="form-control"
                                                style="width: 100%">
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if ($attribute1->allow_doc_see_paid_recent_only == 0 && $o->payment_status != 1)
                        <tr>
                            <td colspan="3">
                                <div class="checkbox d-inline-block mr-3">
                                    <input type="checkbox" class="checkbox-input" id="selectAll"> Pay for all
                                    item(s)
                                </div>
                            </td>
                        </tr>
                    @endif
                </tfoot>
            </table>
            @if ($attribute1->allow_doc_see_paid_recent_only == 0 && $o->payment_status != 1)
                <h5 style="margin-left: 60%">Total: <span id="totalAmount">0</span></h5>
                <label>Print invoice ?
                    <div class="checkboxPrintInvoice d-inline-block mr-3">
                        <label for=""></label> <input type="checkbox" class="checkbox-input"
                            id="checkbox1PrintInvoice">
                    </div>
                </label>
            @endif
        </div>
        <hr>

</div>
        @if ($attribute1->allow_doc_see_paid_recent_only == 0)
            @if ($o->payment_status != 1)
                <div class="tab-content" id="myTabContent-4">
                    <div class="tab-pane fade show active" id="home-three" role="tabpanel"
                        aria-labelledby="home-tab-three">
                        <div class="row">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 align-self-center" for="pwd1">Payment
                                        type:</label>
                                    <div class="col-sm-7">
                                        <select name="payment_type" id="payment_type" class="form-control" required>
                                            <option value="" selected></option>
                                            @foreach ($paymentType as $p)
                                                <option value="{{ $p->payment_type }}">{{ $p->payment_type }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                    </div>
                                    <input type="hidden" name="amount_charge" id="amount_paid" style="width: 90%">
                                    <label class="control-label col-sm-4 align-self-center" for="pwd1">Amount
                                        paid</label>
                                    <div class="col-sm-7">
                                        <input type="number" id="amount_paid" class="form-control" name="amount_paid"
                                            required>
                                        <br>
                                    </div>
                                    <label class="control-label col-sm-4 align-self-center"
                                        for="pwd1">Remark</label>
                                    <div class="col-sm-7">
                                        <textarea name="remark" id=""class="form-control" cols="3" rows="3"></textarea>
                                        {{-- <br> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-8">
                                    </div>
                                    <div class="col-4">
                                        <button type="submit"
                                            class="btn sidebar-bottom-btn btn-lg btn-block submit_payment" id="submit_payment_payment">Process
                                            payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif
</form>
<x-updatePaymentModel :paymentType="$paymentType" />


<script>
$(document).ready(function() {
    $('#payment_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#submit_payment_payment').text
        $.ajax({
            url: '{{ route('Admin.Clinic.encounter_payment', $attribute3) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#submit_payment_payment').text('Processing...');
            },
            success: function(response) {
                if (response.status === 200) {
                    toastr.success(response.message, 'Success!', {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        timeOut: 5000
                    });
                    setTimeout(function() {
                        window.location.href = '{{ route("Admin.Clinic.Clinic_list") }}';
                    }, 2000);
                } else {
                    toastr.error(response.message, 'Error!', {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        timeOut: 3000
                    });
                }
                $('#submit_payment_payment').text('Process payment');
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred. Please try again later.', 'Error!');
                $('#process_button').text('Process');
            }
        });
    });
});



    // this is passing parameter to the updatePayment models
    function updatePayment(value, due, tracking_no) {
        document.getElementById("selected_id").value = value;
        document.getElementById("due").value = due;
        document.getElementById("tracking_no").value = tracking_no;
    }


    $(document).ready(function() {
        function updateTotalAmount() {
            var total = 0;
            var atLeastOneChecked = false;

            // Calculate total and check if at least one checkbox is checked
            $('.checkbox-item:checked').each(function() {
                total += parseFloat($(this).data('cost'));
                atLeastOneChecked = true;
            });

            // Update total amount
            $('#totalAmount').text(total.toFixed(2));
            $('#amount_paid').val(total.toFixed(2));

            // Enable or disable the button based on whether at least one checkbox is checked
            if (atLeastOneChecked) {
                $('.submit_payment').prop('disabled', false);
            } else {
                $('.submit_payment').prop('disabled', true);
            }
        }

        // Bind change event to checkboxes
        $('#selectAll').change(function() {
            $('.checkbox-item').prop('checked', $(this).prop('checked')).trigger('change');
        });
        $('.checkbox-item').change(function() {
            updateTotalAmount();
        });

        // Initial update of the total
        updateTotalAmount();
    });
</script>
