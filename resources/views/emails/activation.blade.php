@extends('layouts.emails')
@section('title')
Account Activation
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
												<h3 style="font-size:16px; margin:0 0 20px 0;font-family:Arial,sans-serif;">{{$company->name}}</h3>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">This is an automated account activation notification.</p>
											</td>
										</tr>
										<tr>
											<td>
												<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
													@if ($company)
														@if ($company->authorization == "approved")
															Congratulations you're now activated to use <a href="https://freyt365.com/" target="_blank">freyt365</a>.
															This is a secure platform for all services freyt365, attached is a Freyt365 User Manual to get you started.
															Please click on the link below and log in with your username and password.
															<br>
															<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="https://freyt365.com/login" style="color:#fcc02d;text-decoration:underline;" target="_blank">Click me to get started</a></p>
														@else
															Unfortunately your account was not activated to use <a href="https://freyt365.com/" target="_blank">freyt365</a>.
															<br>
															Here are a few reasons why your account activation was rejected:
															<br>
															1) You did not submit the required documents.
															<br>
															2) Illegitimacy of your business.
															<br>
															3) {{$reason}}
															<br>
															if you think we are wrong in our decision please send us an email on <a href="mailto: activations@freyt365.com">activations@freyt365.com</a>
														@endif
													@endif
													<br>
													
													Best Regards Freyt365 Admin
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
											{{-- <td>
												
											</td> --}}
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
													Freyt365 {{date('Y')}} | <a href="mailto:info@freyt365.com" style="color:#ffffff;text-decoration:underline;">info@freyt365.com</a>
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
