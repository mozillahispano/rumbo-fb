<?
/*
* 2012 - Mozilla Hispano
*
* NOTICE OF LICENSE
*
* This source file is subject to the Creative Commons BY-SA 3.0 license.
* It is also available through the world-wide-web at this URL:
* http://creativecommons.org/licenses/by-sa/3.0/
*
*  @author Mozilla Hispano <tecnico@mozilla-hispano.org>
*  @version Release: $Revision: 149fb4220d78 $
*  @license http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons BY-SA 3.0
*/

/**
* Load Database and Facebook Configuration. 
* Die if config-sample.inc.php is not renamed 
*/
if (!file_exists(dirname(__FILE__).'config/config.inc.php'))
{
    die('Config.inc.php does not exist. Configure and rename \'config\'config-sample.inc.php'); 
else 
    require_once (dirname(__FILE__).'config/config.inc.php');
}

/**
* Get the UID of the connected user, or 0
* if the Facebook user is not connected.
*
* @return string the UID if available.
*/
$user = $facebook->getUser();
?> 

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo y los 100.000..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
    </head>
<body>

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
    <div id="contenedor-cabecera">
        <?php include 'cabecera.php'; ?>
    </div>

    <!-- Wrapper -->
    <div id="main" class="envoltura">
    	<aside>
    	   <!-- <h3>IMAGEN DE RUMBO</h3> -->
            <img src="img/mh-banner-v.png" width="250px" height="400px" />
        </aside>
        
    	<article>
            <div id="contenido">
    		  <p>¡Hola! Soy Rumbo y me gustaría que hicieses un viaje conmigo. Estamos muy cerca de conseguir 100.000 fans y queremos celebrarlo con todos vosotros.</p>
                <p>Cuando lleguemos a esa cifra mostraremos una página especial en Facebook y dedicaremos nuestro banner a ello. Tienes la oportunidad de que todo eso sea obra tuya.</p>
                <p> Envia tus diseños y, además de que los usen miles de personas en todo el mundo, podrás conseguir una camiseta oficial de Firefox</p>
            </div>    
            <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/cargar.php';" class="boton">Participar</a>
            <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/galeria.php';" class="boton">Ir a Galeria</a>
            <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/aprobacion.php';" class="boton">Aprobar</a>
            <a href="galeria.php" class="boton">Bases Legales</a>
    	</article>
    </div>

    <!-- Footer -->
    <div id="contenedor-footer">
    	<?php include 'pie.php';?>
    </div>
</body>
</html>
