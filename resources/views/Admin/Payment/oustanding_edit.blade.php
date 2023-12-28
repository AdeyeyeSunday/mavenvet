<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"> Update Outstanding Vaccine Payment </h4>
                            </div>
                        </div>
                        @if (Session::has('valid'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('valid') }}</div>
                                </div>
                            </center>
                        @endif
                        <div class="card-body">
                            {{-- <p>Update Outstanding Vaccine Payment</p> --}}
                            <form action="{{ route('Admin.Payment.oustanding_update', $oustanding_edit->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault03"> Total Bill</label>
                                        <input type="number" value="{{ $oustanding_edit->total }}" class="form-control"
                                            name="total" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault02"> Payment Status</label>
                                        <input type="text" class="form-control" name="Payment_type" value="Full Payment"
                                            id="" readonly>

                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault02"> Mode Of Payment</label>
                                        <select class="form-control" name="Mode_Of_payment" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Pos">Pos</option>
                                        </select>
                                    </div>




                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefaultUsername">Amount Paid</label>
                                        <div class="input-group">
                                            <input type="number" value="{{ $oustanding_edit->pay + $oustanding_edit->new_due }}" readonly
                                                class="form-control" name="pay" aria-describedby="inputGroupPrepend2"
                                                required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="name" value="{{ $oustanding_edit->name }}" id="">
                                    <input type="hidden" name="location" value="{{ $oustanding_edit->location }}" id="">



                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault03">Outstanding Payment</label>
                                        <input type="number" value="{{ $oustanding_edit->total - $oustanding_edit->pay - $oustanding_edit->new_due }}"
                                            class="form-control" name="due" required readonly>
                                    </div>
                                </div>



                                <center><button class="btn btn-primary" type="submit">Update Payment</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
</x-admin-master>
