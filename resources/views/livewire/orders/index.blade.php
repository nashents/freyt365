<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if (!Auth::user()->is_admin())
                <div class="card-header">

                    <a href="{{route('orders.create')}}" type="button" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> New order</a>
                  
                </div>
                @endif
               
                <div class="card-body">
                    <table id="basic-datatable" class="table table-sordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Order#</th>
                                <th>Order Summary</th>
                                @if (Auth::user()->is_admin())
                                    <th>Company</th>
                                @endif
                                <th>Driver/Horse/Trailer(s)</th>
                                <th>Collection Date</th>
                                <th>Amount</th>
                                <th>Authorization</th>
                                <th>Verification</th>
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
                                    @if ($order->order_item)
                                    @if (!is_null($order->order_item->fuel_station_id))
                                        @php
                                            $fuel_station = App\Models\FuelStation::find($order->order_item->fuel_station_id);
                                        @endphp
                                        @if (isset($fuel_station))
                                            <img src="{{asset('images/flags/'.$fuel_station->country->flag)}}" width="25px" height="20px" alt=""><span style="padding-left:0px;"><strong>{{strtoupper($fuel_station->name)}}</strong></span>  
                                            <br>
                                            {{number_format($order->order_item->qty ? $order->order_item->qty : 0,2)}} Litres @ {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->symbol : ""}}{{number_format($order->order_item->fuel_station->fuel_price->retail_price ? $order->order_item->fuel_station->fuel_price->retail_price : 0,2)}}
                                        @endif
                                       
                                    @elseif (!is_null($order->order_item->branch_id))
                                        @php
                                            $branch = App\Models\Branch::find($order->order_item->branch_id);
                                        @endphp
                                        @if (isset($branch))
                                            <img src="{{asset('images/flags/'.$branch->country->flag)}}" width="25px" height="20px" alt=""> <span style="padding-left:0px;"><strong>{{strtoupper($branch->name)}}</strong> | {{$order->order_item->service ? $order->order_item->service->name : ""}}</span>  
                                            <br>
                                            {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->name : ""}}{{number_format($order->order_item->qty ? $order->order_item->qty : 0,2)}}  
                                            @if ($order->transaction_type)
                                            @ {{$order->transaction_type->charge ? $order->transaction_type->charge->percentage."%" : ""}} Service Fee.  
                                            @endif
                                        @endif
                                    @elseif (!is_null($order->order_item->office_id))
                                        @php
                                            $office = App\Models\Office::find($order->order_item->office_id);
                                        @endphp
                                        @if (isset($office))
                                            <img src="{{asset('images/flags/'.$office->country->flag)}}" width="25px" height="20px" alt=""><span style="padding-left:0px;"><strong>{{strtoupper($office->name)}}</strong> | {{$order->order_item->service ? $order->order_item->service->name : ""}}</span>  
                                            <br>
                                            {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->name : ""}}{{number_format($order->order_item->qty ? $order->order_item->qty : 0,2)}}  @ {{number_format($office->rate ? $office->rate : 0,2)}}/{{$office->frequency}}. 
                                        @endif
                                       
                                    @endif
                                @endif
                                </td>
                                @if (Auth::user()->is_admin())
                                    <td>{{$order->company ? $order->company->name : ""}}</td>
                                @endif
                                <td>
                                    {{$order->driver ? $order->driver->name : ""}} {{$order->driver ? $order->driver->surname : ""}} {{$order->horse ? " / ".$order->horse->registration_number : ""}} {{$order->horse ? "(".$order->horse->fleet_number.")" : ""}}
                                    @if ($order->trailers->count()>0)
                                        /
                                        @foreach ($order->trailers as $trailer)
                                            [{{$trailer->registration_number}}]
                                        @endforeach
                                    @endif

                                </td>
                                <td>{{$order->collection_date}}</td>   
                                <td> {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->symbol : ""}}{{number_format($order->total ? $order->total : 0,2)}}</td>   
                                <td><span class="badge bg-{{($order->authorization == 'approved') ? 'primary' : (($order->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($order->authorization == 'approved') ? 'approved' : (($order->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                  <td><span class="badge bg-{{($order->verification == 'verified') ? 'primary' : (($order->verification == 'declined') ? 'danger' : 'warning') }}">{{($order->verification == 'verified') ? 'verified' : (($order->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                <td><span class="badge bg-{{($order->status == 'successful') ? 'primary' : (($order->status == 'unsuccessful') ? 'danger' : 'warning') }}">{{($order->status == 'successful') ? 'successful' : (($order->status == 'unsuccessful') ? 'unsuccessful' : 'pending') }}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('orders.show',$order->id)}}" class="dropdown-item"><i class="fa fa-eye color-default"></i> View</a></li>
                                            @if (Auth::user()->is_admin() && $order->authorization == "approved" && $order->verification != "verified")
                                            <li><a href="#" wire:click.prevent="showVerify({{$order->id}})"  class="dropdown-item"><i class="fa fa-refresh color-success"></i> Verify</a></li>
                                            @endif
                                            @if (!Auth::user()->is_admin())
                                                <li><a href="{{route('orders.edit',$order->id)}}" class="dropdown-item"><i class="fa fa-edit color-default"></i> Edit</a></li>
                                                <li>
                                                    <a href="#" wire:click="delete({{$order->id}})"
                                                    wire:confirm="Are you sure you want to delete this order?" class="dropdown-item" ><i class="fa fa-trash color-danger"></i> Delete</a>
                                                </li>
                                            @endif
                                           
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">
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
                    <nav class="text-center" style="float: right">
                        <ul class="pagination rounded-corners">
                            @if (isset($orders))
                                {{ $orders->links() }} 
                            @endif 
                        </ul>
                    </nav>  

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="verificationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Verify Order </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent = "saveVerify()">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Verified/Declined<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="verification" required>
                                <option value="">Select Option</option>
                                <option value="verified">Verified</option>
                                    <option value="declined">Declined</option>
                            </select>
                            @error('verification') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom01">Reason</label>
                            <textarea class="form-control" wire:model.live.debounce.300ms="reason"
                            placeholder="Enter Reason" cols="30" rows="3"></textarea>
                            @error('reason') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-gray btn-wide btn-rounded" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>Close</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa fa-refresh "></i> Update</button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</div>
