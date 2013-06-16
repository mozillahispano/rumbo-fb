<<?php 
 /* Database Configuration */
require_once (dirname(__FILE__).'/config/config-sample.php');

/* Facebook API */
require_once(dirname(__FILE__).'/config/facebook.php');

/* Functions */
require_once (dirname(__FILE__).'/util/funciones.php');

/* <?php Define your Facebook appID and secret key */ 
  $facebook = new Facebook (
    array(
    'appId'  => '153053701464197',
    'secret' => '9faf86161ca03fd7a3def4c105a2c3c1',
    )
);

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
        <title>..::Rumbo | Gracias ..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
        
    </head>
    <body>
    <section>
        <?php

$urlAuth  =  "http://www.facebook.com/dialog/oauth?client_id=153053701464197&redirect_uri=http://apps.facebook.com/demorumbo/&scope=read_stream,user_status,publish_stream,email";
$signed_request = isset($_REQUEST['signed_request']) ? $_REQUEST['signed_request'] : '.';

list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);


 
if ( empty ( $data['user_id'] ) ) 
{ 
  
 echo "<script language=javascript>window.open('$urlAuth', '_parent', '')</script>";
}else
{  
?>
      
        <header>
		<?php include 'cabecera.php'; ?>
	</header>
	<section id="carga">
		   <article>
			  <img src="images/gracias.png" /> 
                    
		</article>
		<article class="ancho">
                    
				
                                 <h3><strong>¡Gracias por participar!</strong></h3>
                                <p>Estamos revisando tu diseño. En breve podrás verlo publicado en una galería especial que hemos preparado. Los diseños más votados por los participantes serán los que podrán optar a ganar la camiseta. ¡Suerte!</p>
                                <p>Este concurso está hecho por la Comunidad de voluntarios de Mozilla Hispano</p>
                                <p>¿Quieres Conocernos? Únete y colabora con nosotros<p>
                                <ul>
                                    
                                    <li><a href="https://www.mozilla-hispano.org/documentacion/Colabora" target="_blank" class="boton">Colabora</a></li>
                                    <li><a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/galeria.php';" class="boton">Galeria</a></li> 
                     
                                </ul>         
                                
                        
                  
                    
                  
		</article>
	</section>
	

        
        
             
    </section>
    </body>
<?php
} 

?>
    
    
</html>


