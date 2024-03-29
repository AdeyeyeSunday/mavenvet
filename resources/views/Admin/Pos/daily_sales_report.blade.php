<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title"> Report</h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Cash:
                                    ₦: {{ number_format($cash + $cash_cash + $cash_cash_pos + $new_cash , 2, '.', ',') }}

                                    </h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Transfer:
                                    ₦:
                                    {{ number_format( $tranfer + $cash_transfer + $new_transfer, 2, '.', ',') }}

                                    {{-- {{ }} --}}
                                </h6>
                            </div>


                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Pos: ₦:

                                    {{ number_format( $pos + $cash_pos + $new_pos , 2, '.', ',') }}


                                </h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: red" class="card-title">Today Grand Total:
                                    ₦:
                                    {{ number_format( $cash +$tranfer +$pos +$cash_transfer +$cash_cash +$cash_pos +$cash_cash_pos +$new_transfer +$new_pos +$new_cash , 2, '.', ',') }}

                                </h6>
                            </div>

                        </div>

                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
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


                        @if (Session::has('Discount'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('Discount') }} Is
                                        {{ $Pos_invoice->discount }} !!!!</div>
                                </div>
                            </center>
                        @endif


                        @if (Session::has('success'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('success') }} </div>
                                </div>
                            </center>
                        @endif

                        @if (Session::has('error'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('error') }}

                                        <li class="">
                                            <a href="{{ route('Admin.Pos.daily_sales_report') }}">
                                                <i class="las la-minus"></i><span>Click here now</span>
                                            </a>
                                        </li>

                                    </div>
                                </div>
                            </center>
                        @endif


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="">
                                            <th>Name</th>
                                            <th>Total Bill</th>
                                            <th>Discount</th>
                                            <th>Cash</th>
                                            <th>Pos</th>
                                            <th>Transfer</th>
                                            <th>Discount</th>
                                            <th>Due</th>
                                            <th>Bank</th>
                                            <th>Paid Debt</th>
                                            <th>Payment Mode</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($daily as $daily)
                                            @if ($daily->new_due > 0)
                                                <td style="color: red">New due payment</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    @if ($daily->new_due > 0)
                                                        <span class="badge badge-danger">
                                                            {{ $daily->new_mode_of_payment }}</span>
                                                            {{ $daily->new_due }}
                                                    @else

                                                    @endif
                                                </td>
                                                <td>
                                                </td>



                                                <td>

                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal{{  $daily->id }}">
                                                            View
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{  $daily->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Details</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
	                                                             @foreach($daily->orderIteams as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item:{{$daily->prod_id}}</h6>
                                                                        <h6>Item:{{$daily->qty}}</h6>
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
                                            @else
                                                <td>{{ $daily->fname }}</td>
                                                <td>{{ $daily->total_price }}</td>
                                                <td>{{ $daily->discount }}</td>
                                                <td>{{ $daily->pay }}</td>
                                                <td>{{ $daily->cash_pos }}</td>
                                                <td>{{ $daily->cash_transfer }}</td>
                                                <td>{{ $daily->discount }}</td>
                                                <td>{{ $daily->due }}</td>
                                                <td>{{ $daily->bankName }}</td>
                                                <td>
                                                    @if ($daily->new_due > 0)
                                                        <span class="badge badge-danger">
                                                            {{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                                    @else
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        if ($daily->Mode_of_payment == 'Cash') {
                                                            echo '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                                        } elseif ($daily->Mode_of_payment == 'Transfer') {
                                                            echo ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                                        } elseif ($daily->Mode_of_payment == 'Pos') {
                                                            echo ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';
                                                        } elseif ($daily->Mode_of_payment == 'cash_pos') {
                                                            echo ' <button type="button" class="btn btn-info btn-sm mr-2">cash/pos</button>';
                                                        } elseif ($daily->Mode_of_payment == 'cash_transfer') {
                                                            echo ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash/transfer</button>';
                                                        }
                                                    @endphp
                                                </td>

                                                <td>


                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal{{  $daily->id }}">
                                                        View
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{  $daily->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Details</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                @foreach($daily->orderIteams as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item:{{$daily->prod_id}}</h6>
                                                                        <h6>Item:{{$daily->qty}}</h6>
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

                                            @endif
                                    </tbody>
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
