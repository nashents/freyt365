@extends('layouts.emails')
@section('title')
Transaction Notification
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
											<h3 style="font-size:16px; margin:0 0 20px 0;font-family:Arial,sans-serif;">{{$transaction->company ? $transaction->company->name : ""}}</h3>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">This is an automated transaction notification.</p>
											</td>
										</tr>
										<tr>
											<td>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
													
													Your {{$receiving_wallet->name}} wallet with account number {{$receiving_wallet->wallet_number}} has been credited with {{$transaction->currency ? $transaction->currency->name : ""}} {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($transaction->amount ? $transaction->amount: 0,2)}}
													via {{ucfirst($transaction->transaction_type ? $transaction->transaction_type->name : "")}}  from {{$transaction->wallet ? $transaction->wallet->name : ""}} {{$transaction->wallet ? $transaction->wallet->wallet_number : ""}}  as of {{$transaction->transaction_date}}. Your new Account Balance is {{$transaction->currency ? $transaction->currency->name : ""}} {{$transaction->currency ? $transaction->currency->symbol : ""}}{{number_format($receiving_wallet->balance ? $receiving_wallet->balance: 0,2)}}.
													
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
