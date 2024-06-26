<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller{
    function rolGet(){
        $idRol = $_SESSION['idrol'];
//        $idestudiante = $_SESSION['idusuario'];
        $idestudiante = $this->User->consulta('idestudiante','estudiante','idpersona',$_SESSION['idusuario']);
        echo json_encode(["idRol"=>$idRol, "idestudiante" => $idestudiante]);
    }
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Alumno';
        $this->load->View('templates/header',$data);
        $this->load->View('alumno',$data);
        $data['js']="<script src='".base_url()."assets/js/alumno.js'></script>";
        $this->load->View('templates/footer',$data);
    }
    function uploadfile(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];

        $file=$_FILES['file'];
        $ruta="uploads/";
        $nombre=time().".pdf";
        $temp=$file['tmp_name'];
        $ruta=$ruta.$nombre;
        move_uploaded_file($temp,$ruta);

//        verificamos is existe en documentoarchivo
        $query=$this->db->query("SELECT * FROM documentoarchivo WHERE idestudiante='$idestudiante' AND idprograma='$idprograma'");
        if ($query->num_rows()>0){
            $this->db->query("UPDATE documentoarchivo SET archivo='$nombre' WHERE idestudiante='$idestudiante' AND idprograma='$idprograma'");
        }else{
            $this->db->query("INSERT INTO documentoarchivo SET idestudiante='$idestudiante',idprograma='$idprograma',archivo='$nombre'");
        }
        echo $nombre;
    }
    function deletefile(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
//        $query=$this->db->query("SELECT archivo FROM documentoarchivo WHERE idestudiante='$idestudiante' AND idprograma='$idprograma'");
//        $row=$query->row();
//        $archivo=$row->archivo;
//        unlink("uploads/".$archivo);
        $this->db->query("DELETE FROM documentoarchivo WHERE idestudiante='$idestudiante' AND idprograma='$idprograma'");
        echo 1;
    }
    function insert(){
        $paterno=$_POST['paterno'];
        $materno=$_POST['materno'];
        $nombres=$_POST['nombres'];
        $ci=$_POST['ci'];
        $profesion=$_POST['profesion'];
        $email=$_POST['email'];
        $celular=$_POST['celular'];
        $telefono=$_POST['telefono'];
        $sexo=$_POST['sexo'];
        $beca=$_POST['beca'];
        $observacion=$_POST['observacion'];
        $this->db->query("INSERT INTO persona SET 
paterno='$paterno',
materno='$materno',
nombres='$nombres',
ci='$ci',
profesion='$profesion',
telefono='$telefono',
celular='$celular',
email='$email',
sexo='$sexo'
");
        $idpersona=$this->db->insert_id();
        $this->db->query("INSERT INTO estudiante SET idpersona='$idpersona',beca='$beca',observaciones='$observacion'");
        $this->db->query("INSERT INTO usuario SET idpersona='$idpersona',nombre='$paterno',clave=md5('$ci'),idrol='2'");

        header("Location: ".base_url()."Alumno");
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idmodulo'];
        $query = $this->db->query("INSERT INTO estudianteprograma(idestudiante,idprograma)
VALUES('$idestudiante','$idprograma')");
        echo 1;
    }
    function alumnosmultas(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $query=$this->db->query("SELECT *
        FROM multas m
        WHERE idprograma='$idprograma' AND idestudiante='$idestudiante'");
        $row=$query->result_array();
        $idRol = $_SESSION['idrol'];
        echo json_encode(["row"=>$row,"idRol"=>$idRol]);
    }
    function alumnosnotas(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $query=$this->db->query("SELECT m.idmodulo,m.nombre,
(
CASE
    WHEN (SELECT count(*) FROM estudiantemodulo
          WHERE idmodulo=m.idmodulo AND idestudiante='$idestudiante'AND idprograma='$idprograma')=0 THEN ''
    ELSE (SELECT nota FROM estudiantemodulo
          WHERE idmodulo=m.idmodulo AND idestudiante='$idestudiante'AND idprograma='$idprograma')
END
)
as nota
FROM modulo m
WHERE m.idprograma='$idprograma'");
        $row=$query->result_array();
        $idRol = $_SESSION['idrol'];
        echo json_encode(["row"=>$row,"idRol"=>$idRol]);
    }
    function datos(){
        $idestudiante=$_POST['idestudiante'];
        $idpersona=$this->User->consulta('idpersona','estudiante','idestudiante',$idestudiante);
        $query = $this->db->query("SELECT * FROM estudianteprograma e
    INNER JOIN programa p ON e.idprograma=p.idprograma 
         WHERE e.idestudiante='$idestudiante'
         order by p.idprograma desc");

        echo "<button id='personal' class='btn btn-success btn-mini' idpersona='$idpersona' style='width: 120px'><i class='fa fa-user'></i> Datos personales</button> <br>";
//        $eliminar programa si solo es admin
        if ($_SESSION['idrol']==1 && $query->num_rows()>0){
            $eliminarprograma="<button
idestudiante='$idestudiante'
idprograma='".$query->row()->idprograma."'
class='btn btn-purple btn-mini eliminarprograma' style='width: 120px'><i class='fa fa-trash'></i> Eliminar</button> <br>";
        }else{
            $eliminarprograma="";
        }
        foreach ($query->result() as $row) {
        echo "<div class='text-capitalize ' style='font-size: 10px'>".substr($row->date,0,10)." ".trim($row->nombre)."</div>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-primary btn-mini actualizardoc' style='width: 120px'><i class='fa fa-file'></i> Documentacion</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-warning btn-mini actualizarpagos ' style='width: 120px'><i class='fa fa-money'></i> Pagos efectuados</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-danger btn-mini actualizarmulta' style='width: 120px'><i class='fa fa-dollar'></i> Pagos por multas</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-info btn-mini  actualizarnotas' style='width: 120px'><i class='fa fa-barcode'></i> Calificacion</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-primary btn-mini actualizartramite' style='width: 120px'><i class='fa fa-file-text'></i> Tramite del titulo</button> <br>
               $eliminarprograma";
        }
    }
    function insertmultas(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $monto=$_POST['monto'];
        $motivo=$_POST['motivo'];
        $this->db->query ("INSERT INTO multas SET idprograma='$idprograma' ,idestudiante='$idestudiante',monto='$monto',motivo='$motivo' ");
        echo 1;
    }
    function deleteprograma(){
        $idprograma=$_POST['idprograma'];
        $idestudiante=$_POST['idestudiante'];
        $this->db->query("DELETE FROM estudianteprograma WHERE idprograma='$idprograma' AND idestudiante='$idestudiante'");
        echo 1;
    }

    function delete(){
        $idestudiante=$_POST['idestudiante'];
        $this->db->query("DELETE FROM estudiante WHERE idestudiante='$idestudiante'");
        echo 1;
    }
    function editarmulta(){
        $idmulta=$_POST['idmulta'];
        $monto=$_POST['monto'];
        $motivo=$_POST['motivo'];
//        $sql = "UPDATE multas SET monto='$monto' WHERE idmulta='$idmulta'";
        $query=$this->db->query("UPDATE multas SET monto='$monto', motivo='$motivo' WHERE idmulta='$idmulta'");
        echo 1;
    }
    function eliminarmulta(){
        $idmulta=$_POST['idmulta'];
        $query=$this->db->query("DELETE FROM multas WHERE idmulta='$idmulta'");
        echo 1;
    }
    function duplicarmulta(){
        $idmultae=$_POST['idmulta'];
        $query=$this->db->query("SELECT * FROM multas WHERE idmulta='$idmultae'");
        foreach ($query->result() as $row){
            $this->db->query ("INSERT INTO multas SET idprograma='$row->idprograma' ,idestudiante='$row->idestudiante',monto='$row->monto',motivo='$row->motivo' ");
        }
        echo 1;
    }
    function updatedocuments(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        //echo $idestudiante;
        $query=$this->db->query("SELECT * FROM documento");
        foreach ($query->result() as $row){
            $this->db->query ("INSERT INTO estudiantedocumento 
SET idestudiante='$idestudiante' ,idprograma='$idprograma', iddocumento='".$row->iddocumento."',estado='".$_POST['d'.$row->iddocumento]."'
ON DUPLICATE KEY UPDATE estado= '".$_POST['d'.$row->iddocumento]."';");
        }
        echo 1;
        //echo json_encode($_POST);
    }
    function updatetramite(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        //echo $idestudiante;
        $query=$this->db->query("SELECT * FROM tramite");
        foreach ($query->result() as $row){
            if (isset($_POST['d'.$row->idtramite])) {
                $estado = $_POST['d' . $row->idtramite];
                $estadoUpercase = strtoupper($estado);
                $this->db->query("INSERT INTO estudiantetramite 
                SET idestudiante='$idestudiante' ,idprograma='$idprograma', idtramite='" . $row->idtramite . "',estado='" . $estado . "'
                ON DUPLICATE KEY UPDATE estado= '" . $_POST['d' . $row->idtramite] . "';");
            }else{
                $this->db->query("DELETE FROM estudiantetramite WHERE idestudiante='$idestudiante' AND idprograma='$idprograma' AND idtramite='".$row->idtramite."'");
            }
        }
        echo 1;
    }
    function alumnostramites(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $query=$this->db->query("SELECT t.idtramite,t.nombre,
(
CASE
    WHEN (SELECT count(*) FROM estudiantetramite
          WHERE idtramite=t.idtramite AND idestudiante='$idestudiante'AND idprograma='$idprograma')=0 THEN 'NO'
    ELSE (SELECT estado FROM estudiantetramite
          WHERE idtramite=t.idtramite AND idestudiante='$idestudiante'AND idprograma='$idprograma')
END
)
as estado
FROM tramite t");
        $row=$query->result_array();
        $idRol = $_SESSION['idrol'];
        echo json_encode(["row"=>$row,"idRol"=>$idRol]);
    }
    function updatepagos(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        //echo $idestudiante;
        $query=$this->db->query("SELECT * FROM tipopago");
        foreach ($query->result() as $row){
            if (isset($_POST['p'.$row->idtipopago])) {
                $this->db->query("INSERT INTO pago 
SET idestudiante='$idestudiante' ,idprograma='$idprograma', idtipopago='".$row->idtipopago."',monto='".$_POST['p'.$row->idtipopago]."'
ON DUPLICATE KEY UPDATE monto= '".$_POST['p'.$row->idtipopago]."';");
            }
        }
        echo 1;
    }
    function updatenotas(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        //echo $idestudiante;
        $query=$this->db->query("SELECT * FROM modulo WHERE idprograma='$idprograma'");
        foreach ($query->result() as $row){
            $this->db->query("INSERT INTO estudiantemodulo 
SET idestudiante='$idestudiante',idmodulo='".$row->idmodulo."',nota='".$_POST['n'.$row->idmodulo]."'
ON DUPLICATE KEY UPDATE nota= '".$_POST['n'.$row->idmodulo]."';");
        }
        echo 1;
    }
    function dat(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato'");
        $row=$query->result_array();
        $idRol = $_SESSION['idrol'];
        echo json_encode(["row"=>$row,"idRol"=>$idRol]);
    }
    function dat2(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $where2=$_POST['where2'];
        $dato2=$_POST['dato2'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato' AND $where2='$dato2'");
        $row=$query->result_array();
        echo json_encode($row);
    }
    function dat3(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $where2=$_POST['where2'];
        $dato2=$_POST['dato2'];
        $where3=$_POST['where3'];
        $dato3=$_POST['dato3'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato' AND $where2='$dato2' AND $where3='$dato3'");
        $row=$query->result_array();
        echo json_encode($row);
    }
    function estudiantePrograma($idPrograma, $idModulo){
        $estudiantesPrograma = $this->db->query("
        SELECT e.idestudiante, 
               CONCAT(pe.paterno,' ',pe.materno,' ',pe.nombres) as nombre,
               COALESCE(em.nota, 0) as nota
        FROM programa p
        INNER JOIN estudianteprograma ep ON p.idprograma = ep.idprograma
        INNER JOIN estudiante e ON ep.idestudiante = e.idestudiante
        INNER JOIN persona pe ON e.idpersona = pe.idpersona
        LEFT JOIN estudiantemodulo em ON e.idestudiante = em.idestudiante AND em.idmodulo = '$idModulo'
        WHERE p.idprograma = '$idPrograma'
        ORDER BY pe.paterno, pe.materno, pe.nombres
    ");
        echo json_encode($estudiantesPrograma->result_array());
    }

    function actualizarNota(){
        $idEstudiante = $_POST['idEstudiante'];
        $idModulo = $_POST['idModulo'];
        $nota = $_POST['nota'];

        // Realizar la inserción o actualización
        $query = "INSERT INTO estudiantemodulo (idestudiante, idmodulo, nota) VALUES ('$idEstudiante', '$idModulo', '$nota') 
              ON DUPLICATE KEY UPDATE nota = '$nota'";
        error_log($query);
        $this->db->query($query);

        echo 1;
    }
    function alumnosdocumento(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $query = $this->db->query("SELECT d.iddocumento,d.nombre,
(
CASE
    WHEN (SELECT count(*) FROM estudiantedocumento
          WHERE iddocumento=d.iddocumento AND idestudiante='$idestudiante'AND idprograma='$idprograma')=0 THEN 'NO'
          WHEN (SELECT estado FROM estudiantedocumento
          WHERE iddocumento=d.iddocumento AND idestudiante='$idestudiante'AND idprograma='$idprograma')='NO' THEN 'NO'
    ELSE 'SI'
END
)
as tienedocumento
FROM documento d");
        $row=$query->result_array();
        //buscamos en docuemntoarchivo
        $query=$this->db->query("SELECT archivo FROM documentoarchivo WHERE idestudiante='$idestudiante' AND idprograma='$idprograma'");
        $documento=$query->result_array();
        $idRol = $_SESSION['idrol'];
        $base_url = base_url();
        $programa=$this->db->query("SELECT * FROM programa WHERE idprograma='$idprograma'")->row();
        echo json_encode(["row"=>$row,"idRol"=>$idRol, "base_url" => $base_url, "documento" => $documento, "programa" => $programa]);
    }
    function alumnospagos(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        $query=$this->db->query("SELECT t.idtipopago,t.nombre,t.monto as m1,
(
CASE
    WHEN (SELECT count(*) FROM pago
          WHERE idtipopago=t.idtipopago AND idestudiante='$idestudiante'AND idprograma='$idprograma')=0 THEN 0
          WHEN (SELECT monto FROM pago
          WHERE idtipopago=t.idtipopago AND idestudiante='$idestudiante'AND idprograma='$idprograma')=0 THEN 0
    ELSE (SELECT monto FROM pago
          WHERE idtipopago=t.idtipopago AND idestudiante='$idestudiante'AND idprograma='$idprograma')
END
)
as monto
FROM tipopago t
WHERE idprograma='$idprograma'");
        $row=$query->result_array();
        $idRol = $_SESSION['idrol'];
        $query=$this->db->query("SELECT * FROM programa WHERE  idprograma ='$idprograma'");
        $programa=$query->result_array();
        echo json_encode(["row"=>$row,"idRol"=>$idRol,"programa"=>$programa]);
    }
    function updatestudent(){
        $email=$_POST['email'];
        $paterno=$_POST['paterno'];
        $materno=$_POST['materno'];
        $nombres=$_POST['nombres'];
        $ci=$_POST['ci'];
        $profesion=$_POST['profesion'];
        $telefono=$_POST['telefono'];
        $celular=$_POST['celular'];
        $genero=$_POST['genero'];
        $idpersona=$_POST['idpersona'];
        $this->db->query("UPDATE persona SET
paterno='$paterno',
materno='$materno',
nombres='$nombres',
paterno='$paterno',
ci='$ci',
profesion='$profesion',
telefono='$telefono',
celular='$celular',
email='$email',
sexo='$genero'
WHERE
idpersona='$idpersona'
");
        echo 1;
    }
}
