<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller{
    function index($idestudiante){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Pagos del Estudiante';
        $this->load->View('templates/header',$data);
        $data['idestudiante']=$idestudiante;
        $this->load->View('pagos',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function update(){
        $idestudiante=$_POST['idestudiante'];
        $query = $this->db->query("SELECT * FROM tipopago ");

        foreach ($query->result() as $row)
        {
            if (isset($_POST['d'.$row->idtipopago])){
                $query2 = $this->db->query("SELECT * FROM pago WHERE idtipopago='".$row->idtipopago."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                if($cantidad==1){
                    $this->db->query("UPDATE pago SET monto='".$_POST['d'.$row->idtipopago]."'
                     WHERE idestudiante='$idestudiante' AND idtipopago='".$row2->idtipopago."' ");
                }else{
                    $this->db->query("INSERT INTO pago(idestudiante,idtipopago,monto) VALUES ('$idestudiante','".$row->idtipopago."','".$_POST['d'.$row->idtipopago]."') ");

                }
            }
        }
        header("Location: ".base_url()."Pagos/index/$idestudiante");
    }
}