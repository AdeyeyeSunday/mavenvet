<x-admin-master>
    @section('content')
        <div class="row">

            <div class="col-lg-4">
                <form method="post" action="{{ route('Admin.User.register_store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control" id="" required>

                        <label class="form-label">Resumption time</label>
                        <input type="time" name="time" name="resumption_time" class="form-control" id="" required>
                        <div class="clearfix"></div>

                        <label class="form-label">Late arrival charge </label>
                        <input type="number" name="late_charge" class="form-control" id="" required>
                        <div class="clearfix"></div>

                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="" required>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <label class="form-label">Confirm Password</label>
                        <input type="password_confirmation" name="password_confirmation" class="form-control"
                            id="password_confirmation">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    <button type="submit" class="btn sidebar-bottom-btn  btn-lg btn-block">Submit</button>
                </form>
            </div>


            <div class="col-lg-2">
                <form action="{{ route('Admin.User.bank_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">Bank Name</label>
                    <select name="name" id="" required class="form-control">
                        <option value="">~~Select Bank ~~</option>
                        <option value="Access Bank">Access Bank</option>
                        <option value="Fidelity Bank">Fidelity Bank</option>
                        <option value="FCMB">FCMB</option>
                        <option value="First Bank">First Bank</option>
                        <option value="GTB">GTB</option>
                        <option value="Union Bank">Union Bank</option>
                        <option value="UBA">UBA</option>
                        <option value="Zenith Bank">Zenith Bank</option>
                        <option value="Citibank Bank">Citibank</option>
                        <option value="Ecobank"> Ecobank Nigeria</option>
                        <option value="Heritage Bank">Heritage Bank</option>
                        <option value="Keystone Bank">Keystone Bank</option>
                        <option value="Optimus Bank">Optimus Bank</option>
                        <option value="Polaris Bank"> Polaris Bank</option>
                        <option value="Stanbic">Stanbic</option>
                        <option value="Standard Chartered">Standard Chartered</option>
                        <option value="Titan Trust ">Titan Trust bank</option>
                        <option value="Unity Bank Plc">Unity Bank Plc</option>
                        <option value="Wema Bank Plc">Wema Bank Plc</option>
                        <option value="Globus Bank">Globus Bank Limited</option>
                        <option value="Parallex Bank">Parallex Bank Limited</option>
                        <option value="PremiumTrust Bank">PremiumTrust Bank Limited</option>
                        <option value="Providus Bank Limited">Providus Bank Limited</option>
                        <option value="SunTrust Bank">SunTrust Bank Nigeria Limited</option>
                        <option value="Jaiz Bank">Jaiz Bank Plc</option>
                        <option value="LOTUS BANK">LOTUS BANK</option>
                        <option value="TAJBank Limited">TAJBank Limited</option>
                        <option value="Mutual Trust Microfinance Bank">Mutual Trust Microfinance Bank</option>
                        <option value="Rephidim Microfinance Bank">Rephidim Microfinance Bank</option>
                        <option value="Shepherd Trust Microfinance Bank">Shepherd Trust Microfinance Bank</option>
                        <option value="Empire Trust Microfinance Bank">Empire Trust Microfinance Bank</option>
                        <option value="Finca Microfinance Bank Limited">Finca Microfinance Bank Limited</option>
                        <option value="Fina Trust Microfinance Bank">Fina Trust Microfinance Bank</option>
                        <option value="Accion Microfinance Bank">Accion Microfinance Bank</option>
                        <option value="Peace Microfinance Bank">Peace Microfinance Bank</option>
                        <option value="Infinity Microfinance Bank">Infinity Microfinance Bank</option>
                        <option value="Covenant Microfinance Bank Ltd">Covenant Microfinance Bank Ltd</option>
                        <option value="Advans La Fayette Microfinance Bank">Advans La Fayette Microfinance Bank</option>
                        <option value="Sparkle Bank">Sparkle Bank</option>
                        <option value="Kuda Bank">Kuda Bank</option>
                        <option value="Moniepoint">Moniepoint</option>
                        <option value="Opay">Opay</option>
                        <option value="Palmpay">Palmpay</option>
                        <option value="Rubies Bank">Rubies Bank</option>
                        <option value="VFD Microfinance Bank">VFD Microfinance Bank</option>
                        <option value="Mint Finex MFB">Mint Finex MFB</option>
                        <option value="Mkobo MFB">Mkobo MFB</option>
                        <option value="Raven bank">Raven bank</option>
                    </select>
                    <label for="">Account Number</label>
                    <input type="number" placeholder="Enter account number" name="accountNumber" class="form-control"
                        required>
                    <br>
                    <button type="submit" class="btn sidebar-bottom-btn  btn-lg btn-block">Submit</button>
                </form>
            </div>


            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Bank Table</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped">
                            <thead>
                                <tr class="ligth">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Account Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banklist as $key => $bank)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $bank->name }}</td>
                                        <td>{{ $bank->accountNumber }}</td>
                                        <td>
                                            <a href="{{ route('Admin.User.delete', $bank->id) }}"><button
                                                    class="btn btn-danger btn-sm btn-block">Delete</button></a>
                                        </td>

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

        <br> <br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h6 class="card-title">User Table</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Last Update</th>
                                            <th>Role</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user_list as $user_list)
                                            <tr>
                                                <td>{{ $user_list->id }}</td>
                                                <td>{{ $user_list->name }}</td>
                                                <td>{{ $user_list->email }}</td>
                                                <td>{{ $user_list->created_at->diffForHumans() }}</td>
                                                <td>Last {{ $user_list->updated_at->diffForHumans() }}</td>
                                                <th>
                                                    <a href="{{ route('Admin.User.role_edit', $user_list->id) }}"><button
                                                            class="btn btn-primary btn-sm">Role</button></a>
                                                </th>

                                                <td>
                                                    <a href="{{ route('Admin.User.register_edit', $user_list->id) }}"><button
                                                            class="btn btn-warning btn-sm">Edit</button></a>
                                                </td>
                                                <td>

                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </td>

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
