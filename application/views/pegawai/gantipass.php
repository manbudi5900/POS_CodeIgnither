<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>

<div class="col-md-15">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class="fa fa-cube fa-fw"></i> User <i class="fa fa-angle-right fa-fw"></i> Daftar Pembelian</h5>
			<hr>
			<div class="table-responsive">
				<form role="form" class="form-horizontal" action="<?php echo base_url('pegawai/gantipass2')?>" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">password Lama</label>
                            <div class="col-sm-8">
                            <input type="text" name="passwordL" class="form-control" id="old_password" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">password Baru</label>
                            <div class="col-sm-8">
                            <input type="password" name="passwordB" id="new" class="form-control" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nama lengkap">password Konfirmasi</label>
                            <div class="col-sm-8">
                            <input type="password" name="passwordK" id="confirm" class="form-control" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" name="submitted" value="simpan" id="submit" onclick('location.reload();')>Simpan</button>
                            <button type="reset" class="btn btn-danger" onclick="self.history.back()">Batal</button>
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


  <script>
  $(document).ready(function(){
    // cek event change id old_password 
      $('#old_password').change(function(){    
      var fopassword = $('#old_password').val();

        //mengirimkan old_password dan mengecek ke database ketersediaanya.
            $.ajax({       
              method: "POST",      
              dataType: 'json',
              url: "<?php echo base_url(); ?>pegawai/gantipass1", 
              data: { opassword: fopassword} ,  
              success:function(data){
              	console.log(data);
                  //jika tersedia maka ambil data. data yang dikirimkan controller berupa nilai TRUE or FALSE
                   document.getElementById("new").disabled = data;
                   document.getElementById("confirm").disabled = data;
                   //fungsinya untuk memanipulasi input text id new dan confirm
              }
            });
   
      });
      //fungsi ini digunakan untuk cek kesamaan nilai antara inputan new dan confirm
      $('#confirm').change(function(){    
      var fnew = $('#new').val();  
      var fconfirm = $('#confirm').val();  
          if(fnew==fconfirm){
             document.getElementById("submit").disabled = false;
          }else{
            document.getElementById("submit").disabled = true;
          }
    
   });

});
</script>



<?php  
		$this->load->view('include/footer');
?>