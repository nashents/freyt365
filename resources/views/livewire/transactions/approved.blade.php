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

</div>
