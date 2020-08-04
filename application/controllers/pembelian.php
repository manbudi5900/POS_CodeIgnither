<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class pembelian extends CI_Controller {

	 
	public function __construct() {
            parent::__construct();
        if ($this->session->userdata('username')=="") {
            redirect('Kasir');
        }
        $this->load->helper('text');
    }

	 public function index(){
	 	$this->load->view('welcome_message');
        } 

        public function awal(){
        	if ($this->session->userdata('username')=="") {
            redirect('Kasir');
        	}
	 	 $this->load->model('M_barang');
        $data['barang'] = $this->M_barang->get();
      
       
		$this->load->view('pembelian/data_pembelian',$data);
        } 
    
    public function show_pembelian(){
	 $this->load->model('M_pembelian');
	  $output = '';
	  $query = '';
	 
		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  $data = $this->M_pembelian->gsup($query);
		  $output .= ' 
		  <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 100%;">
		     <thead style="background-color:#bdc3c7;">
				<tr role="row">
					<th class="sorting_asc" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
					<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
					<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama Supplier</th>
					<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Total pembelian</th>
					<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Waktu</th>
					<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Aksi</th>
				</tr>
			</thead>
		  ';
		  if($data->num_rows() > 0)
		  {
		  	$index=1;
		   foreach($data->result() as $row)
		   {
		    $output .= '
		      <tbody>
				<tr role="row" class="odd">
					<td class="sorting_1">'.$index.'</td>
					<td>'.$row->nota.'</td>
					<td>'.$row->nama_supplier.'</td>
	   				<td>'.$row->total_belanja.'</td>
					<td>'.$row->time.'</td>
					<td>
						<a onclick="tambahpembelian(\''.$row->nota.'\')"><i class=" fa fa-plus"></i> Tambah</a>
                     	<a onclick="detail(\''.$row->nota.'\')"><i class="fa fa-file-text-o"></i> Detail</a>
               
					</td>
				</tr>
			</tbody>
		    '; $index++;
		   }
		  }
		  else
		  {
		   $output .= ' <tbody>
		   					<tr>
		       					<td colspan="5">No Data Found</td>
		      				</tr>
		       			</tbody>';
		  }
		   $output .= ' </table>';

		 
		  echo $output;
		 


    }

    public function tambahpembelian(){
    	$this->load->model('M_barang');
    		$this->load->model('M_pembelian');
    	$time=date('Y-m-d');
		$data = array(
				'nota' => $this->input->post('nota'),
				'time' => $time,
				'nama_barang' => strtolower($this->input->post('nama')),
				'stok' => $this->input->post('stok'),
				'harga' => $this->input->post('harga'),
				
		);
		$where = array(
				'nama_barang' => $this->input->post('nama'),
				
		);

		$where1 = array(
				'nota' => $this->input->post('nota'),
		);

		$dataget=$this->M_barang->getstok($where['nama_barang']);
		$dataget1=$this->M_pembelian->getharga($where1['nota']);

		
		
		
		if ($dataget->num_rows()>0) {
			$row = $dataget->row_array();
			$row1 = $dataget1->row_array();
			$data1 = array(
				'stok_barang' => $this->input->post('stok')+$row['stok_barang'],
				
			);

			$data2 = array(
				'total_belanja' => $this->input->post('harga')+$row1['total_belanja'],
				
			);
			$this->M_pembelian->updateharga('supplier',$where1,$data2);

		 	$databarang=$this->M_barang->updateB('barang',$where,$data1);
		   
			$this->M_pembelian->input_pembelian($data);
			redirect(base_url('pembelian/awal'),'refresh');

			
		}else if($dataget->num_rows()==0){
			echo "<script>alert('Gagal Menambahkan Pembelian, inputkan barang terlebih dahulu');</script>";
			$this->load->view('penjualan/data_barang');
		}
		
		
	}


	 public function tambahnota(){
    	$this->load->model('M_barang');
    	$this->load->model('M_pembelian');
    	$time=date('Y-m-d');
		$data = array(
				'nota' => $this->input->post('nota1'),
				'time' => $time,
				'nama_supplier' => strtolower($this->input->post('nama')),
				'total_belanja' => $this->input->post('total')
		);
		
		$where = array(
				'nota' => $this->input->post('nota1'),
		);

		$dataget=$this->M_pembelian->nota($where);
		
		
		
		if ($dataget->num_rows()>0) {
			echo "<script>alert('Gagal Menambahkan Nota, Nota sudah ada');</script>";
			redirect(base_url('pembelian/awal'),'refresh');

			
		}else if($dataget->num_rows()==0){
		   	
			$this->M_pembelian->input_nota($data);
			redirect(base_url('pembelian/awal'),'refresh');
		}
		
		
	}


	public function   datanota(){
		$this->load->model('M_pembelian');
	  $output = '';
	  $query = '';
	 
		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  $data = $this->M_pembelian->gpembelian($query);
		  if($data->num_rows() > 0)
		  {
		  	$index=1;
		   foreach($data->result() as $row)
		   {
		    $output .= '
		    
				<tr role="row" class="odd">
					<td class="sorting_1">'.$index.'</td>
					<td>'.$row->nota.'</td>
					<td>'.$row->nama_barang.'</td>
	   				<td>'.$row->stok.'</td>
	   				<td>'.$row->harga.'</td>
					<td>'.$row->time.'</td>
				</tr>
			
		    '; $index++;
		   }
		  }
		  else
		  {
		   $output .= ' 
		   					<tr>
		       					<td colspan="5">No Data Found</td>
		      				</tr>
		       			';
		  }
		  

		 
		  echo $output;
	
	}

	



}