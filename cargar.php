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


$user = $facebook->getUser();



?> 

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..:: Rumbo | Participa ::..</title>
        <link rel="stylesheet" href="css/estilos.css"/>
        <link rel="stylesheet" href="css/reveal.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="js/jquery.reveal.js"></script>
        <script type="text/javascript" src="js/cargar.js"></script>
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
	<section id="carga">
		      <article >
                       
                       
                       <h3>Envianos tus iseños</h3>
                       <p>Queremos que seas creativo y utilices tu
                       imaginación para diseñar una imagen 
                       para que sean nuestra foto de portada</p>
                       <h3>Formato</h3>
                       <p>Medida de portada: 850 x 315px. - Peso: Máx: 300kb. - Formato: PNG/JPG</p>
		</article>
       
        <section id="caja">
		<article class="borde">
                  <p>Img 1</p>    
                         
                       
                </article>
            
                <img src="images/flecha.png" alt="Flecha" />
            
                <article class="borde">
                    
                    <p>Img 2</p>         
                       
                         
                       
                </article>
            
                <img src="images/flecha.png" alt="Flecha" />
            
                <article class="borde">
                    
                    <p>Img 3</p>         
                       
                         
                       
                </article> 
        </section>
         <section id="texto">
		<article>
                    Elige tu producto favorito    
                </article>
                <article>
                    Crea un fondo que muestre toda tu creatividad         
                </article>
                <article>
                    Piensa en una frase que defina tu amor por tu producto favorito         
                </article> 
        </section>
                 
                        <a href="#x" class="overlay" id="login_form"></a>

                        <div class="popup alto">
                     
                <form id="upload_form" enctype="multipart/form-data" method="post" action="procesa_carga.php">
                    <div>
                        <label for="image_file">Seleccione Su Portada</label>
                        <input type="file" name="image_file" id="image_file"  onchange="seleccionarArchivo();" required /> 
                     
                        <input type="hidden" name="grabar" value="si">
                   <input type="hidden" name="uid" value="<?php  echo $user;?>  "> 
                    </div>
                    <div>

                        <input type="submit" value="Enviar Portada"  class="boton" />
                    </div>
                    <div id="fileinfo">
                       <div id="filename"></div>
                        <div id="filesize"></div>
                        <div id="filetype"></div>
                        <div id="filedim"></div>
                    </div>

                    <div id="error">Hay que seleccionar los archivos válidos, solo imagen!</div>
                    <div id="error2">Se produjo un error al cargar el archivo</div>
                    <div id="abort">La subida ha sido cancelada por el usuario o el navegador ha terminado la conexión</div>
                    <div id="warnsize">Su archivo es muy grande. No lo podemos aceptar. Por favor, seleccione un archivo más pequeño</div>
                    
                   
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                             <div class="clear_both"></div>
                        </div>
                      
                  </form>  
                <img id="vista_previa" />
                
                <a class="close" href="#close"></a>

                
                        </div>
               
            <a href="#x" class="overlay" id="bases"></a>

                 <div class="popup">
                     
                     <h2>Bases Legales</h2>
                     <hr>
                     <p>Lorem ipsum dolor sit amet, vix ut augue sanctus consulatu, sed an odio mundi corrumpit.
                         Vel id choro corrumpit. Qui debet iisque ad. Et eum noster verear scribentur,
                         te doming suavitate mea. Per tritani perfecto ea, ex ipsum inani sit.
                         Impetus eruditi eu sit, per ut everti epicuri. Ei quo tota paulo.</p>
                     <br>
                     <p>Ad mel solet feugiat, ornatus suscipit perpetua ne pri, eam at platonem oportere salutandi.
                         Dolore alterum reformidans an mei. Vel ea congue noluisse scripserit, nibh dolores et ius,
                         ad quas dicta vel. Ea qui ridens maiorum.
                         Mei affert democritum adversarium ea, sint case voluptua eu nam. Tibique sadipscing est et.</p>
                     <br>
                     <p>Tempor nostrum disputationi in has, ferri verterem mea ei.
                         Eripuit adolescens reprehendunt at sed.
                         Utroque torquatos interesset nam no, pro cu graece volumus deleniti.
                         Pro agam aeque causae eu, solum exerci consequat cu sea. Ea menandri assentior duo.
                         Tempor nostrum disputationi in has, ferri verterem mea ei.
                         Eripuit adolescens reprehendunt at sed.
                         Utroque torquatos interesset nam no, pro cu graece volumus deleniti.
                         ausae eu, solum exerci consequat cu sea. Ea menandri assentior duo.
                        
                     </p>
                     <br>
                     <ul>
                           
                    <li> <a href="#login_form" class="boton">Aceptar</a></li>
                     <a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/cargar.php';" class="boton-red">Rechazar</a>
                     </ul>      
                           
                   <a class="close" href="#close"></a> 
                 </div>
                
		</article>
	
        </section>
                        <ul>
                            <li><a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/galeria.php';" class="boton">Galeria</a></li>
                            <li><a href="javascript:void(0);" onClick="top.location='https://apps.facebook.com/demorumbo/aprobacion.php';" class="boton">Aprobar</a> </li>
                           <li><a href="#bases" class="boton"   >Seleccionar...</a></li>
                           
                       </ul>
        </section>
    </body>
<?php
 } 

?>
    
    
</html>
