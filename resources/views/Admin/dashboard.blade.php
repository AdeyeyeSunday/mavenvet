<x-admin-master>
    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-transparent card-block card-stretch card-height border-none">
                        <div class="card-body p-0 mt-lg-2 mt-0">
                            <h3 class="mb-3">Hi {{ auth()->user()->name }}</h3>
                            <p class="mb-0 mr-4">Your dashboard gives you views of key performance .</p>


                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-info-light">
                                            <img src="{{ asset('assets/images/product/1.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">
                                                @if (auth()->user()->userHasRole('Admin'))
                                                    <h6 style="color: green">Daily Sales Profit :
                                                        {{ number_format($profitmonthly - $profitmonthly2, 2) }}
                                                        {{-- {{ number_format( $profitmonthly - $profitmonthly2, 2, '.', ',') }} --}}
                                                    </h6>
                                                @endif
                                        </div>
                                    </div>

                                    {{-- {{  }} --}}
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-info iq-progress progress-1" data-percent="85">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-info-light">
                                            <img src="{{ asset('assets/images/product/1.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">
                                                Clinic Service Monthly </p>
                                            <h6>₦ {{ number_format($service_amount, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-info iq-progress progress-1" data-percent="85">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-danger-light">
                                            <img src="{{ asset('assets/images/product/2.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>

                                            <p class="mb-2">Total daily Cash</p>
                                            ₦ {{ number_format($items_pay + $new_cash, 2) }}



                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-danger iq-progress progress-1" data-percent="70">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-success-light">
                                            <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Total daily Pos</p>
                                            ₦ {{ number_format($items_pos + $new_pos, 2) }}

                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1" data-percent="75">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-success-light">
                                            <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Monthly Clinic Expenditure</p>
                                            ₦ {{ number_format($clinicExpenditure, 2) }}
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1" data-percent="75">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-success-light">
                                            <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                                alt="image">
                                        </div>
                                        <div>
                                            <p class="mb-2">Total daily Transfer</p>
                                            ₦ {{ number_format($items_transfer + $new_transfer, 2) }}
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1" data-percent="75">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <br>
                    <div class="card card-block card-stretch card-height-helf">
                        <div class="header-title">
                            <br>
                        <center>    <h5 class="card-title mb-0">Today Attendance</h5></center>
                        </div>
                        <div class="card-body card-item-right">
                            <div class="d-flex align-items-top">
                                <table class="table">
                                    <thead>
                                        <tr class="ligth">

                                            <th scope="col">Name</th>
                                            <th scope="col">Clockin</th>
                                            <th scope="col">ClockOut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $attendance)
                                            <tr>
                                                <td>{{ $attendance->staff_name }}</td>
                                                <td>{{ $attendance->Time }}</td>
                                                <td>{{ $attendance->Timeout }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>



                @if (auth()->user()->userHasRole('Admin'))
                    <div class="col-lg-4">

                        <p>You can get summary of all profit from here</p>

                        <form action="{{ route('Admin.store_profit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>Enter Year</label>
                            <input type="number" name="year" class="form-control" id="">

                            <label for="">Select</label>
                            <select class="form-control" name="month" required>
                                <option disabled selected></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July </option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November </option>
                                <option value="December">December</option>
                            </select>

                            <label for="">Select Profit Type</label>
                            <input type="text" readonly class="form-control" name="type" value="Sales"
                                id="">

                            <label for="">Optional Type</label>
                            <select class="form-control" name="optional">
                                <option value="" disabled selected></option>
                                <option>Expense</option>
                            </select>
                            <br>
                          <center>  <button class="btn btn-dark btn-block btn-lg" type="submit">Process</button></center>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <p>Last check breakdown</p>
                        <h6>Month: {{ $profit->month ?? '' }}</h6>
                        <br>
                        <h6>Year: {{ $profit->year ?? '' }}</h6>
                        <br>
                        <h6>Total Sales: {{ number_format($profit->totalCost, 2) }}</h6>
                        <br>

                        <h6>Total Cost: {{ number_format($profit->totalSales, 2) }}</h6>
                        <br>

                        <h6>Total Expense: {{ number_format($profit->totalExpense, 2) }}</h6>
                        <br>


                        <h4>Total Profit: {{ number_format($profit->Profit, 2) }}</h4>
                    </div>


                    <div class="col-lg-4">
                        <center>    <p>You can get summary of service and expenes for each month</p> </center>
                        <form action="{{ route('Admin.dashboard') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="">Select</label>
                            <select class="form-control" name="month" required>
                                <option disabled selected></option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July </option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November </option>
                                <option value="December">December</option>
                            </select>

                            <label for="">Category</label>

                            <select class="form-control" name="category" required>
                                <option disabled selected></option>
                                <option value="service">Service</option>
                                <option value="expense">Expenses</option>
                            </select>

                            <label>Enter Year</label>
                            <input type="number" name="year" class="form-control" id="">
                            <br>
                            <center> <h5>{{ $tittle }}  {{  number_format($serviceMonly, 2)  }}</h5></center>
                            <br>
                           <center> <button class="btn btn-dark btn-block btn-lg" type="submit">Process</button></center>

                        </form>
                        <br>
                    </div>
                    <br>

                @endif

                {{-- <label for="" name="larble" >{{ $lable }}</label> --}}

            </div>
        </div>
        </div>
        </div>
    @endsection
</x-admin-master>
