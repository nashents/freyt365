<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('orders.create')}}" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New order</a>
                  
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-sordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Order#</th>
                                <th>Order For</th>
                                <th>Driver/Horse/Trailer(s)</th>
                                <th>Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($orders))

                            @forelse ($orders as $order)
                            <tr>
                                <td>{{$order->order_number}}</td>
                                <td>
                                    @if ($order->fuel_price)
                                       Fuel TopUp |   {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->name : ""}}  {{$order->fuel_price->country ? $order->fuel_price->country->name : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->city : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->suburb : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->street_address : ""}} <br>
                                    @endif
                                    @if ($order->service_providers->count()>0) 
                                        @foreach ($order->service_providers as $service_provider)
                                        Service Provider |   {{$order->service_provider ? $order->service_provider->name : ""}}  {{$order->fuel_price->country ? $order->fuel_price->country->name : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->city : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->suburb : ""}} {{$order->fuel_price->fuel_station ? $order->fuel_price->fuel_station->street_address : ""}} <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{$order->horse ? $order->horse->registration_number : ""}} ({{$order->horse ? $order->horse->fleet_number : ""}})</td>
                                <td>
                                    @foreach ($order->trailers as $trailer)
                                    {{$trailer->registration_number}} ({{$trailer->fleet_number}})
                                    @endforeach
                                </td>
                                <td>{{$order->customer}}</td>
                                <td>{{$order->cargo}}</td>
                                <td>{{$order->from}} {{$order->loading_point}}</td>
                                <td>{{$order->to}} {{$order->offloading_point}}</td>
                                <td>{{$order->status}}</td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="" class="dropdown-item"><i class="fa fa-edit color-success"></i> Edit</a></li>
                                            <li><a href="#" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a></li>
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Orders Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Orders Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endif
                          
                    
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->




</div>
