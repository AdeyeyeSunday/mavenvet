<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            {{-- <div class="header-title">
                           <h6 style="color: seagreen" class="card-title">Today Payment : ₦ {{$amount}}</h6>
                        </div> --}}

                             <div class="header-title">
                                <a href="{{ route('Admin.Payment.vaccineoustanding') }}">
                                    <h6 style="color: red" class="card-title"> Outstanding Vaccine Payment List</h6>
                                </a>
                            </div>


                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Cash:
                                    ₦:{{ $cash + $cash_cash  + $cash_cash_pos + $new_cash }}</h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Transfer:
                                    ₦:{{ $tranfer + $cash_transfer + $new_transfer }} </h6>
                            </div>


                            <div class="header-title">
                                <h6 style="color: green" class="card-title"> Pos: ₦:{{ $pos + $cash_pos + $new_pos }}
                                </h6>
                            </div>

                            <div class="header-title">
                                <h6 style="color: rgb(0, 179, 255)" class="card-title">Today Grand Total:
                                    ₦:{{ $amount + $tranfer + $pos + $cash_pos + $cash_transfer + $new_pos + $new_transfer + $new_cash }}
                                </h6>
                            </div>



                            <a href="{{ route('Admin.Payment.Payment_list') }}"><button
                                    class="btn btn-primary">Back</button></a>



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




                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-primary" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
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

                                        <!--   <li class="">
                           <a href="{{ route('Admin.Payment.oustanding') }}">
                               <i class="las la-minus"></i><span>Click here now</span>
                           </a>
                       </li>
     -->
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
                                                {{-- <th>Id</th> --}}
                                                <th>Name</th>
                                                <th>Total Bill</th>
                                                <th>Cash</th>
                                                <th>Pos</th>
                                                <th>Tranfer</th>
                                                <th>Due</th>
                                                <th>Bank</th>
                                                <th>Paid Due</th>
                                                <th>Payment Mode</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($daily as $daily)
                                                @if ($daily->new_due > 0)
                                                    <td style="color: red">New Due Payment</td>
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
                                                            data-target="#exampleModal{{ $daily->id }}">
                                                            View
                                                        </button>
                                                    </td>
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
                                                                   @foreach($daily->vaccineiteams as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item:{{$daily->items_name}}</h6>
                                                                        <h6>Qty:{{$daily->qty}}</h6>
                                                                     <h6>Item:{{$daily->price * $daily->qty}}</h6>
                                                                    </div>
                                                                    @endforeach






                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    </tr>
                                                @else
                                                    <td>{{ $daily->name }}</td>
                                                    <td>{{ $daily->total }}</td>
                                                    <td>{{ $daily->pay }}</td>
                                                    <td>{{ $daily->cash_pos }}</td>
                                                    <td>{{ $daily->cash_transfer }}</td>
                                                    <td>{{ $daily->due }}</td>
                                                    <td>{{ $daily->bankName }}</td>
                                                    <td>
                                                        @if ($daily->new_due > 0)
                                                            <span class="badge badge-danger">
                                                                {{ $daily->new_mode_of_payment }}</span>
                                                            {{ $daily->new_due }}
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
                                                            data-target="#exampleModal{{ $daily->id }}">
                                                            View
                                                        </button>
                                                    </td>





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
                                                                  @foreach($daily->vaccineiteams as $daily)
                                                                    <div class="modal-body">
                                                                        <h6>Item:{{$daily->items_name}}</h6>
                                                                        <h6>Qty:{{$daily->qty}}</h6>
                                                                     <h6>Item:{{$daily->price * $daily->qty}}</h6>
                                                                    </div>
                                                                    @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


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
        </div>
        </div>
    @endsection
</x-admin-master>
