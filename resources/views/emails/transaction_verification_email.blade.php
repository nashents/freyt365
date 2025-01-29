@extends('layouts.emails')
@section('title')
Transaction Verification
@endsection
@section('content')

			<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
				<tr>
					<td align="center" style="padding:0;">
						<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
			
							<tr>
								<td align="center" style="padding:40px 0 30px 0;background:#f68712;">
									<img src="#" alt="" width="300" style="height:auto;display:block;" />
								</td>
							</tr>
							<tr>
								<td style="padding:36px 30px 42px 30px;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
										<tr>
											<td style="padding:0 0 15px 0;color:#153643;">
											<h3 style="font-size:16px; margin:0 0 20px 0;font-family:Arial,sans-serif;">{{$admin->name}}</h3>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">This is an automated transaction verification notification.</p>
											</td>
										</tr>
										<tr>
											@php
													$from_bank = App\Models\BankAccount::find($transaction->from);
													$to_bank = App\Models\BankAccount::find($transaction->to);
													$authorizer = App\Models\User::find($transaction->authorized_by_id);
												@endphp
											<td>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
													<strong>Transaction#:</strong> {{$transaction->transaction_number}} <strong>Status:</strong> {{ucfirst($transaction->verification)}}
													<br>
													<strong>Transaction Reference:</strong> {{$transaction->transaction_reference}}
													<br>
													<strong>Transaction Date:</strong> {{$transaction->transaction_date}}
													<br>
													@if ($transaction->wallet)
														<strong>Wallet: </strong>{{$transaction->wallet ? $transaction->wallet->name : ""}} {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}} <i>{{$transaction->wallet->default == True ? "Default Wallet" : ""}}</i>
														<br>
													@endif
													
													<strong>Transaction Type:</strong> {{$transaction->transaction_type ? $transaction->transaction_type->name : ""}}
													<br>
													
													@if ($transaction->transaction_type->name == "Deposit")
														@if (isset($from_bank))
														<strong>Funds send from:</strong> {{$from_bank->name}} {{$from_bank->account_name}} {{$from_bank->account_number}} {{$from_bank->branch}} {{$from_bank->swift_code}}
														<br>
														@endif
														@if (isset($to_bank))
														<strong>Funds send into:</strong> {{$to_bank->name}} {{$to_bank->account_name}} {{$to_bank->account_number}} {{$to_bank->branch}} {{$to_bank->swift_code}}
														<br>
														@endif
														<strong>Reference#:</strong> {{$transaction->reference_code}}
														<br>
													@elseif ($transaction->transaction_type->name == "Internal Transfer")
														@if ($receiving_wallet)
															<strong>Receiving Wallet: </strong>{{$receiving_wallet->name}} {{$receiving_wallet->wallet_number}}
															<br>
														@endif
													@endif	
													<strong>Transaction Currency:</strong> {{$transaction->currency ? $transaction->currency->name : ""}}
													<br>
													<strong>Current Wallet Balance:</strong> {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->wallet_balance ? $transaction->wallet_balance : 0,2)}}
													<br>
													<strong>Transaction Amount: </strong> {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount ? $transaction->amount: 0,2)}}
													<br>
													<strong>Transaction Charges:</strong> {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->charges ? $transaction->charges: 0,2)}}
													<br>
													<strong>Transaction Authorized By:</strong> {{$authorizer->name}} {{$authorizer->surname}} {{$authorizer->email}} {{$authorizer->phonenumber}}
												</p>

												<br>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; color:#3064af">
													DISCLAIMER :
													<br>
													The contents of this e-mail, which may include one or more attachments, are strictly confidential, and are intended solely for the use of the named recipient(s).
													If you have received this e-mail in error, you are not permitted to and must not disclose, distribute, or retain it,
													and are requested to please notify the sender immediately by return e-mail and delete it thereafter.
													The opinions therein, explicit or implied, do not necessarily represent those of Freyt365.
													E-mail communication is not necessarily secure or error free as information could arrive late or contain viruses or could be incomplete, intercepted, corrupted, lost or destroyed.
													It is the responsibility of the named recipient(s) to ensure that e-mails are virus free and Freyt365 shall not accept responsibility for loss or damage arising from the use of this e-mail or its attachments.
												</p>
											</td>
											
										</tr>

									</table>
								</td>
							</tr>
							<tr>
								<td style="padding:30px;background: #f68712;">
									<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
										<tr>
											<td style="padding:0;width:50%;" align="left">
											
													<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">Powered By</p> 
													<br>
												<p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
													&reg;
													Freyt365 {{date('Y')}} | <a href="mailto:enquiries@freight365.com" style="color:#ffffff;text-decoration:underline;">enquiries@freight365.com</a>
												</p>
											
											</td>
											<td style="padding:0;width:50%;" align="right">
												<table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
													<tr>
														<td style="padding:0 0 0 10px;width:38px;">
															<a target="_blank" href="https://www.facebook.com/freyt365" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;"  /></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>


@endsection
