<?php

include('TelegramBot/Api/BotApi.php');
include('TelegramBot/Api/Exception.php');
include('TelegramBot/Api/InvalidArgumentException.php');
include('TelegramBot/Api/BaseType.php');

// Inicializar bot con el token
define(TOKEN, '456501628:AAFfwibamNRz29xANcXAGrNPwvf70kEtAU0');
$bot = new \TelegramBot\Api\BotApi(TOKEN);

// Activar Webhook
define(URL_BOT, 'https://localhost/cliente/ismabot/mainbot.php');
$result = $bot->setWebhook(URL_BOT);

if ($result)
	echo 'Webhook registrado correctamente';
	else
		echo 'Error al registrar el Webhook';