<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AccountCreationSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $password;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $mobileNumber = $this->user->phonenumber;
        $user = $this->user;
        $password = $this->password;

        if ($mobileNumber) {
            if(strpos(trim($mobileNumber),"0") === 0)
            {
                $recepient="263".substr($mobileNumber,1);
            }
            elseif(strpos(trim($mobileNumber),"7") === 0)
            {
                $recepient="2637".substr($mobileNumber,1);
            }
            elseif(strpos(trim($mobileNumber),"+") === 0)
            {
                $recepient=substr($mobileNumber,1);                                          
            }
            elseif(strpos(trim($mobileNumber),"2") === 0)
            {
                $recepient=$mobileNumber;
            }
            
            $name = ucfirst($user->name) ." ". ucfirst($user->surname);
            $username = $user->username;
            $category = $user->category;

            $params = [
                'api_id' => env('SMS_API_ID'),
                'api_password' => env('SMS_API_PASSWORD'),
                'sender_id'   => env('SMS_SENDER_ID'),  
                'sms_type' => env('SMS_TYPE'),
                'encoding' => env('SMS_ENCODING'),
                'phonenumber' => str_replace(' ','', $recepient),
                'textmessage'   => 'Dear ' . $name . ' your ' . $category . ' account was created successfully, with login credentials, username: ' . $username . ', password: ' .$password. '. Click me https://freyt365.co.zw/login.',
             ];
            
            $encoded_params = array();
            
               foreach ($params as $k => $v){
            
                   $encoded_params[] = urlencode($k).'='.urlencode($v);
               }
            
            
            $url = "http://rest.bluedotsms.com/api/SendSMS?".implode('&', $encoded_params);
        
        
            
               $curl = curl_init();
               curl_setopt($curl, CURLOPT_URL, $url);
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
        
        }
    
    }
}
