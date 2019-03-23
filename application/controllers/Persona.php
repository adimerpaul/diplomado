<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persona extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar personas';
        $this->load->View('templates/header',$data);
        $this->load->View('persona',$data);
        $data['js']="<script src='".base_url()."assets/js/persona.js'></script>";
        $this->load->View('templates/footer',$data);
    }
    function insert(){
        $apellido_paterno=$_POST['apellido_paterno'];
        $apellido_materno=$_POST['apellido_materno'];
        $nombres=$_POST['nombres'];
        $ci=$_POST['ci'];
        $profesion=$_POST['profesion'];
        $celular=$_POST['celular'];
        $telefono=$_POST['telefono'];
        $email=$_POST['email'];
        $genero=$_POST['genero'];
        $query = $this->db->query("INSERT INTO persona(
idpersona
, apellido_paterno
, apellido_materno
, nombres
, ci
, profesion
, telefono
, celular
, email
, genero
, estado) VALUES (
NULL
, '$apellido_paterno'
, '$apellido_materno'
, '$nombres'
, '$ci'
, '$profesion'
, '$telefono'
, '$celular'
, '$email'
, '$genero'
, 'ACTIVO');");
        header("Location: ".base_url()."Persona");
    }
    function update(){
        $apellido_paterno=$_POST['apellido_paterno'];
        $apellido_materno=$_POST['apellido_materno'];
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
apellido_paterno='$apellido_paterno'
, apellido_materno ='$apellido_materno'
, nombres ='$nombres'
, ci ='$ci'
, profesion ='$profesion'
, telefono ='$telefono'
, celular ='$celular'
, email ='$email'
, genero ='$genero' WHERE idpersona='$idpersona'");
        header("Location: ".base_url()."Persona");
    }
    function delete($idpersona){
        $query = $this->db->query("DELETE FROM persona WHERE idpersona='$idpersona'");
        header("Location: ".base_url()."Persona");

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