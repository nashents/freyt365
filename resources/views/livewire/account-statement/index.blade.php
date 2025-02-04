<div>
    <x-loading/>
    <div class="row">
        <div>
             {{-- @include('includes.messages') --}}
        </div>
        <div class="col-12">
            <div class="card">
                @if (!Auth::user()->company->is_admin())
                <div class="card-header">
                    <blockquote>
                        Note: Account statement may change occasionally if offline orders are processed after month-end. <br>
                        Please select your search criteria including a date range, currency and wallet.
                    </blockquote>
                    <form wire:submit.prevent="search">
                        <div class="row gy-2 gx-2 align-items-center">
                            
                            <div class="col-auto">
                                <label class="visually-hidden"
                                    for="inlineFormInputGroup">date</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">From</div>
                                    <input type="date" class="form-control" wire:model="from" id="inlineFormInputGroup"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="visually-hidden"
                                    for="inlineFormInputGroup">date</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">To</div>
                                    <input type="date" class="form-control" wire:model="to" id="inlineFormInputGroup"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="visually-hidden"
                                    for="inlineFormInputGroup">wallet</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text">Wallets</div>
                                   <select class="form-control" wire:model="selectedWallet" id="inlineFormInputGroup">
                                        <option value="">Select Wallet</option>
                                        @foreach ($wallets as $wallet)
                                        <option value="{{$wallet->id}}">{{$wallet->name}} {{$wallet->wallet_number}} <i>{{$wallet->default == True ? "Default Wallet" : ""}}</i></option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary mb-2">GENERATE REPORT</button>
                            </div>
                            <div class="col-auto">
                                <button wire:click.prevent="clearValues" class="btn btn-outline-primary mb-2">CLEAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
              
                <div class="card-body">
                    <a href="#" wire:click="exportSalesExcel()"  class="btn btn-default border-primary btn-rounded btn-wide" style="float: right"><i class="fa fa-download"></i> EXPORT TO EXCEL</a>
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Narration</th>
                                <th>Ref#</th>
                                <th>Currency</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($transactions))
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y')}}</td>
                                        <td>    
                                                        @if ($transaction->transaction_type->name == "Deposit")
																 {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} has been credited  
																via {{ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "")}} {{ucfirst($transaction->mop)}}.
														@elseif($transaction->transaction_type->name == "Withdrawal")
																 {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} has been debited  
																via Cash {{ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "")}} {{$transaction->charge ? "Bank Charges" : ""}}.
														@elseif($transaction->transaction_type->name == "Internal Transfer")
															@if (isset($receiving_wallet))
																 {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} has been debited  
																via {{ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "")}}  to {{$receiving_wallet->name}} {{$receiving_wallet->wallet_number}}.
															@else
															 {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} has been debited  
																via {{ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "")}} {{$transaction->charge ? "Bank Charges" : ""}} . 
															@endif
														@else
														 {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} has been debited  
																via Bank Charges.
														@endif
                                        </td>
                                        <td>{{$transaction->transaction_reference}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>
                                            @if ($transaction->movement == "Dbt")
                                            {{number_format($transaction->amount,2)}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->movement == "Crt")
                                            {{number_format($transaction->amount,2)}}
                                            @endif
                                        </td>
                                        <td>{{number_format($transaction->wallet_balance,2)}}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No transactions found for this account ....
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

</div>
