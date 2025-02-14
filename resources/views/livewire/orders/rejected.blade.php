<div>
    <x-loading/>
    <div class="row">
        <div class="col-12">
            <div class="card">
              
                <div class="card-body">
                    <table id="basic-datatable" class="table table-sordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Order#</th>
                                <th>Order Summary</th>
                                <th>Driver/Horse/Trailer(s)</th>
                                <th>Collection Date</th>
                                <th>Amount</th>
                                <th>Auth</th>
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
                                            <img src="{{asset('images/flags/'.$fuel_station->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($fuel_station->name)}}</strong></span>  
                                            <br>
                                            {{number_format($order->order_item->qty,2)}} Litres @ {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->name : ""}}{{number_format($order->order_item->fuel_station->fuel_price->retail_price,2)}}
                                        @elseif (!is_null($order->order_item->branch_id))
                                            @php
                                                $branch = App\Models\Branch::find($order->order_item->branch_id);
                                            @endphp
                                            <img src="{{asset('images/flags/'.$branch->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($branch->name)}}</strong> | {{$order->order_item->service ? $order->order_item->service->name : ""}}</span>  
                                            <br>
                                            {{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->name : ""}}{{number_format($order->order_item->qty,2)}}  
                                            @if ($order->transaction_type)
                                                 @ {{$order->transaction_type->charge ? $order->transaction_type->charge->percentage."%" : ""}} Service Fee.  
                                            @endif
                                        @elseif (!is_null($order->order_item->office_id))
                                            @php
                                                $office = App\Models\Office::find($order->order_item->office_id);
                                            @endphp
                                            <img src="{{asset('images/flags/'.$office->country->flag)}}" width="25px" height="20px" alt="">  <span style="padding-left:0px;"><strong>{{strtoupper($office->name)}}</strong> | {{$order->order_item->service ? $order->order_item->service->name : ""}}</span>  
                                            <br>
                                            {{number_format($order->order_item->qty,2)}}  @ {{number_format($office->rate ? $office->rate : 0,2)}}/{{$office->frequency}}. 
                                        @endif
                                    @endif
                                </td>
                                <td>{{$order->driver ? $order->driver->name : ""}} {{$order->driver ? $order->driver->surname : ""}} / {{$order->horse ? $order->horse->registration_number : ""}} {{$order->horse ? "(".$order->horse->fleet_number.")" : ""}} /
                                    @if ($order->trailers->count()>0)
                                        @foreach ($order->trailers as $trailer)
                                            [{{$trailer->registration_number}}]
                                        @endforeach
                                    @endif

                                </td>
                                <td>{{$order->collection_date}}</td>   
                                <td>{{$order->currency ? $order->currency->name : ""}} {{$order->currency ? $order->currency->symbol : ""}}{{number_format($order->total,2)}}</td>   
                                <td><span class="badge bg-{{($order->authorization == 'approved') ? 'primary' : (($order->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($order->authorization == 'approved') ? 'approved' : (($order->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                <td><span class="badge bg-{{($order->status == 'successful') ? 'primary' : (($order->status == 'unsuccessful') ? 'danger' : 'warning') }}">{{($order->status == 'successful') ? 'successful' : (($order->status == 'unsuccessful') ? 'unsuccessful' : 'pending') }}</span></td>
                                <td class="w-10 line-height-35 table-dropdown">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('orders.show',$order->id)}}" class="dropdown-item"><i class="fa fa-eye color-default"></i> View</a></li>
                                            @if ($order->authorization == "pending" || $order->authorization == "rejected")
                                            <li><a href="#" wire:click.prevent="showAuthorize({{$order->id}})"  class="dropdown-item"><i class="fa fa-refresh color-success"></i> Authorize</a></li>
                                            @endif
                                        </ul>
                                    </div>
                            </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Rejected Orders Found ....
                                    </div>
                                   
                                </td>
                            </tr>
                            @endforelse

                            @else
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                        No Rejected Orders Found ....
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


    <div wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" id="authorizationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"> <i class="bi bi-plus-lg"></i> Authorize Transaction </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="saveAuthorize()" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="validationCustom02">Approve/Reject<span class="required" style="color: red">*</span></label>
                            <select class="form-control" wire:model.live.debounce.300ms="authorization" required>
                                <option value="">Select Option</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                            @error('authorization') <span class="error" style="color:red">{{ $message }}</span> @enderror
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
