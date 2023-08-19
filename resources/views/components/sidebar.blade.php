<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                {{-- <div class="nav-item theme-logo">
                    <a href="#">
                        <img src="../src/assets/img/logo.svg" class="navbar-logo" alt="logo">
                    </a>
                </div> --}}
                <div class="nav-item theme-text">
                    <a href="/" class="nav-link"> QONDOS </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <span>لوحة التحكم</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="dashboard" data-bs-parent="#accordionExample">
                    <li>
                        <a href="{{ route('clients.index') }}"> العملاء </a>
                    </li>
                    <li>
                        <a href="{{ route('maintenance-technicians.index') }}"> فنيو الصيانة </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}"> التصنيفات الرئيسية </a>
                    </li>
                    <li>
                        <a href="{{ route('sub-categories.index') }}"> التصنيفات الفرعية </a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}"> الخدمات </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}"> الطلبات </a>
                    </li>
                    <li>
                        <a href="#"> طلبات فنيو الصيانة </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
