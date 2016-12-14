<?php 
	$this->load->view('template/header');
	echo validation_errors(); ?>
<form action="<?php echo base_url(); ?>barang/store" method="POST">
	nama barang
	<br><input type="text" name="namaBarang" class="form-control"><br>
	jumlah barang
	<br><input type="text" name="jumlahBarang" class="form-control"><br>
	tanggal pmbuatan
	<br><input type="date" name="tglPembuatan" class="form-control"><br>
	tanggal kadaluarsa
	<br><input type="date" name="tglKadaluarsa" class="form-control"><br>
	max persediaan
	<br><input type="text" name="maxPersediaan" class="form-control"><br>
	min persediaan
	<br><input type="text" name="minPersediaan" class="form-control"><br>
	isi satuan
	<br><input type="text" name="isiSatuan" class="form-control"><br>
	harga beli
	<br><input type="text" name="hargaBeli" class="form-control"><br>
	harga beli
	<br><input type="text" name="hargaJual" class="form-control"><br>

	<br><input type="submit" name="submit" value="tambah barang"><br>

</form>

<?php
	$this->load->view('template/footer');
?>