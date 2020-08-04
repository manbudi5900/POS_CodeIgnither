<?php if($penjualan->num_rows() > 0) { 
?>


	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Tanggal</th>
				<th>Nomor Anggota</th>
				<th>Nama anggota</th>
				<th>Nama barang</th>
				<th>Jumlah</th>
				<th>Hutang</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no_anggota;
			$no = 1; 
			$total_penjualan = 0;
			foreach($penjualan->result() as $p)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".date('Y-m-d', strtotime($p->time))."</td>
						<td>".$p->no_anggota."</td>
						<td>".$p->nama_anggota."</td>
						<td>".$p->nama_barang."</td>
						<td>".$p->jumlah."</td>
						<td>".$p->subtotal."</td>
					
					</tr>
				";

			
				$no++;
				$no_anggota=$p->no_anggota;
			}

			
			?>
		</tbody>
	</table>
	<br />
<?php } ?>

<?php if($penjualan->num_rows() == 0) { ?>
<div class='alert alert-info'>
Data dari tanggal <b><?php echo $from; ?></b> sampai tanggal <b><?php echo $to; ?></b> tidak ditemukan
</div>
<br />
<?php } ?>

