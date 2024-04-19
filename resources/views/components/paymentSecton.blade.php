@if ($attribute1->allow_doc__to_recieve_payment == 1)
    <ul class="nav nav-tabs" id="myTab-three" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab-three" data-toggle="tab" href="#home-three" role="tab"
                aria-controls="home" aria-selected="true">
                    Most recent doctor's orders
            </a>
        </li>
    </ul>

    <div class="col-md-12">
        <br>
        <div class="row">
            <div class="col-md-4">
                <h6 for="">Ref. Number</h6>
            </div>
            <div class="col-md-5">
                <h6 for="">Details</h6>
            </div>
            <div class="col-md-3">
                <h6 for="">Amount</h6>
            </div>
            <hr>
            @foreach ($attribute2 as $o)
                @if ($o->payment_status == 1)
                    <div class="col-md-4" style="border-left: 5px solid green; padding-left: 10px;">
                        <p>{{ $o->tracking_no }} <strong>-</strong>{{ $o->date }}</p>
                    </div>
                @else
                    <div class="col-md-4" style="border-left: 5px solid orange; padding-left: 10px;">
                        <p>{{ $o->tracking_no }} <strong>-</strong> {{ $o->date }}</p>
                    </div>
                @endif
                @php
                    $category_name = App\Models\Medicationcategoty::where('id', $o->med_category)->first();
                @endphp
                <div class="col-md-5">
                    @if ($attribute1->allow_doc_see_paid_recent_only == 1)
                        {{ $category_name->med_desc }} <br>
                        <p> {{ $o->medication }}
                            @if ($o->payment_status == 1)
                                <span class="mt-2 badge border border-success text-success mt-2">Paid</span>
                            @else
                                <span class="mt-2 badge border border-danger text-danger mt-2">Not paid</span>
                            @endif
                        </p>
                    @else
                        <div class="checkbox d-inline-block mr-3">
                            <form action="{{ route("Admin.Clinic.encounter_payment",$attribute3 )  }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                {{ $category_name->med_desc }} <br>
                                @if ($o->payment_status == 1)
                                {{-- <input type="" disabled name="checked_items[]" value="{{ $o->id }}" class="checkbox-input checkbox-item" data-cost="{{ $o->total_cost }}"> --}}
                                {{ $o->medication }}<span class="mt-2 badge border border-success text-success mt-2">Paid</span>
                                @else
                                <input type="checkbox" name="checked_items[]" value="{{ $o->id }}" class="checkbox-input checkbox-item" data-cost="{{ $o->total_cost }}">
                                {{ $o->medication }}
                                @endif

                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <p>{{ number_format($o->total_cost, 2) }}</p>
                </div>
            @endforeach
            @if ($o->payment_status != 1)
            <div class="col-md-12">
                <div class="checkbox d-inline-block mr-3">
                    <input type="checkbox" class="checkbox-input" id="selectAll"> <strong> Pay for all
                        item(s)</strong>
                </div>
        </div>
        @endif

            @if ($attribute1->allow_doc_see_paid_recent_only == 0)
            @if ($o->payment_status != 1)
                <h5 style="margin-left: 60%">Total: <span id="totalAmount">0</span></h5>
                <h6>Print invoice ?<div class="checkboxPrintInvoice d-inline-block mr-3">
                        <label for=""></label> <input type="checkbox" class="checkbox-input"
                            id="checkbox1PrintInvoice">
                    </div>
                </h6>
                @endif
            @endif
        </div>
    </div>
    {{-- </div> --}}
    <hr>
    @if ($attribute1->allow_doc_see_paid_recent_only == 0)
    @if ($o->payment_status != 1)
        <div class="tab-content" id="myTabContent-4">
            <div class="tab-pane fade show active" id="home-three" role="tabpanel" aria-labelledby="home-tab-three">
                <div class="row">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="control-label col-sm-4 align-self-center" for="pwd1">Payment type:</label>
                            <div class="col-sm-7">
                                <select name="payment_type" id="payment_type" class="form-control" required>
                                    <option value="" selected></option>
                                    <option value="Cash">Cash</option>
                                    <option value="Pos">Pos</option>
                                    <option value="Trasfer">Trasfer</option>
                                    @if ($attribute1->allow_doube_mode_of_payment == 1)
                                        <option value="Cash & Transfer">Cash & Transfer</option>
                                        <option value="Cash & Pos">Cash & POS</option>
                                    @endif
                                </select>
                                <br>
                            </div>
                            <label class="control-label col-sm-4 align-self-center" for="pwd1">Amount paid</label>
                            <div class="col-sm-7">
                                <input type="number" readonly id="amount_paid" class="form-control" name="amount_paid" required>
                                <br>
                            </div>
                            <label class="control-label col-sm-4 align-self-center" for="pwd1">Remark</label>
                            <div class="col-sm-7">
                                <textarea name="remark" id=""class="form-control" cols="3" rows="3"></textarea>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-4">
                                <button class="btn sidebar-bottom-btn btn-lg btn-block">Process
                                    payment</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @endif
    @endif

@endif

<script>
    $(document).ready(function() {
        function updateTotalAmount() {
            var total = 0;
            $('.checkbox-item:checked').each(function() {
                total += parseFloat($(this).data('cost'));
            });
            $('#totalAmount').text(total.toFixed(2));
            $('#amount_paid').val(total.toFixed(2));
        }
        $('#selectAll').change(function() {
            $('.checkbox-item').prop('checked', $(this).prop('checked')).trigger('change');
        });
        $('.checkbox-item').change(function() {
            updateTotalAmount();
        });
        updateTotalAmount();
    });
</script>
