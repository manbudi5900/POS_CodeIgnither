<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
    class My_model extends CI_Model{
         function fetch_data($query){
        $this->db->select("*");
        $this->db->from("barang");
        if ($query!='') {
        	$this->db->like('nama_barang',$query);
        	$this->db->or_like('kode_barang',$query);
        }
        $this->db->order_by('id','ASC');
        return $this->db->get();

         
    	}
        function fetch_data1($query){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("level != admin");

        if ($query!='') {
            $this->db->like('nama',$query);
        }
        $this->db->order_by('id','ASC');
        return $this->db->get();

         
        }
	}
?>