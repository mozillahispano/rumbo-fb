 
<?php

require_once ('conexion.php');
require_once('facebook.php');



$facebook = new Facebook(array(
  'appId'  => '153053701464197',
  'secret' => '9faf86161ca03fd7a3def4c105a2c3c1',
));

// Get User ID
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

$urlAuth  =  "http://www.facebook.com/dialog/oauth?client_id=153053701464197&redirect_uri=http://apps.facebook.com/demorumbo/&scope=read_stream,user_status,publish_stream,email";
$signed_request = $_REQUEST['signed_request']; 

list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);


 
if ( empty ( $data['user_id'] ) ) 
{ 
  
 echo "<script language=javascript>window.open('$urlAuth', '_parent', '')</script>";
}else
{ 
?>
      
        <div id="contenedor-cabecera">
		<?php include 'cabecera.php'; ?>
	</div>
	<div id="main" class="envoltura">
		   <aside>
			 <h3>IMAGEN DE RUMBO</h3> 
                    
		</aside>
		<article>
                    <div id="contenido">
				
                                 <p><strong>¡Gracias por participar!</strong></p>
                                <p>Estamos revisando tus diseños. En breve podrás verlos publicados en una galería especial que hemos preparado. Los diseños más votados por vosotros serán los que podrán optar a ganar el concurso. ¡Suerte!</p>
                              
                                
                        </div>
                     <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/galeria.php';" class="boton">Ir a Galeria</a>
                     <a href="javascript:void(0);" onClick="history.back()" class="boton">Volver Atras</a>
                  
		</article>
	</div>
	<div id="contenedor-footer">
		<?php include 'pie.php'; ?>
	</div>

        
        
             
        
    </body>
<?php
} 

?>
    
    
</html>

