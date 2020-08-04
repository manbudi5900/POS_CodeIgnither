<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pegawai extends CI_Model{

	private $primary_key = 'id_barang';
	private $table_name	= 'barang';
	private $table_name1	= 'anggota';

	public function __construct()
	{
	
		parent::__construct();
	
	}
	public function gpegawai($query) 
	{
	  	
	  $this->db->select("*");
	  $this->db->from("user");
	  $this->db->where("level !=","admin");
	  	if($query != ''){
		   $this->db->like('nama', $query);
	  	}
	  	$this->db->order_by('id', 'DESC');
	  	return $this->db->get();
 	}

 	function input_user($data){
		$this->db->insert('user',$data);
	}


	function ambilid($where){
		return $this->db->get_where('user',$where); 
	}

	function editPegawai($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table,$data);	  
	}

	 function Getuser($where) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($where);
        $data=$this->db->get();
        return $data;
    }

    function gantipass($where,$data) {
       $this->db->where($where);
		$this->db->update('user',$data);
		return true;
    }


	

}