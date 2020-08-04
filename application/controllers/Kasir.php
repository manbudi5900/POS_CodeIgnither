

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Kasir extends CI_Controller {

	 public function index(){

	 	
		$this->load->view('welcome_message');

        } 
         public function transaksi(){
          	$this->load->model('M_barang');
	        $data['barang'] = $this->M_barang->get();
	        $data['anggota'] = $this->M_barang->getA1();
	        $this->load->view('penjualan/transaksi',$data);
    	}
         public function history(){

	 	
		$this->load->view('penjualan/history');

        } 

         public function historyD(){

	 	
		$this->load->view('penjualan/historyD');

        } 

     public function cek_login() {
		$data = array('username' => $this->input->post('username'),
						'password' => $this->input->post('password')
		);
		$this->load->model('M_barang');
		$hasil = $this->M_barang->cek_user($data);
		if ($hasil->num_rows() > 0) {
			$cek=$hasil->row_array();
			if ($cek['status'] == "aktif") {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Loggin';
				$sess_data['id'] = $sess->id;
				$sess_data['nama'] = $sess->nama;
				$sess_data['username'] = $sess->username;
				$sess_data['level'] = $sess->level;
				$this->session->set_userdata($sess_data);
			}
				redirect('login');
			}else{
				echo "<script>alert('Gagal login: Anda sudah Dinonaktifkan');history.go(-1);</script>";
				
			}	
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}



    public function Tbarang(){
    	 $this->load->model('M_barang');
        $data['barang'] = $this->M_barang->get();
    	
	$this->load->view('penjualan/data_barang',$data);
    }

    public function barang(){
	 $this->load->model('M_barang');
		// $data['barang'] = $this->M_barang->gBarang();
		// $this->load->view('penjualan/data_barang',$data);

  $output = '';
  $query = '';
 
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->M_barang->gBarang($query);
  $output .= ' 
  <table  class="table table-striped  dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 95%;">
     <thead style="background-color:#bdc3c7;">
		<tr role="row">
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Kode Barang</th>
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama</th>
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 268px;">Harga</th>
			<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Edit" style="width: 207px;">stok_barang</th>
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
			<td class="sorting_1">'. $index.'</td>
			<td>'.$row->id_barang.'</td>
			<td>'.$row->nama_barang.'</td>
			<td>'.$row->harga_barang.'</td>
			<td>'.$row->stok_barang.'</td>
			<td><a onclick="editB(\''.$row->id_barang.'\')"><i class="fa fa-pencil"></i> Edit</a></td>
			
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

    public function history1(){
	 $this->load->model('M_barang');
	  


	  $output = '';
	  // $data = $this->M_barang->gTransaksi();
	  $data = $this->M_barang->gNota();
	   $output .= ' 
	  
	  <table class="table table-striped  dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 98%;" >
	    <thead style="background-color:#bdc3c7">
			<tr role="row">
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Total</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Waktu</th>
				
				
			</tr>
			
		</thead>
		
		
	  ';
	 
	  	$index=1;

	   foreach($data->result() as $row){
	    $output .= '
	      <tbody>
			<tr role="row" class="odd">
				<td class="sorting_1">'. $index.'</td>
				<td><a onClick=ambilnota(\''.$row->nota.'\')>'.$row->nota.'</a></td>
				<td>'.$row->total_harga.'</td>
				<td>'.$row->time.'</td>
			</tr>
		</tbody>
	    '; $index++;
	   }




	 //  $output .= ' 
	 //  <table class="table table-striped  dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 98%;">
	 //     <thead style="background-color:#bdc3c7;">
		// 	<tr role="row">
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama pembeli</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 268px;">Nama Kasir</th>
		// 		<th class="no-sort sorting_disabled" rowspan="3" colspan="1" aria-label="Edit" style="width: 268px;">Nama Barang</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 268px;">Harga Satuan</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 100px;">Jumlah</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Total</th>
		// 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Waktu</th>
				
				
		// 	</tr>
		// </thead>
	 //  ';
	 
	 //  	$index=1;
	 //   foreach($data->result() as $row){
	 //    $output .= '
	 //      <tbody>
		// 	<tr role="row" class="odd">
		// 		<td class="sorting_1">'. $index.'</td>
		// 		<td>'.$row->nota.'</td>
		// 		<td>'.$row->nama_anggota.'</td>
		// 		<td>'.$row->nama.'</td>
		// 		<td>'.$row->nama_barang.'</td>
		// 		<td>'.$row->harga.'</td>
		// 		<td>'.$row->qty.'</td>
		// 		<td>'.$row->subtotal.'</td>
		// 		<td>'.$row->time.'</td>
		// 	</tr>
		// </tbody>
	 //    '; $index++;
	 //   }
	   $output .= ' </table>';

	 
	  echo $output;
	 


	    } 


	    public function history2(){
	  $this->load->model('M_barang');
	  


	  $output = '';
	  // $data = $this->M_barang->gTransaksi();
	  $data = $this->M_barang->gNotaD();
	   $output .= ' 
	  <table class="table table-striped  dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 98%;">
	     <thead style="background-color:#bdc3c7;">
			<tr role="row">
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Total</th>
				<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Waktu</th>
				
				
			</tr>
		</thead>
	  ';
	 
	  	$index=1;

	   foreach($data->result() as $row){
	    $output .= '
	      <tbody>
			<tr role="row" class="odd">
				<td class="sorting_1">'. $index.'</td>
				<td><a onClick=ambilnota(\''.$row->nota.'\')>'.$row->nota.'</a></td>
				<td>'.$row->total_harga.'</td>
				<td>'.$row->time.'</td>
			</tr>
		</tbody>
	    '; $index++;
	   }
	   $output .= ' </table>';

	 
	  echo $output;
	 


	    }


    
	public function getbarang($id)
	{

		$this->load->model('M_barang');

		$barang = $this->M_barang->get_by_id($id);

		if ($barang) {

			if ($barang->stok_barang == '0') {
				$disabled = 'disabled';
				$info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #d9534f;">
					          stok habis</span>';
			}else{
				$disabled = '';
				$info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #5cb85c;">stok : '
					          .$barang->stok_barang.'</span>';
			}

			echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="'.$barang->nama_barang.'"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" id="harga_barang" name="harga_barang" 
				        	value="'.number_format( $barang->harga_barang, 0 ,
				        	 '' , '.' ).'" readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Quantity :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	name="qty" placeholder="Isi qty..." autocomplete="off" 
				        	id="qty" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" min="0"  
				        	max="'.$barang->stok_barang.'" '.$disabled.'>
				      </div>'.$info_stok.'
				    </div>';
	    }else{

	    	echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="harga_barang">Harga (Rp) :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="harga_barang" id="harga_barang" 
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Quantity :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	autocomplete="off" onchange="subTotal(this.value)" 
				        	onkeyup="subTotal(this.value)" id="qty" min="0"  
				        	name="qty" placeholder="Isi qty...">
				      </div>
				    </div>';
	    }


	}

	public function ajax_list_transaksi()
	{

		$data = array();

		$no = 1; 
        
        foreach ($this->cart->contents() as $items){
        	
			$row = array();
			$row[] = $no;
			$row[] = $items["id"];
			$row[] = $items["name"];
			$row[] = 'Rp. ' . number_format( $items['price'], 
                    0 , '' , '.' ) . ',-';
			$row[] = $items["qty"];
			$row[] = 'Rp. ' . number_format( $items['subtotal'], 
					0 , '' , '.' ) . ',-';

			//add html for action
			$row[] = '<a 
				href="javascript:void()" style="color:rgb(255,128,128);
				text-decoration:none" onclick="deletebarang('
					."'".$items["rowid"]."'".','."'".$items['subtotal'].
					"'".','."'".$items['id'].
					"'".','."'".$items['qty'].
					"'".')"> <i class="fa fa-close"></i> Delete</a>';
		
			$data[] = $row;
			$no++;
        }

		$output = array(
						"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function addtransaksi(){
		$total1=0;
		$time= date('Y-m-d H:i:s');
		$nota=$this->input->post('nomor_nota');
		$bon=$this->input->post('bon');
		$kasir=$this->input->post('nama_kasir');
		$id_pelanggan=$this->input->post('id_pelanggan');
		$id_user=$this->session->userdata('id');
		$this->load->model('M_barang');
		
		$data = array();
		foreach ($this->cart->contents() as $items){
			$dataset1 = array(
			'id_barang' => $items["id"],
			'harga' => $items['price'],
			'qty' => $items["qty"],
			'subtotal' => $items['subtotal'],
			'time' => $time,
			'no_anggota' => $id_pelanggan,
			'id_user' => $id_user,
			'nota' => $nota,
			);
			$total1=$total1+$items['subtotal'];
			$this->load->model('M_barang');
		$this->M_barang->input_data1($dataset1);
		
		}

		

		$data2 =array('nota' =>$nota ,
						'time'=> $time,
						'total_harga' => $total1,
		 );
		$this->M_barang->input_nota($data2);
		$this->load->model('M_barang');
		$this->M_barang->bon($id_pelanggan,$bon);
		if ($bon !=0) {
			$data7 = array();
			foreach ($this->cart->contents() as $items){
			$dataset2 = array(
			'id_barang' => $items["id"],
			'harga' => $items['price'],
			'jumlah' => $items["qty"],
			'subtotal' => $items['subtotal'],
			'time' => $time,
			'no_anggota' => $id_pelanggan,
			);
			$this->load->model('M_barang');
			$this->M_barang->input_hutang($dataset2);
			$i++;
			}
		
		}
		
	
		foreach ($this->cart->contents() as $items){
			$this->cart->update(array(
				'rowid'=>$items["rowid"],
				'qty'=>0,));
		}		
				redirect('');
	}

	public function addbarang()
	{

		$data = array(
				'id' => $this->input->post('id_barang'),
				'name' => $this->input->post('nama_barang'),
				'price' => str_replace('.', '', $this->input->post(
					'harga_barang')),
				'qty' => $this->input->post('qty')
			);
		$insert = $this->cart->insert($data);
		echo json_encode(array("status" => TRUE));
		$this->load->model('M_barang');
		$this->M_barang->minstok($this->input->post('id_barang'), $this->input->post('qty'));
		
	}

	public function deletebarang($rowid, $id, $qty) 
	{
		$this->load->model('M_barang');
		$this->M_barang->plusstok($id,$qty);

		$this->cart->update(array(
				'rowid'=>$rowid,
				'qty'=>0,));


		echo json_encode(array("status" => TRUE));
	}

	public function tambahBarang(){
		$data = array(
				'id_barang' => $this->input->post('kode'),
				'nama_barang' => $this->input->post('nama'),
				'stok_barang' => 0,
				'harga_barang' => $this->input->post('harga'),
			);
		$where=array(
			'nama_barang' => $this->input->post('nama'),
			);
		$this->load->model('M_barang');
		$databarang=$this->M_barang->ambilnama($where);
		$cek=$databarang->row_array(); 
			if ($cek['nama_barang']!=$this->input->post('nama')) {
				$this->M_barang->input_barang($data);
				redirect(base_url('Kasir/Tbarang'),'refresh');
			}
			else{
				echo "<script>alert('Gagal Menambahkan');history.go(-1);</script>";
			}
	
	}

	public function   ambilid(){
		$query = '';

	  if($this->input->post('query')){
   		$query = $this->input->post('query');
  	  }
		$where=array(
			'id_barang' => $query
			);
		$this->load->model('M_barang');
		$databarang=$this->M_barang->ambilid($where)->result();
		echo json_encode($databarang);
	
	}


	function editBarang(){
		

  	  $where=array(
			'id_barang' =>$this->input->post('kodeA')
	  );

	  $data=array(
			'id_barang' => $this->input->post('kode'),
				'nama_barang' => strtolower($this->input->post('nama')),
				'harga_barang' => $this->input->post('harga'),
	  );

  	  $this->load->model('M_barang');
	 $databarang=$this->M_barang->editBarang('barang',$where,$data);
	  echo json_encode($kode);
	}



	public function ajax_pelanggan()
	{
		if($this->input->is_ajax_request())
		{
			$id_pelanggan = $this->input->post('id_pelanggan');
			$this->load->model('M_barang');

			$data = $this->M_barang->get_baris($id_pelanggan)->row();
			$json['no_telpon']			= ( ! empty($data->no_telpon)) ? $data->telp : "<small><i>Tidak ada</i></small>";
			$json['alamat']			= ( ! empty($data->alamat)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->alamat) : "<small><i>Tidak ada</i></small>";
			echo json_encode($json);
		}
	}


	public function gbarang($id)
	{

		$this->load->model('M_barang');

		$barang = $this->M_barang->get_by_id1($id);

		if ($barang) {
			echo '	<div class="form-group">
						<label>Kode Barang</label>
						<input type="text" name="kode" class="form-control" autocomplete="off" required value="'.$barang->id_barang.'" >
						<input type="hidden"  name="kodeA" value="">
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type ="text" name="harga" id="harga" class="form-control" autocomplete="off" required value="'.$barang->harga_barang.'" >
					</div>
					';
	    }else{

	    	echo '<div class="form-group">
						<label>Kode Barang</label>
						<input type="text" name="kode" class="form-control" autocomplete="off" required  >
						<input type="hidden"  name="kodeA" value="">
					</div>					
					<div class="form-group">
						<label>Harga</label>
						<input type ="text" name="harga" id="harga" class="form-control" autocomplete="off" required >
					</div>
					';
	    }

	}
	
	public function hutang() 
	{

		$this->load->model('M_barang');
        $data['anggota'] = $this->M_barang->getA();
        $this->load->view('penjualan/bayarhutang',$data);
	}
	public function ghutang($id){
		$this->load->model('M_barang');

		$barang = $this->M_barang->getanggota($id);

		if ($barang) {
			echo '	<div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">Jumlah Hutang</label>
                            <div class="col-sm-8">
                            <input type="text" name="hutang" class="form-control" id="hutang" readonly="readonly" value="'.$barang->hutang.'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">Bayar</label>
                            <div class="col-sm-8">
                            <input type="text" name="bayar" class="form-control" id="bayar" required>
                            </div>
                        </div>

					';
	    }else{

	    	echo '<div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">Jumlah Hutang</label>
                            <div class="col-sm-8">
                            <input type="text" name="hutang" class="form-control" id="hutang" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">Bayar</label>
                            <div class="col-sm-8">
                            <input type="text" name="bayar" class="form-control" id="bayar" required >
                            </div>
                        </div>
					';
	    }

	}

	function minhutang(){
		$no=$this->input->post('no_anggota');
		$hutang=$this->input->post('hutang');
		$bayar=$this->input->post('bayar');

		$akhir=intval($hutang)-intval($bayar);
			if ($akhir<=0) {
				$akhir=0;
			}
		$where=array( 'no_anggota' => $no
			);
		$data=array('hutang' => $akhir
			);

		$this->load->model('M_barang');
		$cek=$this->M_barang->minhutang($where,$data);
		redirect(base_url('Kasir/hutang'),'refresh');
	}

	public function  datanota(){
	  $this->load->model('M_barang');
	  $output = '';
	  $query = '';
	 
		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  $data = $this->M_barang->gTransaksi($query);

		  

		  if($data->num_rows() > 0){
		  	$index=1;
			   foreach($data->result() as $row){
			    $output .= '			    
					<tr role="row" class="odd">
						<td class="sorting_1">'. $index.'</td>
						<td>'.$row->nota.'</td>
						<td>'.$row->nama_anggota.'</td>
						<td>'.$row->nama.'</td>
						<td>'.$row->nama_barang.'</td>
						<td>'.$row->harga.'</td>
						<td>'.$row->qty.'</td>
						<td>'.$row->subtotal.'</td>
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




	static function _paging($base_url, $total_data, $current_page, $data_per_page = 10, $range_data = 3){

        $out = '<span class="text-muted">' . $total_data . ' Item' . ($total_data > 1 ? 's' : '') . '</span>';
        /** cek apakah memungkinkan untuk paging */
        if ($total_data > $data_per_page && $data_per_page > 0) {
            $total_page = ceil($total_data / $data_per_page);

            /** batas minimum */
            $ii = ($ii = $current_page - $range_data) < 1 ? 1 : $ii;

            /** batas maksimum */
            $iii = ($iii = $current_page + $range_data) > $total_page ? $total_page : $iii;

            $out .= '<ul class="pagination pagination-sm no-margin pull-right">';

            /** tampilkan left arrow */
            if ($current_page == 1)
                $out .= '<li><span>&laquo;</span></li>';
            else
                $out .= '<li><a href="' . $base_url . DS . self::nav_page . DS . 1 . '">&laquo;</a></li>';

            /** jika tidak mepet dengan nilai minimum, tampilkan titik-titik */
             if ($ii != 1)
                $out .= '<li><span>...</span></li>';

            /** mulai iterasi sesuai range yang telah ditentukan */
            for ($i = $ii; $i <= $iii; $i++)
                $out .= '<li class="' . ($current_page == $i ? 'active' : '') . '">' .
                    '<a href="' . $base_url . DS . self::nav_page . DS . $i . '">' . $i . '</a></li>';

            /** jika tidak mepet dengan nilai maksimum, tampilkan titik-titik */
            if ($iii != $total_page)
                $out .= '<li><span>...</span></li>';

            /** tampilkan right arrow */
            if ($current_page == $total_page)
                $out .= '<li><span>&raquo;</span></li>';
            else
                $out .= '<li><a href="' . $base_url . DS . self::nav_page . DS . $total_page . '">&raquo;</a></li>';

            $out .= '</ul>';

        }

        return $out;
    }


}