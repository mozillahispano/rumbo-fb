<?php
/* Database Configuration. Die if config-sample.php is not renamed.*/
require_once (dirname(__FILE__).'/config/config.php');

/* Facebook API */
require_once(dirname(__FILE__).'/config/facebook.php');

/* Functions */
require_once (dirname(__FILE__).'/util/funciones.php');


/* Define your Facebook appID and secret key */ 
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

$tra= new Trabajo;
$mostrar_transito=$tra->mostrar_transito();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
    {
   // print_r($_POST);
    $tra->aprobar_imagenes();
   exit;
}
?> 
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo y los 100.000..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
        <script src="js/validacion.js" type="text/javascript"></script>
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
			<!--  <h3>IMAGEN DE RUMBO</h3> -->
                       <img src="img/mh-banner-v.png" width="250px" height="400px" /> 
		</aside>
		<article>
                    <div id="contenido">
			
                        <ul class="album">
                            <?php 
                            
                            for($i=0;$i<sizeof($mostrar_transito);$i++)
                            {
                            ?>
                            
                            <li>
                                                <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/aprobacion.php?#image-<?php echo $mostrar_transito[$i]['id_imagenes'];  ?>'">
                                                        <img src="img/<?php echo $mostrar_transito[$i]["imagen"]; ?>" width="150" height="150"/>
							 <?php
                                                       $autor = $facebook->api('/'.$mostrar[$i]["uid"]);
                                                        ?>
							<span>Elaborado Por:<?php  echo $autor["name"];?></span>
                                                 
						</a>
                                <form  name="form" action="" method="post">
                                    <input type="hidden" name="id" value='<?php echo $mostrar_transito[$i]["id_imagenes"]; ?>' />
                                    <input type="hidden" name="grabar" value="si"/>
                                    <input type="submit" value="Aprobar" />   
                                </form>
                                                
						<div class="superposicion" id="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/aprobacion.php?image-<?php echo $mostrar_transito[$i]["id_imagenes"];  ?>'">
						<img src="img/<?php echo $mostrar_transito[$i]["imagen"]; ?>" width="350" height="550"/>	
                                                   
							<div>
								<h3><?php  echo $autor["name"];?></h3>
								<p> xxxx <?php echo $mostrar_transito[$i]["descripcion"]; ?></p>
								
							</div>
							<a href="#page" class="lb-close">Cerrar</a>
						</div>
                                
                                
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        
                        
                       
			
                    </div>
                 
		</article> 
            <a href="#" class="boton">Volver Atras</a>
	</div>
	<div id="contenedor-footer">
		<?php include 'pie.php'; ?>
	</div>

        
        
             
        
    </body>
<?php

 } 

?>
    
    
</html>

