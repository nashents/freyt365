<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Freyt365</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Welcome!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div>
                @include('includes.messages')
           </div>

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-purple">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-wallet-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Wallet ({{Auth::user()->company->wallet->currency->name}})</h6>
                        <h2 class="my-2">{{Auth::user()->company->wallet->currency->symbol}}{{number_format(Auth::user()->company->wallet->balance,2)}}</h2>
                        <p class="mb-0">
                            {{-- <span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                            <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-eye-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Daily Visits</h6>
                        <h2 class="my-2">0</h2>
                        <p class="mb-0">
                            {{-- <span class="badge bg-white bg-opacity-10 me-1">2.97%</span>
                            <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

           
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-shopping-basket-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Orders</h6>
                        <h2 class="my-2">0</h2>
                        <p class="mb-0">
                            {{-- <span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                            <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-group-2-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                        <h2 class="my-2">1</h2>
                        <p class="mb-0">
                            {{-- <span class="badge bg-white bg-opacity-10 me-1">8.21%</span>
                            <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>

        {{-- <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#weeklysales-collapse" role="button" aria-expanded="false" aria-controls="weeklysales-collapse"><i class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Weekly Sales Report</h5>

                        <div id="weeklysales-collapse" class="collapse pt-3 show">
                            <div dir="ltr">
                                <div id="revenue-chart" class="apex-charts" data-colors="#3bc0c3,#1a2942,#d1d7d973"></div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <p class="text-muted mt-3">Current Week</p>
                                    <h3 class=" mb-0">
                                        <span>$506.54</span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Previous Week</p>
                                    <h3 class=" mb-0">
                                        <span>$305.25 </span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Conversation</p>
                                    <h3 class=" mb-0">
                                        <span>3.27%</span>
                                    </h3>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3">Customers</p>
                                    <h3 class=" mb-0">
                                        <span>3k</span>
                                    </h3>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Yearly Sales Report</h5>

                        <div id="yearly-sales-collapse" class="collapse pt-3 show">
                            <div dir="ltr">
                                <div id="yearly-sales-chart" class="apex-charts" data-colors="#3bc0c3,#1a2942,#d1d7d973"></div>
                            </div>
                            <div class="row text-center">
                                <div class="col">
                                    <p class="text-muted mt-3 mb-2">Quarter 1</p>
                                    <h4 class="mb-0">$56.2k</h4>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3 mb-2">Quarter 2</p>
                                    <h4 class="mb-0">$42.5k</h4>
                                </div>
                                <div class="col">
                                    <p class="text-muted mt-3 mb-2">All Time</p>
                                    <h4 class="mb-0">$102.03k</h4>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h4 class="fs-22 fw-semibold">69.25%</h4>
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> US Dollar Share</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div id="us-share-chart" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div> --}}
        <!-- end row -->

        <div class="row">


            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Companies</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Company#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phonenumber</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($companies))
            
                                        @forelse ($companies as $company)
                                        <tr>
                                            <td>{{$company->company_number}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{$company->phonenumber}}</td>
                                            <td>{{$company->street_address}} {{$company->suburb}} {{$company->city}} {{$company->country}}</td>
                                            <td><span class="badge bg-{{$company->status == 1 ? "primary" : "danger"}}">{{$company->status == 1 ? "Active" : "Inactive"}}</span></td>
                                            <td class="w-10 line-height-35 table-dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    </ul>
                                                </div>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Companies Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
            
                                        @else
                                        <tr>
                                            <td colspan="8">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Companies Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endif
                                      
                                
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Horses</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Registration#</th>
                                            <th>Fleet#</th>
                                            <th>Make/Model</th>
                                            <th>Color</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($horses))
            
                                        @forelse ($horses as $horse)
                                        <tr>
                                            <td>{{$horse->registration_number}}</td>
                                            <td>{{$horse->fleet_number}}</td>
                                            <td>{{$horse->make}} {{$horse->model}}</td>
                                            <td>{{$horse->color}}</td>
                                            <td><span class="badge bg-{{$horse->status == 1 ? "primary" : "danger"}}">{{$horse->status == 1 ? "Active" : "Inactive"}}</span></td>
                                            <td class="w-10 line-height-35 table-dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    </ul>
                                                </div>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Horses Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
            
                                        @else
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Horses Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endif
                                      
                                
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <div class="row">


            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Trailers</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Registration#</th>
                                            <th>Fleet#</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($trailers))
            
                                        @forelse ($trailers as $trailer)
                                        <tr>
                                            <td>{{$trailer->registration_number}}</td>
                                            <td>{{$trailer->fleet_number}}</td>
                                            <td><span class="badge bg-{{$trailer->status == 1 ? "primary" : "danger"}}">{{$trailer->status == 1 ? "Active" : "Inactive"}}</span></td>
                                            <td class="w-10 line-height-35 table-dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    </ul>
                                                </div>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Trailers Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
            
                                        @else
                                        <tr>
                                            <td colspan="4">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Trailers Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endif
                                      
                                
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Drivers</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fullname</th>
                                            <th>Passport#</th>
                                            <th>License#</th>
                                            <th>Phonenumber</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($drivers))
            
                                        @forelse ($drivers as $driver)
                                        <tr>
                                            <td>{{$driver->id}}</td>
                                            <td>{{$driver->name}} {{$driver->surname}}</td>
                                            <td>{{$driver->passport_number}}</td>
                                            <td>{{$driver->license_number}}</td>
                                            <td>{{$driver->phonenumber}}</td>
                                            <td><span class="badge bg-{{$driver->status == 1 ? "primary" : "danger"}}">{{$driver->status == 1 ? "Active" : "Inactive"}}</span></td>
                                            <td class="w-10 line-height-35 table-dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    </ul>
                                                </div>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Drivers Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
            
                                        @else
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Drivers Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endif
                                      
                                
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>

        <div class="row">


            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Trips</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Trip#</th>
                                            <th>Transporter</th>
                                            <th>Customer</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($trips))
            
                                        @forelse ($trips as $trip)
                                        <tr>
                                            <td>{{$trip->trip_number}}</td>
                                            <td>{{$trip->company ? $trip->company->name : ""}}</td>
                                            <td>{{$trip->customer ? $trip->customer->name : ""}}</td>
                                            <td>{{$trip->from}}</td>
                                            <td>{{$trip->to}}</td>
                                            <td>
                                                {{$trip->trip_status}}
                                            </td>
                                            <td class="w-10 line-height-35 table-dropdown">
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-bars"></i>
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="" class="dropdown-item"><i class="fa fa-eye color-success"></i> View</a></li>
                                                    </ul>
                                                </div>
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Trips Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
            
                                        @else
                                        <tr>
                                            <td colspan="7">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Trips Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endif
                                      
                                
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->

            <div class="col-xl-6">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Orders</h5>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">

                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order Ref</th>
                                            <th>Status</th>
                                            <th>Truck/Driver</th>
                                            <th>Order Date</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($companies as $company) --}}
                                        <tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tr>
                                        {{-- @endforeach --}}
                                       
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
</div>
