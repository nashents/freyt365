<div>
    <x-loading/>
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <div class="col-md-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#transaction" type="button" role="tab"
                                            aria-controls="home" aria-selected="true" href="#transaction"  >
                                            <span style="margin-left: -10%">Transaction Details</span>
                                        </a>
                                    </li>
                                </div>
                               
                              
                            </ul>

                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="transaction" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">
                                    <div class="user-profile-content">
                                        <table class="table table-condensed mb-0 border-top table-striped">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Transaction#</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                           {{$transaction->transaction_number}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Transaction Reference</th>
                                                    <td>
                                                        <a href="" class="ng-binding">
                                                            {{$transaction->transaction_reference}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Transaction Date</th>
                                                    <td class="ng-binding">{{Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d')}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Wallet</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->wallet ? $transaction->wallet->name : ""}} {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Transaction Type</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->transaction_type ? $transaction->transaction_type->name : ""}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @if ($transaction->mop)
                                                <tr>
                                                    <th scope="row">Method Of Payment</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->mop}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($from_account)
                                                <tr>
                                                    <th scope="row">Sending Bank</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$from_account->name}} {{$from_account->account_name}} {{$from_account->account_number}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($to_account)
                                                <tr>
                                                    <th scope="row">Receiving Bank</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$to_account->name}} {{$to_account->account_name}} {{$to_account->account_number}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($transaction->reference_code)
                                                <tr>
                                                    <th scope="row">Reference Code</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->reference_code}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if ($transaction->transaction_date)
                                                <tr>
                                                    <th scope="row">Date of payment</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->transaction_date}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @if (isset($receiving_wallet))
                                                <tr>
                                                    <th scope="row">Receiving Wallet</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$receiving_wallet->name}} {{$receiving_wallet->wallet_number}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th scope="row">Transaction Currency</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->currency ? $transaction->currency->name : ""}} 
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Transaction Amount</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount,2)}}
                                                        </a>
                                                    </td>
                                                </tr>
                                    
                                                <tr>
                                                    <th scope="row">Transaction Authorization</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            <span class="badge bg-{{($transaction->authorization == 'approved') ? 'primary' : (($transaction->authorization == 'rejected') ? 'danger' : 'warning') }}">{{($transaction->authorization == 'approved') ? 'approved' : (($transaction->authorization == 'rejected') ? 'rejected' : 'pending') }}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Verified/Declined</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            <span class="badge bg-{{($transaction->verification == 'verified') ? 'primary' : (($transaction->verification == 'declined') ? 'danger' : 'warning') }}">{{($transaction->verification == 'verified') ? 'verified' : (($transaction->verification == 'declined') ? 'declined' : 'pending') }}</span>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">Transaction Status</th>
                                                    <td>
                                                        <a href="#" class="ng-binding">
                                                            {{$transaction->status == True ? "Successfull" : ""}}
                                                        </a>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>

                                       
                                    </div>
                                  
                                </div> <!-- about-me -->
                              
                               
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group pull-right mt-10 mr-10" style="float: right; margin-right:30px; margin-bottom:20px;" >
                                       <a onclick="goBack()" class="btn bg-gray btn-wide btn-primary btn-rounded"><i class="fa fa-arrow-left"></i> Back</a>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- end page title -->

   
</div>
