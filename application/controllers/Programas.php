<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programas extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar Programas';
        $this->load->View('templates/header',$data);
        $this->load->View('programas',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function insert(){
        $nombre=$_POST['nombre'];
        $version=$_POST['version'];
        $query = $this->db->query("INSERT INTO programa SET nombre='$nombre', version='$version'");
        header("Location: ".base_url()."Programas");
    }
    function update(){
        $idprograma=$_POST['idprograma'];
        $nombre=$_POST['nombre'];
        $version=$_POST['version'];
        $estado=$_POST['estado'];
        $query = $this->db->query("UPDATE  programa
SET nombre='$nombre', version='$version', estado='$estado' WHERE idprograma='$idprograma'");

        header("Location: ".base_url()."Programas");
    }
    function delete($id){
        $query = $this->db->query("DELETE FROM programa WHERE idprograma='$id'");
        header("Location: ".base_url()."Programas");

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