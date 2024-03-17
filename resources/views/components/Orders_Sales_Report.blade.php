
<div class="container">
    {{-- <hSales Report</h2> --}}
        <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
        </svg>
    <a style="margin-left: 20px" href="#demo" class="btn btn-info" data-toggle="collapse">Sales Report</a>


    <div id="demo" class="collapse">
        <li class="">
            <a href="{{route('Admin.Pos.Pos_pending')}}">
                <i class="las la-minus"></i><span class="">Pending Orders</span>
            </a>
        </li>
        <li class="">
            <a href="{{route('Admin.Pos.daily_sales_report')}}" class="svg-icon">
               <i class="las la-minus"></i><span class="">Daily sales report</span>
            </a>
        </li>




        {{-- working here  --}}
        <li class="">
            <a href="{{ route('Admin.Pos.today_items_cashier') }}">
                <i class="las la-minus"></i><span> Goods Sold Daily</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Pos.due')}}" class="svg-icon">
               <i class="las la-minus"></i><span class="">Debt For Goods</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Payment.cash_report')}}">
                <i class="las la-minus"></i><span>Cash Back</span>
            </a>
        </li>


        <li class="">
            <a href="{{route('Admin.Expense.Monthly')}}">
                <i class="las la-minus"></i><span>Expense</span>
            </a>
        </li>




        <li class="">
            <a href="{{route('Admin.Payment.bank_deposit')}}">
                <i class="las la-minus"></i><span>Bank Deposit</span>
            </a>
        </li>


    </div>
  </div>
