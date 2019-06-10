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
    function datos(){
        $idestudiante=$_POST['idestudiante'];
        $query = $this->db->query("SELECT * FROM estudianteprograma e INNER JOIN programa p ON e.idprograma=p.idprograma  WHERE e.idestudiante='$idestudiante'");

        foreach ($query->result() as $row)
        {
                echo "<a href='' class='form-search'>".substr($row->date,0,10)." ".$row->nombre."</a><br>
                       <a href='".base_url()."Datos/index/".$this->User->consulta("idpersona","estudiante","idestudiante",$row->idestudiante)."' class='btn btn-success btn-mini ' style='width: 120px'><i class='fa fa-user'></i> Datos personales</a> <br>
                       <a href='".base_url()."Documentacion/index/".$row->idestudiante."' class='btn btn-primary btn-mini ' style='width: 120px'><i class='fa fa-file'></i> Documentacion</a> <br>
                       <a href='".base_url()."Pagos/index/".$row->idestudiante."' class='btn btn-warning btn-mini ' style='width: 120px'><i class='fa fa-money'></i> Pagos efectuados</a> <br>
                       <a href='".base_url()."Datos' class='btn btn-danger btn-mini ' style='width: 120px'><i class='fa fa-dollar'></i> Pagos por multas</a> <br>
                       <a href='".base_url()."Calificacion/index/".$row->idestudiante."' class='btn btn-info btn-mini ' style='width: 120px'><i class='fa fa-barcode'></i> Calificacion</a> <br>
                       <a href='".base_url()."Datos' class='btn btn-warning btn-mini ' style='width: 120px'><i class='fa fa-file-text'></i> Tramite del titulo</a> <br>";
        }
    }
}
