<?php
class M_penjualan_master extends CI_Model
{

	function laporan_penjualan($from, $to)
	{
		$sql = "
			SELECT 
				DISTINCT(SUBSTR(a.`time`, 1, 10)) AS time,
				(
					SELECT 
						SUM(b.`subtotal`) 
					FROM 
						`transaksi` AS b 
					WHERE 
						SUBSTR(b.`time`, 1, 10) = SUBSTR(a.`time`, 1, 10) 
					LIMIT 1
				) AS total_penjualan 
			FROM 
				`transaksi` AS a 
			WHERE 
				SUBSTR(a.`time`, 1, 10) >= '".$from."' 
				AND SUBSTR(a.`time`, 1, 10) <= '".$to."' 
			ORDER BY 
				a.`time` ASC
		";

		return $this->db->query($sql);
	}

	function laporan_pembelian($from, $to)
	{
		$sql = "
			SELECT 
				DISTINCT(SUBSTR(a.`time`, 1, 10)) AS time,
				(
					SELECT 
						SUM(b.`harga`) 
					FROM 
						`pembelian` AS b 
					WHERE 
						SUBSTR(b.`time`, 1, 10) = SUBSTR(a.`time`, 1, 10) 
					LIMIT 1
				) AS total_penjualan 
			FROM 
				`pembelian` AS a 
			WHERE 
				SUBSTR(a.`time`, 1, 10) >= '".$from."' 
				AND SUBSTR(a.`time`, 1, 10) <= '".$to."' 
			ORDER BY 
				a.`time` ASC
		";

		return $this->db->query($sql);
	}

	function laporan_anggota($from, $to,$nomor)
	{
		$sql = "
			SELECT  
				DISTINCT(SUBSTR(a.`time`, 1, 10)) AS time,
				(
					SELECT 
						SUM(b.`subtotal`) 
					FROM 
						`transaksi` AS b 
					WHERE 
						SUBSTR(b.`time`, 1, 10) = SUBSTR(a.`time`, 1, 10) 
						AND (b.`no_anggota`) = '".$nomor."'  
					LIMIT 1
				) AS total_penjualan 
			,no_anggota
			FROM 
				`transaksi` AS a 
			
			WHERE 
				SUBSTR(a.`time`, 1, 10) >= '".$from."' 
				AND SUBSTR(a.`time`, 1, 10) <= '".$to."'
				AND `no_anggota` = '".$nomor."'  
			ORDER BY 
				a.`time` ASC
		";

		return $this->db->query($sql);
	}

	function laporan_Hanggota($nomor)
	{
		$sql = "
			SELECT  
			*
			FROM 
				anggota
			
			WHERE 
				no_anggota = '".$nomor."'  
		";

		return $this->db->query($sql);
	
 		
	}

	function laporan_hutang($from, $to,$nomor)
	{
	 $this->db->select('*');
	 $this->db->from('hutang');
	 $this->db->join('barang','barang.id_barang=hutang.id_barang');
	 $this->db->join('anggota','anggota.no_anggota=hutang.no_anggota');
	 $this->db->where('hutang.no_anggota',$nomor);

	  $this->db->order_by('time','DESC');
 		return $this->db->get();
	}


}