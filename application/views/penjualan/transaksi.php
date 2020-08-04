<?php  $this->load->view('include/header');
		$this->load->view('include/beranda');
?>

<div class="col-md-15">
    <div class="panel panel-default">
     <div class="panel-body">
      <form class="form-horizontal" id="form_transaksi" role="form">
          <div class="col-md-8">
          <div class="form-group">
            <label class="control-label col-md-3" 
              for="id_barang">Id Barang :</label>
            <div class="col-md-5">
              <input list="list_barang" class="form-control reset" 
                placeholder="Isi id..." name="id_barang" id="id_barang" 
                autocomplete="off" onchange="showBarang(this.value)">
                    
                    <datalist id="list_barang">
                      <?php foreach ($barang as $barang): ?>
                        <option value="<?= $barang->id_barang ?>"><?= $barang->nama_barang ?></option>
                      <?php endforeach ?>
                    </datalist>

            </div>
           
          </div>
          <div id="barang">
            <div class="form-group">
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
            </div>
          </div><!-- end id barang -->
          <div class="form-group">
            <label class="control-label col-md-3" 
              for="sub_total">Sub-Total (Rp):</label>
            <div class="col-md-8">
              <input type="text" class="form-control reset" 
                name="sub_total" id="sub_total" 
                readonly="readonly">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-3 col-md-3">
                <button type="button" class="btn btn-primary" 
                id="tambah" onclick="addbarang()">
                  <i class="fa fa-cart-plus"></i> Tambah</button>
            </div>
          </div>
            <!-- </div>
          </div> --><!-- end panel-->
          </div><!-- end col-md-8 -->
          <div class="col-md-4 mb">
        <div class="col-md-12">
            <div class="form-group">
              <label for="total" class="besar">Total (Rp) :</label>
                <input type="text" class="form-control input-lg" 
                name="total" id="total" placeholder="0"
                readonly="readonly"  value="<?= number_format( 
                      $this->cart->total(), 0 , '' , '.' ); ?>">
            </div>
            <div class="form-group">
              <label for="bayar" class="besar">Bayar (Rp) :</label>
                <input type="text" class="form-control input-lg uang" 
                  name="bayar" placeholder="0" autocomplete="off"
                  id="bayar" onkeyup="showKembali(this.value)">
            </div>
            <div class="form-group">
              <label for="kembali" class="besar">Kembali (Rp) :</label>
                <input type="text" class="form-control input-lg" 
                name="kembali" id="kembali" placeholder="0"
                readonly="readonly">
            </div>
        </div>
          </div><!-- end col-md-4 -->
          </form>
          <table id="table_transaksi" class="table table-striped 
            table-bordered">
        <thead>
          <tr>
              <th>No</th>
              <th>Id Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Quantity</th>
              <th>Sub-Total</th>
              <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <form action="<?php echo base_url('Kasir/addtransaksi')?>" method="post">
        <input name="bon" class="form-control"  placeholder="masukan BON (Jika Ada)" style="resize: vertical; width:50%;"></input>
      <div class="col-md-13" style="margin-top:20px">
        <div class="col-md-5">
          <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-file-text-o fa-fw"></i> Informasi Nota</div>
            <div class="panel-body">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-4 control-label">No. Nota</label>
                  <div class="col-sm-8">
                    <input type="text" name="nomor_nota" class="form-control input-sm" id="nomor_nota" value="<?php echo strtoupper(uniqid()).$this->session->userdata('id'); ?>" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="text" name="tanggal" class="form-control input-sm" id="tanggal" value="<?php echo date('Y-m-d'); ?>" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Kasir</label>
                  <div class="col-sm-8">
                   <input type="text" name="nama_kasir" class="form-control input-sm" id="nomor_nota" value="<?php echo $this->session->userdata('nama'); ?>" readonly="">
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-5">
          <div class="panel panel-primary" id="PelangganArea">
            <div class="panel-heading"><i class="fa fa-user"></i> Informasi Pelanggan</div>
            <div class="panel-body">
              <div class="form-group">
                <label>Pelanggan</label>
                
                <select name="id_pelanggan" id="id_pelanggan" class="form-control input-sm" style="cursor: pointer;">
                  
                  <?php foreach ($anggota as $l): ?>
                      <option value="<?= $l->no_anggota ?>"><?= $l->nama_anggota ?>  </option>
                  <?php 
                  endforeach ?>
                  </select>
              </div>
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="col-sm-4 control-label">Telp / HP</label>
                  <div class="col-sm-8">
                    <div id="telp_pelanggan"><small><i>Tidak ada</i></small></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Alamat</label>
                  <div class="col-sm-8">
                    <div id="alamat_pelanggan"><small><i>Tidak ada</i></small></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label">Info Lain</label>
                  <div class="col-sm-8">
                    <div id="info_tambahan_pelanggan"><small><i>Tidak ada</i></small></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-1">
      
          <input type="submit" value="Simpan" class="btn btn-primary btn-lg" 
          id="selesai" disabled="disabled">
        </form>
      </div>
      </div>
        </div>
      </div>
  </div><!-- end col-md-9 -->






