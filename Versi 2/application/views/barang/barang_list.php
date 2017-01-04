<?php
	$this->load->view('template/header');
?>

<h3 align="center"> Data Barang</h3>
<p><a href="<?php echo base_url(); ?>barang/tambah" class="btn btn-success">tambah barang</a></p>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<tr>
		<td>id Barng</td>
		<td>nama Barang</td>
		<td>Jumlah Barang</td>
		<td>tgl Pembuatan</td>
		<td>tgl Kadaluarsa</td>
		<td>max persediaan</td>
		<td>min persediaan</td>
		<td>isi satuan</td>
		<td>harga beli</td>
		<td>harga jual</td>
		<td>action</td>
	</tr>
	<?php foreach ($barang_list as $barang) { ?>
	<tr>
		<td><?php echo $barang->id_barang; ?></td>
		<td><?php echo $barang->nama_barang; ?></td>
		<td><?php echo $barang->jumlah_barang; ?></td>
		<td><?php echo $barang->tanggal_pembuatan_barang; ?></td>
		<td><?php echo $barang->tanggal_kadaluarsa_barang; ?></td>
		<td><?php echo $barang->max_persediaan_barang; ?></td>
		<td><?php echo $barang->min_persediaan_barang; ?></td>
		<td><?php echo $barang->isi_satuan; ?></td>
		<td><?php echo $barang->harga_beli; ?></td>
		<td><?php echo $barang->harga_jual; ?></td>
		<td>
			<a href="<?php echo base_url() ?>barang/ubah/<?php echo $barang->id_barang; ?>">ubah</a>
			<a href="<?php echo base_url() ?>barang/hapus/<?php echo $barang->id_barang; ?>">hapus</a>
		</td>
	</tr>
	<?php } ?>
	<?php echo $link; ?>
	
</table>
<?php
	echo form_open('barang/cetak_pdf');
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