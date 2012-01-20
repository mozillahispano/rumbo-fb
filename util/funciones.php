<?php
/* Database Configuration */
require_once "config/config.php";

class Trabajo{
    
    private $mostar=array();
    private $mostar_transito=array();
    public function aprobar_imagenes(){
        
        $id_imagen=$_POST["id"];
        $sql="update imagenes set situacion='aprobado' where id_imagenes=$id_imagen";
        mysql_query($sql,Conectar::con());
         echo '<script type="text/javascript"> alert("SE HA APROBADO LA IMAGEN"); window.location="galeria.php";</script>';
  }
    
public function mostrar_transito(){
        
       $sql="select * from imagenes where situacion='transito'";
        $rep=mysql_query($sql,Conectar::con());
        while($res=mysql_fetch_assoc($rep)){
            
            $this->mostar[]=$res;
        }
        return $this->mostar;
        
        
       }
    
public function mostrar_img(){
        
        $sql="select * from imagenes where situacion='aprobado'";
        $rep=mysql_query($sql,Conectar::con());
        while($res=mysql_fetch_assoc($rep)){
            
            $this->mostar[]=$res;
        }
        return $this->mostar;
    }
    
    
    
    
public function cargar_img(){
        
        $uid=$_POST["uid"];
        $des=$_POST["descripcion"];
        $img=$_FILES["image_file"]["name"];
        $tempimg=$_FILES["image_file"]["tmp_name"];
        $tamanoimg=$_FILES["image_file"]["size"];
        $tipoimg=$_FILES["image_file"]["type"];
      // echo "$uid"."$des"."$img"."$tempimg"."$tamañoimg"."$tipoimg";
        
        //Validando el tamaño del Archivo
        $porte=$tamanoimg/1024;//tamaño en KB
        
        if($porte > 1024){
            
           ?>
	El archivo subido supera los 1024 Kilobytes
	<br />
	<input type="button" value="Volver" title="Volver" onclick="history.back()" />
	<?php
        }
    //Ahora validamos la extensión o el tipo de archivo
if ($tipoimg=="image/png" or $tipoimg=="image/jpeg")
{
//**************************************************************************
//Ahora podemos subir la imagen al servidor
switch ($tipoimg)
{
	case 'image/png':
		$ext=".png";
	break;
	case 'image/jpeg':
		$ext=".jpg";
	break;
	
}/*	 $num=self::obtiene_numero_foto($_POST["uid"]);
		$foto=$_POST["uid"]."_".$num.".jpg"; */
//$nombre_foto=$_POST["nom"].$ext;
$nombre_foto=$_POST["uid"];
$nombre_foto=str_replace(" ","_",$nombre_foto);
$nombre_foto=$nombre_foto.$ext;
copy($tempimg,"img/$nombre_foto");
//**************************************************************************
//Ahora guardamos el archivo en una tabla de la base de datos
$sql="insert into imagenes "
			." values "
			."(null,'".$_POST["uid"]."','".$_POST["descripcion"]."','$nombre_foto','transito');";
		//echo $sql;	
		mysql_query($sql,Conectar::con());
                header('location: gracias.php');
}else
{
	?>
	el archivo subido solo puede ser JPG o PNG
	<br />
	<input type="button" value="Volver" title="Volver" onclick="history.back()" />
	<?php
}

 
    }       
   
    private function obtiene_numero_foto($uid)
	{
		$query="select uid from imagenes where uid='".$uid."'";
		$respuesta=mysql_query($query,Conectar::con());
		if (mysql_num_rows($respuesta)==0)
		{	
			$num=1;
		}else
		{
			$num=mysql_num_rows($respuesta)+1;
		}
			return $num;
	}
        
     
    
    
    
    
    
}

?>
