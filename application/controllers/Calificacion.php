<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificacion extends CI_Controller{
    function index($idestudiante){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Calificacion del Estudiante';
        $this->load->View('templates/header',$data);
        $data['idestudiante']=$idestudiante;
        $this->load->View('calificacion',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $query = $this->db->query("SELECT * FROM modulo ");

        foreach ($query->result() as $row)
        {
            if (isset($_POST['d'.$row->idmodulo])){
                $query2 = $this->db->query("SELECT * FROM estudiantemodulo WHERE idmodulo='".$row->idmodulo."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                if($cantidad==1){
                    $this->db->query("UPDATE estudiantemodulo SET nota='".$_POST['d'.$row->idmodulo]."'
                     WHERE idestudiante='$idestudiante' AND idmodulo='".$row2->idmodulo."' ");
                }else{
                    $this->db->query("INSERT INTO estudiantemodulo(idestudiante,idmodulo,nota) VALUES ('$idestudiante','".$row->idmodulo."','".$_POST['d'.$row->idmodulo]."') ");
                }
            }
        }
        header("Location: ".base_url()."Calificacion/index/$idestudiante");
    }
}