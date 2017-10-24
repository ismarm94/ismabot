<?php

//Almacenamos el token del bot (el DNI del bot)

$bottoken = "456501628:AAFfwibamNRz29xANcXAGrNPwvf70kEtAU0";

//Ahorramos escribir parte de la petición con esta variable, ya que todas las peticiones HTTPS empiezan así

$website = 'https://api.telegram.org/bot'.$bottoken;

//Variables que obtienen resultados a raíz de la petición realizada

$fichero = 'dump.txt';

$update = file_get_contents('php://input');

file_put_contents('dump.txt', $update); //Vuelca el contenido recibido en un archivo

$update = json_decode($update, TRUE); //decodifica el json a un array dimensional

//Variables donde almacenaremos datos de utilidad (mensajes recibidos, nombre del chat, id del chat...)

$chatId = $update["message"]["chat"]["id"]; //ID del mensaje recibido

$message = $update["message"]["text"]; //Mensaje que ha sido enviado por el usuario

$messagedate = $update["message"]["date"]; //Fecha del mensaje

$messageId = $update["message"]["message_id"];

$messageName = $update["message"]["chat"]["first_name"];

$userId = $update["message"]["from"]["id"]; //Id del usuario que manda el mensaje

$userName = $update["message"]["from"]["username"];
?>