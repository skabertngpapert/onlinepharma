<?php
use Google\Service\AIPlatformNotebooks\Location;
    session_start();
    // Update the path below to your autoload.php, 
            // see https://getcomposer.org/doc/01-basic-usage.md 
    require __DIR__ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))
    {
        // $transactId = $_GET['transactId'];
        // $pairedId = $_POST['transactId'];
        // if ($transactId === $pairedId)
        // {
            $smsbody = $_POST['smsbody'];
            $smsnet = $_POST['smsnet'];

            $smsUserName = $_SESSION['account_name'];
            $smsUserNumber = (string)($_SESSION['account_phone']);
            $myMessage = "Hi " . $smsUserName . "!\r\nyour order: " . $smsbody . "\r\nwith a total amount of: " . $smsnet . "php\r\nwill be delivered shortly";
            // Required if your environment does not handle autoloading
            // $sid    = "ACc5d0ab719392ff574b1f959966ab69aa"; 
            // $token  = "[AuthToken]"; 
            // $twilio = new Client($sid, $token); 
     

          
            // In production, these should be environment variables. E.g.:
            // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

            // A Twilio number you own with SMS capabilities
            $twilio_number = "+18455817681";

            


 
            
            
            $sid    = "ACc5d0ab719392ff574b1f959966ab69aa"; 
            $token  = "006b26850be17062352f0586edb80d28"; 
            $twilio = new Client($sid, $token); 
            
            $message = $twilio->messages 
                            ->create($smsUserNumber, // to 
                                    array(  
                                        'from' => $twilio_number,
                                        "messagingServiceSid" => "MGc5c26926f7b068a92cdbc1b43c0cd946",      
                                        "body" => $myMessage
                                    ) 
                            ); 
            
            print($message->sid);

            // Use the REST API Client to make requests to the Twilio REST API
            

            // Your Account SID and Auth Token from twilio.com/console
            

            // Use the client to do fun stuff like send text messages!
            // $client->messages->create(
            //     // the number you'd like to send the message to
            //         $smsUserNumber,
            //         [
            //             // A Twilio phone number you purchased at twilio.com/console
            //             'from' => '+18455817681',
            //             // the body of the text message you'd like to send
            //             'body' => $myMessage
            //         ]
            //     );


            
            
            // $sid    = "ACc5d0ab719392ff574b1f959966ab69aa"; 
            // $token  = "[Redacted]"; 
            // $twilio = new Client($sid, $token); 
            
            // $message = $twilio->messages 
            //                 ->create("+639179655984", // to 
            //                         array(  
            //                             "messagingServiceSid" => "MGc5c26926f7b068a92cdbc1b43c0cd946",      
            //                             "body" => "try" 
            //                         ) 
            //                 ); 
            
            // print($message->sid);
        // }
        // else
        // {
        // header("Location: /");
        // }
    

    }
    
    
?>