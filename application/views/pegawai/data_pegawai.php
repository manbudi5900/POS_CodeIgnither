<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>


<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> User <i class="fa fa-angle-right fa-fw"></i> Daftar User</h5>
			<hr>
			<div class="table-responsive">
				<div data-toggle="modal" data-target="#exampleModal" id="my-grid_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="row"><div class="col-sm-6">
						<div  class="dataTables_length" id="my-grid_length" >
							<label>
								<a  class="btn btn-default" id="TambahMerek" onclick="modal()">
									<i class="fa fa-plus fa-fw"></i> Tambah User
								</a>&nbsp;&nbsp;
									<span id="Notifikasi" style="display: none;"></span>
							</label>
						</div>
					</div>
					<div class="col-sm-5">
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
		        <h5 class="modal-title" id="exampleModalLabel">Tambah User baru</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="<?php echo base_url('pegawai/tambahuser')?>" id="FormTambahUser" method="post" accept-charset="utf-8">
					<div class="form-group">
						<label>Nama Pengguna</label>
						<input type="text" name="nama" class="form-control" autocomplete="off" required >
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" autocomplete="off" required >
					</div>
					<hr>
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" class="form-control" autocomplete="off" required >
					</div>
					<div class="form-group">
						<label>Level</label>
							<select name="level" id="id_pelanggan" class="form-control input-sm" style="cursor: pointer;">
			                  <option value="kasir">Kasir</option>
                  			</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" id="id_pelanggan" class="form-control input-sm" style="cursor: pointer;">
			                  <option value="Aktif">Aktif</option>
			                  <option value="tidak aktif">Tidak Aktif</option>
                  		</select>
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


	<!-- Modal edi -->
	<div class="modal fade" id="editB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="editPegawai">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" autocomplete="off" required >
						<input type="hidden" name="id" class="form-control" autocomplete="off" required >
						
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" autocomplete="off" required >
					</div>
					<hr>
					<div class="form-group">
						<label>Password</label>
						<input type="text" name="password" class="form-control" autocomplete="off" required >
					</div>
					<div class="form-group">
						<label>Level</label>
							<select name="level" id="id_pelanggan" class="form-control input-sm" style="cursor: pointer;">
			                  <option value="kasir">Kasir</option>
                  			</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select name="status" id="id_pelanggan" class="form-control input-sm" style="cursor: pointer;">
			                  <option value="Aktif">Aktif</option>
			                  <option value="tidak aktif">Tidak Aktif</option>
                  		</select>
					</div>
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="Submit" onclick="editPegawai()" class="btn btn-primary">Save changes</button>
		      </div>
		      </form>
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

	function editB(query){
  	$('#editB').modal('show');
		setTimeout(function() {
		    $('#editB').modal('hide');
		}, 50000);
		console.log(query);
		$.ajax({
		   method:"POST",
		   data :{query:query},
		   url:"<?php echo base_url();?>pegawai/ambilid",
		   dataType :'json',
		   success:function(data){
		   	$('[name="id"]').val(data[0].id);
		   	$('[name="nama"]').val(data[0].nama);
		    $('[name="username"]').val(data[0].username);
		    $('[name="password"]').val(data[0].password);
		    $('[name="level"]').val(data[0].level);
		    $('[name="status"]').val(data[0].status);
		    console.log(data);
		   }
		  })
	}


	function editPegawai(){
		$.ajax({
		   method:"POST",
		   data : $("#editPegawai").serialize(),
		   url:"<?php echo base_url();?>pegawai/editPegawai",
		   dataType :'json',
		   success:function(data){
		   	console.log(data);
		    $('editB').modal('hide');
		    load_data();
		   }
		  })
		window.location.reload();
	}



	function mstok(query){
		
  	$('#stok').modal('show');
	  	setTimeout(function () {
		$('#stok').modal('hide');
		}, 500000);
		$.ajax({
		   method:"POST",
		   data :{query:query},
		   url:"<?php echo base_url();?>/Kasir/ambilid",
		   dataType :'json',
		   success:function(data){
		    $('[name="id"]').val(data[0].id_barang);
		    $('[name="stokS"]').val(data[0].stok_barang);
		    console.log(data);
		   }
		  })

	}


	function Tstok(){
		// var query=$("[name='id']").val();
		// var stokS=$("[name='stokS']").val();
		// var stok = $("[name='stok']").val();
		
		// console.log(stokS);
		$.ajax({
		   method:"POST",
		   data : $("#form_barang").serialize(),
		   url:"<?php echo base_url();?>Kasir/tStok",
		   dataType :'json',
		   success:function(data){
		   console.log(data);
		    $('#stok').modal('hide');
		    load_data();
		   }
		  })

	}

	






 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>pegawai/show_pegawai",
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