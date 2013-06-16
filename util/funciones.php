<?php

require_once "config/config-sample.php";

class Trabajo{
    
    
    private $db;
    private $mostar;
    private $mostar_transito;
    
    public function __construct()
    {
        $this->db = Conectar::con_pdo();
        $this->mostar=array();
        $this->mostar_transito=array();
        
    }
    
   
    public function aprobarImagenes()
            {
        
            $id=strip_tags($_POST["id"]);
            $sql="update imagenes set estado=? where id_imagenes=?";
            $stmt= $this->db->prepare($sql);
            $stmt->bindValue(1,'aprobado',PDO::PARAM_STR);
            $stmt->bindValue(2,$id,PDO::PARAM_INT);
            $stmt->execute();
            $this->db=null;
            echo '<script type="text/javascript"> alert("SE HA APROBADO LA IMAGEN"); window.location="galeria.php";</script>';
  }
    
    public function mostrarTransito()
       {
       
            $sql="select * from imagenes where estado='transito'";
            foreach($this->db->query($sql) as $rows)
            {
                $this->mostar_transito[]=$rows;
            }
            return $this->mostar_transito;
            $this->db=null;

       }
    
    public function mostrarImg()
        {
        
            $sql="select * from imagenes where estado='aprobado'";
            foreach($this->db->query($sql) as $rows)
            {
                $this->mostrar[]=$rows;
            }
            return $this->mostrar;
            $this->db=null;
        
        }
    
public function cargar_img()
        {
  
            $uid=$_POST["uid"];
            $img=$_FILES["image_file"]["name"];
            $tempimg=$_FILES["image_file"]["tmp_name"];
            $tam=$_FILES["image_file"]["size"];
            $tipoimg=$_FILES["image_file"]["type"];

            $porte=$tam/1024;

            if($porte > 1024){

            ?>
            <strong>El archivo subido supera los 1024 Kilobytes</strong>
            <br />
            <input type="button" value="Volver" title="Volver" onclick="history.back()" />
            <?php
            }

            if ($tipoimg=="image/png" or $tipoimg=="image/jpeg")
            {

                switch ($tipoimg)
                {
                        case 'image/png':
                                $ext=".png";
                        break;
                        case 'image/jpeg':
                                $ext=".jpg";
                        break;

                }

                $nom=$uid;
                $nom=str_replace(" ","_",$nom);
                $nom=$nom.$ext;
                copy($tempimg,"portadas/$nom");

                require_once("util/resize-class.php");
                $resizeObj = new resize("portadas/$nom");
                $resizeObj -> resizeImage(150, 100, 0);
                $resizeObj -> saveImage("portadas/thumbnail/$nom", 100);

                $sql="insert into imagenes "
                                        ." values "
                                        ."(null,?,?,?);";
                $stmt= $this->db->prepare($sql);
                $stmt->bindValue(1,$uid,PDO::PARAM_INT);
                $stmt->bindValue(2,$nom,PDO::PARAM_STR);
                $stmt->bindValue(3,'transito',PDO::PARAM_STR);
                $stmt->execute();
                $this->db=null;
                header('location: gracias.php');

            }else
            {
            ?>
                <strong>El archivo subido solo puede ser JPG o PNG</strong>
                <br />
                <input type="button" value="Volver" title="Volver" onclick="history.back()" />
            <?php
        }

 
    }       
 
}

?>


