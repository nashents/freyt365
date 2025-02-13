<div>
    <div class="card">
        <div class="card-header mb-1" style="background-color: #787276; color:white">
            <h5>Order Ref: {{$order->order_number}}</h5>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #787276; color:white">
                    <strong>Created on {{$order->created_at}}</strong>
                    <span class="badge bg-primary mb-3" style="float: right;">{{$order->status}}</span>
                </div>
            </div>
        </div>
       
    </div> 
    @if (!is_null($order->horse_id))
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #787276; color:white">
                    <strong>DRIVER DETAILS</strong>
                </div>
                <hr>
                <div class="card-body" style="background-color: #ECECEC">
                    <p class="mb-2"><i class="fas fa-user"></i> Driver: <span style="float:right"><strong>{{$order->driver ? $order->driver->name : ""}} {{$order->driver ? $order->driver->surname : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-address-book"></i> License#: <span style="float:right"><strong>{{$order->driver ? $order->driver->license_number : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-address-book"></i> Passport# <span style="float:right"><strong>{{$order->driver ? $order->driver->passport_number : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-phone"></i> Contact# <span style="float:right"><strong>{{$order->driver ? $order->driver->phonenumber : ""}}</strong></span></p>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #787276; color:white">
                    <strong>HORSE DETAILS</strong>
                </div>
                <hr>
                <div class="card-body" style="background-color: #ECECEC">
                    @if (!is_null($order->horse_id))
                        <p class="mb-2"><i class="fas fa-key"></i> Reg Number: <span style="float: right;"><strong>{{$order->horse->registration_number}} {{$order->horse->fleet_number ? "(".$order->horse->fleet_number.")" : ""}}</strong></span></p>
                        <p class="mb-2"><i class="fas fa-info-circle"></i> Make/Model: <span style="float: right;"><strong>{{$order->horse->make}} {{$order->horse->model}}</strong></span></p>
                    @endif
                    @if (isset($trailer_id))
                    <p class="mb-2"><i class="fas fa-trailer"></i> Trailer: 
                        <span style="float: right;">
                         
                                @foreach ($trailer_id as $id)
                                    @php
                                        $trailer = App\Models\Trailer::find($id);
                                    @endphp
                                   <strong>{{$trailer->registration_number}} </strong> 
                                @endforeach 
                            
                        </span>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #787276; color:white">
                    <strong>DRIVER DETAILS</strong>
                </div>
                <hr>
                <div class="card-body" style="background-color: #ECECEC">
                    <p class="mb-2"><i class="fas fa-user"></i> Driver: <span style="float:right"><strong>{{$order->driver ? $order->driver->name : ""}} {{$order->driver ? $order->driver->surname : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-address-book"></i> License#: <span style="float:right"><strong>{{$order->driver ? $order->driver->license_number : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-address-book"></i> Passport# <span style="float:right"><strong>{{$order->driver ? $order->driver->passport_number : ""}}</strong></span></p>
                    <p class="mb-2"><i class="fas fa-phone"></i> Contact# <span style="float:right"><strong>{{$order->driver ? $order->driver->phonenumber : ""}}</strong></span></p>
                </div>
            </div>
        </div>
       
    </div> 
    @endif
    <div class="card">
        <div class="card-header mb-1" style="background-color: #787276; color:white">
            <h5>ORDER ITEMS</h5>
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
                                    @if (isset($fuel_station->location))
                                    <a href="{{$fuel_station->location}}" class="btn btn-default" target="_blank"><i class="bi bi-geo-alt-fill h2"></i></a>
                                    @endif
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
                                            <h5>{{$fuel_station->fuel_price->currency ? $fuel_station->fuel_price->currency->name : ""}} {{$fuel_station->fuel_price->currency ? $fuel_station->fuel_price->currency->symbol : ""}}{{number_format($fuel_station->fuel_price->retail_price,2)}} /  Litre</h5>
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
                                    @if (isset($office->location))
                                    <a href="{{$office->location}}" class="btn btn-default" target="_blank"><i class="bi bi-geo-alt-fill h2"></i> <span></span> </a>
                                    @endif
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
                                <p>Rate: {{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format($office->service_provider->rate,2)}} / {{$office->service_provider->frequency}} with a minimum of {{$office->service_provider->minimum}}{{$office->service_provider->frequency}}(s) </p>
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
                                        @if (isset($branch->location))
                                        <a href="{{$branch->location}}" class="btn btn-default" target="_blank"><i class="bi bi-geo-alt-fill h2"></i> <span></span> </a>
                                        @endif
                                        @endif
                                    </span>
                                    <br>
                                    <br>
                                    @if ($branch->currencies->count()>0)
                                        @foreach ($branch->currencies as $currency)
                                        <span class="badge bg-primary">{{$currency->name}}</span>
                                        @endforeach
                                    @endif
                                    @if ($branch->services->count()>0)
                                        @foreach ($branch->services as $service)
                                        <span class="badge bg-warning">{{$service->name}}</span>
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
                        @if (isset($selected_wallet))
                        <small>Available Balance is: {{$selected_currency->name}} {{$selected_currency->symbol}}{{number_format($selected_wallet->balance ? $selected_wallet->balance : 0,2)}}</small>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table table-sordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Status</th>
                                    <th>Ccy</th>
                                    <th>Wallet</th>
                                    <th>Ref</th>
                                    <th>Tax Incl</th>
                                    <th>Amt/Qty</th>
                                    <th>Rate/Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$order->order_item->service->name}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>{{$order->currency->name}}</td>
                                    <td>{{$order->wallet->name}}</td>
                                    <td>{{$order->transaction->transaction_reference}}</td>
                                    <td></td>
                                    <td>{{$order->order_item->qty}}</td>
                                    <td>{{$order->order_item->amount}}</td>
                                    <td>{{$order->total}}</td>
        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
     
       
    </div>
</div>
