<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form wire:submit.prevent="store()">
                <div class="card-header">
                    <h4 class="header-title">CREATE A ONCE-OFF ORDER</h4>
                    <p class="text-muted mb-0">If you would like to place an order at only one of our collection offices, select the country and collection office below.</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Horses(Optional)</p>
                            <p class="text-muted fs-14">
                                Selecting a truck is only optional when you are not placing an order with an insurance company, Whiskey Parking or Peage. If you intend to place an order with an insurance company you have to select a truck and at least one trailer registration number should be specified.
                            </p>

                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="horse_id">
                                <option>Select Horse</option>
                                @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}">{{$horse->registration_number}} ({{$horse->fleet_number}})</option>
                                @endforeach
                            </select>
                            @error('horse_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <p class="mb-1 fw-bold text-muted">Trailers(Optional)</p>
                            <p class="text-muted fs-14">
                                If you intend to place an order with an insurance company you have to enter the at least one trailer registration number
                            </p>

                            <select class="select2 form-control select2-multiple" data-toggle="select2"
                                multiple="multiple" data-placeholder="Choose ...">
                            <option value="">Multi Select Trailer(s)</option>
                            @foreach ($trailers as $trailer)
                                <option value="{{$trailer->id}}">{{$trailer->registration_number}} ({{$trailer->fleet_number}})</option>
                            @endforeach
                            </select>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <p class="mb-1 fw-bold text-muted">Drivers<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="driver_id" required>
                                <option>Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->name}} {{$driver->surname}}</option>
                                @endforeach
                            </select>
                            @error('driver_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div> <!-- end col -->
                        <div class="col-lg-4">
                            <p class="mb-1 fw-bold text-muted">Select the account you want to pay with?<span class="required" style="color: red">*</span></p>
                            <select class="form-control select2" data-toggle="select2" wire:model.live.debounce.300ms="wallet_id" required>
                                <option>Select Wallet</option>
                                @foreach ($wallets as $wallet)
                                    <option value="{{$wallet->id}}">{{$wallet->currency ? $wallet->currency->name : ""}} {{$wallet->currency ? $wallet->currency->symbol : ""}}{{number_format($wallet->balance,2)}} </option>
                                @endforeach
                            </select>
                            @error('wallet_id') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
                            <div class="accordion" id="accordionServicesParent">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingServices{{$service->id}}">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseServices{{$service->id}}" aria-expanded="false" aria-controls="collapseServices{{$service->id}}">
                                        {{strtoupper($service->name)}}
                                        </button>
                                    </h2>
                                    <div id="collapseServices{{$service->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$service->id}}"
                                        data-bs-parent="#accordionServicesParent">
                                        <div class="accordion-body">
                                            @if ($service->fuel_stations->count()>0 || $service->branches->count()>0 || $service->offices->count()>0)
                                            <div class="card">
                                                <div class="card-body">
                                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>Offices</th>
                                                                <th>Currencies</th>
                                                                <th>Fuel</th>
                                                                <th>Service</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (isset($service->branches))
                                                            @foreach ($service->branches as $branch)
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
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($branch->fuel_types->count()>0)
                                                                        @foreach ($branch->fuel_types as $fuel_type)
                                                                        <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                        
                                                                        @endforeach
                                                                    @else
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($branch->services->count()>0)
                                                                        @foreach ($branch->services as $service)
                                                                        <span class="badge bg-warning">{{$service->name}}</span>
                                                                        @endforeach
                                                                    @else
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>Place Order</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                            @if (isset($service->fuel_stations))
                                                                @foreach ($service->fuel_stations as $station)
                                                                <tr>
                                                                    <td>
                                                                        <strong>{{$station->name}}</strong> <br>
                                                                        <strong>
                                                                            <span class="badge bg-success">{{$station->fuel_prices->first()->stock_level}}</span>
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
                                                                        <i class="bi bi-x-lg"></i>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($station->fuel_types->count()>0)
                                                                            @foreach ($station->fuel_types as $fuel_type)
                                                                            <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                            
                                                                            @endforeach
                                                                        @else
                                                                        <i class="bi bi-x-lg"></i>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($station->services->count()>0)
                                                                            @foreach ($station->services as $service)
                                                                            <span class="badge bg-warning">{{$service->name}}</span>
                                                                            @endforeach
                                                                        @else
                                                                        <i class="bi bi-x-lg"></i>
                                                                        @endif
                                                                    </td>
                                                                    <td>Place Order</td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                            @if (isset($service->offices))
                                                            @foreach ($service->offices as $office)
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
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($office->fuel_types->count()>0)
                                                                        @foreach ($office->fuel_types as $fuel_type)
                                                                        <span class="badge bg-success">{{$fuel_type->name}}</span>
                                                                        
                                                                        @endforeach
                                                                    @else
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($office->services->count()>0)
                                                                        @foreach ($office->services as $service)
                                                                        <span class="badge bg-warning">{{$service->name}}</span>
                                                                        @endforeach
                                                                    @else
                                                                    <i class="bi bi-x-lg"></i>
                                                                    @endif
                                                                </td>
                                                                <td>Place Order</td>
                                                            </tr>
                                                                @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            @endforeach
                       
                            
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <br>
                   
                
                    @endif

                 

 

                </div> <!-- end card-body-->
            </form>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
</div>
