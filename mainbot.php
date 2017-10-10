<?php

openlog('TelegramBot', LOG_PID | LOG_PERROR, LOG_LOCAL0);

include('TelegramBot/Api/BotApi.php');
include('TelegramBot/Api/Exception.php');
include('TelegramBot/Api/InvalidArgumentException.php');
include('TelegramBot/Api/BaseType.php');
include('TelegramBot/Api/TypeInterface.php');
include('TelegramBot/Api/Types/ArrayOfArrayOfPhotoSize.php');
include('TelegramBot/Api/Types/ArrayOfPhotoSize.php');
include('TelegramBot/Api/Types/Audio.php');
include('TelegramBot/Api/Types/Chat.php');
include('TelegramBot/Api/Types/Contact.php');
include('TelegramBot/Api/Types/Document.php');
include('TelegramBot/Api/Types/ForceReply.php');
include('TelegramBot/Api/Types/GroupChat.php');
include('TelegramBot/Api/Types/Location.php');
include('TelegramBot/Api/Types/Message.php');
include('TelegramBot/Api/Types/PhotoSize.php');
include('TelegramBot/Api/Types/ReplyKeyboardHide.php');
include('TelegramBot/Api/Types/ReplyKeyboardMarkup.php');
include('TelegramBot/Api/Types/Sticker.php');
include('TelegramBot/Api/Types/User.php');
include('TelegramBot/Api/Types/UserProfilePhotos.php');
include('TelegramBot/Api/Types/Video.php');

syslog(LOG_DEBUG, '[' . getmypid() . '] - Peticion WebHook recibida desde ' . $_SERVER['REMOTE_ADDR']);

// Inicializar bot con el token
define(TOKEN, '456501628:AAFfwibamNRz29xANcXAGrNPwvf70kEtAU0');
$bot = new \TelegramBot\Api\BotApi(TOKEN);

$returnArray = true;
$rawData = file_get_contents('php://input');
$response = json_decode($rawData, $returnArray);

if (empty($rawData)) {
	syslog(LOG_ERR, '[' . getmypid() . '] Peticion incorrecta: no hay datos');
	exit(1);
}

try {
	$oMessage = \TelegramBot\Api\Types\Message::fromResponse($response['message']);
} catch (\TelegramBot\Api\InvalidArgumentException $e) {
	syslog(LOG_ERR, '[' . getmypid() . '] Error obteniendo mensajes (argumento invalido): ' . $e->getMessage() . ' - Rawdata: ' . $rawData);
}

$oUserFrom = $oMessage->getFrom();
$oChat = $oMessage->getChat();

$msg = 'Comando recibido [' . $oMessage->getText() . '] del usuario [' . $oUserFrom->getFirstName() . '] el [' . date('Y/m/d H:i:s', $oMessage->getDate()) . ']';
syslog(LOG_DEBUG, '[' . getmypid() . '] ' . $msg);

// Obtener comando (y sus posibles parametros)
$regExp = '#^(\/[a-zA-Z0-9\/]+?)(\ .*?)$#i';
$tmp = preg_match($regExp, $oMessage->getText(), $aResults);
if (isset($aResults[1])) {
	$cmd = trim($aResults[1]);
	$cmd_params = trim($aResults[2]);
} else {
	$cmd = trim($oMessage->getText());
	$cmd_params = '';
}

// Reply message data
$msg = array();
$msg['chat_id'] = $oChat->getId();
$msg['text'] = null;
$msg['disable_web_page_preview'] = true;
$msg['reply_to_message_id'] = $oMessage->getMessageId();
$msg['reply_markup'] = null;

// Comandos
switch ($cmd) {
	case '/start':
		$msg['text']  = 'Hola ' . $oUserFrom->getFirstName() . '!' . PHP_EOL;
		$msg['text'] .= '¿Qué puedo hacer por ti? Puedes ver una lista de las opciones disponibles con el comando /help';
		$msg['reply_to_message_id'] = null;
		break;

	case '/help':
		$msg['text']  = 'Los comandos disponibles son:' . PHP_EOL;
		$msg['text'] .= '/start Inicializa el bot';
		$msg['text'] .= '/fecha Muestra la fecha actual';
		$msg['text'] .= '/hora Muestra la hora actual';
		$msg['text'] .= '/help Muestra esta ayuda';
		$msg['reply_to_message_id'] = null;
		break;

	case '/fecha':
		$msg['text']  = 'La fecha actual es ' . date('d/m/Y');
		break;

	case '/hora':
		$msg['text']  = 'La hora actual es ' . date('H:i:s');
		break;

	default:
		$msg['text']  = 'Lo siento ' . $oUserFrom->getFirstName() . ', pero [' . $cmd . '] no es un comando válido.' . PHP_EOL;
		$msg['text'] .= 'Prueba /help para ver la lista de comandos disponibles';
		break;
}

try {
	syslog(LOG_DEBUG, '[' . getmypid() . '] Enviando mensaje de respuesta (' . strlen($msg['text']) . ' bytes) al usuario');
	$bot->sendMessage($msg['chat_id'], $msg['text'], $msg['disable_web_page_preview'], $msg['reply_to_message_id'], $msg['reply_markup']);
} catch (\TelegramBot\Api\Exception $e) {
	syslog(LOG_ERR, '[' . getmypid() . '] ERROR Exception al enviar el mensaje: ' . $e->getMessage());
	exit(1);
} catch (\TelegramBot\Api\InvalidArgumentException $e) {
	syslog(LOG_ERR, '[' . getmypid() . '] ERROR InvalidArgumentException al enviar el mensaje: ' . $e->getMessage());
	exit(1);
}

syslog(LOG_DEBUG, '[' . getmypid() . '] > Ejecucion del bot terminada correctamente!');

exit(0);