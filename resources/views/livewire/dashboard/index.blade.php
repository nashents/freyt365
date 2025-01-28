<div>
    <x-loading/>
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
        <div class="col-md-8">
            
        </div>
        <div class="col-md-4">

        </div>

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
                            <a href="{{route('wallets.index')}}">
                            <h6 class="text-uppercase mt-0" title="Customers">Default Wallet</h6>  </a>
                            <h2 class="my-2">{{$wallet->currency ? $wallet->currency->symbol : ""}} {{number_format($wallet->balance ? $wallet->balance : 0,2)}}</h2>
                            <p class="mb-0">
                                {{-- <span class="badge bg-white bg-opacity-10 me-1">18.25%</span>
                                <span class="text-nowrap">Since last month</span> --}}
                            </p>
                      
                     
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-file-list-3-fill widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Orders</h6>
                        <h2 class="my-2">{{$completed_orders_count}}</h2>
                        <p class="mb-0">
                            {{-- <span class="badge bg-white bg-opacity-25 me-1">-5.75%</span>
                            <span class="text-nowrap">Since last month</span> --}}
                        </p>
                    </div>
                </div>
            </div> <!-- end col-->

          
        </div>

        @if (Auth::user()->is_admin())
        <div class="row">
            <div class="col-xl-12">
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
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phonenumber</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($companies))
            
                                        @forelse ($companies as $company)
                                        <tr>
                                            <td>{{$company->company_number}}</td>
                                            <td>{{ucfirst($company->type)}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{$company->phonenumber}}</td>
                                            <td>{{$company->street_address}} {{$company->suburb}}{{$company->city ? ", ".$company->city : ""}} {{$company->country}}</td>
                                            <td><span class="badge bg-{{($company->authorization == 'approved') ? 'primary' : (($company->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($company->authorization == 'approved') ? 'approved' : (($company->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
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
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">All Authorized Transactions</h5>
                        </div>
    
                        <div id="yearly-sales-collapse" class="collapse show">
    
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Transaction#</th>
                                            <th>Ref#</th>
                                            <th>Date</th>
                                            <th>MOP</th>
                                            <th>Type</th>
                                            <th>Company</th>
                                            <th>CreatedBy</th>
                                            <th>Wallet</th>
                                            <th>Ccy</th>
                                            <th>Amt</th>
                                            <th>Charges</th>
                                            <th>Verified/Declined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                      
                                        <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>{{$transaction->reference_code}}</td>
                                        <td>{{$transaction->transaction_date}}</td>
                                        <td>{{$transaction->mop}}</td>
                                        <td>{{$transaction->transaction_type ? $transaction->transaction_type->name : ""}}</td>
                                        <td>{{$transaction->company ? $transaction->company->name : ""}}</td>
                                        <td>{{$transaction->user ? $transaction->user->name : ""}} {{$transaction->user ? $transaction->user->surname : ""}}</td>
                                        <td>
                                            @if ($transaction->wallet)
                                                {{$transaction->wallet ? $transaction->wallet->name : ""}} 
                                            @endif
                                        </td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                        <td>
                                            @if ($transaction->charge_amount)
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->charge_amount,2)}} @ {{$transaction->charge ? $transaction->charge."%" : ""}}
                                            @else   
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format(0,2)}}    
                                            @endif
                                        </td>
                                        <td><span class="badge bg-{{($transaction->verification == 'verified') ? 'success' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>     
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Transactions Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
                                       
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div>
  
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">All Authorized Orders</h5>
                        </div>
    
                        <div id="yearly-sales-collapse" class="collapse show">
    
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order Ref</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                            <th>Driver/Truck/Trailer</th>
                                            <th>Order Date</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                        <tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Latest Orders Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
                                       
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div>
  
        </div>
        @endif

  
        @if (!Auth::user()->is_admin())

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Latest Orders Completed</h5>
                        </div>
    
                        <div id="yearly-sales-collapse" class="collapse show">
    
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order Ref</th>
                                            <th>Status</th>
                                            <th>Driver/Truck/Trailer</th>
                                            <th>Order Date</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latest_orders as $order)
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
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Latest Completed Orders Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
                                       
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->

                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="card-widgets">
                                <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                                <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                            </div>
                            <h5 class="header-title mb-0">Orders Orders</h5>
                        </div>
    
                        <div id="yearly-sales-collapse" class="collapse show">
    
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order Ref</th>
                                            <th>Status</th>
                                            <th>Driver/Truck/Trailer</th>
                                            <th>Order Date</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($newest_orders as $order)
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
                                        @empty
                                        <tr>
                                            <td colspan="6">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Newest Orders Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                        @endforelse
                                       
                                    </tbody>
                                </table>
                            </div>        
                        </div>
                    </div>                           
                </div> <!-- end card-->
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="fs-22 fw-semibold">Balances</h4>
                        <a href="{{route('wallets.index')}}" ><i class="bi bi-wallet-fill" style="float: right;margin-top:-33px;"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @foreach (Auth::user()->company->wallets as $wallet)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$wallet->id}}">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$wallet->id}}"
                                        aria-expanded="true" aria-controls="collapse{{$wallet->id}}">
                                       <h4>{{$wallet->currency ? $wallet->currency->name : ""}} {{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->balance ? $wallet->balance : 0,2)}}</h4>
                                    </button>
                                </h2>
                                <div id="collapse{{$wallet->id}}" class="accordion-collapse collapse collapse" aria-labelledby="heading{{$wallet->id}}"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong> {{$wallet->name}} <i>{{$wallet->default == True ? "Default Wallet" : ""}}</i></strong>
                                        <p>Available <span class="float:right">{{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->balance ? $wallet->balance : 0,2)}}</span></p>
                                        <p style="margin-top: -15px;">Reserved <span class="float:right">{{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->reserved ? $wallet->reserved : 0,2)}}</span></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           
                           
                          
                        </div>
                    </div><!-- end card body -->
                </div> <!-- end card-->
                {{-- <div class="card">
                    <div class="card-header">
                        <h4 class="fs-22 fw-semibold">Toll Balances</h4>
                    </div>
                    <div class="card-body">
                       <p>Company not registered on road toll system yet. Please complete a Zimbabwean inland road toll order first</p>
                    </div><!-- end card body -->
                </div> <!-- end card--> --}}
            </div> <!-- end col-->
  
        </div>

      
        @endif


        <!-- end row -->

    </div>
</div>
