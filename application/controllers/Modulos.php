<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar Modulos';
        $this->load->View('templates/header',$data);
        $this->load->View('modulos',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function insert(){
        $nombre=$_POST['nombre'];
        $codigo=$_POST['codigo'];
        $fechainicio=$_POST['fechainicio'];
        $fechafin=$_POST['fechafin'];
        $iddocente=$_POST['iddocente'];
        $idprograma=$_POST['idprograma'];
        $query = $this->db->query("INSERT INTO modulo SET 
nombre='$nombre',
codigo='$codigo',
fechainicio='$fechainicio',
fechafin='$fechafin',
iddocente='$iddocente',
idprograma='$idprograma'
");
        header("Location: ".base_url()."Modulos");
    }
    function update(){
        $idmodulo=$_POST['idmodulo'];
        $nombre=$_POST['nombre'];
        $codigo=$_POST['codigo'];
        $fechainicio=$_POST['fechainicio'];
        $fechafin=$_POST['fechafin'];
        $iddocente=$_POST['iddocente'];
        $idprograma=$_POST['idprograma'];
        $query = $this->db->query("UPDATE modulo SET 
nombre='$nombre',
codigo='$codigo',
fechainicio='$fechainicio',
fechafin='$fechafin',
iddocente='$iddocente',
idprograma='$idprograma'
WHERE
idmodulo='$idmodulo'
");

        header("Location: ".base_url()."Modulos");
    }
    function delete($id){
        $query = $this->db->query("DELETE FROM modulo WHERE idmodulo='$id'");
        header("Location: ".base_url()."Modulos");

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