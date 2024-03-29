<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                </div>
                            </center>
                        @endif
                       <center> <div>
                            <button type="button" class="btn sidebar-bottom-btn btn-lg" data-toggle="modal"
                                data-target="#exampleModalScrollable">Search with Date
                            </button>
                        </div>
                    </center>
                        <div class="header-title card-header d-flex justify-content-between">
                            <h4 class="card-title"></h4>
                            <a href="{{ route('Admin.Expense.Expense') }}"><button class="btn sidebar-bottom-btn btn-lg">Add
                                    expense</button></a>
                        </div>

                        <div class="card-header d-flex justify-content-between">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped">
                                        <center>
                                            <h6 style="color: red">Today Total Amount: ₦
                                                {{ number_format($amount, 2, '.', ',') }}

                                            </h6>
                                        </center>
                                        <thead>
                                            <tr class="ligth">
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Month</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Expense as $Exp)
                                                <tr>
                                                    <td>{{ $Exp->name }}</td>
                                                    <td>{{ $Exp->description }}</td>
                                                    <td> ₦{{ $Exp->amount }}</td>
                                                    <td>{{ $Exp->date }}</td>
                                                    <td>{{ $Exp->month }}</td>

                                                    <td><a href="{{ route('Admin.Expense.Monthly_edit', $Exp->id) }}"
                                                            class="btn btn-primary btn-sm">Edit</a></td>
                                                </tr>
                                            @endforeach
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
                        <form action="{{ route('Admin.Expense.search') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="validationDefault02">From </label>
                                    <input type="date" class="form-control" name="from" id="date">
                                </div>
                                <div class="col-md-6">
                                    <label for="validationDefault02">To</label>
                                    <input type="date" class="form-control" name="to" id="date">
                                </div>
                            </div>
                            <br>
                             <button type="submit" class="btn sidebar-bottom-btn btn-lg btn-block">Search</button></center>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
