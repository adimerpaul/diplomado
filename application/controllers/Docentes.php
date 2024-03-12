<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docentes extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar docentes';
        $this->load->View('templates/header',$data);
        $this->load->View('docentes',$data);
        $data['js']="";
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
        $user=$_POST['user'];
        $password=$_POST['password'];
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
        $this->db->query("INSERT INTO docente SET idpersona='$idpersona'");
        $this->db->query("INSERT INTO usuario SET idpersona='$idpersona',nombre='$user',clave=md5('$password'),idrol='3'");




        //        $array=$_POST;
//        unset($array['user']);
//        unset($array['password']);
//        $json = json_encode($array);
//        echo("INSERT INTO persona SET $json");
        //echo $json;
//        $idpersona=$_POST['idpersona'];
//        $nombre=$_POST['nombre'];
//        $clave=$_POST['clave'];
//        $query = $this->db->query("INSERT INTO docente(idpersona) VALUES ('$idpersona');");
//        $query = $this->db->query("INSERT INTO usuario(nombre,clave,idpersona,idrol) VALUES ('$nombre','$clave','$idpersona','3');");
        header("Location: ".base_url()."Docentes");

    }
    function update(){
        $idusuario=$_POST['idusuario'];
        $nombre=$_POST['nombre'];
        $clave=$_POST['clave'];
        $estado=$_POST['estado'];
        $query = $this->db->query("UPDATE  usuario
SET
nombre ='$nombre'
, clave ='$clave'
, estado ='$estado' WHERE idusuario='$idusuario'");
        header("Location: ".base_url()."Docentes");
    }
    function delete($id){
        $query = $this->db->query("DELETE FROM modulo WHERE iddocente='$id'");
        $query = $this->db->query("DELETE FROM usuario WHERE idusuario='$id'");
        $query = $this->db->query("DELETE FROM docente WHERE idpersona='$id'");
        header("Location: ".base_url()."Docentes");
    }

    function datos(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato'");
        $row=$query->result_array()[0];
        echo json_encode($row);
    }
}
