<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar Documentos';
        $this->load->View('templates/header',$data);
        $this->load->View('documentos',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function insert(){
        $nombre=$_POST['nombre'];
        $query = $this->db->query("INSERT INTO documento SET nombre='$nombre'");
        header("Location: ".base_url()."Documentos");
    }
    function update(){
        $iddocumento=$_POST['iddocumento'];
        $nombre=$_POST['nombre'];
        $query = $this->db->query("UPDATE  documento
SET
nombre='$nombre' WHERE iddocumento='$iddocumento'");

        header("Location: ".base_url()."Documentos");
    }
    function delete($id){
        $query = $this->db->query("DELETE FROM documento WHERE iddocumento='$id'");
        header("Location: ".base_url()."Documentos");

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