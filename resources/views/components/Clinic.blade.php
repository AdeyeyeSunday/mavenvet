<li class=" ">
    <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
        <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <polyline points="4 14 10 14 10 20"></polyline>
            <polyline points="20 10 14 10 14 4"></polyline>
            <line x1="14" y1="10" x2="21" y2="3"></line>
            <line x1="3" y1="21" x2="10" y2="14"></line>
        </svg>
        <span class="ml-4">Clinic</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline>
            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>
    <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

        <div class="container">

            <button style="margin-left: 20px;" type="button" class="btn  sidebar-bottom-btn  btn-lg btn-block"
                data-toggle="collapse" data-target="#demo1">Open special order</button>

            <div id="demo1" class="collapse">
                <li class="">
                    <a href="{{ route('Admin.Clinic.Clinic_sale') }}">
                        <i class="las la-minus"></i><span>Vaccine Pos</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('Admin.Clinic.cart_pending') }}">
                        <i class="las la-minus"></i><span>Pending order</span>
                    </a>
                </li>


                <li class="">
                    <a href="{{ route('Admin.Clinic.Clinic_list_vaccine') }}">
                        <i class="las la-minus"></i><span>Vaccine stock</span>
                    </a>
                </li>




                <li class="">
                    <a href="{{ route('Admin.Clinic.Vaccine_subtact') }}">
                        <i class="las la-minus"></i><span>Subtract history</span>
                    </a>
                </li>

                @if (auth()->user()->userHasRole('Admin'))
                    <li class="">
                        <a href="{{ route('Admin.Clinic.brand') }}">
                            <i class="las la-minus"></i><span>Add Brand</span>
                        </a>
                    </li>



                    <li class="">
                        <a href="{{ route('Admin.Clinic.Clinic_supplier') }}">
                            <i class="las la-minus"></i><span>Add Supplier</span>
                        </a>
                    </li>
                @endif

            </div>
        </div>


        <li class="">
            <a href="{{ route('Admin.Payment.Payment') }}">
                <i class="las la-minus"></i><span> Service Payment</span>
            </a>
        </li>

        <li class="">
            <a href="{{ route('Admin.Payment.paynent_pending') }}">
                <i class="las la-minus"></i><span>Service Pending Order </span>
            </a>
        </li>


        <li class="">
            <a href="{{ route('Admin.Payment.Payment_list') }}">
                <i class="las la-minus"></i><span>Daily Payment List</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('Admin.Clinic.Clinic_list') }}">
                <i class="las la-minus"></i><span> Registration List</span>
            </a>
        </li>



        {{-- <li class="">
            <a href="{{route('Admin.Treatment.treatment_list')}}">
                <i class="las la-minus"></i><span> Vaccination Record</span>
            </a>
    </li> --}}

        <li class="">
            <a href="{{ route('Admin.Casenote.Casenote') }}">
                <i class="las la-minus"></i><span>Medical Case Note</span>
            </a>
        </li>

        <li class="">
            <a href="{{ route('Admin.Casenote.Casenote_list') }}">
                <i class="las la-minus"></i><span> Medical History</span>
            </a>
        </li>




        <li class="">
            <a href="{{ route('Admin.admission.admission') }}">
                <i class="las la-minus"></i><span>Admission</span>
            </a>
        </li>





        <li class="">
            <a href="{{ route('Admin.Clinic.expenditure') }}">
                <i class="las la-minus"></i><span>Clinic Expenditure</span>
            </a>
        </li>

    </ul>
</li>
