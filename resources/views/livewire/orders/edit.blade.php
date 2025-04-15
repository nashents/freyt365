<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="update()">
                <div class="card-header">
                    <h4 class="header-title">EDIT A ONCE-OFF ORDER</h4>
                    <p class="text-muted mb-0">If you would like to place an order at only one of our collection offices, select the country and collection office below.</p>
                </div>
                <div class="card-body">
                  
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Horses(Optional)</p>
                            <p class="text-muted fs-14">
                                Selecting a truck is only optional when you are not placing an order with an insurance company, Whiskey Parking or Peage. If you intend to place an order with an insurance company you have to select a truck and at least one trailer registration number should be specified.
                            </p>

                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="selectedHorse">
                                <option>Select Horse</option>
                                @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}">{{$horse->registration_number}} ({{$horse->fleet_number}})</option>
                                @endforeach
                            </select>
                            @error('selectedHorse') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Trailers(Optional)</p>
                            <p class="text-muted fs-14">
                                If you intend to place an order with an insurance company you have to enter the at least one trailer registration number
                            </p>

                            <select class="select2 form-control select2-multiple" wire:model.live.debounce.300ms="trailer_id" data-toggle="select2"
                                multiple="multiple" data-placeholder="Choose ...">
                            <option value="">Multi Select Trailer(s)</option>
                                @foreach ($trailers as $trailer)
                                    <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                                @endforeach
                            </select>
                            @error('trailer_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="mb-1 fw-bold text-muted">Drivers<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="selectedDriver" required>
                                <option>Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                @endforeach
                            </select>
                            @error('selectedDriver') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->
                        <div class="col-lg-4">
                            <p class="mb-1 fw-bold text-muted">Select the account you want to pay with?<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="selectedWallet" required>
                                <option>Select Wallet</option>
                                @foreach ($wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{$wallet->name}} {{$wallet->default == True ? "Default Wallet" : ""}} {{$wallet->currency ? $wallet->currency->name : ""}} {{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->balance ? $wallet->balance : 0,2)}} </option>
                                @endforeach
                            </select>
                            @error('selectedWallet') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->
                        <div class="col-lg-4">
                            <p class="mb-1 fw-bold text-muted">Countries<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="selectedCountry" required>
                                <option>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @error('selectedCountry') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->

                       
                    </div> <!-- end row -->
                    <br>
                    @if (!is_null($selectedCountry))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                        @foreach ($services as $service)
                                        <a href="#" wire:click.prevent="setService({{$service->id}})">
                                            <div class="card-header mb-2" style="background-color: #ECECEC">
                                               @if ($selected_country->flag)
                                               <img src="{{asset('images/flags/'.$selected_country->flag)}}" width="25px" height="20px" alt=""  style="margin-top: -1px;">
                                               @endif
                                               <span ><strong>{{strtoupper($service->name)}}</strong></span>
                                             </div>
                                        </a>
                                        @if (in_array($service->id, $opened_service_ids))
                                            @php
                                                $branches = $service->branches->where('country_id',$selectedCountry);
                                                $fuel_stations = $service->fuel_stations->where('country_id',$selectedCountry);
                                                $offices = $service->offices->where('country_id',$selectedCountry);
                                            @endphp
                                            <div class="card-body mb-2">
                                                @if ($fuel_stations->count() > 0 || $branches->count() > 0 || $offices->count() > 0)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Currencies</th>
                                                                    <th>Fuel</th>
                                                                    <th>Service</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (isset($branches))
                                                                @foreach ($branches as $branch)
                                                                <tr>
                                                                    <td>
                                                                        <strong>{{$branch->name}}</strong> <br>
                                                                        <i class="fas fa-envelope"></i> {{$branch->email}} | <i class="fas fa-phone"></i> {{$branch->phonenumber}} <br>
                                                                        <i class="fas fa-map-marker"></i> {{$branch->street_address}} {{$branch->suburb ? $branch->suburb.", " : ""}} {{$branch->city}} <br>
                                                                        <i class="fa fa-clock-o"></i>
                                                                        Office Hours:
                                                                        @if (isset($branch->working_schedule) && $branch->working_schedule->everyday == False)
                                                                        {{$branch->working_schedule ? $branch->working_schedule->first_day : ""}} - {{$branch->working_schedule ? $branch->working_schedule->last_day : ""}} {{$branch->working_schedule ? $branch->working_schedule->start_time : ""}} - {{$branch->working_schedule ? $branch->working_schedule->end_time : ""}}
                                                                        @else   
                                                                        24/7
                                                                        @endif 
                                                                    </td>
                                                                    <td>
                                                                        @if ($branch->currencies->count()>0)
                                                                            @foreach ($branch->currencies as $currency)
                                                                            <span class="badge bg-primary">{{$currency->name}}</span>
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($branch->fuel_types->count()>0)
                                                                            @foreach ($branch->fuel_types as $fuel_type)
                                                                            <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                            
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($branch->services->count()>0)
                                                                            @foreach ($branch->services as $service)
                                                                            <span class="badge bg-warning">{{$service->name}}</span>
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            $order = App\Models\OrderItem::where('service_id',$service->id)->where('branch_id', $branch->id)->where('uniqueid',$uniqueid)->first()
                                                                        @endphp
                                                                        @if (isset($order))
                                                                        <a href="#" wire:click.prevent="unPlaceOrder({{$service->id}},'branch',{{$branch->id}})" type="button" class="btn btn-primary"> Unplace Order</a>
                                                                        @else
                                                                        <a href="#" wire:click.prevent="placeOrder({{$service->id}},'branch',{{$branch->id}})" type="button" class="btn btn-outline-primary"> Place Order</a>
                                                                        @endif
                                                                      
                                                                    </td>
                                                                        
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                                @if (isset($fuel_stations))
                                                                    @foreach ($fuel_stations as $station)
                                                                    @if (isset($station->fuel_price))
                                                                        <tr>
                                                                            <td>
                                                                                <strong>{{$station->name}}</strong> <br>
                                                                                <strong>
                                                                                    @if (isset($station->fuel_price))
                                                                                    <span class="badge bg-success">{{$station->fuel_price->stock_level}}</span>
                                                                                    @endif
                                                                                
                                                                                </strong> <br>
                                                                                <i class="fas fa-envelope"></i> {{$station->email}} | <i class="fas fa-phone"></i> {{$station->phonenumber}} <br>
                                                                                <i class="fas fa-map-marker"></i> {{$station->street_address}} {{$station->suburb ? $station->suburb.", " : ""}} {{$station->city}} <br>
                                                                                <i class="fa fa-clock-o"></i>
                                                                                Office Hours:
                                                                                @if (isset($station->working_schedule) && $station->working_schedule->everyday == False)
                                                                                    {{$station->working_schedule ? $station->working_schedule->first_day : ""}} - {{$station->working_schedule ? $station->working_schedule->last_day : ""}} {{$station->working_schedule ? $station->working_schedule->start_time : ""}} - {{$station->working_schedule ? $station->working_schedule->end_time : ""}}
                                                                                @else   
                                                                                    24/7
                                                                                @endif 
                                                                            </td>
                                                                            <td>
                                                                                @if ($station->currencies->count()>0)
                                                                                    @foreach ($station->currencies as $currency)
                                                                                    <span class="badge bg-primary">{{$currency->name}}</span>
                                                                                    @endforeach
                                                                                @else
                                                                                <span class="badge bg-secondary">N/A</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($station->fuel_types->count()>0)
                                                                                    @foreach ($station->fuel_types as $fuel_type)
                                                                                    <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                                    
                                                                                    @endforeach
                                                                                @else
                                                                                <span class="badge bg-secondary">N/A</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @if ($station->services->count()>0)
                                                                                    @foreach ($station->services as $service)
                                                                                    <span class="badge bg-warning">{{$service->name}}</span>
                                                                                    @endforeach
                                                                                @else
                                                                                <span class="badge bg-secondary">N/A</span>
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                @php
                                                                                    $order = App\Models\OrderItem::where('service_id',$service->id)->where('fuel_station_id', $station->id)->where('uniqueid',$uniqueid)->first()
                                                                                @endphp
                                                                                @if (isset($order))
                                                                                <a href="#" wire:click.prevent="unPlaceOrder({{$service->id}},'fuel_station',{{$station->id}})" type="button" class="btn btn-primary"> Unplace Order</a>
                                                                                @else
                                                                                <a href="#" wire:click.prevent="placeOrder({{$service->id}},'fuel_station',{{$station->id}})" type="button" class="btn btn-outline-primary"> Place Order</a>
                                                                                @endif
                                                                            
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                               
                                                                    @endforeach
                                                                @endif
                                                                @if (isset($offices))
                                                                @foreach ($offices as $office)
                                                                <tr>
                                                                    <td>
                                                                        <strong>{{$office->name}}</strong> <br>
                                                                        <i class="fas fa-envelope"></i> {{$office->email}} | <i class="fas fa-phone"></i> {{$office->phonenumber}} <br>
                                                                        <i class="fas fa-map-marker"></i> {{$office->street_address}} {{$office->suburb ? $office->suburb.", " : ""}} {{$office->city}} <br>
                                                                        <i class="fa fa-clock-o"></i>
                                                                        Office Hours:
                                                                        @if (isset($office->working_schedule) && $office->working_schedule->everyday == False)
                                                                            {{$office->working_schedule ? $office->working_schedule->first_day : ""}} - {{$office->working_schedule ? $office->working_schedule->last_day : ""}} {{$office->working_schedule ? $office->working_schedule->start_time : ""}} - {{$office->working_schedule ? $office->working_schedule->end_time : ""}}
                                                                        @else   
                                                                            24/7
                                                                        @endif 
                                                                    
                                                                    </td>
                                                                    <td>
                                                                        @if ($office->currencies->count()>0)
                                                                            @foreach ($office->currencies as $currency)
                                                                            <span class="badge bg-primary">{{$currency->name}}</span>
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($office->fuel_types->count()>0)
                                                                            @foreach ($office->fuel_types as $fuel_type)
                                                                            <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                            
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($office->services->count()>0)
                                                                            @foreach ($office->services as $service)
                                                                            <span class="badge bg-warning">{{$service->name}}</span>
                                                                            @endforeach
                                                                        @else
                                                                        <span class="badge bg-secondary">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            $order = App\Models\OrderItem::where('service_id',$service->id)->where('office_id', $office->id)->where('uniqueid',$uniqueid)->first()
                                                                        @endphp
                                                                        @if (isset($order))
                                                                        <a href="#" wire:click.prevent="unPlaceOrder({{$service->id}},'office',{{$office->id}})" type="button" class="btn btn-primary"> Unplace Order</a>
                                                                        @else
                                                                        <a href="#" wire:click.prevent="placeOrder({{$service->id}},'office',{{$office->id}})" type="button" class="btn btn-outline-primary"> Place Order</a>
                                                                        @endif
                                                                      
                                                                    </td>
                                                                </tr>
                                                                    @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        @endif
                                                            
                                        @endforeach
                       
                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        @endif
                    @if ($next == False)
                        <a href="#" wire:click.prevent="nextStep()" type="button" class="btn btn-outline-primary mb-5" style="float: right">Next</a>
                    @endif

                    @if ($next == True)
                    <div class="card-header mb-1" style="background-color: #787276; color:white">
                        <h5>DRAFT ORDER SUMMARY</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #787276; color:white">
                                    <strong>DRIVER DETAILS</strong>
                                </div>
                                <hr>
                                <div class="card-body" style="background-color: #ECECEC">
                                    <p class="mb-2"><i class="fas fa-user"></i> Driver: <span style="float:right"><strong>{{$selected_driver->name}} {{$selected_driver->surname}}</strong></span></p>
                                    <p class="mb-2"><i class="fas fa-address-book"></i> License#: <span style="float:right"><strong>{{$selected_driver->license_number}}</strong></span></p>
                                    <p class="mb-2"><i class="fas fa-address-book"></i> Passport# <span style="float:right"><strong>{{$selected_driver->passport_number}}</strong></span></p>
                                    <p class="mb-2"><i class="fas fa-phone"></i> Contact# <span style="float:right"><strong>{{$selected_driver->phonenumber}}</strong></span></p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #787276; color:white">
                                    <strong>TRUCK DETAILS</strong>
                                </div>
                                <hr>
                                <div class="card-body" style="background-color: #ECECEC">
                                    <p class="mb-2"><i class="fas fa-key"></i> Reg Number: <span style="float: right;"><strong>{{$selected_horse->registration_number}} {{$selected_horse->fleet_number ? "(".$selected_horse->fleet_number.")" : ""}}</strong></span></p>
                                    <p class="mb-2"><i class="fas fa-info-circle"></i> Make/Model: <span style="float: right;"><strong>{{$selected_horse->make}} {{$selected_horse->model}}</strong></span></p>
                                    <p class="mb-2"><i class="fas fa-trailer"></i> Trailer: 
                                        <span style="float: right;">
                                            @if (isset($trailer_id))
                                                @foreach ($trailer_id as $id)
                                                    @php
                                                        $trailer = App\Models\Trailer::find($id);
                                                    @endphp
                                                   <strong>{{$trailer->registration_number}} </strong> 
                                                @endforeach 
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body" style="background-color: #ECECEC">
                                    
                                    @if (isset($order_item))
                                        @if ($order_item->fuel_station)
                                        <div class="row">
                                            <div class="col-md-6">
                                                @php
                                                    $fuel_station = $order_item->fuel_station;
                                                @endphp
                                                <span class="mb-3">
                                                    @if ($fuel_station->country)
                                                    <img src="{{asset('images/flags/'.$fuel_station->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($fuel_station->name)}}</strong></span>  
                                                    @endif
                                                </span>
                                                <br>
                                                <br>
                                                @if ($fuel_station->fuel_price->stock_level == "High")
                                                    <span class="badge bg-primary mb-3">SUFFICIENT STOCK</span>
                                                @elseif ($fuel_station->fuel_price->stock_level == "Medium")
                                                    <span class="badge bg-warning mb-3">MEDIUM STOCK</span>
                                                @elseif ($fuel_station->fuel_price->stock_level == "Low")
                                                    <span class="badge bg-danger mb-3">LOW STOCK</span>
                                                @endif
                                                <br>
                                                <span>
                                                    <strong>
                                                        @if ($fuel_station->fuel_price->retail_price)
                                                            <h5>{{$fuel_station->fuel_price->currency ? $fuel_station->fuel_price->currency->name : ""}} {{$fuel_station->fuel_price->currency ? $fuel_station->fuel_price->currency->symbol : ""}}{{number_format($fuel_station->fuel_price->retail_price ? $fuel_station->fuel_price->retail_price : 0,2)}} /  Litre</h5>
                                                        @endif
                                                    </strong>
                                                   
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <i class="fa fa-clock-o"></i> Office Hours: <br>
                                                    @if ($fuel_station->working_schedule->everyday == False)
                                                    {{$fuel_station->working_schedule ? $fuel_station->working_schedule->first_day : ""}} - {{$fuel_station->working_schedule ? $fuel_station->working_schedule->last_day : ""}} {{$fuel_station->working_schedule ? $fuel_station->working_schedule->start_time : ""}} - {{$fuel_station->working_schedule ? $fuel_station->working_schedule->end_time : ""}}
                                                    @else   
                                                    Open: 24 Hours, 7 Days a week.
                                                    @endif 
                                                </p>
                                            </div> 
                                        </div>
                                     
                                        @elseif ($order_item->office)
                                        @php
                                            $office = $order_item->office;
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="mb-3">
                                                    @if ($office->country)
                                                    <img src="{{asset('images/flags/'.$office->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($office->name)}}</strong></span>  
                                                    @endif
                                                </span>
                                                <br>
                                                <br>
                                                @if ($office->currencies->count()>0)
                                                    @foreach ($office->currencies as $currency)
                                                    <span class="badge bg-primary">{{$currency->name}}</span>
                                                    @endforeach
                                                @endif
                                                @if ($office->service_provider)
                                                    <p>{{$office->service_provider->description}}</p>
                                                @endif
                                               
                                            </div>
                                            <div class="col-md-6">
                                                <p>
                                                    <i class="fa fa-clock-o"></i> Office Hours: <br>
                                                    @if ($office->working_schedule->everyday == False)
                                                    {{$office->working_schedule ? $office->working_schedule->first_day : ""}} - {{$office->working_schedule ? $office->working_schedule->last_day : ""}} {{$office->working_schedule ? $office->working_schedule->start_time : ""}} - {{$office->working_schedule ? $office->working_schedule->end_time : ""}}
                                                    @else   
                                                    Open: 24 Hours, 7 Days a week.
                                                    @endif 
                                                </p>
                                                <br>
                                                @if ($office->service_provider)
                                                <p>{{$office->service_provider->rate}} {{$office->service_provider->frequency}}</p>
                                            @endif
                                            </div> 
                                            
                                        </div>
                                        @elseif($order_item->branch)
                                            @php
                                                $branch = $order_item->branch;
                                            @endphp
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="mb-3">
                                                        @if ($branch->country)
                                                        <img src="{{asset('images/flags/'.$branch->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($branch->name)}}</strong></span>  
                                                        @endif
                                                    </span>
                                                    <br>
                                                    <br>
                                                    @if ($branch->currencies->count()>0)
                                                        @foreach ($branch->currencies as $currency)
                                                        <span class="badge bg-primary">{{$currency->name}}</span>
                                                        @endforeach
                                                    @endif
                                                  
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        <i class="fa fa-clock-o"></i> Office Hours: <br>
                                                        @if ($branch->working_schedule->everyday == False)
                                                        {{$branch->working_schedule ? $branch->working_schedule->first_day : ""}} - {{$branch->working_schedule ? $branch->working_schedule->last_day : ""}} {{$branch->working_schedule ? $branch->working_schedule->start_time : ""}} - {{$branch->working_schedule ? $branch->working_schedule->end_time : ""}}
                                                        @else   
                                                        Open: 24 Hours, 7 Days a week.
                                                        @endif 
                                                    </p>
                                                    <br>
                                                    <p>{{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format(1,2)}} for {{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format(1,2)}}</p>
                                                    <p>Service fee: {{$charge->percentage}} %</p>
                                                </div> 
                                                
                                                <blockquote class="mt-3" style="background-color: #ffac3c;  border-radius: 5px;">
                                                    Funds will be reserved upon order completion. Please send the order number, together with the invoice, directly to payments@freyt365.com. Kindly note that it can take up to 72 business hours before payment is finalised and the POP will be received.
                                                </blockquote>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header" style="background-color: #787276; color:white">
                                    <strong>Est. Total: {{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format($total ? $total : 0,2)}}</strong>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Collection Date<span class="required" style="color: red">*</span></label>
                                        <input type="date"  class="form-control" wire:model.live.debounce.300ms="collection_date" required>
                                        @error('collection_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">Amount/Qty<span class="required" style="color: red">*</span></label>
                                        <input type="number" step="any" min="1"  class="form-control" wire:model.live.debounce.300ms="amount" required>
                                        @error('amount') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        <small>Available Balance is: {{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format($selected_wallet->balance ? $selected_wallet->balance : 0,2)}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="btn-group mb-10" role="group" style="float: right">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-floppy-fill"></i>Update Order</button>
                    </div>
                    @endif
                        
                   <br>
                   <br>
                   <br>

                </div> <!-- end card-body-->
            </form>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>
