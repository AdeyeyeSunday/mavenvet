<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 style="color: seagreen" class="card-title">Mavenvet Pos </h6>
                            </div>
                            <center>
                                <h6 style="color: red" class="card-title">{{ gmdate(' jS \ F Y ') }} </h6>
                            </center>
                        </div>


                        @if (Session::has('message'))
                            <center>
                                <div class="alert alert-danger" role="alert">
                                    <div class="iq-alert-text">{{ Session::get('message') }}</div>
                                </div>
                            </center>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="">
                                            {{-- <th>Name</th> --}}
                                            {{-- <th>Phone no</th> --}}
                                            <th>Tracking no</th>
                                            <th>Order status</th>
                                            <th>Date</th>
                                            <th>Process payment</th>
                                            <th>View</th>
                                            {{-- <th>Actions</th> --}}
                                            @if (auth()->user()->userHasRole('Admin'))
                                                <th>Actions</th>
                                            @endif
                                            @if (auth()->user()->userHasRole('Cashier'))
                                                <th>Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pending as $pos_view)
                                            {{-- <td>{{ $pos_view->fname }} </td> --}}
                                            {{-- <td>{{ $pos_view->phone }}</td> --}}
                                            <td>Mavenvet{{ $pos_view->trackking_id }}</td>
                                            <td><button type="button"
                                                    class="btn btn-warning btn-sm mr-2">{{ $pos_view->order_status }}</button>
                                            </td>
                                            <td>{{ $pos_view->date }}</td>
                                            <td>
                                                <a href="{{ route('Admin.Pos.Pos_invoice', $pos_view->id) }}"><button
                                                        type="button" class="btn btn-dark btn-sm mr-2">Process
                                                        payment</button></a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-link mr-2" data-toggle="modal"
                                                        data-target="#exampleModal{{ $pos_view->id }}"><i
                                                            class="ri-eye-line mr-0 ri-lg fw-bold"></i></a>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $pos_view->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Purchase</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            @php
                                                                $items = App\Models\OrderIteams::where(
                                                                    'order_id',
                                                                    $pos_view->id,
                                                                )->get();
                                                            @endphp
                                                            <div class="modal-body">
                                                                @foreach ($items as $item)
                                                                    <ul>
                                                                        <li>Item : {{ $item->prod_id }}
                                                                            <br>
                                                                            Qty:{{ $item->qty }}</li>

                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </td>

                                            <td>
                                                @if (auth()->user()->userHasRole('Admin'))
                                                    <form
                                                        action="{{ route('Admin.Pos.Pos_pending_delete', $pos_view->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex align-items-center list-action">
                                                            <a
                                                                href="{{ route('Admin.Pos.Pos_pending_delete', $pos_view->id) }}">
                                                                <button class="btn btn-danger btn-sm">Remove</button></a>
                                                        </div>
                                                    </form>
                                                @elseif (auth()->user()->userHasRole('Manager'))
                                                    <form
                                                        action="{{ route('Admin.Pos.Pos_pending_delete', $pos_view->id) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-flex align-items-center list-action">
                                                            <a
                                                                href="{{ route('Admin.Pos.Pos_pending_delete', $pos_view->id) }}">
                                                                <button class="btn btn-danger btn-sm">Remove</button></a>
                                                        </div>
                                                    </form>
                                                @else
                                                @endif
                                                @if (auth()->user()->userHasRole('Cashier'))
                                                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal"
                                                        data-target="#exampleModalScrollable btn-sm">Delete
                                                    </button>
                                                    </form>
                                                @else
                                                @endif
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
        </div>
        </div>
        @if (auth()->user()->userHasRole('Cashier'))
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
                            <h6>Please contact admin to delete and add iteam back to store</h6>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
</x-admin-master>
