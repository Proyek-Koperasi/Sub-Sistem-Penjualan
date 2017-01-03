
<?php
  $this->load->view('template/header');
  echo validation_errors(); 
 ?>
<?php foreach ($editAnggota as $data): ?>
	
<form action="<?php echo base_url(); ?>anggota/update" method="POST">
	nama anggota : <br>
	<input type="text" name="idAnggota" readonly value="<?php echo $data->id_anggota ?>"><br>
	
	<input type="text" name="namaAnggota"  value="<?php echo $data->nama_anggota ?>"><br>
	username : <br>
	<input type="text" name="username"  value="<?php echo $data->username_anggota ?>"><br>
	password <br>
	<input type="text" name="password"  value="<?php echo $data->password_anggota ?>"><br>
	alamat : <br>
	<input type="text" name="alamat"  value="<?php echo $data->alamat_anggota ?>"><br>
	no telp : <br>
	<input type="text" name="noTelp"  value="<?php echo $data->telp_anggota?>"><br>
	hak ahses : <br>
	<input type="text" name="hakAkses"  value="<?php echo $data->hak_akses?>"><br>

	<input type="submit" name="submit">
</form>
<?php 
	endforeach; 
	$this->load->view('template/footer');
?>