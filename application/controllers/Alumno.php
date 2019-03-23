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
        $idpersona=$_POST['idpersona'];
        $observacion=$_POST['observacion'];
        $query = $this->db->query("INSERT INTO estudiante(
idpersona
, observaciones
) VALUES (
$idpersona
, '$observacion');");
        header("Location: ".base_url()."Alumno");
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $idmodulo=$_POST['idmodulo'];
        $query = $this->db->query("INSERT INTO estudiantemodulo(idestudiante,idmodulo)
VALUES('$idestudiante','$idmodulo')");
        header("Location: ".base_url()."Alumno");

    }
    function datos(){
        $idestudiante=$_POST['idestudiante'];
        $query = $this->db->query("SELECT * FROM estudiantemodulo e INNER JOIN modulo m ON e.idmodulo=m.idmodulo INNER JOIN programa p ON p.idprograma=m.idprograma WHERE e.idestudiante='$idestudiante'");

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