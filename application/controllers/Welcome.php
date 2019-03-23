<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login(){
	    $name=$_POST['name'];
        $password=$_POST['password'];
        $query = $this->db->query("SELECT * FROM usuario WHERE nombre='$name' AND clave='$password' AND estado='ACTIVO'");
        echo $query->num_rows();
        if($query->num_rows()==1){
            $row=$query->row();
            $_SESSION['idusuario']=$row->idusuario;
            $_SESSION['idpersona']=$row->idpersona;
            $_SESSION['idrol']=$row->idrol;
            header('Location: '.base_url().'main');
        }else{
            header('Location: '.base_url());
        }
    }
}
