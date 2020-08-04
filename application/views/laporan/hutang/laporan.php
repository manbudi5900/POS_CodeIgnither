<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>


<?php
$level = $this->session->userdata('level');
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Pembelanjaan Anggota</h5>
			<hr />

			<form id="FormLaporan">
			<div class="row"> 
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Dari Tanggal</label>
							<div class="col-sm-8">
								<input type='date' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Sampai Tanggal</label>
							<div class="col-sm-8">
								<input type='date' name='to' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Nomor anggota</label>
							<div class="col-sm-7">
								 <input list="list_barang" class="form-control reset" 
					                placeholder="Isi no anggota" name="id_barang" id="nomor" 
					                autocomplete="off" onchange="showBarang(this.value)">
					                    <datalist id="list_barang">
					                      <?php foreach ($anggota as $anggota): ?>
					                        <option value="<?= $anggota->no_anggota  ?>"><?= $anggota->nama_anggota ?></option>
					                      <?php endforeach ?>
					                    </datalist>
							</div>
						</div>
					</div>
				</div>
			</div>	

			<div class='row'>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>

			<br />
			<div id='result'></div>
		</div>
	</div>
</div>

</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<script>
// $('#tanggal_dari').datetimepicker({
// 	lang:'en',
// 	timepicker:false,
// 	format:'Y-m-d',
// 	closeOnDateSelect:true
// });
// $('#tanggal_sampai').datetimepicker({
// 	lang:'en',
// 	timepicker:false,
// 	format:'Y-m-d',
// 	closeOnDateSelect:true
// });

$(document).ready(function(){
	$('#FormLaporan').submit(function(e){
		e.preventDefault();
		var TanggalDari = $('#tanggal_dari').val();
		var TanggalSampai = $('#tanggal_sampai').val();
		var nomor = $('#nomor').val();
	

		if(TanggalDari == '' || TanggalSampai == '')
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html("Tanggal harus diisi !");
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
			$('#ModalGue').modal('show');
 		}
		else
		{
			var URL = "<?php echo site_url('laporan/hutang1'); ?>/" + TanggalDari + "/" + TanggalSampai + "/" + nomor;
			$('#result').load(URL);
		}
	});
});
</script>

<?php  
		$this->load->view('include/footer');
?>