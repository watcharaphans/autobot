<?php
      
require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token = 'sSUx94O0aAdZrwQo85EXZ3poIdqIZQDeSbdN9hBxX5arLf7e44nqa36NVgqON1W6NglViheYIOvN5H8ymQEytL+zKuEvEgGNAdSdnzTJeUIlIYgENGMJBParNDNz1/yVRdENPY7gvFRXABMte23BGAdB04t89/1O/w1cDnyilFU='; 
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

			    $httpClient = new CurlHTTPClient($channel_token);
			    $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

			    $textMessageBuilder = new TextMessageBuilder($respMessage);
			    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
				    
				    
error_log($event['message']['type']);
error_log($replyToken);
			    break;
			}
		    }
	}
}

echo "OK";
