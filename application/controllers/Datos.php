<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos extends CI_Controller{
    function index($idpersona){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Datos del Estudiante';
        $this->load->View('templates/header',$data);
        $data['idpersona']=$idpersona;
        $this->load->View('datos',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function update(){
        $paterno=$_POST['apellido_paterno'];
        $materno=$_POST['apellido_materno'];
        $nombres=$_POST['nombres'];
        $ci=$_POST['ci'];
        $profesion=$_POST['profesion'];
        $celular=$_POST['celular'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $genero=$_POST['genero'];
        $idpersona=$_POST['idpersona'];
        $query = $this->db->query("UPDATE  persona
SET
paterno='$paterno'
, materno ='$materno'
, nombres ='$nombres'
, ci ='$ci'
, profesion ='$profesion'
, telefono ='$telefono'
, celular ='$celular'
, email ='$email'
, sexo ='$genero' WHERE idpersona='$idpersona'");
        header("Location: ".base_url()."Datos/index/$idpersona");
    }
}
