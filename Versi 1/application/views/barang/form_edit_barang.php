
<?php 
$this->load->view('template/header');
echo validation_errors(); ?>
<form action="<?php echo base_url(); ?>barang/update" method="POST">
<?php foreach ($barangEdit as $barang) { ?>
	nama barang
	<br><input type="text" name="idBarang" value="<?php echo $barang->id_barang ?>" readonly><br>
	<br><input type="text" name="namaBarang" value="<?php echo $barang->nama_barang ?>"><br>
	jumlah barang
	<br><input type="text" name="jumlahBarang" value="<?php echo $barang->jumlah_barang ?>"><br>
	tanggal pmbuatan
	<br><input type="date" name="tglPembuatan" value="<?php echo $barang->tanggal_pembuatan_barang ?>"><br>
	tanggal kadaluarsa
	<br><input type="date" name="tglKadaluarsa" value="<?php echo $barang->tanggal_kadaluarsa_barang ?>"><br>
	max persediaan
	<br><input type="text" name="maxPersediaan" value="<?php echo $barang->max_persediaan_barang ?>"><br>
	min persediaan
	<br><input type="text" name="minPersediaan" value="<?php echo $barang->min_persediaan_barang ?>"><br>
	isi satuan
	<br><input type="text" name="isiSatuan" value="<?php echo $barang->isi_satuan ?>"><br>
	harga beli
	<br><input type="text" name="hargaBeli" value="<?php echo $barang->harga_beli ?>"><br>
	harga beli
	<br><input type="text" name="hargaJual" value="<?php echo $barang->harga_jual ?>"><br>
<?php } ?>
	<br><input type="submit" name="submit" value="ubah barang"><br>

</form>

<?php
	$this->load->view('template/footer');
?>