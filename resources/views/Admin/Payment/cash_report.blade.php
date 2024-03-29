<x-admin-master>
    @section('content')
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h6 class="card-title">Cash Transaction</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('Admin.Payment.cash_report_store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="location" value="MVC" id="">
                    <div class="form-row">
                        <div class="col">
                            <label for="">Customer name & Transaction details</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
                        </div>
                        <div class="col">
                            <label for="">Mode of payment</label>
                            <select class="form-control" name="mode" id="validationTooltip04" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Pos">Pos</option>
                                <option value="Bank_deposit">Bank Deposit</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Amount">
                        </div>
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <input type="hidden" name="date" value="{{ date('d/m/y') }}">
                        <input type="hidden" name="month" value="{{ date('F') }}">
                        <input type="hidden" name="year" value="{{ date('Y') }}">
                    </div>
                    <br>
                    <center><button type="submit" class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Submit</button>
                    </center>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">Cash Transaction History</h6>
                            </div>


                            <button type="button" class="btn sidebar-bottom-btn mt-4 btn-lg" data-toggle="modal"
                                data-target="#exampleModalScrollable">Search with date
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="">
                                        <th>Customet name</th>
                                        <th>Mode of payment</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Approved by</th>
                                        {{-- <th>Action</th> --}}

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cash as $cash)
                                        <tr>
                                            <td>{{ $cash->customer_name }}</td>

                                                @if ($cash->mode == "Bank_deposit")
                                                <td>Bank deposit</td>
                                                @elseif($cash->mode == "Transfer")
                                                <td>Transfer</td>
                                                @elseif($cash->mode == "Pos")
                                                <td>Pos</td>
                                                @elseif($cash->mode == "Cash")
                                                <td>Cash</td>
                                                @else

                                                @endif
                                                {{-- {{ $cash->mode }} --}}

                                            <td>{{ $cash->amount }}</td>
                                            <td>{{ $cash->date }}</td>
                                            <td>{{ $cash->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                        <h5 class="modal-title" style="margin-left: 150px" id="exampleModalScrollableTitle"> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="col-lg-12">
                        <form action="{{ route('Admin.Pos.cashbackseach') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="validationDefault02">From</label>
                                    <input type="date" class="form-control" name="from" id="date">
                                </div>
                                <div class="col-md-6">
                                    <label for="validationDefault02">To</label>
                                    <input type="date" class="form-control" name="to" id="date">
                                </div>
                            </div>
                            <br>
                            <center> <button type="submit"
                                    class="btn sidebar-bottom-btn btn-lg btn-block">Search</button></center>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