</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <script type="text/javascript">

  function showBarang(str) 
  {

      if (str == "") {
          $('#nama_barang').val('');
          $('#harga_barang').val('');
          $('#qty').val('');
          $('#sub_total').val('');
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
        xmlhttp.open("GET", "<?= base_url(
          'kasir/getbarang') ?>/"+str,true);
        xmlhttp.send();
      }
  }

  function subTotal(qty)
  {

    var harga = $('#harga_barang').val().replace(".", "").replace(".", "");

    $('#sub_total').val(convertToRupiah(harga*qty));
  }

  function convertToRupiah(angka)
  {

      var rupiah = '';    
      var angkarev = angka.toString().split('').reverse().join('');
      
      for(var i = 0; i < angkarev.length; i++) 
        if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
      
      return rupiah.split('',rupiah.length-1).reverse().join('');
  
  }

  var table;
    $(document).ready(function() {

      showKembali($('#bayar').val());

      table = $('#table_transaksi').DataTable({ 
        paging: false,
        "info": false,
        "searching": false,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' 
        
        "ajax": {
            "url": "<?= site_url('kasir/ajax_list_transaksi')?>",
            "type": "POST"
        },
      });
    });

    function reload_table()
    {

      table.ajax.reload(null,false); //reload datatable ajax 
    
    }

    function addbarang()
    {

        var id_barang = $('#id_barang').val();
        var qty = $('#qty').val();
        if (id_barang == '') {
          $('#id_barang').focus();
        }else if(qty == ''){
          $('#qty').focus();
        }else{
       // ajax adding data to database
          $.ajax({
            url : "<?= site_url('kasir/addbarang')?>",
            type: "POST",
            data: $('#form_transaksi').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //reload ajax table
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });

          showTotal();
          showKembali($('#bayar').val());
          //mereset semua value setelah btn tambah ditekan
          $('.reset').val('');
        };
        window.location.reload();
        
    }

    function deletebarang(rowid,sub_total,id,qty)
    {
        // ajax delete data to database
          $.ajax({
            url : "<?= site_url('kasir/deletebarang')?>/"+rowid+'/'+id+'/'+qty,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

          var ttl = $('#total').val().replace(".", "");

          $('#total').val(convertToRupiah(ttl-sub_total));

          showKembali($('#bayar').val());
    }

    function showTotal()
    {
      var total = $('#total').val().replace(".", "").replace(".", "");
      var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");
      $('#total').val(convertToRupiah((Number(total)+Number(sub_total))));

    }

    //maskMoney
  $('.uang').maskMoney({
    thousands:'.', 
    decimal:',', 
    precision:0
  });

  function showKembali(str){
      var total = $('#total').val().replace(".", "").replace(".", "");
      var bayar = str.replace(".", "").replace(".", "");
      var kembali = bayar-total;

          $('#kembali').val(convertToRupiah(kembali));

      if (kembali >= 0) {
        $('#selesai').removeAttr("disabled");
      }else{
        $('#selesai').attr("disabled","disabled");
      };

      if (total == '0') {
        $('#selesai').attr("disabled","disabled");
      };
    }

  </script>

<?php  
		$this->load->view('include/footer');
?>