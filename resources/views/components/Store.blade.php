<li class=" ">
    <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
        <svg class="svg-icon" id="p-dash4" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>
        </svg>
        <span class="ml-4">Store</span>
        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
        </svg>
    </a>


    <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


        <li class="">
            <a href="{{route('Admin.Category.list_Category')}}">
                <i class="las la-minus"></i><span> Category List</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Product.Product_list')}}">
                <i class="las la-minus"></i><span> Product List</span>
            </a>
        </li>


        <li class="">
            <a href="{{route('Admin.Supplier.list_Supplier')}}">
                <i class="las la-minus"></i><span class="">Suppliers List</span>
            </a>
        </li>


        <li class="">
            <a href="{{route('Admin.Product.Product_subtact')}}">
                <i class="las la-minus"></i><span>Subtract Product  History</span>
            </a>
        </li>


            {{-- <li class=" ">
                <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                   <svg class="svg-icon" id="p-dash11" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    </svg>
                    <span class="ml-4">Categories</span>
                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                    </svg>
                </a>
                <ul id="ui" class="iq-submenu collapse" data-parent="#otherpage">
                        <li class="">
                            <a href="{{route('Admin.Category.list_Category')}}">
                                <i class="las la-minus"></i><span>List Category</span>
                            </a>
                        </li>
                        {{-- <li class="">
                            <a href="{{route('Admin.Category.add_Category')}}">
                                <i class="las la-minus"></i><span>Add Category</span>
                            </a>
                        </li> --}}
                {{-- </ul>
            </li>  --}}

            {{-- <li class=" ">
                <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                    <svg class="svg-icon" id="p-dash12" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span class="ml-4">Products</span>
                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                    </svg>
                </a>
                <ul id="auth" class="iq-submenu collapse" data-parent="#otherpage">
                        <li class="">
                            <a href="{{route('Admin.Product.Product_list')}}">
                                <i class="las la-minus"></i><span>List Product</span>
                            </a>
                        </li> --}}
                        {{-- <li class="">
                            <a href="{{route('Admin.Product.add_product')}}">
                                <i class="las la-minus"></i><span>Add Product</span>
                            </a>
                        </li> --}}
                {{-- </ul>
            </li> --}}

            {{-- <li class="">
                <a href="#form" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                    <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>
                    <span class="ml-4">Suppliers</span>
                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                    </svg>
                </a>
                <ul id="form" class="iq-submenu collapse" data-parent="#otherpage">
                    <li class="">
                        <a href="{{route('Admin.Supplier.list_Supplier')}}">
                            <i class="las la-minus"></i><span class="">Suppliers List</span>
                        </a>
                    </li> --}}
                    {{-- <li class="">
                        <a href="{{route('Admin.Supplier.add_Supplier')}}" class="svg-icon">
                           <i class="las la-minus"></i><span class="">Add Suppliers </span>
                        </a>
                    </li> --}}
                {{-- </ul>
            </li> --}}


            </li>
    </ul>
</li>
