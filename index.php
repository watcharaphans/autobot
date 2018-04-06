<?php
      
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token = 'hrIGS6tRfEMT4rh9WTdwrzCCRm9KM98RFME+yeXZoiP/GxQyEjahJ3a6Siz+Ff3+NglViheYIOvN5H8ymQEytL+zKuEvEgGNAdSdnzTJeULn7Ro2timuIk4GlARuig5qOIzSgNNpW8AaU1pc6uayeAdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '2a7393359c7302eca994ccee192125ee'; 

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
		
		
		 
    
        // Line API send a lot of event type, we interested in message only.
	if ($event['type'] == 'message') {

		    switch($event['message']['type']) {

			case 'text':
			    // Get replyToken
			    $replyToken = $event['replyToken'];

			    // Reply message
			    $respMessage = 'Hello, your message is '. $event['message']['text'];
				    
				    $ask = $event['message']['text'];

        				switch(strtolower($ask)) {
          				  case 'm':
           				     $respMessage = 'What sup man. Go away!';
           				     break;
          				  case 'f':
            				     $respMessage = 'Love you lady.';
             				     break;
					  case 'hello':
            				     $respMessage = 'สวัสดีครับ คุณต้องการทราบข้อมูลอะไร';
             				     break;	
           				 default:
            				    // $respMessage = 'งง??';
               				 break;    
        				}

			    $httpClient = new CurlHTTPClient($channel_token);
			    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

			    $textMessageBuilder = new TextMessageBuilder($respMessage);
			    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
			
			    break;
			}
		    }
	}
}

echo "OK";
