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
        $data['js']="<script src='".base_url()."assets/js/docentes.js'></script>";
        $this->load->View('templates/footer',$data);
    }
    function insert(){
        $idpersona=$_POST['idpersona'];
        $nombre=$_POST['nombre'];
        $clave=$_POST['clave'];
        $query = $this->db->query("INSERT INTO docente(idpersona) VALUES ('$idpersona');");
        $query = $this->db->query("INSERT INTO usuario(nombre,clave,idpersona,idrol) VALUES ('$nombre','$clave','$idpersona','3');");
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