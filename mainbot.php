
<?php
include 'functions.php';
include 'textprocessing.php';
include 'varlist.php';

switch (limpiaTexto($message)) {
	
	case limpiaTexto("Hola");
	
	funcSaludo($chatId,$userName);
	
	
	break;
	
	case limpiaTexto("Quién es tu creador?");
	
	funcCreator($chatId);
	
	break;
	
	case "/github":
	
    funcGit($chatId);
	
	break;
	
	case limpiaTexto("/ping");
	    
	    msgPing($chatId);
	    
	break;
	    
	    /*esta es la forma de comprobar 3 cosas a la vez , por eso -> || <- no funcionaba*/
	 case limpiaTexto("Apuesto al rojo"):
	 case limpiaTexto("Apuesto al negro"):
	 case limpiaTexto("Apuesto al cero"):
	 case limpiaTexto("Apuesto al 0"):
	    
	    funcRuleta($chatId,$message,$userId);
	    
	    break;
	    
}

/* PRUEBAS  */

?>