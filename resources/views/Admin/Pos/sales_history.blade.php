<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#exampleModalScrollable">Search with Date</button>
                            </div>
                            <div class="header-title">
                                <a href="{{ route('Admin.Pos.store_cash') }}">
                                    <h6 style="color: green" class="card-title"> Cash: ₦:
                                        {{ number_format($cash + $cash_cash + $cash_cash_pos + $new_cash, 2, '.', ',') }}
                                    </h6>
                                </a>
                            </div>
                            <div class="header-title">
                                <a href="{{ route('Admin.Pos.store_transfer') }}">
                                    <h6 style="color: green" class="card-title"> Transfer: ₦:
                                        {{ number_format($tranfer + $cash_transfer + $new_transfer, 2, '.', ',') }}
                                    </h6>
                                </a>
                            </div>
                            <div class="header-title">
                                <a href="{{ route('Admin.Pos.store_pos') }}">
                                    <h6 style="color: green" class="card-title"> Pos: ₦:
                                        {{ number_format($pos + $cash_pos + $new_pos, 2, '.', ',') }}
                                    </h6>
                                </a>
                            </div>
                            <div class="header-title">
                                <h6 style="color: red" class="card-title">Today Grand Total: ₦:
                                    {{ number_format($cash + $tranfer + $pos + $cash_transfer + $cash_cash + $cash_pos + $cash_cash_pos + $new_transfer + $new_pos + $new_cash, 2, '.', ',') }}
                                </h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive rounded mb-3">
                                <table class="data-table table mb-0 tbl-server-info">
                                    <thead class="bg-white text">
                                        <tr class="light light-data">
                                            {{-- <th>Id</th> --}}
                                            <th>Name</th>
                                            <th>Total bill</th>
                                            <th>Cash</th>
                                            <th>Pos</th>
                                            <th>Transfer</th>
                                            <th>Due</th>
                                            <th>Bank</th>
                                            <th>Payment mode</th>
                                            <th>Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody class="light-body">
                                        @foreach ($daily as $entry)
                                            <tr>
                                                {{-- <td>{{ $entry->id }}</td> --}}
                                                <td>{{ $entry->fname }}</td>
                                                <td>{{ $entry->total_price }}</td>
                                                <td>{{ $entry->pay }}</td>
                                                <td>{{ $entry->cash_pos }}</td>
                                                <td>{{ $entry->cash_transfer }}</td>
                                                <td>{{ $entry->due }}</td>
                                                <td>{{ $entry->bankName }}</td>
                                                <td>
                                                    @php
                                                        switch ($entry->Mode_of_payment) {
                                                            case 'Cash':
                                                                echo '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                                                break;
                                                            case 'Transfer':
                                                                echo ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                                                break;
                                                            case 'Pos':
                                                                echo ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';
                                                                break;
                                                            case 'cash_pos':
                                                                echo ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';
                                                                break;
                                                            case 'cash_transfer':
                                                                echo ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                                                break;
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ $entry->date }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $entry->id }}">View</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $entry->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Details
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @foreach ($entry->orderIteams as $item)
                                                                    <div class="modal-body">
                                                                        <h6>Item: {{ $item->prod_id }}</h6>
                                                                        <h6>Qty: {{ $item->qty }}</h6>
                                                                    </div>
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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

        <!-- Search Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Search with Date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Admin.search.search') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="validationDefault02">Pick a date</label>
                                    <input type="date" class="form-control" name="from" id="date">
                                </div>
                            </div>
                            <br><br>
                            <center><button type="submit" class="btn btn-primary">Search</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>
