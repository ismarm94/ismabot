<?php

    include "basedatos.php";
    
    include "varlist.php";

//Funciones de respuesta del bot

    function funcSaludo($chatId, $userName, $basicName) {
    
        if (isset($userName)) {

	        $message1 = "Â¡Hola!, @".$userName. " Â¿QuÃ© tal? \xF0\x9F\x98\x8A";
	
	            sendMessage($chatId, $message1);

            } else {
    
    	        $message1 = "Hola!, ".$basicName. " Â¿QuÃ© tal? \xF0\x9F\x98\x8A";
	
	                sendMessage($chatId, $message1);
    
            }
	
                        }
                        
    function funcDays($chatId, $userName, $basicName) {
    
        if (isset($userName)) {

	        $messageDay = "Buenos dÃ­as! :D @".$userName;
	
	            sendMessage($chatId, $messageDay);

        } else {
    
    	    $messageDay = "Buenos dÃ­as! :D, ".$basicName;
	
	            sendMessage($chatId, $messageDay);
    
            }

    }

    function funcAfternoon($chatId, $userName, $basicName) {
    
        if (isset($userName)) {

	        $messageAft = "Buenas tardes! :) @".$userName;
	
	            sendMessage($chatId, $messageAft);

        } else {
    
    	    $messageAft = "Buenas tardes! :) ".$basicName;
	
	            sendMessage($chatId, $messageAft);
    
        }
    
    }

    function funcNight($chatId, $userName, $basicName) {
    
        if (isset($userName)) {

	        $messageNight = "Buenas noches! descansa! @".$userName;
	
	            sendMessage($chatId, $messageNight);

        } else {
    
    	    $messageNight = "Buenas noches!, descansa! ".$basicName;
	
	            sendMessage($chatId, $messageNight);
    
        }
    
    } 

    function msgPing($chatId){
    
        $message2 = "Estoy vivo!";
    
            sendMessage($chatId, $message2);
    
    }
    
    function respUsr($chatId, $messageId) {
        
            $messageResp1 = "Hasta luego!";
            
            replyMessage($chatId, $messageResp1, $messageId);
        
    }

    function funcCreator($chatId) {
    
        $message3 = "Mi creador es @Issma94! \xF0\x9F\x98\x8A";
    
            sendMessage($chatId, $message3);
    
    }

    function funcGit($chatId) {
    
        $message4 = "https://github.com/ismarm94/ismabot";
   
            sendMessage($chatId, $message4);
    
    }

    function whereIam($chatId, $chatName, $typeGroup) {
    
        if ($typeGroup != "private") {
            
            $nombre = rtrim($chatName, "_");
    
            $message5 = "EstÃ¡s en: \n\xE2\x96\xB6 ".$nombre."\n\xF0\x9F\x86\x94 ".$chatId;
    
            $message5encoded = urlencode ( $message5 );
   
                sendMessage($chatId, $message5encoded);
    
        } else {
        
        $message5err = "No estÃ¡s en un grupo!";
        
            sendMessage($chatId, $message5err);
        
        }
    
    }

    function sendMessage($chatId, $message) {

	    $url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message";
	
	        file_get_contents($url);

    }

    function deleteMessage($chatId, $messageId) {
    
        $url = "$GLOBALS[website]/deleteMessage?chat_id=$chatId&message_id=$messageId";
	
	        file_get_contents($url);
    
    }
    
    function replyMessage($chatId, $message, $messageId) {

	   $url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message&reply_to_message_id=$messageId";
	
	       file_get_contents($url);

    }



    function funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName){
        
   //si lo que introducimos no contiene /apuesto al principio, destruye el proceso
   
        if (substr(limpiaTexto($message) , 0 , 8)!=limpiaTexto("/apuesto")){
            
            die();
            
        } else {
            
            //creacion de numero aleatorio
            
            $aleatorio = rand(0, 36);
            
            $n1=0;
            
            if($aleatorio != 0) {
            
             if($aleatorio % 2 == 0) {
                 
                $n1 = 1;
                
                } else {
                    
                    $n1 = 2;
            
                }
                
            } else {
            
                $n1 = 3;
            
            }
            
                //Valor de salida de la ruleta, en cada caso se le agrega el valor correspondiente.
                
                 $message3="";
        
        switch(limpiaTexto($message)) {
            
        //si el mensaje contiene /apuesto al principio y rojo al final ejecuta la funcion, es para evitar que se introduzca cualquier otra cosa
        
            case ((strpos(limpiaTexto($message), "/apuesto") !== FALSE) && (strpos(limpiaTexto($message), "rojo") !== FALSE));
        
        //asigna el mensaje correspondiente en cada caso
        
        if ($n1 == 1) {
            
           if (isset($userName)) {
            
                $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB4 , @".$userName." ganÃ³: ".($cantidad*2)." fichas.";
            
            //Es una variable global para saber si el usuario ha acertado o no (1->si,0->no)
            
                $fichas = 1;
            
            }
            
            else {
                
                $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." ganÃ³: ".($cantidad*2)." fichas.";
            
                $fichas = 1;
            
            }
            
        } else if ($n1 == 2) {
            
             if (isset($userName)) {

                $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
            
             }
             
             else {
                 
                $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
                 
             }
             
        } else if ($n1 == 0) {
            
            if (isset($userName)) {

                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB5 , @".$userName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
            
            } else {
                
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB5 , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
            
            }
            
        }
        
	        break;
	        
	        //si el mensaje contiene /apuesto al principio y cero al final ejecuta la funcion, es para evitar que se introduzca cualquier otra cosa
	        
	     case strpos(limpiaTexto($message), "/apuesto") !== FALSE && strpos(limpiaTexto($message), "negro") !== FALSE:
	         
	         //asigna el mensaje correspondiente en cada caso
	         
        if ($n1 == 1) {
            
            if (isset($userName)) {
            
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , @".$userName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0;
                
            } else {
                
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
            
            }
            
        } else if ($n1 == 2) {
            
            if (isset($userName)) {
            
                $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , @".$userName." ganÃ³: ".($cantidad*2)." fichas.";
            
                $fichas = 1;
                
            } else {
                
                $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." ganÃ³: ".($cantidad*2)." fichas.";
            
                $fichas = 1;
            
            }
            
        } else {
            
            if (isset($userName)) {
            
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB5 , @".$userName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0;
            } else {
                
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB5 , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0;
                
            }
            
        }
	        break;
	        
	        //si el mensaje contiene /apuesto al principio y cero al final ejecuta la funcion, es para evitar que se introduzca cualquier otra cosa
	        
	     case strpos(limpiaTexto($message),"/apuesto")!==FALSE && strpos(limpiaTexto($message),"cero")!==FALSE:
	         
	     //asigna el mensaje correspondiente en cada caso
	     
        if ($n1 == 1) {
            
            if (isset($userName)) {
            
                $message3 = "Fallaste! ".$aleatorio."   \xF0\x9F\x94\xB4 , @".$userName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0;
            }
            else{
                
                $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0;   
            }
            
        } else if ($n1 == 2) {
            
            if (isset($userName)) {
         
                $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdiÃ³: ".$cantidad." fichas.";
            
                $fichas = 0;
            
            } else {
                
                $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdiÃ³: ".$cantidad." fichas.";
                
                $fichas = 0; 
                
            }
            
        } else {
            
            if (isset($userName)) {
                
                $cantidad = $cantidad*37;
                
                $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB5 , @".$userName." ganÃ³: ".$cantidad." fichas.";
                
                $fichas = 1;
            
            } else {
                
                $cantidad = $cantidad*37;
                
                $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB5 , ".$basicName." ganÃ³Â³: ".$cantidad." fichas.";
                
                $fichas = 1;   
            
            }
            
        }
	        
	        break;
	        
        }
        
            sendMessage($chatId, $message3);
            
       //en caso de fallar (fichas==0) ejecuta la funcion de fallo
       
        if ($fichas == 0){
            
            funcFallo($userId, $fichas, $conn, $cantidad);
            
        }
        //en caso de acierto, ejecuta la funcion de acierto
        else {
            
            funcAcierto($userId, $fichas, $conn, $cantidad);
            
        }
        
    }
    
}
    
 function funcAcierto($userId, $fichas, $conn, $cantidad){
        //buscamos que exista el usuario dentro de la base de datos
        
          $sql = "SELECT * FROM Identificacion WHERE id = ".$userId;
            $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                
                    //actualiza las fichas del usuario que ha apostado
                    $sql = "UPDATE Identificacion SET fichas = fichas + ".$cantidad." WHERE id = ".$userId;

                    if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
                    
                    } else {
                        
             echo "Error updating record: " . $conn->error;
             
                    }
                
                }
                
            //si el usuario no existe, se le aÃ±ade a la tabla y se le aÃ±aden fichas, despues se le dan las fichas ganadas
            
            else {
                
                 $sql = "INSERT INTO `Identificacion`(`id`, `fichas`) VALUES (".$userId.",600)";

                    if ($conn->query($sql) === TRUE) {
                        
                        echo "New record created successfully";
                        
                    } else {
                        
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        
                            }
                            
                $sql = "UPDATE Identificacion SET fichas = fichas +".$cantidad."  WHERE id = ".$userId;

            if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
            
                } else {
                    
                 echo "Error updating record: " . $conn->error;
                 
                        }
                        
            }
            
    }
 
 function funcFallo ($userId, $fichas, $conn, $cantidad) {
     
     //buscamos que exista el usuario dentro de la base de datos
     
            $sql = "SELECT * FROM Identificacion WHERE id = ".$userId;
            
            $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                
                    $sql = "UPDATE Identificacion SET fichas = fichas - ".$cantidad." WHERE id = ".$userId;

                    if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
                    
                        } else {
                            
             echo "Error updating record: " . $conn->error;
             
                        }
                
                } else {
                    
                //si el usuario no existe, se le aÃ±Â±ade a la tabla y se le aÃ±aden fichas, despues se le quitan las fichas apostadas
                
                 $sql = "INSERT INTO `Identificacion`(`id`, `fichas`) VALUES (".$userId.",600)";

                    if ($conn->query($sql) === TRUE) {
                        
                        echo "New record created successfully";
                        
                    } else {
                        
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        
                    }
                    
                $sql = "UPDATE Identificacion SET fichas = fichas".$cantidad." WHERE id = ".$userId;

                    if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
            
                    } else {
                    
                        echo "Error updating record: " . $conn->error;
                        
                    }
                    
                }
     
    }
 
 function cuantasFichas($userId, $conn) {
     
    //comprobacion de la cantidad de fichas que tiene un usuario
    
    $texto;
     
    $sql = "SELECT fichas FROM Identificacion WHERE id = ".$userId;
    
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            // output data of each row
            
            while($row = $result->fetch_assoc()) {
        
                return $row["fichas"];
                
            }

        }

 }
 
 function noExiste ($userId, $conn) {
    
    $texto;
     
    $sql = "SELECT id FROM Identificacion WHERE id = ".$userId;

    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
    // output data of each row
    
            while($row = $result->fetch_assoc()) {
        
                return $row["id"];
         
            }

        }

 }
 
 function usuarioNuevoRuleta($userId, $conn) {
     
     $sql = "INSERT INTO `Identificacion`(`id`, `fichas`) VALUES (".$userId.",600)";

        if ($conn->query($sql) === TRUE) {
            
            echo "New record created successfully";
            
            } else {
                
            echo "Error: " . $sql . "<br>" . $conn->error;
            
            }
            
 }
 
 function apuestoSintaxis($chatId) {
     
     sendMessage($chatId, "Para apostar escribe: /apuesto CANTIDAD COLOR");
     
 }
 
 function sendIMG($chatId, $img) {
    
    $numberRand = rand ( 1 , 3 );
    
    $img = array("https://media.giphy.com/media/7xkxbhryQO7hm/giphy.gif","https://media.giphy.com/media/OQkOBxMNv0bqU/giphy.gif","https://thumbs.gfycat.com/KindlyExaltedBellsnake-max-1mb.gif");
    
    $url = "$GLOBALS[website]/sendDocument?chat_id=$chatId&document=$img[$numberRand]";
   
	    file_get_contents($url);
    
 }

?>
