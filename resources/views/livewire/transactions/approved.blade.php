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
                                <th>Reference</th>
                                @if (Auth::user()->is_admin())
                                <th>Company</th>
                                @endif
                                <th>CreatedBy</th>
                                <th>Wallet</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Ccy</th>
                                <th>Amt</th>
                                @if (!Auth::user()->is_admin())
                                <th>Auth</th>     
                                @endif
                                <th>Verified/Declined</th>
                             
                            </tr>
                        </thead>


                        <tbody>
                            @if (isset($transactions))
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{$transaction->transaction_number}}</td>
                                        <td>{{$transaction->transaction_reference}}</td>
                                        @if (Auth::user()->is_admin())
                                        <td>{{$transaction->company ? $transaction->company->name : ""}}</td>
                                        @endif
                                        <td>{{$transaction->user ? $transaction->user->name : ""}} {{$transaction->user ? $transaction->user->surname : ""}}</td>
                                        <td>
                                            @if ($transaction->wallet)
                                                {{$transaction->wallet ? $transaction->wallet->name : ""}} <i>{{$transaction->wallet->default == True ? "Default Wallet" : ""}}     </i>   
                                            @endif
                                        </td>
                                        <td>{{Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d')}}</td>
                                        <td>{{$transaction->transaction_type ? $transaction->transaction_type->name : ""}} {{$transaction->charge ? "Charges" : ""}}
                                            {{$transaction->mop ? " / ".$transaction->mop : ""}}
                                        </td>
                                        <td>{{$transaction->currency ? $transaction->currency->name : ""}}</td>
                                        <td>{{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}</td>
                                        @if (!Auth::user()->is_admin())
                                        <td><span class="badge bg-{{($transaction->authorization == 'approved') ? 'primary' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span></td>
                                        @endif
                                        <td><span class="badge bg-{{($transaction->verification == 'verified') ? 'primary' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span></td>
                                       
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div style="text-align:center; text-color:grey; padding-top:5px; padding-bottom:5px; font-size:17px">
                                                    No Approved Transactions Found ....
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    @endforelse
                            @endif
                        </tbody>
                    </table>
                     <nav class="text-center" style="float: right">
                                <ul class="pagination rounded-corners">
                                    @if (isset($transactions))
                                        {{ $transactions->links() }} 
                                    @endif 
                                </ul>
                            </nav>  

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->

</div>
