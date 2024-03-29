<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table data-table table-striped">

                                        <a href="{{ route('Admin.Clinic.expenditure') }}"><button
                                            class="btn btn-primary">Back</button></a>
                                        <center>
                                            <h4 style="color: red">Total Amount: ₦ {{ $amount }}</h4>
                                        </center>
                                        <thead>
                                            <tr class="">
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jan as $Exp)
                                                <tr>
                                                    <td>{{ $Exp->name }}</td>
                                                    <td>{{ $Exp->description }}</td>
                                                    <td>₦{{ $Exp->amount }}</td>
                                                    <td>{{ $Exp->date }}</td>
                                                    <td>{{ $Exp->month }}</td>

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
    @endsection
</x-admin-master>
