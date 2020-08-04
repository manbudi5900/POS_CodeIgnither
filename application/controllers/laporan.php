<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');



class laporan extends  CI_Controller
{
	public function __construct() {
            parent::__construct();
        if ($this->session->userdata('username')=="") {
            redirect('Kasir');
        }
        $this->load->helper('text');
    }
	public function index()
	{
		$this->load->view('laporan/penjualan/laporan');
	}
	public function pembelian()
	{
		$this->load->view('laporan/pembelian/laporan');
	}

	public function anggota()
	{
		$this->load->model('M_barang');
        $data['anggota'] = $this->M_barang->getA();
		$this->load->view('laporan/anggota/laporan',$data);
	}
	public function hutang()
	{
		$this->load->model('M_barang');
        $data['anggota'] = $this->M_barang->getA();
		$this->load->view('laporan/hutang/laporan',$data);
	}

	public function anggota1($from, $to,$nomor)
	{
		$this->load->model('M_penjualan_master');
		$dt['penjualan'] 	= $this->M_penjualan_master->laporan_anggota($from, $to,$nomor);
		$dt['hutang'] 	= $this->M_penjualan_master->laporan_Hanggota($nomor);
		$dt['from']			= date($from);
		$dt['to']			= date($to);
	
		$this->load->view('laporan/anggota/laporan1', $dt);
	}

	public function penjualan($from, $to)
	{
		
		
		$this->load->model('M_penjualan_master');
		$dt['penjualan'] 	= $this->M_penjualan_master->laporan_penjualan($from, $to);
		
		$dt['from']			= date($from);
		$dt['to']			= date($to);

		$this->load->view('laporan/penjualan/laporan1', $dt);
	}
	public function pembelian1($from, $to)
	{
		
		
		$this->load->model('M_penjualan_master');
		$dt['penjualan'] 	= $this->M_penjualan_master->laporan_pembelian($from, $to);
		
		$dt['from']			= date($from);
		$dt['to']			= date($to);

		$this->load->view('laporan/pembelian/laporan1', $dt);
	}

	public function hutang1($from, $to,$nomor)
	{
		$this->load->model('M_penjualan_master');
		$dt['penjualan'] 	= $this->M_penjualan_master->laporan_hutang($from, $to,$nomor);
		$dt['from']			= date($from);
		$dt['to']			= date($to);

		$this->load->view('laporan/hutang/laporan1', $dt);
	}



	public function excel($from, $to)
	{
		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_penjualan($from, $to);
		if($penjualan->num_rows() > 0)
		{
			$filename = 'Laporan_Penjualan_'.$from.'_'.$to;
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");

			echo "
				<h4>Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to))."</h4>
				<table border='1' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
			";

			$no = 1;
			$total_penjualan = 0;
			foreach($penjualan->result() as $p)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".date('d F Y', strtotime($p->time))."</td>
						<td>Rp. ".str_replace(",", ".", number_format($p->total_penjualan))."</td>
					</tr>
				";

