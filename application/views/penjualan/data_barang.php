<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>


<div class="container ">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> Barang <i class="fa fa-angle-right fa-fw"></i> List Barang</h5>
			<hr>
			<div class="table-responsive">
				<div data-toggle="modal" data-target="#exampleModal" id="my-grid_wrapper" class="dataTables_wrapper form-inline no-footer">
					<div class="row"><div class="col-sm-5">
						<div  class="dataTables_length" id="my-grid_length" >
							<label>
								<a  class="btn btn-default" id="TambahMerek" onclick="modal()">
									<i class="fa fa-plus fa-fw"></i> Tambah Barang
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
		        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Baru</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form action="<?php echo base_url('Kasir/tambahBarang')?>" id="FormTambahUser" method="post" accept-charset="utf-8">
		      		
					<div class="form-group">
						<label>Nama Barang</label>
		              <input list="list_barang" class="form-control reset" 
		                placeholder="Nama Barang" name="nama" id="id_barang" 
		                autocomplete="off" onchange="TBarang(this.value)">
		                    <datalist id="list_barang">
		                      <?php foreach ($barang as $barang): ?>
		                        <option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
		                      <?php endforeach ?>
		                    </datalist>
		            </div>
		            <div id="barang">
		            <div class="form-group">
						<label>Kode Barang</label>
						<input type="text" name="kode" id="kode" class="form-control reset" autocomplete="off" required >
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type ="text" name="harga" id="harga" class="form-control reset" autocomplete="off" required >
					</div>
					
					</div>
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="Submit" class="btn btn-primary">Save changes</button>
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
		        <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="editBarang">
					<div class="form-group">
						<label>Kode Barang</label>
						<input type="text" name="kode" class="form-control" autocomplete="off" required >
						<input type="hidden"  name="kodeA" value="">
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nama" class="form-control" autocomplete="off" required >
					</div>
				
					<div class="form-group">
						<label>Harga</label>
						<input type="text" name="harga" class="form-control" autocomplete="off" required >
					</div>
					
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="Submit" onclick="editBarang()" class="btn btn-primary">Save changes</button>
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
		$.ajax({
		   method:"POST",
		   data :{query:query},
		   url:"<?php echo base_url();?>/Kasir/ambilid",
		   dataType :'json',
		   success:function(data){
		   	$('[name="kodeA"]').val(data[0].id_barang);
		    $('[name="kode"]').val(data[0].id_barang);
		    $('[name="stok"]').val(data[0].stok_barang);
		    $('[name="nama"]').val(data[0].nama_barang);
		    $('[name="harga"]').val(data[0].harga_barang);
		    console.log(data);
		   }
		  })
	}


	function editBarang(){
		$.ajax({
		   method:"POST",
		   data : $("#editBarang").serialize(),
		   url:"<?php echo base_url();?>Kasir/editBarang",
		   dataType :'json',
		   success:function(data){
		   	console.log(data);
		    $('editB').modal('hide');
		    load_data();
		   }
		  })

	}



	

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Kasir/barang",
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


  function TBarang(str) 
  {

      if (str == "") {
      	 $('#kode').val('');
          $('#nama').val('');
          $('#harga').val('');
          $('#reset').hide();
          
          return;
      } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("barang").innerHTML = 
                xmlhttp.responseText;
            }
        }
        console.log(str);
        xmlhttp.open("GET", "<?= base_url(
          'kasir/gbarang') ?>/"+str,true);
        xmlhttp.send();
      }
  }



 


</script>



  <?php  
		$this->load->view('include/footer');
?>