<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login(){
	    $name=$_POST['name'];
        $password=md5($_POST['password']);
        $query = $this->db->query("SELECT * FROM usuario WHERE nombre='$name' AND clave='$password' AND estado='ACTIVO'");
//        echo $query->num_rows();
//        error_log($query->num_rows());
        if($query->num_rows()==1){

            $row=$query->row();
            $_SESSION['idusuario']=$row->idusuario;
            $_SESSION['idpersona']=$row->idpersona;
            // echo $this->User->consulta('idestudiante','estudiante','idpersona',$row->idusuario);
            // exit;

            $_SESSION['idestudiante']=$this->User->consulta('idestudiante','estudiante','idpersona',$row->idusuario);
            $_SESSION['idrol']=$row->idrol;

            // echo "<meta http-equiv='refresh' content='0; url=".base_url()."Main'>";
//            header("Location: ".base_url()."Main");
            echo 1;
//            exit;
        }else{
            // echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
//            header("Location: ".base_url());
            exit;
        }
    }
    function logout(){
	    session_destroy();
        header('Location: '.base_url());
    }
}
