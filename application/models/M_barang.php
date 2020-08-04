<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_barang extends CI_Model{

	private $primary_key = 'id_barang';
	private $table_name	= 'barang';
	private $table_name1	= 'anggota';

	public function __construct()
	{
	
		parent::__construct();
	
	}

	public function cek_user($data) {
			$query = $this->db->get_where('user',$data);
			return $query;
		}

	public function gBarang($query) 
	{
	  	
	  $this->db->select("*");
	  $this->db->from("barang");
	  	if($query != ''){
		   $this->db->like('id_barang', $query);
		   $this->db->or_like('nama_barang', $query);
	  	}
	  	$this->db->order_by('id_barang', 'DESC');
	  	return $this->db->get();
 	}	
	

	public function get() 
	{
	  	
	  	$this->db->select('*');

		return $this->db->get($this->table_name)->result();
	
	}

	public function getnota() 
	{
	  	$time=date('Y-m-d');
	  	$this->db->select('nota');
	  	$this->db->where('time',$time);
		return $this->db->get('pembelian')->result();
	
	}

	

	public function getA() 
	{
	  	
	  	$this->db->select('no_anggota,nama_anggota');
	  	$this->db->where('no_anggota not like 0');
		return $this->db->get('anggota')->result();
	
	}

	public function getA1() 
	{
	  	
	  	$this->db->select('no_anggota,nama_anggota');
	  
		return $this->db->get('anggota')->result();
	
	}

	public function get_by_id($id)
	{
	  
	  	$this->db->where($this->primary_key,$id); 
	  
	  	return $this->db->get($this->table_name)->row();
	
	}

	public function get_by_nama($id)
	{
	  
	  	$this->db->where('nama_barang',$id); 
	  
	  	return $this->db->get($this->table_name)->row();
	
	}

	public function get_by_id1($id)
	{
	  
	  	$this->db->where('nama_barang',$id); 
	  
	  	return $this->db->get($this->table_name)->row();
	
	}
	public function getanggota($id)
	{
	  
	  	$this->db->where('no_anggota',$id); 
	  
	  	return $this->db->get('anggota')->row();
	
	}



	function input_data($data){
		$this->db->insert($table_name,$data);
		return true;
	}

	function input_data1($data1){
		$this->db->insert('transaksi',$data1);
		return $this->db->insert_id();
	}

	function input_nota($data1){
		$this->db->insert('penjualan',$data1);
		return $this->db->insert_id();
	}


	function minstok($id,$qty){
		$query = $this->db->query("select stok_barang from barang where id_barang='$id'");
		$stok;
		foreach ($query->result() as $barang)
		{
        	$stok = $barang->stok_barang;
		}
		$stok = $stok - $qty;
		//echo $stok;
		//exit();
 		$this->db->query("UPDATE barang SET stok_barang='$stok' WHERE id_barang='$id'");
	}

	function plusstok($id,$qty){
		$query = $this->db->query("select stok_barang from barang where id_barang='$id'");
		$stok;
		foreach ($query->result() as $barang)
		{
        	$stok = $barang->stok_barang;
		}
		$stok = $stok + $qty;
 		$this->db->query("UPDATE barang SET stok_barang='$stok' WHERE id_barang='$id'");
	}

	function input_barang($data){
		$this->db->insert('barang',$data);
	}

	function ambilid($where){
		return $this->db->get_where('barang',$where); 
	}
	function ambilnama($where){
		return $this->db->get_where('barang',$where); 
	}

	function tStok($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table,$data);	  
	}
	function editBarang($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table,$data);	  
	}


	function get_baris($id_pelanggan)
	{
		return $this->db
			->select('no_anggota, nama_anggota, alamat, telp, bidang, no_telpon')
			->where('no_anggota', $id_pelanggan)
			->limit(1)
			->get('anggota');
	}

	function getstok($where){
		$query=$this->db->query("SELECT * FROM barang WHERE nama_barang ='$where'");
		return $query; 
	}


	function updateB($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table,$data);	  
	}

	public function gTBarang($query) 
	{
	  	
	  $query=$this->db->query("SELECT * FROM barang WHERE id_barang ='$query'");
		return $query; 
	}


	public function gNota() 
	{
	$time=date('Y');
	$time1=date('m');
	$time2=date('d');
	return $this->db->query("SELECT * FROM penjualan   WHERE YEAR(time) ='$time' AND month(time) ='$time1' AND day(time) ='$time2'  ORDER BY time DESC" );

	// $this->db->select('*');
	//  $this->db->from('penjualan');
	//  $this->db->where('YEAR(time)=',$time, 'AND Month(time) =',$time1);
	//   $this->db->order_by('time','DESC');
 		// return $this->db->get();
 	}	 

 	public function gNotaD() 
	{
	  
	$this->db->select('*');
	 $this->db->from('penjualan');
	  $this->db->order_by('time','DESC');
 		return $this->db->get();
 	}	

	public function gTransaksi($nota) 
	{
	  	$time=date('Y-m-d H:i:s');
	$this->db->select('*');
	 $this->db->from('transaksi');
	 $this->db->join('barang','barang.id_barang=transaksi.id_barang');
	 $this->db->join('anggota','anggota.no_anggota=transaksi.no_anggota');
	 $this->db->join('user','user.id=transaksi.id_user');
	 $this->db->where('nota',$nota);
	  $this->db->order_by('time','DESC');
 		return $this->db->get();
 	}	

 	public function gTransaksiD() 
	{
	  
	$this->db->select('*');
	 $this->db->from('transaksi');
	 $this->db->join('barang','barang.id_barang=transaksi.id_barang');
	 $this->db->join('anggota','anggota.no_anggota=transaksi.no_anggota');
	 $this->db->join('user','user.id=transaksi.id_user');
	  $this->db->order_by('time','DESC');
 		return $this->db->get();
 	}	

 	public function bon($id,$bon){
 		$query = $this->db->query("select hutang from anggota where no_anggota='$id'");
		$hutang;
		foreach ($query->result() as $anggota)
		{
        	$hutang = $anggota->hutang;
		}
		$hutang = $hutang + $bon;
 		$this->db->query("UPDATE anggota SET hutang='$hutang' WHERE no_anggota='$id'");
 	}

 	

	function minhutang($where,$data){
		$this->db->where($where);
		$this->db->update('anggota',$data);
		
	}

	function input_hutang($data){
		$this->db->insert('hutang',$data);		
	}

}