<?php

//Almacenamos el token del bot (el DNI del bot)

$bottoken = "456501628:AAFfwibamNRz29xANcXAGrNPwvf70kEtAU0";

//Ahorramos escribir parte de la petición con esta variable, ya que todas las peticiones HTTPS empiezan así

$website = 'https://api.telegram.org/bot'.$bottoken;

//Variables que obtienen resultados a raíz de la petición realizada

$fichero = 'dump.txt';

$update = file_get_contents('php://input');

file_put_contents($fichero, $update); //Vuelca el contenido recibido en un archivo

$update = json_decode($update, TRUE); //decodifica el json a un array dimensional

//Variables donde almacenaremos datos de utilidad (mensajes recibidos, nombre del chat, id del chat...)

$chatId = $update["message"]["chat"]["id"]; //ID del mensaje recibido

$chatName = $update["message"]["chat"]["title"]; //Nombre del chat/grupo

$message = $update["message"]["text"]; //Mensaje que ha sido enviado por el usuario

$messagedate = $update["message"]["date"]; //Fecha del mensaje

$messageId = $update["message"]["message_id"]; //ID del mensaje recibido

$basicName = $update["message"]["from"]["first_name"]; //nombre del usuario que envía el mensaje

$userId = $update["message"]["from"]["id"]; //Id del usuario que manda el mensaje

$userName = $update["message"]["from"]["username"]; //alias del usuario que envia el mensaje

//inicializamos fichas para poder almacenar en ella despues las fichas del usuario actual


$fichas = 0;

// obtenemos el saldo del usuario actual


$saldo = cuantasFichas($userId,$conn);

//obtenemos la cantidad apostada por el usuario

$cantidad = substr($message,strpos($message," ")+1,(strrpos($message," ")-1)-strpos($message," "));

// variable para comprobar si el usuario existe

$existencia = noExiste($userId,$conn);

?>