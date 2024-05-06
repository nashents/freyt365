<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{route('dashboard')}}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset('images/logo.png')}}" alt="logo" style="width: 75%; height:75%">
        </span>
        <span class="logo-sm">
            <img src="{{asset('images/logo.png')}}" alt="small logo" style="width: 75%; height:75%">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{route('dashboard')}}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{asset('images/logo.png')}}" alt="dark logo" style="width: 75%; height:75%">
        </span>
        <span class="logo-sm">
            <img src="{{asset('images/logo.png')}}" alt="small logo" style="width: 75%; height:75%">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('companies.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Companies </span>
                </a>
            </li>
           
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="bi bi-wallet-fill"></i>
                    <span> Wallet </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('transactions.index') }}">Transactions</a>
                        </li>
                        <li>
                            <a href="{{route('bank_accounts.index')}}">Bank Accounts</a>
                        </li>
                    </ul>
                </div>
            </li>

          

            <li class="side-nav-item">
                <a href="{{ route('users.index') }}" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span> Users </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('horses.index') }}" class="side-nav-link">
                    <i class="bi bi-truck-front-fill"></i>
                    <span> Horses </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('trailers.index') }}" class="side-nav-link">
                    <i class="bi bi-list-ul"></i>
                    <span> Trailers </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('drivers.index') }}" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span> Driver </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('clearing_agents.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span> Clearing Agents </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('vendors.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span> Vendors </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="bi bi-map-fill"></i>
                    <span> Trips </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">My Trips</a>
                        </li>
                        <li>
                            <a href="#">My Trip Templates</a>
                        </li>
                        <li>
                            <a href="#">Standard Trip Template</a>
                        </li>
                        <li>
                            <a href="#">UnAuthorized Trips</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="bi bi-list-ol"></i>
                    <span> Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Manage Orders</a>
                        </li>
                        <li>
                            <a href="#">UnAuthorized Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Account Statement</a>
                        </li>
                        <li>
                            <a href="#">Deposits</a>
                        </li>
                        <li>
                            <a href="#">Extended Order History</a>
                        </li>
                        <li>
                            <a href="#">Tax Invoice Report</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span> Customers </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span> Quotations </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span> Invoices </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-files"></i>
                    <span> Documents </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-person-gear"></i>
                    <span> My Account </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" class="side-nav-link">
                    <i class="bi bi-box-arrow-right" style="color: red"></i>
                    <span> Log Out </span>
                </a>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>