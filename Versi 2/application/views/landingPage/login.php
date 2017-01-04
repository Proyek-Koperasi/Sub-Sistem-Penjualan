<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Pusat Koperasi</title>
    <!-- <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'> -->
    <link rel="stylesheet" href="<?=base_url();?>asset/login-css/style.css">
  </head>
  <body>
  <center>
  
</center>
    <div class="login-card">
    <h1>PUSKOP LOGIN ADMIN</h1><br>
  
<?php echo validation_errors(); ?>
	<form action="<?php echo base_url() ?>landing/login" method="POST">
		<label>username</label>
		<input type="text" name="username"><br>
		<label>password</label>
		<input type="password" name="password"><br>
		<label>Leveld</label>
		<select name="level">
			<option value="1">Kepla</option>
			<option value="2">divis simpan pinjam</option>
			<option value="3">divis toko</option>
		</select><br>
		<input type="submit">
	</form>
 <div>
	  	<p align="center">Copyright &copy; Polinema 2016</p>
	  </div>
	</div>

  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
  </body>
</html>
