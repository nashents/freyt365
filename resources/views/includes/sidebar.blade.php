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
            
            @if (Auth::user()->is_admin())
            <li class="side-nav-item">
                <a href="{{ route('companies.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Companies </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#master1" aria-expanded="false" aria-controls="master1" class="side-nav-link">
                    <i class="bi bi-gear-fill"></i>
                    <span> Master </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="master1">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('currencies.index') }}">Currencies</a>
                        </li>
                        <li>
                            <a href="{{ route('services.index') }}">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('charges.index') }}">Transaction Charges</a>
                        </li>
                       
                    </ul>
                </div>
            </li>
            @endif

           
           
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarExtendedUI" aria-expanded="false" aria-controls="sidebarExtendedUI" class="side-nav-link">
                    <i class="bi bi-wallet-fill"></i>
                    <span> Cost Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarExtendedUI">
                    <ul class="side-nav-second-level">
                        @if (!Auth::user()->is_admin())
                        <li>
                            <a href="{{route('bank_accounts.index')}}">Bank Accounts</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('wallets.index') }}">Wallets</a>
                        </li>
                        @php
                        $transactionsAuthPendingCount = App\Models\Transaction::where('authorization','pending')
                        ->where('company_id',Auth::user()->company_id)
                        ->where('created_at', '>', \Carbon\Carbon::now()->startOfWeek())
                        ->where('created_at', '<', \Carbon\Carbon::now()->endOfWeek())->get()->count();
                        $transactionsAuthApprovedCount = App\Models\Transaction::where('authorization','approved')
                        ->where('company_id',Auth::user()->company_id)
                        ->where('created_at', '>', \Carbon\Carbon::now()->startOfWeek())
                        ->where('created_at', '<', \Carbon\Carbon::now()->endOfWeek())->get()->count();
                        $transactionsAuthRejectedCount = App\Models\Transaction::where('authorization','rejected')
                        ->where('company_id',Auth::user()->company_id)
                        ->where('created_at', '>', \Carbon\Carbon::now()->startOfWeek())
                        ->where('created_at', '<', \Carbon\Carbon::now()->endOfWeek())->get()->count();
                        @endphp
                        <li>
                            <a href="{{ route('transactions.index') }}">Manage Transactions</a>
                        </li>
                        @if (!Auth::user()->is_admin())
                        <li>
                            <a href="{{ route('transactions.pending') }}">
                                @if ($transactionsAuthPendingCount>0)
                                <span class="badge bg-success float-end">{{$transactionsAuthPendingCount}}</span>
                                @endif
                                <span>Pending Transactions</span>
                            </a>
                           
                        </li>
                        <li>
                            <a href="{{ route('transactions.approved') }}">
                                @if ($transactionsAuthApprovedCount>0)
                                <span class="badge bg-success float-end">{{$transactionsAuthApprovedCount}}</span>
                                @endif
                              
                                <span>Approved Transactions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.rejected') }}">
                                @if ($transactionsAuthRejectedCount>0)
                                <span class="badge bg-success float-end">{{$transactionsAuthRejectedCount}}</span>
                                @endif
                                <span>Rejected Transactions</span>
                            </a>
                        </li>
                        @endif
                       
                    </ul>
                </div>
            </li>
            @if (Auth::user()->is_admin())
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span> Users </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="users">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('users.admins') }}">Admins</a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">All Users</a>
                        </li> 
                    </ul>
                </div>
            </li>
            @else
            <li class="side-nav-item">
                <a href="{{ route('users.index') }}" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span>Users </span>
                </a>
            </li>
            @endif
           

          
         
            @if (!Auth::user()->is_admin())
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
            @endif
    
            {{-- <li class="side-nav-item">
                <a href="{{ route('clearing_agents.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span> Clearing Agents </span>
                </a>
            </li> --}}
            {{-- <li class="side-nav-item">
                <a href="{{route('customers.index')}}" class="side-nav-link">
                    <i class="bi bi-people"></i>
                    <span> Customers </span>
                </a>
            </li> --}}
            <li class="side-nav-item">
                <a href="{{ route('fuel_stations.index') }}" class="side-nav-link">
                    <i class="bi bi-fuel-pump-fill"></i>
                    <span> Fuel Stations </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('service_providers.index') }}" class="side-nav-link">
                    <i class="bi bi-building-fill-add"></i>
                    <span> Service Providers </span>
                </a>
            </li>
          
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders" class="side-nav-link">
                    <i class="bi bi-list-ol"></i>
                    <span> Orders </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="orders">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('orders.index')}}">Manage Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#trips" aria-expanded="false" aria-controls="trips" class="side-nav-link">
                    <i class="bi bi-map-fill"></i>
                    <span> Trips </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="trips">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('trips.index')}}">Manage Trips</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="side-nav-item">
                <a href="{{route('invoices.index')}}" class="side-nav-link">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span> Invoices </span>
                </a>
            </li> --}}

       
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports" class="side-nav-link">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="reports">
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
                        {{-- <li>
                            <a href="#">Tax Invoice Report</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
          
            <li class="side-nav-item">
                <a href="{{route('company-profile',Auth::user()->company->id)}}" class="side-nav-link">
                    <i class="bi bi-person-gear"></i>
                    <span> Company Profile </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('profile',Auth::user()->id)}}" class="side-nav-link">
                    <i class="bi bi-person-gear"></i>
                    <span> My Account </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{route('logout')}}" class="side-nav-link">
                    <i class="bi bi-box-arrow-right" style="color: red"></i>
                    <span> Log Out </span>
                </a>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>