				$total_penjualan = $total_penjualan + $p->total_penjualan;
				$no++;
			}

			echo "
				<tr>
					<td colspan='2'><b>Total Seluruh Penjualan</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($total_penjualan))."</b></td>
				</tr>
			</tbody>
			</table>
			";
		}
	}

	public function pdf($from, $to)
	{
		$this->load->library('pdf');
					
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',10);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0, 8, "Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'L'); 

		$pdf->Cell(15, 7, 'No', 1, 0, 'L'); 
		$pdf->Cell(85, 7, 'Tanggal', 1, 0, 'L');
		$pdf->Cell(85, 7, 'Total Penjualan', 1, 0, 'L'); 
		$pdf->Ln();

		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_penjualan($from, $to);

		$no = 1;
		$total_penjualan = 0;
		foreach($penjualan->result() as $p)
		{
			$pdf->Cell(15, 7, $no, 1, 0, 'L'); 
			$pdf->Cell(85, 7, date('d F Y', strtotime($p->time)), 1, 0, 'L');
			$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($p->total_penjualan)), 1, 0, 'L');
			$pdf->Ln();

			$total_penjualan = $total_penjualan + $p->total_penjualan;
			$no++;
		}

		$pdf->Cell(100, 7, 'Total Seluruh Penjualan', 1, 0, 'L'); 
		$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($total_penjualan)), 1, 0, 'L');
		$pdf->Ln();

		$pdf->Output();
	}

	public function excel1($from, $to)
	{
		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_pembelian($from, $to);
		if($penjualan->num_rows() > 0)
		{
			$filename = 'Laporan_Pembelian_'.$from.'_'.$to;
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");

			echo "
				<h4>Laporan Pembelian Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to))."</h4>
				<table border='1' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
			";

			$no = 1;
			$total_penjualan = 0;
			foreach($penjualan->result() as $p)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".date('d F Y', strtotime($p->time))."</td>
						<td>Rp. ".str_replace(",", ".", number_format($p->total_penjualan))."</td>
					</tr>
				";

				$total_penjualan = $total_penjualan + $p->total_penjualan;
				$no++;
			}

			echo "
				<tr>
					<td colspan='2'><b>Total Seluruh Pembelian</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($total_penjualan))."</b></td>
				</tr>
			</tbody>
			</table>
			";
		}
	}

	public function pdf1($from, $to)
	{
		$this->load->library('pdf');
					
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',10);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0, 8, "Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'L'); 

		$pdf->Cell(15, 7, 'No', 1, 0, 'L'); 
		$pdf->Cell(85, 7, 'Tanggal', 1, 0, 'L');
		$pdf->Cell(85, 7, 'Total Pembelian', 1, 0, 'L'); 
		$pdf->Ln();

		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_pembelian($from, $to);

		$no = 1;
		$total_penjualan = 0;
		foreach($penjualan->result() as $p)
		{
			$pdf->Cell(15, 7, $no, 1, 0, 'L'); 
			$pdf->Cell(85, 7, date('d F Y', strtotime($p->time)), 1, 0, 'L');
			$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($p->total_penjualan)), 1, 0, 'L');
			$pdf->Ln();

			$total_penjualan = $total_penjualan + $p->total_penjualan;
			$no++;
		}

		$pdf->Cell(100, 7, 'Total Seluruh Pembelian', 1, 0, 'L'); 
		$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($total_penjualan)), 1, 0, 'L');
		$pdf->Ln();

		$pdf->Output();
	}

	public function excel2($from, $to,$no_anggota)
	{
		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_anggota($from, $to,$no_anggota);
		$dt = $this->m_penjualan_master->laporan_Hanggota($no_anggota);
		if($penjualan->num_rows() > 0)
		{
			$filename = 'Laporan_Pembelian_'.$from.'_'.$to;
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");

			echo "
				<h4>Laporan Pembelian Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to))."</h4>
				<table border='1' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>No Angota</th>
							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
			";

			$no = 1;
			$total_penjualan = 0;
			foreach($penjualan->result() as $p)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".date('d F Y', strtotime($p->time))."</td>
						
						<td>".$no_anggota."</td>
						<td>Rp. ".str_replace(",", ".", number_format($p->total_penjualan))."</td>
					</tr>
				";

				$total_penjualan = $total_penjualan + $p->total_penjualan;
				$no++;
			}
			foreach($dt->result() as $p){
			echo "
				<tr>
					<td colspan='3'><b>Total Seluruh Pembelian</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($total_penjualan))."</b></td>
				</tr>
				<tr>
					<td colspan='3'><b>Total Seluruh Hutang</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($p->hutang))."</b></td>
				</tr>
			</tbody>
			</table>
			";
			}
		}
	}

	public function pdf2($from, $to,$no_anggota)
	{
		$this->load->library('pdf');
					
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',10);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0, 8, "Laporan Penjualan Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'L'); 

		$pdf->Cell(10, 7, 'No', 1, 0, 'L'); 
		$pdf->Cell(45, 7, 'Tanggal', 1, 0, 'L');
		$pdf->Cell(45, 7, 'No anggota', 1, 0, 'L');
		$pdf->Cell(95, 7, 'Total Pembelian', 1, 0, 'L'); 
		$pdf->Ln();

		$this->load->model('m_penjualan_master');
		$penjualan 	= $this->m_penjualan_master->laporan_anggota($from, $to,$no_anggota);
		$dt = $this->m_penjualan_master->laporan_Hanggota($no_anggota);

		$no = 1;
		$total_penjualan = 0;
		foreach($penjualan->result() as $p)
		{
			$pdf->Cell(10, 7, $no, 1, 0, 'L'); 
			$pdf->Cell(45, 7, date('d F Y', strtotime($p->time)), 1, 0, 'L');
			$pdf->Cell(45, 7, $no_anggota, 1, 0, 'L');
			$pdf->Cell(95, 7, "Rp. ".str_replace(",", ".", number_format($p->total_penjualan)), 1, 0, 'L');
			$pdf->Ln();

			$total_penjualan = $total_penjualan + $p->total_penjualan;
			$no++;
		}

		$pdf->Cell(100, 7, 'Total Seluruh Pembelian', 1, 0, 'L'); 
		$pdf->Cell(95, 7, "Rp. ".str_replace(",", ".", number_format($total_penjualan)), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(100, 7, 'Total seluruh hutang', 1, 0, 'L'); 
		
		foreach($dt->result() as $p){
		$pdf->Cell(95, 7, "Rp. ".str_replace(",", ".", number_format($p->hutang)), 1, 0, 'L');
		}
		$pdf->Ln();
		$pdf->Output();
	}


}