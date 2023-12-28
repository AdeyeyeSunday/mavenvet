
                    <li class=" ">
                        <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                            <span class="ml-4">Employee</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class="">
                                        <a href="{{route('Admin.Employee.Employee_list')}}">
                                            <i class="las la-minus"></i><span> Employee Details</span>
                                        </a>
                                </li>


                                <li class="">
                                    <a href="{{route('Admin.Employee.leave')}}">
                                        <i class="las la-minus"></i><span>Leave</span>
                                    </a>
                            </li>
                        </ul>
                    </li>
