<x-admin-master>
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h6 class="card-title">Due Report</h6>
                        </div>
                        <div class="header-title">
                            <a href="{{ route('Admin.Pos.balance') }}">
                                <h6 style="color: blue" class="card-title">Paid Debts</h6>
                            </a>
                        </div>
                        <div class="header-title">
                            <h6 style="color: red" class="card-title">Due Total: {{ $amount }}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-table table mb-0 tbl-server-info">
                                <thead class="bg-white">
                                    <tr class=" -data">
                                        {{-- <th>Id</th> --}}
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Due</th>
                                        <th>Payment Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="-body">
                                    @foreach ($daily as $entry)
                                    @if ($entry->due > 0)
                                    <tr>
                                        {{-- <td>{{ $entry->id }}</td> --}}
                                        <td>{{ $entry->fname }}</td>
                                        <td>{{ $entry->phone }}</td>
                                        <td>{{ $entry->address }}</td>
                                        <td>{{ $entry->total_price }}</td>
                                        <td>{{ $entry->pay }}</td>
                                        <td>{{ $entry->due }}</td>
                                        <td>{{ $entry->Payment_type }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#exampleModal{{ $entry->id }}">
                                                View
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $entry->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Details
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h6 class="mb-0">Items :
                                                                {{ $entry->orderIteams[0]->prod_id ?? '' }}
                                                            </h6>
                                                            <p>Qty : {{ $entry->orderIteams[0]->qty ?? '' }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>
