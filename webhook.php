<?php

include('TelegramBot/Api/BotApi.php');
include('TelegramBot/Api/Exception.php');
include('TelegramBot/Api/InvalidArgumentException.php');
include('TelegramBot/Api/BaseType.php');

// Inicializar bot con el token
define(TOKEN, '');
$bot = new \TelegramBot\Api\BotApi(TOKEN);

// Activar Webhook
define(URL_BOT, '');
$result = $bot->setWebhook(URL_BOT);

if ($result)
	echo 'Webhook registrado correctamente';
	else
		echo 'Error al registrar el Webhook';
