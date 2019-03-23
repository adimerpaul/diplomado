<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentacion extends CI_Controller{
    function index($idestudiante){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Documentacion del Estudiante';
        $this->load->View('templates/header',$data);
        $data['idestudiante']=$idestudiante;
        $this->load->View('documentacion',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $query = $this->db->query("SELECT * FROM documento ");

        foreach ($query->result() as $row)
        {
            if (isset($_POST['d'.$row->iddocumento])){
                $query2 = $this->db->query("SELECT * FROM estudiantedocumento WHERE iddocumento='".$row->iddocumento."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                if($cantidad==1){
                    $this->db->query("UPDATE estudiantedocumento SET estado='".$_POST['d'.$row->iddocumento]."'
                     WHERE idestudiante='$idestudiante' AND iddocumento='".$row2->iddocumento."' ");
                }else{
                    $this->db->query("INSERT INTO estudiantedocumento(idestudiante,iddocumento,estado) VALUES ('$idestudiante','".$row->iddocumento."','".$_POST['d'.$row->iddocumento]."') ");

                }
            }
        }
        header("Location: ".base_url()."Documentacion/index/$idestudiante");
    }
}