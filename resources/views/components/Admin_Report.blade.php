<li class=" ">
    <a href="#pricing" class="collapsed" data-toggle="collapse" aria-expanded="false">
        <svg class="svg-icon" id="p-dash16" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
        </svg>
        <span class="ml-4">Admin/Report</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline>
            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="pricing" class="iq-submenu collapse" data-parent="#otherpage">
        <li class=" ">
            <a href="#pages-error" class="collapsed" data-toggle="collapse" aria-expanded="false">
                <svg class="svg-icon" id="p-dash17" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                    </path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="ml-4">Store Report</span>
                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="10 15 15 20 20 15"></polyline>
                    <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                </svg>
            </a>



          <ul id="pages-error" class="iq-submenu collapse" data-parent="#otherpage">



            @if (auth()->user()->userHasRole('Manager'))
                <li class="">
                    <a href="{{ route('Admin.Pos.sales_history') }}">
                        <i class="las la-minus"></i><span>Sales History</span>
                    </a>
                </li>
            @else
                <li class="">
                    <a href="{{ route('Admin.Pos.sales_history') }}">
                        <i class="las la-minus"></i><span>Sales History</span>
                    </a>
                </li>
            @endif


            @if (auth()->user()->userHasRole('Manager'))
            @else
                <li class="">
                    <a href="{{ route('Admin.Pos.store_due') }}">
                        <i class="las la-minus"></i><span> Debt For Goods</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('Admin.Pos.today_items') }}">
                        <i class="las la-minus"></i><span> Goods Sold Daily</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('Admin.Product.new_supply') }}">
                        <i class="las la-minus"></i><span>Product Supply Record </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('Admin.Clinic.newsupply') }}">
                        <i class="las la-minus"></i><span>Vaccine Supply Record </span>
                    </a>
                </li>


                <li class="">
                    <a href="{{ route('Admin.Attendance.attendance_list') }}">
                        <i class="las la-minus"></i><span>Attendance Record </span>
                    </a>
                </li>
            @endif


            <li class="">
                <a href="{{ route('Admin.Store.store') }}">
                    <i class="las la-minus"></i><span>Goods Transfer</span>
                </a>
            </li>



            <li class="">
                <a href="{{ route('Admin.Store.store_view') }}">
                    <i class="las la-minus"></i><span>Store History</span>
                </a>
            </li>

            @if (auth()->user()->userHasRole('Manager'))
            @else
                <li class="">
                    <a href="{{ route('Admin.Payment.bank_deposit') }}">
                        <i class="las la-minus"></i><span>Bank Deposit</span>
                    </a>
                </li>
            @endif

            <li class="">
                <a href="{{ route('Admin.Store.transfer_details') }}">
                    <i class="las la-minus"></i><span>Transfer Details</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('Admin.Store.store_view_details') }}">
                    <i class="las la-minus"></i><span>Transfer History</span>
                </a>
            </li>
        </ul>
</li>


@if (auth()->user()->userHasRole('Manager'))
    <li class="">
        <a href="{{ route('Admin.Payment.Account_cash') }}">
            <i class="las la-minus"></i><span> Payment For Services </span>
        </a>
    </li>
@else
    <li class=" ">
        <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
            <svg class="svg-icon" id="p-dash11" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                </path>
            </svg>
            <span class="ml-4">Employee/Service</span>
            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="10 15 15 20 20 15"></polyline>
                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
            </svg>
        </a>
        <ul id="ui" class="iq-submenu collapse" data-parent="#otherpage">

            <li class="">
                <a href="{{ route('Admin.Payment.Account_cash') }}">
                    <i class="las la-minus"></i><span> Payment For Services </span>
                </a>
            </li>



            <li class="">
                <a href="{{ route('Admin.Employee.Employee') }}">
                    <i class="las la-minus"></i><span>Add Employee</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('Admin.Store.vaccine_due') }}">
                    <i class="las la-minus"></i><span> Debt For Vaccine</span>
                </a>
            </li>



            <li class="">
                <a href="{{ route('Admin.Store.service_due') }}">
                    <i class="las la-minus"></i><span> Debt For Service</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('Admin.Store.service') }}">
                    <i class="las la-minus"></i><span>Add Service </span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('Admin.Employee.leave_list') }}">
                    <i class="las la-minus"></i><span>Leave Approval</span>
                </a>
            </li>


            <li class="">

                <a href="{{ route('Admin.Employee.salary_add') }}">
                    <i class="las la-minus"></i><span>Generate Salary</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('Admin.Attendance.attendance_list') }}">
                    <i class="las la-minus"></i><span>Attendance Record </span>
                </a>
            </li>
            <li class="">

                <a href="{{ route('Admin.Employee.salary_add') }}">
                    <i class="las la-minus"></i><span>Generate Salary</span>
                </a>
            </li>


            <li class="">
                <a href="{{ route('Admin.Payment.doctor_report') }}">
                    <i class="las la-minus"></i><span>Doctors Report</span>
                </a>
            </li>

        </ul>
    </li>
@endif


</ul>
</li>
