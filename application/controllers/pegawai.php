<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class pegawai extends CI_Controller {


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
	 
		$this->load->view('pegawai/data_pegawai');
        } 
    
    public function show_pegawai(){
	 $this->load->model('M_pegawai');
  $output = '';
  $query = '';
 
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->M_pegawai->gpegawai($query);
  $output .= ' 
  <table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 95%;">
     <thead style="background-color:#bdc3c7;">
		<tr role="row">
			<th class="sorting_asc" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
			<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama User</th>
			<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Bidang</th>
			<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Status</th>
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Edit" style="width: 207px;">Edit</th>
			
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
			<td>'.$row->nama.'</td>
			<td>'.$row->level.'</td>
			<td>'.$row->status.'</td>
			<td><a onclick="editB('.$row->id.')"><i class="fa fa-pencil"></i> Edit</a></td>
			
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

    public function tambahuser(){
		$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status'),
				
			);
		$this->load->model('M_pegawai');
		$this->M_pegawai->input_user($data);
		redirect(base_url('pegawai/awal'),'refresh');
	}

	public function  ambilid(){
	$query = '';

	  if($this->input->post('query')){
   		$query = $this->input->post('query');
  	  }
		$where=array(
			'id' => $query
			);
		$this->load->model('M_pegawai');
		$databarang=$this->M_pegawai->ambilid($where)->result();
		echo json_encode($databarang);
	
	}


	function editPegawai(){
  	  $where=array(
			'id' =>$this->input->post('id')
	  );

	  $data=array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status')
	  );

  	  $this->load->model('M_pegawai');
	 $databarang=$this->M_pegawai->editPegawai('user',$where,$data);
	  echo json_encode($kode);
	}

	function gantipass(){
		$this->load->view('pegawai/gantipass');
	}

	function gantipass1(){
		$old_password=$this->input->post('opassword');
		$id=$this->session->userdata('id');
		  $this->load->model('M_pegawai');
		$cek=$this->M_pegawai->Getuser(array('password' => $old_password,'id'=>$id));
		if($cek->num_rows()>=1){
			echo json_encode(false);
			// jika cek user bernilai lebih dari sama dengan 1 (ada data) maka kirimkan nilai false
		} else{
			echo json_encode(true);
		}
	}

	function gantipass2(){
		$baru=$this->input->post('passwordK');
		$id=$this->session->userdata('id');
		$where=array(
			'id' =>$id
	  	);
		 $data=array(
				'password' => $baru,
	  	);
		
		  $this->load->model('M_pegawai');
		$cek=$this->M_pegawai->gantipass($where,$data);
		if($cek==true){
			echo "<script>alert('Berhasil di ganti');history.go(-1);</script>";
		} else{
			echo "<script>alert('Gagal');history.go(-1);</script>";
		}
	}



}