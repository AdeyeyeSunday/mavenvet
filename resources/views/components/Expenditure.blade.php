
    <li class=" ">
    <a href="#table" class="collapsed" data-toggle="collapse" aria-expanded="false">
        <svg class="svg-icon" id="p-dash14" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
        </svg>
        <span class="ml-4">Expenditure</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="table" class="iq-submenu collapse" data-parent="#otherpage">
            {{-- <li class="">
                <a href="{{route('Admin.Expense.Expense')}}">
                    <i class="las la-minus"></i><span>Make Expense</span>
                </a>
            </li> --}}
            <li class="">
                <a href="{{route('Admin.Expense.Monthly')}}">
                    <i class="las la-minus"></i><span>Monthly Expense</span>
                </a>
            </li>
    </ul>
</li>


