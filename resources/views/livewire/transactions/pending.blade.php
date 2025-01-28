<div>
    <x-loading/>
    <div class="row">
        <div>
             @include('includes.messages')
        </div>
        <div class="col-12">
            <div class="card">
               
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Transaction#</th>
                                <th>Wallet</th>
                                <th>Date</th>
                                <th>Ref#</th>
                                <th>Type</th>
                                <th>MOP</th>
                                <th>Ccy</th>
                                <th>Amt</th>
                                <th>Charges</th>
                                @if (!Auth::user()->is_admin())
                                <th>Auth</th>     
                                @endif
                                <th>Verified/Declined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($transactions))
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>
                                            @if ($transaction->wallet)
                                                {{$transaction->wallet ? $transaction->wallet->name : ""}} <i>{{$transaction->wallet->default == True ? "Default Wallet" : ""}}     </i>   
                                            @endif
                                        </td>
                                        <td>{{$transaction->transaction_date}}</td>
                                        <td>{{$transaction->reference_code}}</td>
                                        <td>{{$transaction->transaction_type ? $transaction->transaction_type->name : ""}}</td>
                                        <td>{{$transaction->mop}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                        <td>
                                            @if ($transaction->charge_amount)
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->charge_amount,2)}} @ {{$transaction->charge ? $transaction->charge."%" : ""}}
                                            @else   
                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format(0,2)}}    
                                            @endif
                                        </td>
                                        @if (!Auth::user()->is_admin())
                                        <td><span class="badge bg-{{($transaction->authorization == 'approved') ? 'success' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                        @endif
                                        <td><span class="badge bg-{{($transaction->verification == 'verified') ? 'success' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                        <td class="w-10 line-height-35 table-dropdown">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if ($transaction->authorization == "pending" || $transaction->authorization == "rejected")
                                                    <li><a href="#" wire:click.prevent="showAuthorize({{$transaction->id}})"  class="dropdown-item"><i class="fa fa-refresh color-success"></i> Authorize</a></li>
                                                    @else   
                                                    {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format(0,2)}}    
                                                    @endif
                                                </ul>
                                            </div>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Transactions Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    @endforelse
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
