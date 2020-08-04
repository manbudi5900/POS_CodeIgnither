<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>


<div class="col-md-15">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> User <i class="fa fa-angle-right fa-fw"></i> Daftar Pembelian</h5>
			<hr>
			<div class="table-responsive">
				<div data-toggle="modal" data-target="#exampleModal" id="my-grid_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="row"><div class="col-sm-6">
						<div  class="dataTables_length" id="my-grid_length" >
							<label>
								<a  class="btn btn-default" id="TambahMerek" onclick="modal()">
									<i class="fa fa-plus fa-fw"></i> Tambah Nota
								</a>&nbsp;&nbsp;
									<span id="Notifikasi" style="display: none;"></span>
							</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div id="my-grid_filter" class="dataTables_filter">
							<label>
								<i class="fa fa-search fa-fw"></i> 
								Pencarian : <input id="search_text" type="search" class="form-control input-sm" placeholder="" aria-controls="my-grid">
							</label>
						</div>
					</div>
				</div>

				<div id="result"></div>
							
			</div>
			</div>
		</div>
		
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Tambah Nota</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="<?php echo base_url('pembelian/tambahnota')?>" id="FormTambahUser" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label>NOTA</label>
						<input list="list_nota" class="form-control reset" 
		                placeholder="Isi nota" name="nota1" id="nota">
					</div>
					<div class="form-group">
						<label>Nama Suplier</label>
						<input type="text" name="nama" class="form-control" autocomplete="off" required >
					</div>
					<hr>
					<div class="form-group">
						<input type="hidden" name="total" value="0"  class="form-control" autocomplete="off" >
					</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="Submit" class="btn btn-primary" onclick('location.reload();')>Save changes</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
	</div>

	<div class="modal fade" id="tambahpembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Tambah Pembelian Barang</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="<?php echo base_url('pembelian/tambahpembelian')?>" id="FormTambahUser" method="post" accept-charset="utf-8">
					<div class="form-group">
						<input type="hidden" name="nota"  class="form-control" autocomplete="off" >
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						 <input list="list_barang" class="form-control reset" 
			                placeholder="Isi Nama Barang" name="nama" id="id_barang" 
			                autocomplete="off">
		                    <datalist id="list_barang">
		                      <?php foreach ($barang as $barang): ?>
		                        <option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
		                      <?php endforeach ?>
		                    </datalist>
					</div>
					<div class="form-group">
						<label>Jumlah Pembelian</label>
						<input type="text" name="stok" class="form-control" autocomplete="off" required >
					</div>
					<div class="form-group">
						<label>Harga Barang</label>
						<input type="text" name="harga" class="form-control" autocomplete="off" required >
					</div>
					
					
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="Submit" class="btn btn-primary" onclick('location.reload();')>Save changes</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
	</div>


	<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Data Pembelian Barang</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 100%;">
				     <thead>
						<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
							<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
							<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama Barang</th>
							<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Jumlah Pembelian</th>
							<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Harga Beli</th>
							<th class="sorting" tabindex="0" aria-controls="my-grid" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Waktu </th>
						</tr>
					</thead>
					<tbody id="result1">
						
					</tbody>
				</table>
					
					
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		    </div>
		  </div>
		</div>
	





				



		

	
</section>
    <!-- /.content -->
  </div>

  <script>
   function modal(){
  	$('#myModal').modal('show');
		setTimeout(function() {
		    $('#myModal').modal('hide');
		}, 50000);
	}

	function tambahpembelian(nota){
		console.log(nota);
  	$('#tambahpembelian').modal('show');
		setTimeout(function() {
		    $('#tambahpembelian').modal('hide');
		}, 50000);
			$('[name="nota"]').val(nota);
		

	}
	

	function detail(nota){
  	$('#detail').modal('show');
		setTimeout(function() {
		    $('#detail').modal('hide');
		}, 150000);
		$.ajax({
		   method:"POST",
		   data :{query:nota},
		   url:"<?php echo base_url();?>pembelian/datanota",
		   success:function(data){
		   $('#result1').html(data);
		   }
		  })		

	}



 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>pembelian/show_pembelian",
   method:"POST",
   data:{query:query},
   success:function(data){
 
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });



 


</script>



  <?php  
		$this->load->view('include/footer');
?>