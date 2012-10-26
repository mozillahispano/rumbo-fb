<?php
/* Database Configuration. Die if config-sample.php is not renamed.*/
require_once (dirname(__FILE__).'/config/config-sample.php');

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
    $mostrar_transito=$tra->mostrarTransito();
    if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
        {
    
        $tra->aprobarImagenes();
    exit;
    }  
?> 
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo | Aprobar..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
        
    </head>
    <body>
        <section>
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
      
        <header>
		<?php include 'cabecera.php'; ?>
	</header>
	<section>
		   
		 <ul id="album">
                            <?php 
                            
                            for($i=0;$i<sizeof($mostrar_transito);$i++)
                            { 
                            ?>
                            
                            <li>
                                <div id="detalle">
                                    <?php  $autor = $facebook->api('/'.$mostrar_transito[$i]["uid"]); ?>
                                     <h3> Por:<?php  echo $autor["name"];?></h3>
                                </div>
                          
                                
                              <img src="portadas/<?php echo $mostrar_transito[$i]["nombre"]; ?>" /> 
                                <div id="social">
                                     <ul>
                                         <li>
                                             <form  name="form" action="" method="post">
                                    <input type="hidden" name="id" value='<?php echo $mostrar_transito[$i]["id_imagenes"]; ?>' />
                                    <input type="hidden" name="grabar" value="si"/>
                                    <input type="submit" class="boton" value="Aprobar" />   
                                </form>    
                                         </li>
                                         
                                          
                                           
                                     </ul> 
                                </div>
                                
                                
                                
                               </li> 
                               <?php

                            } 

                                ?>
                               
                               </ul>
        
        </section>
<?php  } ?>        
    </body>

    
    
</html>


