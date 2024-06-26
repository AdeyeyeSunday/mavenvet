<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">


                            <div class="header-title">
                                <a href="{{ route('Admin.Payment.outstandingpayment') }}">
                                    <h6 style="color: red" class="card-title">Outstanding payment list</h6>
                                </a>
                            </div>
                            <div class="header-title">
                                <a href="{{ route('Admin.Payment.oustanding') }}">
                                    <h6 style="color:#6495ED " class="card-title">Vaccine payment list</h6>
                                </a>
                            </div>


                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Cash:
                                    ₦:{{ number_format( $cash + $cash_cash + $cash_cash_pos + $new_cash)  }}</h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Transfer:
                                    ₦:{{number_format($tranfer + $cash_transfer + $new_transfer)  }}
                                </h6>
                            </div>


                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Pos: ₦:{{  number_format($pos + $cash_pos + $new_pos)   }}
                                </h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: red" class="card-title">Today Grand Total:
                                    ₦:{{  number_format($cash + $tranfer + $pos + $cash_transfer + $cash_cash + $cash_pos + $cash_cash_pos + $new_transfer + $new_pos + $new_cash)   }}
                                </h6>
                            </div>





                            </h6>
                        </div>
                    </div>

                    @if (Session::has('payment'))
                        <center>
                            <div class="alert alert-success" role="alert">
                                <div class="iq-alert-text">{{ Session::get('payment') }}</div>
                            </div>
                        </center>
                    @endif

                    @if (Session::has('due'))
                        <center>
                            <div class="alert alert-success" role="alert">
                                <div class="iq-alert-text">{{ Session::get('due') }}</div>
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

                                </div>
                            </div>
                        </center>
                    @endif
                    <div class="card-header d-flex justify-content-between">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="">
                                            <th>Name</th>
                                            <th>Total bill</th>
                                            <th>Cash</th>
                                            <th>Pos</th>
                                            <th>Tranfer</th>
                                            <th>Due</th>
                                            <th>Bank</th>
                                            <th>Payment mode</th>
                                            <th>Assinged</th>
                                            <th>Paid debt</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($pay as $daily)
                                            @if ($daily->new_due > 0)
                                                <td style="color: red">New due payment</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <span class="badge badge-danger">
                                                        {{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                                </td>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal{{ $daily->id }}">
                                                        View
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $daily->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                                @foreach ($daily->service_item as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item: {{ $daily->prod_name }}</h6>
                                                                        <h6>Qty:{{ $daily->qty }} </h6>
                                                                        <h6>Price: {{ $daily->price }}</h6>
                                                                        <h6>Service : {{ $daily->service }}</h6>
                                                                        <h6>Amount: {{ $daily->Amount }}</h6>
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
                                                <td>{{ $daily->Pet_name }}{{ $daily->Unregister }} {{ $daily->Owner_name }}</td>
                                                <td>{{  number_format($daily->total_price)  }}</td>
                                                <td>
                                                    @if ( $daily->pay != 0)
                                                    {{ number_format($daily->pay)  }}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($daily->cash_pos != 0)
                                                    {{  number_format($daily->cash_pos)  }}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($daily->cash_transfer !=0)
                                                    {{  number_format($daily->cash_transfer)  }}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ( $daily->due  != 0)
                                                    {{ number_format($daily->due)  }}
                                                    @endif

                                                </td>
                                                <td>{{ $daily->bankName }}</td>
                                                <td>
                                                    @php
                                                        if ($daily->Mode_of_payment == 'Cash') {
                                                            echo '<button type="button" class="btn btn-danger btn-sm mr-2">Cash</button>';
                                                        } elseif ($daily->Mode_of_payment == 'Transfer') {
                                                            echo ' <button type="button" class="btn btn-primary btn-sm mr-2">Transfer</button>';
                                                        } elseif ($daily->Mode_of_payment == 'Pos') {
                                                            echo ' <button type="button" class="btn btn-warning btn-sm mr-2">Pos</button>';
                                                        } elseif ($daily->Mode_of_payment == 'cash_pos') {
                                                            echo ' <button type="button" class="btn btn-info btn-sm mr-2">cash & pos</button>';
                                                        } elseif ($daily->Mode_of_payment == 'cash_transfer') {
                                                            echo ' <button type="button" class="btn btn-secondary btn-sm mr-2">cash & transfer</button>';
                                                        }
                                                    @endphp
                                                </td>

                                                <td>Dr. {{ $daily->user->name }}</td>

                                                <td>
                                                    <span class="badge badge-danger">
                                                        {{ $daily->new_mode_of_payment }}</span>{{ $daily->new_due }}
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal{{ $daily->id }}">
                                                        View
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $daily->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                                @foreach ($daily->service_item as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>
                                                                            @if ($daily->prod_name != 0)
                                                                            Item: {{ $daily->prod_name }}</h6>
                                                                           @endif

                                                                        <h6>
                                                                            @if ($daily->qty != 0)
                                                                            Qty:{{ $daily->qty }}
                                                                            @endif

                                                                          </h6>
                                                                         <h6>
                                                                            @if ($daily->price != 0)
                                                                            Price: {{ $daily->price }}</h6>
                                                                            @endif

                                                                        <h6>
                                                                            @if ($daily->price * $daily->qty  != 0)
                                                                            Total Amount: {{ $daily->price * $daily->qty }}
                                                                            @endif

                                                                        </h6>
                                                                        <h6>
                                                                            @if ($daily->service != 0)
                                                                            Service : {{ $daily->service }}
                                                                            @endif

                                                                        </h6>
                                                                        <h6>
                                                                            @if ($daily->Amount != 0)
                                                                            Amount:
                                                                            {{ $daily->Amount }}</h6>
                                                                            @endif

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
    @endsection
</x-admin-master>
