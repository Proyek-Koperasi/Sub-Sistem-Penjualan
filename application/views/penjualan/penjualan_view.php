<?php
	$this->load->view('template/header');
?>

<h3 align="center"> Data Barang</h3>
<p><a href="<?php echo base_url(); ?>penjualan" class="btn btn-success">tambah penjualan</a></p>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<tr>
		<td>ID</td>
		<td>Tanggal Penjualan</td>
		<td>Total Harga</td>
		<td>Keterangan</td>
		<td>ID Anggota</td>
		<td>ID Admin</td>
		<td>action</td>
	</tr>
	<?php foreach ($penjualan_list as $pejualan) { ?>
	<tr>
		<td><?php echo $pejualan->id_penjualan; ?></td>
		<td><?php echo $pejualan->tanggal_penjualan; ?></td>
		<td><?php echo $pejualan->total_harga_penjualan; ?></td>
		<td><?php echo $pejualan->keterangan_penjualan; ?></td>
		<td><?php echo $pejualan->id_anggota; ?></td>
		<td><?php echo $pejualan->id_admin; ?></td>
		
		<td>
			<a href="#">ubah</a>
			<a href="#">hapus</a>
		</td>
	</tr>
	<?php } ?>
	<?php echo $halaman; ?>
	
</table>
<?php
	echo form_open('penjualan/cetak_pdf');
?>
<table>
	<tr>
		<td>Dari tanggal</td>
		<td>:</td>
		<td><input type="date" name="tanggal_dari" class="form-control"></td>
	</tr>
	<tr>
		<td colspan="3"><br></td>
	</tr>
	<tr>
		<td>Sampai tanggal</td>
		<td>:</td>
		<td><input type="date" name="tanggal_sampai" class="form-control"></td>
	</tr>
	<tr>
		<td colspan="3">
			<br><input type="submit" class='btn btn-danger' value="Cetak Laporan">
		</td>
	</tr>
</table>

<?php
	echo form_close();
?>

<?php
	$this->load->view('template/footer');
?>