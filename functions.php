<?php
include "basedatos.php";
include "varlist.php";

//Funciones de respuesta del bot

function funcSaludo($chatId, $userName, $basicName) {
    
    if (isset($userName)) {

	 $message1 = "Hola!, @".$userName. " ¿Qué tal? \xF0\x9F\x98\x8A";
	
	sendMessage($chatId, $message1);

} else {
    
    	 $message1 = "Hola!, ".$basicName. " ¿Qué tal? \xF0\x9F\x98\x8A";
	
	sendMessage($chatId, $message1);
    
        }
	
                        }
                        
function funcDays($chatId, $userName, $basicName) {
    
        if (isset($userName)) {

	 $messageDay = "Buenos días! :D @".$userName;
	
	sendMessage($chatId, $messageDay);

} else {
    
    	 $messageDay = "Buenos días! :D, ".$basicName;
	
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

function funcCreator($chatId) {
    
    $message3 = "Mi creador es @Issma94! \xF0\x9F\x98\x8A";
    
    sendMessage($chatId, $message3);
    
}

function funcGit($chatId) {
    
   $message4 = "https://github.com/ismarm94/ismabot";
   
   sendMessage($chatId, $message4);
    
}

function whereIam($chatId, $chatName) {
    $nombre = rtrim($chatName, "_");

    /*$message5 = "-Estás en: ";//.$nombre. " \n -ID: ".$chatId;
    $message5 .= $nombre . "\n" ;
    
    
    $message5 .= "-ID: ".$chatId; */
    
    $message5 = "Estás en: ".$nombre."\n"."-ID: ".$chatId;
   
    sendMessage($chatId, $message5);
    
}

function sendMessage($chatId, $message) {

	$url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message";
	
	file_get_contents($url);

}

function deleteMessage($chatId, $messageId) {
    
    $url = "$GLOBALS[website]/deleteMessage?chat_id=$chatId&message_id=$messageId";
	
	file_get_contents($url);
    
}



function funcRuleta($chatId,$message,$userId,$conn,$cantidad,$userName,$basicName){
    
    
    
  
    $aleatorio = rand(0,36);
    
    
    $n1=0;
    if($aleatorio != 0) {
            
        if($aleatorio % 2==0){
             $n1=1;
        }
        else {
            $n1=2;
            
        }
    } else {
            
        $n1=3;
            
    }
    
    
    
    $message3="";
        //file_put_contents('dump2.txt', limpiaTexto($message));
        
        switch(limpiaTexto($message)) {
        
        case ((strpos(limpiaTexto($message),"/apuesto")!==FALSE) && (strpos(limpiaTexto($message),"rojo")!==FALSE));
        
        
        if ($n1 == 1) {
             if (isset($userName)) {
            
            $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB4 , @".$userName." ganó: ".($cantidad*2)." fichas.";
            $fichas = 1;
             }
            else{
                
            $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." ganó: ".($cantidad*2)." fichas.";
            $fichas = 1;
            }
            
        } else if ($n1 == 2) {
            
             if (isset($userName)) {

            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
             }
             else{
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0;
                 
             }
        } else {
            
            if (isset($userName)) {

            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
            }
            else{
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0;
            }
        }
	        break;
	        
	     case strpos(limpiaTexto($message),"/apuesto")!==FALSE && strpos(limpiaTexto($message),"negro")!==FALSE:
        if ($n1 == 1) {
            
        if (isset($userName)) {
            
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
        }
        else{
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0;
        }
            
        } else if ($n1 == 2) {
            
            if (isset($userName)) {
            
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , @".$userName." ganó: ".($cantidad*2)." fichas.";
            $fichas=1;
            }
            else{
                
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." ganó: ".($cantidad*2)." fichas.";
            $fichas=1;
            }
            
        } else {
            
            if (isset($userName)) {
            
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
            }
            else{
                
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0;
                
            }
            
        }
	        break;
	        
	     case strpos(limpiaTexto($message),"/apuesto")!==FALSE && strpos(limpiaTexto($message),"cero")!==FALSE:
	     
        if ($n1 == 1) {
            
            if (isset($userName)) {
            
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
            }
            else{
                
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4 , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0;   
            }
            
        } else if ($n1 == 2) {
            
            if (isset($userName)) {
         
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , @".$userName." perdió: ".$cantidad." fichas.";
            $fichas=0;
            }
            else{
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." perdió: ".$cantidad." fichas.";
            $fichas=0; 
            }
            
        } else {
            
            if (isset($userName)) {
                
            $cantidad = $cantidad*37;
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , @".$userName." ganó: ".$cantidad." fichas.";
            $fichas=1;
            
            }
            else{
                
            $cantidad = $cantidad*37;
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB , ".$basicName." ganó: ".$cantidad." fichas.";
            $fichas=1;   
            
            }
            
        }
	        
	        break;
	        
	   
    
        }
        
        //ignora los case referentes a cero/0 y no pasa de esta línea
        //file_put_contents('dump2.txt', limpiaTexto($message));
        
        
   
        
        sendMessage($chatId, $message3);
       
        if ($fichas==0){
            funcFallo($userId,$fichas,$conn,$cantidad);
        }
        else{
            funcAcierto($userId,$fichas,$conn,$cantidad);
        }
        
}

 function funcAcierto($userId,$fichas,$conn,$cantidad){
        
          $sql = "SELECT * FROM Identificacion WHERE id = ".$userId;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                $sql = "UPDATE Identificacion SET fichas = fichas + ".$cantidad." WHERE id = ".$userId;

            if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
            } else {
             echo "Error updating record: " . $conn->error;
            }
                
            }
            else{
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
 
 function funcFallo ($userId,$fichas,$conn,$cantidad){
     
      $sql = "SELECT * FROM Identificacion WHERE id = ".$userId;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                $sql = "UPDATE Identificacion SET fichas = fichas - ".$cantidad." WHERE id = ".$userId;

            if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
            } else {
             echo "Error updating record: " . $conn->error;
            }
                
            }
            else{
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
 
 function cuantasFichas($userId,$conn) {
    
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
 
 function noExiste ($userId,$conn) {
    
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
 
 function usuarioNuevoRuleta($userId,$conn){
     $sql = "INSERT INTO `Identificacion`(`id`, `fichas`) VALUES (".$userId.",600)";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
 }
 
 function apuestoSintaxis($chatId){
     
     sendMessage($chatId,"Para apostar escribe: /apuesto CANTIDAD COLOR");
 }
     
     
 



/* ESTOY INTENTANDO HACER QUE SE GUARDEN FICHAS PARA CADA UNO


*/
/*$sql = "INSERT INTO `Identificacion`(`id`, `fichas`) VALUES (".$userId.",600)";

if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
        
                
?>