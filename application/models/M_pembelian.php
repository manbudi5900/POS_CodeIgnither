<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pembelian extends CI_Model{

	private $primary_key = 'id_barang';
	private $table_name	= 'barang';
	private $table_name1	= 'anggota';

	public function __construct()
	{
	
		parent::__construct();
	
	}
	public function gpembelian($query) 
	{

	  $this->db->select("*");
	  $this->db->from("pembelian");
	   $this->db->where("nota",$query);	  
	  	$this->db->order_by('time', 'DESC');
	  	return $this->db->get();
 	}

 	public function gsup($query) 
	{

	  $this->db->select("*");
	  $this->db->from("supplier");
	  	if($query != ''){
		   $this->db->like('nota', $query);
		    $this->db->or_like('nama_supplier', $query);
	  	}
	  	$this->db->order_by('time', 'DESC');
	  	return $this->db->get();
 	}

 	function input_pembelian($data){
		$this->db->insert('pembelian',$data);
	}
	function input_nota($data){
		$this->db->insert('supplier',$data);
	}


	function ambilid($where){
		return $this->db->get_where('pembelian',$where); 
	}
	
	function nota($where){
		return $this->db->get_where('supplier',$where); 
	}

	function getharga($where){
		$query=$this->db->query("SELECT * FROM supplier WHERE nota ='$where'");
		return $query; 
	}

	function updateharga($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table,$data);	  
	}

}