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
                <i class="las la-minus"></i><span> Category list</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Product.Product_list')}}">
                <i class="las la-minus"></i><span> Product list</span>
            </a>
        </li>


        <li class="">
            <a href="{{route('Admin.Supplier.list_Supplier')}}">
                <i class="las la-minus"></i><span class="">Suppliers list</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Store.service')}}">
                <i class="las la-minus"></i><span class="">Service list</span>
            </a>
        </li>

        <li class="">
            <a href="{{route('Admin.Product.Product_subtact')}}">
                <i class="las la-minus"></i><span>Subtract product history</span>
            </a>
        </li>
            </li>
    </ul>
</li>
