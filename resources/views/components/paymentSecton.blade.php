
@if ($attribute1->allow_doc__to_recieve_payment == 1)
    <ul class="nav nav-tabs" id="myTab-three" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab-three" data-toggle="tab"
                href="#home-three" role="tab" aria-controls="home"
                aria-selected="true">Payment section</a>
        </li>
        {{-- <h5 style="color: red">Overall cost: {{ $totalSum }}</h5> --}}
    </ul>

    <div class="col-md-12">
        <div class="checkbox d-inline-block mr-3">
            <input type="checkbox" class="checkbox-input" id="selectAll"> Select all items
            item(s)
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            {{-- <div class="row"> --}}
            <div class="col-md-4">
                <h6 for="">Ref. Number</h6>
            </div>
            <div class="col-md-5">
                <h6 for="">Details</h6>
            </div>
            <div class="col-md-3">
                <h6 for="">Amount</h6>
            </div>
            {{-- </div> --}}
            @foreach ($attribute2 as $o)
                {{-- <div class="row"> --}}
                <div class="col-md-4">
                    <p>{{ $o->tracking_no }} <strong>-</strong> 12-02-2025</p>
                </div>
                <div class="col-md-5">
                    <div class="checkbox d-inline-block mr-3">
                        <input type="checkbox" class="checkbox-input checkbox-item"
                            data-cost="{{ $o->total_cost }}">
                        {{ $o->medication }}
                    </div>
                </div>
                <div class="col-md-3">
                    <p>{{ number_format($o->total_cost, 2) }}</p>
                </div>
            @endforeach
            <h5 style="margin-left: 60%">Total: <span id="totalAmount">0</span></h5>
        </div>
    </div>
    {{-- </div> --}}
    <hr>
    <div class="tab-content" id="myTabContent-4">
        <div class="tab-pane fade show active" id="home-three" role="tabpanel"
            aria-labelledby="home-tab-three">
            <div class="row">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-4 align-self-center"
                            for="pwd1">Payment type:</label>
                        <div class="col-sm-7">
                            <select name="mode_of_payment" id=""
                                class="form-control">
                                <option value="" selected></option>
                                <option value="">Cash</option>
                                <option value="">Pos</option>
                                <option value="">Trasfer</option>
                                @if ($attribute1->allow_doube_mode_of_payment == 1)
                                    <option value="">Cash & Transfer</option>
                                    <option value="">Cash & POS</option>
                                @endif
                            </select>
                            <br>
                        </div>
                        <label class="control-label col-sm-4 align-self-center"
                            for="pwd1">Amount paid</label>
                        <div class="col-sm-7">
                            <input type="number" disabled id="amount_paid" class="form-control" name="amount_paid"
                                >
                            <br>
                        </div>

                        <label class="control-label col-sm-4 align-self-center"
                            for="pwd1">Remark</label>
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
            </div>
        </div>
    </div>
</div>
<hr>
@endif

<script>
$(document).ready(function(){
function updateTotalAmount() {
    var total = 0;
    $('.checkbox-item:checked').each(function(){
        total += parseFloat($(this).data('cost'));
    });
    $('#totalAmount').text(total.toFixed(2));
    $('#amount_paid').val(total.toFixed(2));
}
$('#selectAll').change(function(){
    $('.checkbox-item').prop('checked', $(this).prop('checked')).trigger('change');
});
$('.checkbox-item').change(function(){
    updateTotalAmount();
});
updateTotalAmount();
});
</script>
