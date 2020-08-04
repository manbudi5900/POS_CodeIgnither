<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>


<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> Barang <i class="fa fa-angle-right fa-fw"></i> List Penjualan</h5>
			<hr>

			<div class="table-responsive">

				<div data-toggle="modal" data-target="#exampleModal" id="my-grid_wrapper" class="dataTables_wrapper form-inline no-footer">
					
					
				</div>
				<div class="col-sm-2">
					<a href="<?php echo base_url('kasir/history');?>"><button class="btn btn-block btn-primary" type="button">Penjualan hari ini</button></a>
				</div>
				<div class="col-sm-2">
					<a href="<?php echo base_url('kasir/historyD');?>"><button class="btn btn-block btn-primary" type="button">Penjualan detail</button></a>
				</div>
				<hr>
				<div id="result"></div>
							
			</div>
			</div>
		</div>
		
	</div>
	
	<div class="modal fade modal-admin" id="nota" tabindex="1" style="display" role="dialog" aria-labelledby="exampleModalLabel" >
		  <div class="modal-dialog modal-admin" role="document">
		    <div class="modal-content ">
		      <div class="modal-header ">
		        <h5 class="modal-title" id="exampleModalLabel">Data Pembelian Barang</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<table  class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="my-grid_info" style="width: 100%;">
				     <thead>
						<tr role="row">
							<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="#: activate to sort column descending" style="width: 79px;" aria-sort="ascending">#</th>
							<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nota</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Merek: activate to sort column ascending" style="width: 282px;">Nama pembeli</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 268px;">Nama Kasir</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Edit" style="width: 268px;">Nama Barang</th>
							<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 268px;">Harga Satuan</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 100px;">Jumlah</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Total</th>
					 		<th class="no-sort sorting_disabled" rowspan="1" colspan="1" aria-label="Hapus" style="width: 138px;">Waktu</th>
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
   
 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Kasir/history1",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
 }


 function ambilnota(nota){
  	$('#nota').modal('show');
		setTimeout(function() {
		    $('#nota').modal('hide');
		}, 50000);
		$.ajax({
		   method:"POST",
		   data :{query:nota},
		   url:"<?php echo base_url();?>kasir/datanota",
		   success:function(data){
		   $('#result1').html(data);
		   }
		  })	

}



 


 


</script>



  <?php  
		$this->load->view('include/footer');
?>