<?php

// Inicializar bot con el token
$bottoken = "456501628:AAFfwibamNRz29xANcXAGrNPwvf70kEtAU0" ;

$website = "https://api.telegram.org/bot".$bottoken;

$update = file_get_contents("php://input");

$updateArray = json_decode($update, TRUE);

$chatId = $updateArray["message"]["chat"]["id"];

file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=test");

