<?php

$bottoken = "";

$website = 'https://api.telegram.org/bot'.$bottoken;

$update = file_get_contents('php://input');

$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];

$message = $update["message"]["text"];

$telegramusername = $update["message"]["from"]["username"];

$messageId = $update["message"]["message_id"];

$messageName = $update["message"]["chat"]["first_name"];

switch ($message) {
	
	case "Hola";
	
	funcSaludo($chatId);
	
	break;
	
	case "Quién es tu creador?";
	
	funcCreator($chatId);
	
	break;
	
}

/*if ($message == Hola) {
    
    funcSaludo($chatId);
    
}*/

if ($message == "Qué opinas de luis?") {
    
    opinaLuis($chatId);
    
}

function funcCreator($chatId) {
    
    $message3 = "Mi creador es @Issma94! \xF0\x9F\x98\x8A";
    
    sendMessage($chatId, $message3);
    
}

function funcSaludo($chatId) {
	
	 $message1 = "Hola, quieres tema? hehehehe";
	
	sendMessage($chatId, $message1);
	
}

function opinaLuis($chatId){
    
    $message2 = "Que es un puto gay";
    
    sendMessage($chatId, $message2);
    
}

function sendMessage($chatId, $message) {

	$url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message";
	
	file_get_contents($url);

}

?>
