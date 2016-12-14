<form action="<?php echo base_url(); ?>penjualan/proses_pembayaran" method="POST">
	id anggota <br>
	<input type="text" name="idAnggota"><br>
	total pembelian : <br>
	<?php echo $this->cart->total();?><input type="hidden" name="totalBayar" value="<?php echo $this->cart->total();?>"><br>
	jumlah bayar : <br>
	<input type="text" name="jumlahBayar"><br>
	<input type="submit" name="submit">
</form>