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
$mostrar=$tra->mostrar_img();


?> 
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo | Galeria..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
       <link href='http://fonts.googleapis.com/css?family=Lemon' rel="stylesheet" />
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
                    
			
                        <ul id="album">
                            <?php 
                            
                            for($i=0;$i<sizeof($mostrar);$i++)
                            { 
                            ?>
                            
                            <li>
                                <div id="detalle">
                                    <?php  $autor = $facebook->api('/'.$mostrar[$i]["uid"]); ?>
                                     <h3> Por:<?php  echo $autor["name"];?></h3>
                                </div>
                                <img src="portadas/<?php echo $mostrar[$i]["nombre"]; ?>" />
                                <div id="social">
                                     <ul>
                                         <li>
                                                <iframe src="https://www.facebook.com/plugins/like.php?href=https://apps.facebook.com/demorumbo/galeria.php?image-<?php // echo $mostrar[$i]["id_imagenes"]; ?>" scrolling="no" frameborder="0" style="height: 42px; width: 250px" allowTransparency="true"></iframe>
                                           </li>
                                         
                                           <li>
                                                <div id="fb-root"></div>
                                                <script src="http://connect.facebook.net/es_ES/all.js#xfbml=1"></script>
                                                <fb:send href="https://apps.facebook.com/demorumbo/galeria.php?image-<?php // echo $mostrar[$i]["id_imagenes"]; ?>"></fb:send>
                                                <br>
                                                <br>
                                           </li>
                                           
                                     </ul> 
                                </div>
                                
                                
                                
                               </li> 
                              
                            <?php
                            }
                            ?>
                      </ul>                          
                 
		</article>
           
	</div>
      
           
          
	
        
        
             
        </section>
    </body>
<?php

 } 

?>
    
    
</html>

