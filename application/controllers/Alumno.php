<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller{
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
        $this->db->query("INSERT INTO usuario SET idpersona='$idpersona',nombre='$paterno',clave='$ci',idrol='2'");

        header("Location: ".base_url()."Alumno");
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idmodulo'];
        $query = $this->db->query("INSERT INTO estudianteprograma(idestudiante,idprograma)
VALUES('$idestudiante','$idprograma')");
        header("Location: ".base_url()."Alumno");
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
        echo json_encode($row);
    }
    function datos(){
        $idestudiante=$_POST['idestudiante'];
        $idpersona=$this->User->consulta('idpersona','estudiante','idestudiante',$idestudiante);
        $query = $this->db->query("SELECT * FROM estudianteprograma e INNER JOIN programa p ON e.idprograma=p.idprograma  WHERE e.idestudiante='$idestudiante'");
        echo "<button id='personal' class='btn btn-success btn-mini' idpersona='$idpersona' style='width: 120px'><i class='fa fa-user'></i> Datos personales</button> <br>";
        foreach ($query->result() as $row)
        {
        echo "<b>".substr($row->date,0,10)." ".$row->nombre."</b><br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-primary btn-mini actualizardoc' style='width: 120px'><i class='fa fa-file'></i> Documentacion</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-warning btn-mini actualizarpagos ' style='width: 120px'><i class='fa fa-money'></i> Pagos efectuados</button> <br>
               <button class='btn btn-danger btn-mini' style='width: 120px'><i class='fa fa-dollar'></i> Pagos por multas</button> <br>
               <button idestudiante='$idestudiante' idprograma='$row->idprograma' class='btn btn-info btn-mini  actualizarnotas' style='width: 120px'><i class='fa fa-barcode'></i> Calificacion</button> <br>
               <button class='btn btn-warning btn-mini ' style='width: 120px'><i class='fa fa-file-text'></i> Tramite del titulo</button> <br>";
        }
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
    function updatepagos(){
        $idestudiante=$_POST['idestudiante'];
        $idprograma=$_POST['idprograma'];
        //echo $idestudiante;
        $query=$this->db->query("SELECT * FROM tipopago");
        foreach ($query->result() as $row){
            $this->db->query("INSERT INTO pago 
SET idestudiante='$idestudiante' ,idprograma='$idprograma', idtipopago='".$row->idtipopago."',monto='".$_POST['p'.$row->idtipopago]."'
ON DUPLICATE KEY UPDATE monto= '".$_POST['p'.$row->idtipopago]."';");
        }
        echo 1;
    }
    function dat(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato'");
        $row=$query->result_array();
        echo json_encode($row);
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
        echo json_encode($row);
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
FROM tipopago t");
        $row=$query->result_array();
        echo json_encode($row);
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
