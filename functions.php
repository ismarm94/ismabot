<?php
include "basedatos.php";
include "varlist.php";
$fichas = 0;
//Funciones de respuesta del bot

function funcSaludo($chatId, $userName) {
	
	 $message1 = "Hola!, @".$userName. " ¿Qué tal? \xF0\x9F\x98\x8A";
	
	sendMessage($chatId, $message1);
	
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

function sendMessage($chatId, $message) {

	$url = "$GLOBALS[website]/sendMessage?chat_id=$chatId&text=$message";
	
	file_get_contents($url);

}

function funcRuleta($chatId,$message,$userId){
    
    
    
  /*generacion de aleatorio*/
    $aleatorio = rand(0,36);
    
    /*Comprobacion de respuesta para saber si es par, impar o 0, 
    mas adelante le asignaremos a cada uno su color correspondiente*/
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
        $fichero = 'dump2.txt';
        
        /*switch comprobando si es par->rojo, impar->negro o 0->cero, 
         en caso contrario nos devuelve el error y cual habria sido la respuesta correcta*/
        switch(limpiaTexto($message)) {
        
        case limpiaTexto("apuesto al rojo");
        
        
        if ($n1 == 1) {
            //file_put_contents('dump2.txt', "estoy en rojo ok!");
            $message3 = "Has acertado! ".$aleatorio." \xF0\x9F\x94\xB4";
            $fichas = 1;
            
        } else if ($n1 == 2) {
            //file_put_contents('dump2.txt', "estoy en rojo zona negra");
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=0;
        } else {
            //file_put_contents('dump2.txt', "estoy en rojo en 0");
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=0;
        }
	        break;
	        
	     case limpiaTexto("apuesto al negro");
        if ($n1 == 1) {
            //file_put_contents('dump2.txt', "estoy en negro rojo");
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4";
            $fichas=0;
            
        } else if ($n1 == 2) {
         //file_put_contents('dump2.txt', "estoy en negro ok!");
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=1;
            
        } else {
            //file_put_contents('dump2.txt', "estoy en negro cero");
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=0;
            
        }
	        break;
	        
	     case limpiaTexto("apuesto al cero"):
	     case limpiaTexto("apuesto al 0"):
        if ($n1 == 1) {
            
            $message3 = "Fallaste! ".$aleatorio." \xF0\x9F\x94\xB4";
            $fichas=0;
            
        } else if ($n1 == 2) {
         
            $message3 = "Fallaste! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=0;
            
        } else {
            
            $message3 = "Has acertado! ".$aleatorio." \xE2\x9A\xAB";
            $fichas=1;
            
        }
	        
	        break;
	        
	   
    
        }
        
        //ignora los case referentes a cero/0 y no pasa de esta línea
        file_put_contents('dump2.txt', limpiaTexto($message));
        
        
   
        
        sendMessage($chatId, $message3);
        
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
        if ($fichas==0){
            $sql = "SELECT * FROM Identificacion WHERE id = ".$userId;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                $sql = "UPDATE Identificacion SET fichas = fichas-100 WHERE id = ".$userId;

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
                $sql = "UPDATE Identificacion SET fichas = fichas-100 WHERE id = ".$userId;

            if ($conn->query($sql) === TRUE) { echo "Record updated successfully";
                } else {
                 echo "Error updating record: " . $conn->error;
            }
                }
            }
        
                else{
                    
                }
                
?>