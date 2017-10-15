<?php

// Inicializar bot con el token
/*$bottoken = "" ;

$website = 'https://api.telegram.org/bot'.$bottoken;

$update = file_get_contents('php://input');

$updateArray = json_decode($update, TRUE);

$chatId = -;

file_get_contents($response);*/

//$updateArray["message"]["chat"]["id"]

$bottoken = "";

$website = 'https://api.telegram.org/bot'.$bottoken;

$update = file_get_contents('php://input');

$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];

$message = $update["message"]["text"];

/*$telegramusername = $update["message"]["from"]["username"];

$messageId = $update["message"]["message_id"];

$messageName = $update["message"]["chat"]["first_name"];*/

switch ($message) {
	
	case "Hola"||"hola";
	
	funcSaludo($chatId);
	
	break;
	
}

function funcSaludo($chatId) {
	
	echo "Hola, quieres tema? hehehehe";
	
	sendMessage($chatId, $message);
	
}

function sendMessage($chatId, $message) {

	$url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message";
	
	file_get_contents($url);

}
