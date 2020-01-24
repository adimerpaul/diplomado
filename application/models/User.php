<?php
class User extends CI_Model {

    function  consulta($mostrar,$tabla,$where,$dato){
    $query = $this->db->query("SELECT $mostrar FROM $tabla WHERE $where='$dato'");
       if($query->num_rows()==0){
           return 0;
       }else{
           $row=$query->row();
           return $row->$mostrar;    
       }
       
    }
}