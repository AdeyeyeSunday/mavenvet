<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"> Update Outstanding Payment </h4>
                            </div>
                        </div>
                        @if (Session::has('valid'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('valid') }}</div>
                                </div>
                            </center>
                        @endif


                        @if (Session::has('payment'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('payment') }}</div>
                                </div>
                            </center>
                        @endif



                        <div class="card-body">
                            <p>Update Outstanding Payment and input the amount and the outstanding payment</p>
                            <form action="{{ route('Admin.Payment.Payment_update', $payment_edit->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault03"> Total Bill</label>
                                        <input type="number" value="{{ $payment_edit->total_price }}"
                                            class="form-control" name="total_price" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault02"> Payment Status</label>
                                        <input type="text" class="form-control" readonly name="Payment_type"
                                            value="Full Payment" id="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault02"> Mode Of Payment</label>
                                        <select class="form-control" name="Mode_Of_Payment" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Pos">Pos</option>
                                        </select>
                                    </div>
                                    <input type="text" hidden value="{{ $payment_edit->location }}" class="form-control"
                                        name="location">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefaultUsername">Amount Paid</label>
                                        <div class="input-group">
                                            <input type="number"
                                                value="{{ $payment_edit->pay + $payment_edit->cash_transfer + $payment_edit->cash_pos + $payment_edit->new_due }}"
                                                class="form-control" name="pay" aria-describedby="inputGroupPrepend2"
                                                readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault03">Outstanding Payment</label>
                                        <input type="number"
                                            value="{{ $payment_edit->total_price -$payment_edit->pay -$payment_edit->cash_transfer -$payment_edit->cash_pos -$payment_edit->new_due }}"
                                            class="form-control" readonly name="due" required>
                                    </div>
                                    <input type="hidden" value="{{ date('d/m/y') }}" class="form-control" name="date">
                                    <input type="hidden" value="{{ date('Y') }}" class="form-control" name="year">
                                    <input type="hidden" value="{{ date('M') }}" class="form-control" name="month">
                                </div>
                                <center><button class="btn btn-primary" type="submit">Payment</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
</x-admin-master>
