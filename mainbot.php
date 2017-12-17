<?php

    include 'functions.php';
    
    include 'textprocessing.php';
    
    include 'varlist.php';
    
    include 'basedatos.php';

//obtenemos la ultima palabra cuando el usuario apuesta, para comprobar que el comando no tiene errores de sintaxis

    $ultimaPalabra = substr(limpiaTexto($message),strrpos(limpiatexto($message)," ")+1,strlen($message));

        switch (limpiaTexto($message)) {
	
	        case limpiaTexto("Hola");
	        
	    case limpiaTexto("buenas");
	    
	    case limpiaTexto("hey");
	    
	    case limpiaTexto("hi");
	    
	    case limpiaTexto("hello");
	
	        funcSaludo($chatId, $userName, $basicName);
	
	    break;

	    case limpiaTexto("buenos dias");
	
	        funcDays($chatId, $userName, $basicName);
	
	    break;
	
	    case limpiaTexto("buenas tardes");
	
	        funcAfternoon($chatId, $userName, $basicName);
	
	    break;
	
	    case limpiaTexto("buenas noches");
	
	        funcNight($chatId, $userName, $basicName);
	
	    break;
	
	    case limpiaTexto("Quien es tu creador?");
	
	        funcCreator($chatId);
	
    	break;
    	
    	case limpiaTexto("adios"):
    	    
    	    respUsr($chatId, $messageId);
    	   
    	break;
	
	    case limpiaTexto("/github"):
	
            funcGit($chatId);
	
	    break;
	
	    case limpiaTexto("/ping");
	    
	        msgPing($chatId);
	    
	    break;
	
	    case limpiaTexto("donde estoy?");
	
	        whereIam($chatId, $chatName, $typeGroup);
	    
	    break;
	
	    case limpiaTexto("/apuesto"):
	        
	    case limpiaTexto("/apuesta"):
	        
	    case limpiaTexto("/apostar"):
	    
	        sendMessage($chatId, "La sintaxis para apostar es: /apuesto CANTIDAD COLOR/cero");
	    
	    break;
	    
	    case limpiaTexto("!fichas"):
	  
	        if (strcmp($existencia, "") == 0){
	            
	            usuarioNuevoRuleta($userId, $conn);
	    
	                if (isset($userName)) {
	                    
	                    sendMessage($chatId,"Hola @".$userName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	                    
	               }  
	               
	                else {
	            
	                    sendMessage($chatId,"Hola ".$basicName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	                 }
	        
	    }
	    
	    else {
	        
	        if ( $saldo == 0 ){
	            
	            if (isset($userName)) {
	                
	                sendMessage($chatId,"@".$userName.", tienes ".$saldo." fichas, habla con @Issma94 para que te de fichas.");
	                
	                } 
	                
	            else {
	            
	                sendMessage($chatId,$basicName.", tienes ".$saldo." fichas, habla con @Issma94 para que te de fichas.");
	                }
	                
	    }
	    
	            else if ( $saldo > 0 ) {
	                
    	    if (isset($userName)) {
    	        
    	    sendMessage($chatId,"El usuario: @".$userName.", tiene: ".$saldo." fichas.");
    	    
    	    }
    	    
    	    else {
    	        
    	    sendMessage($chatId,"El usuario: ".$basicName.", tiene: ".$saldo." fichas.");
    	    
    	        }
    	        
	        }
	        
	    }
	    
	        break;
	    
	 case (strpos(limpiaTexto($message), "/apuesto")!==FALSE) && (strpos(limpiaTexto($message), "rojo")!==FALSE) && strcmp($ultimaPalabra, "rojo") == 0 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $message)==TRUE && is_numeric($cantidad):
	    
	     if (strcmp($existencia, "") == 0) {
	         
	        usuarioNuevoRuleta($userId, $conn);
	    
	        if (isset($userName)) {
	            
	            sendMessage($chatId,"Hola @".$userName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId,$message,$userId,$conn,$cantidad,$userName,$basicName);
	            
	        }
	        
	        else {
	            
	            sendMessage($chatId,"Hola ".$basicName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	            
	        }
	        
	    }
	    
	    else {
	     
	     if (($saldo-$cantidad) >= 0) {
	         
	         funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	         
	     }
	     
	     else {
	         
	         $noItem = "No tienes tantas fichas";
	         
	         replyMessage($chatId, $noItem, $messageId);
	         
	           }
	     
	    }
	    
	     break;
	     
	     case (strpos(limpiaTexto($message), "/apuesto")!==FALSE) && (strpos(limpiaTexto($message), "negro")!==FALSE) && strcmp($ultimaPalabra, "negro") == 0 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $message)==TRUE && is_numeric($cantidad):
	     
	     if ( strcmp($existencia,"") == 0 ) {
	         
	    usuarioNuevoRuleta($userId, $conn);
	    
	        if (isset($userName)) {
	            
	            sendMessage($chatId,"Hola @".$userName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	            
	        }
	        
	        else {
	            
	            sendMessage($chatId,"Hola ".$basicName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	            
	        }
	        
	    }
	    
	    else {
	     
	     if (($saldo-$cantidad) >=0 ){
	         
	         funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	         
	     }
	     
	     else{
	         $noItem = "No tienes tantas fichas";
	         replyMessage($chatId, $noItem, $messageId);
	         //sendMessage($chatId, "No tienes tantas fichas");
	         
	        }
	        
	   }
	    
	     break;
	     
	     case (strpos(limpiaTexto($message), "/apuesto")!==FALSE) && (strpos(limpiaTexto($message), "cero")!==FALSE) && strcmp($ultimaPalabra, "cero") == 0 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $message)==TRUE && is_numeric($cantidad):
	     
	      if (strcmp($existencia,"") == 0) {
	          
	    usuarioNuevoRuleta($userId, $conn);
	    
	        if (isset($userName)) {
	            
	            sendMessage($chatId,"Hola @".$userName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	            
	        }
	        
	        else {
	            
	            sendMessage($chatId,"Hola ".$basicName.", veo que eres nuevo, se te han aÃ±adido: 600 fichas.");
	            
	            funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	            
	        }
	        
	    }
	    
	    else {
	     
	     if (($saldo-$cantidad) >=0 ){
	         
	         funcRuleta($chatId, $message, $userId, $conn, $cantidad, $userName, $basicName);
	         
	     }
	     
	     else {
	         $noItem = "No tienes tantas fichas";
	         replyMessage($chatId, $noItem, $messageId);
	         //sendMessage($chatId, "No tienes tantas fichas");
	         
	     }
	     
	    }
	      
	     break;
	     
	     case limpiaTexto("/fecha"):
	         
	         $messageDate = "\xF0\x9F\x93\x86 Fecha: ".$date;
	         
	            sendMessage($chatId, $messageDate);
	         
	     break;
	         
	     // Manda gifs
	     
	     case limpiaTexto("/imagen"):
	         
	         sendIMG($chatId, $img);
	         
	     break;
	         
}

?>
