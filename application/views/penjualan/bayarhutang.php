<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>

<div class="col-md-15">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> User <i class="fa fa-angle-right fa-fw"></i> Daftar Pembelian</h5>
			<hr>
			<div class="table-responsive">

				<form role="form" class="form-horizontal" id="form_barang" action="<?php echo base_url('Kasir/minhutang')?>" method="post">
                        <div class="form-group">
			                <label  class="control-label col-sm-2">Pelanggan</label>
			                <div class="col-sm-8">
                        <input list="list_barang" class="form-control reset" 
                          placeholder="Isi no anggota" name="no_anggota" id="id_barang" 
                          autocomplete="off" onchange="Tanggota(this.value)">
                              <datalist id="list_barang">
                                <?php foreach ($anggota as $anggota): ?>
                                  <option value="<?= $anggota->no_anggota  ?>"><?= $anggota->nama_anggota ?></option>
                                <?php endforeach ?>
                              </datalist>
			                  </div>
		              	</div>
		              	<div id="barang">
                        <div class="form-group">
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
                           </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            
                            </div>
                        </div>
                        

                    </form>

							
			</div>
			</div>
		</div>
	</div>


				



		

	
</section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
  	function Tanggota(str) 
  	{

      if (str == "") {
      	
          $('#bayar').val('');
          $('#hutang').val('');
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
          'kasir/ghutang') ?>/"+str,true);
        xmlhttp.send();
      }
  }

  </script>



<?php  
		$this->load->view('include/footer');
?>