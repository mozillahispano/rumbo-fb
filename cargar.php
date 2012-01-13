 
<?php

require_once ('conexion.php');
require_once('facebook.php');



$facebook = new Facebook(array(
  'appId'  => '153053701464197',
  'secret' => '9faf86161ca03fd7a3def4c105a2c3c1',
));

// Get User ID
$user = $facebook->getUser();


if(isset($_GET["grabar"]) and $_GET["grabar"]=="si"){
    
    $tra= new Trabajo();
    $tra->cargar_img();
    
}

?> 





<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>..::Rumbo y los 100.000..::</title>
        <link rel="stylesheet" href="css/estilos.css" type="text/css"/>
        <script type="text/javascript" src="js/cargar.js"></script>
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
	<div  class="envoltura">
		   <aside>
                       <img src="img/mh-banner-v.png" width="250px" height="400px" />
			 <!-- <h3>IMAGEN DE RUMBO</h3> -->
		</aside>
                       
		<article>
                    <div id="contenido">
				
				<p>Diseña una imagen para que usemos en la portada de Facebook cuando lleguemos a 100.000 fans. Recuerda que tiene que ser un diseño que represente a Mozilla..</p>
                                <p>Medidas: xxx * xxx</p>
                                <p>Formato: xxx</p>
                                <p>Tamaño máximo: xxx</p>
                         
                                <hr>      
                                                   
                                
                                
                <form id="upload_form" enctype="multipart/form-data" method="post" action="procesa_cargar.php">
                    <div>
                        <div><label for="image_file">Seleccione La Imagen</label></div>
                        <div><input type="file" name="image_file" id="image_file" onchange="seleccionarArchivo();" /></div>
                        <!--   <input type="text" name="uid"/> -->
                        <textarea name="descripcion" placeholder="Define tu Creacion"></textarea>
                     
                        <input type="hidden" name="grabar" value="si">
                        <input type="hidden" name="uid" value="<?php  echo $user;?> ">
                    </div>
                    <div>

                        <input type="submit" value="Cargar"  />
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
                
                
                    </div>
                    
                    <div class="envoltura">      
                    <a href="gracias.php" class="boton ">Bases Legales</a> 
                    </div>
                    
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