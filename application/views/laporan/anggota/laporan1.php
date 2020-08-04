<?php if($penjualan->num_rows() > 0) { 
?>


	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>#</th>
				<th>Tanggal</th>
				<th>Nomor Anggota</th>
				<th>Total Penjualan</th>
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
						<td>Rp. ".str_replace(",", ".", number_format($p->total_penjualan))."</td>
					</tr>
				";

				$total_penjualan = $total_penjualan + $p->total_penjualan;
				$no++;
				$no_anggota=$p->no_anggota;
				
			}

			echo "
				<tr>
					<td colspan='3'><b>Total Seluruh Penjualan</b></td>
					
					
					<td><b>Rp. ".str_replace(",", ".", number_format($total_penjualan))."</b></td>
				</tr>
				";
			foreach($hutang->result() as $p)
			{
				echo "
				<tr>
					<td colspan='3'><b>Total Seluruh Hutang</b></td>
					
					
					<td><b>Rp. ".str_replace(",", ".", number_format($p->hutang))."</b></td>
				</tr>
			";
			}
			?>
		</tbody>
	</table>

	<p>
		<?php
		$from 	= date('Y-m-d', strtotime($from));
		$to		= date('Y-m-d', strtotime($to));
		?>
		<a href="<?php echo site_url('laporan/pdf2/'.$from.'/'.$to.'/'.$no_anggota); ?>" target='blank' class='btn btn-default'><img src="<?php echo base_url('assets/dist/img/pdf.png')?>"> Export ke PDF</a>
		<a href="<?php echo site_url('laporan/excel2/'.$from.'/'.$to.'/'.$no_anggota); ?>" target='blank' class='btn btn-default'><img src="<?php echo base_url('assets/dist/img/xls.png')?>"> Export ke Excel</a>
	</p>
	<br />
<?php } ?>

<?php if($penjualan->num_rows() == 0) { ?>
<div class='alert alert-info'>
Data dari tanggal <b><?php echo $from; ?></b> sampai tanggal <b><?php echo $to; ?></b> tidak ditemukan
</div>
<br />
<?php } ?>

