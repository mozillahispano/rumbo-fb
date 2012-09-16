<?php

if (!file_exists(dirname(__FILE__).'config/config.inc.php'))
{
    die('Config.inc.php does not exist. Configure and rename \config\'config-sample.inc.php'); 
else 
    require_once (dirname(__FILE__).'config/config.inc.php');
}


$user = $facebook->getUser(); 
 ?> 

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo y los 200.000::..</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
     
    </head>
<body>
    <section>
    <?php
        /* Request for user permissions */
      $urlAuth  =  "http://www.facebook.com/dialog/oauth?client_id=153053701464197&redirect_uri=http://apps.facebook.com/demorumbo/&scope=read_stream,user_status,publish_stream,email";
        $signed_request = $_REQUEST['signed_request']; 

        list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
        $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
         
        if (empty ($data['user_id'])) 
            {
                echo "<script language=javascript>window.open('$urlAuth', '_parent', '')</script>";
        }               
    ?>  

    <!-- Header -->
    <header>
        <?php include 'cabecera.php'; ?>
  
    </header>
    <!-- Contenido -->
    <section id="contenido">    
        <article class="borde">
            <h3>¡Hola Amigos!</h3>
             <p>¡Hola! Soy Rumbo y me gustaría que hicieses un viaje conmigo. <p>
             <p>Quiero celebrar con todos ustedes los 200.000 fans de nuestra p&aacute;gina en Facebook.</p>  
       </article>
    
    
    	<article>
    	   
            <img src="images/rumbo.png" width="250px" height="250px" />
        </article>
        
    	<article class="borde">
            <h3>Participar tiene premios</h3>
             <p>An&iacute;mate y participa en nuestro concurso.</p>
             <p>Env&iacute;a tus diseños y, además de que los usen miles de personas, podrás conseguir una camiseta oficial de Firefox.</p>
       </article>
    </section>    
        <ul>
         <!--     <li><a href="cargar.php" class="boton" >Participar</a></li>
              <li><a href="galeria.php" class="boton">Galeria</a> </li>
              <li><a href="aprobacion.php" class="boton" >Aprobar</a> </li> -->
             
            <li>   <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/cargar.php';" class="boton">Participar</a>  </li>
          <li> <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/galeria.php';" class="boton">Galeria</a> </li>
            <li> <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/aprobacion.php';" class="boton">Aprobar</a> </li>
                
        </ul>

    
    </section>
</body>
</html>
