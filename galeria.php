<?php
/* Database Configuration */
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
$mostrar=$tra->mostrarImg();


?> 
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo | Galeria..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
        <link rel="stylesheet" href="css/reveal.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="js/jquery.reveal.js"></script>
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
	
            <article>
                
			
                        <ul class="lb-album">
                            <?php 
                            
                            for($i=0;$i<sizeof($mostrar);$i++)
                           { 
                            ?>
                            <li>
                            
                                <a href="#"  class="big-link" data-reveal-id="image-<?php  echo $mostrar[$i]["id_imagenes"]; ?>" data-animation="fade">
                                        <img src="portadas/thumbnail/<?php  echo $mostrar[$i]["nombre"]; ?>"  />

                                </a>

                                <div   class="reveal-modal"  id="image-<?php  echo $mostrar[$i]["id_imagenes"]; ?>" >

                                        <img src="portadas/<?php  echo $mostrar[$i]["nombre"]; ?>" width="851" height="315" />

                                        <div>
                                                    <?php  $autor = $facebook->api('/'.$mostrar_transito[$i]["uid"]); ?>
                                                    <h3><?php  echo $autor["name"];?> <span>Autor</h3>
                                                    <p><iframe src="https://www.facebook.com/plugins/like.php?href=https://apps.facebook.com/demorumbo/galeria.php?image-<?php echo $mostrar[$i]["id_imagenes"]; ?>" scrolling="no" frameborder="0" style="height: 42px; width: 240px" allowTransparency="true"></iframe>
                                                    </p>
                                                    <p>
                                                    <div id="fb-root"></div>
                                        <script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
                                        <fb:send href="https://apps.facebook.com/demorumbo/galeria.php?image-<?php  echo $mostrar[$i]["id_imagenes"]; ?>"></fb:send>  
                                                    </p>
                                    </div>
                                        <a class="close-reveal-modal">&#215;</a>
                                          
                                </div>
                            
                            </li>
                         
                            <?php
                            }
                            ?>
                      </ul>                          
        
            </article>
             
        </section>
       
        
    </body>
<?php

} 

?>
    
    
</html>


