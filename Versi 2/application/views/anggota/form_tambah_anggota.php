<?php  
	  $this->load->view('template/header');
	echo validation_errors(); 
?>
<form action="<?php echo base_url(); ?>anggota/store" method="POST">
	nama anggota : <br>
	<input type="text" name="namaAnggota"><br>
	username : <br>
	<input type="text" name="username"><br>
	password <br>
	<input type="text" name="password"><br>
	alamat : <br>
	<input type="text" name="alamat"><br>
	no telp : <br>
	<input type="text" name="noTelp"><br>
	hak ahses : <br>
	<input type="text" name="hakAkses"><br>

	<input type="submit" name="submit">
</form>
<?php
	$this->load->view('template/footer');
?>