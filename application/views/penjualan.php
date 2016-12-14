<?php $this->load->view('template/header')?>
<p>
	<br>
	<button name="back" onclick="history.go(-1)" class="btn btn-default">Back</button> 
	| <a href="<?=site_url('penjualan/cetak_pdf')?>" class="btn btn-danger"><b>Cetak Laporan</b></a>
</p>
	<div class="container-fluid">
		<div class="col-md-8">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				
				<a class="navbar-brand" href="#">Brand</a>
				</div>
				<div class="claer-fix"></div>
				<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<form class="navbar-form navbar-left" action="<?php echo base_url(); ?>penjualan/addToCart" method="POST">
							<div class="input-group">
								<input class="form-control col-md-5" type="text" name="itemId" placeholder="item id">
							</div>
							<div class="input-group">
								<input class="form-control col-md-5" type="text" name="itemJumlah" placeholder="jumlah">
							</div>
					        <button type="submit" class="btn btn-primary">tambah item</button>
						</form>
					</div><!-- /.navbar-collapse -->
				<!-- /.container-fluid -->
			</nav>
			<!--  -->
			
			<div class="container col-md-12">
				<form action="<?php echo base_url() ?>penjualan/updateCart" method="POST">
					<table class="table table-striped">
						<!-- label table -->
						<tr>
						    <th>QTY</th>
						    <th>Item Description</th>
						    <th style="text-align:right">Item Price</th>
						    <th style="text-align:right">Sub-Total</th>
						</tr>

						<?php $i = 1; ?>
						<?php foreach ($this->cart->contents() as $items): ?>
							<div class="input-group">
								<input type="hidden" name="<?php echo $i.'[rowid]' ?>" value="<?php echo $items['rowid'] ?>">
							</div>
						    <tr>
						        <td>
						        	<div class="input-group">
							        	<div class="col-md-2">
							        		<a class="btn btn-danger" href="<?php echo base_url(); ?>penjualan/removeItemFromCart/<?php echo $items['rowid'] ?>" ><i class="glyphicon glyphicon-remove-sign"></i> </a>
							        	</div>
							        	<div class="col-md-8">
								        	<input class="form-control" type="text" name="<?php echo $i.'qty' ?>" value="<?php echo $items['qty'] ?>">
							        	</div>
						        	</div>
						        </td>
						        <td><?php echo $items['name']; ?></td>
						        <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
						        <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
						    </tr>
						<?php $i++; ?>
						<?php endforeach; ?>
						<tr>
						    <!-- <td colspan="2"> </td>
						    <td class="right"><strong>Total</strong></td>
						    <td class="right">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></td> -->
						</tr>
					</table>
					
					<input type="submit" name="submit" value="Update Cart" class="btn btn-primary">
					<a href="<?php echo base_url(); ?>penjualan/pembayaran">pembayaran</a>
				</form>
			</div>
		</div>
		<div class="col-md-4">
			<div class="col-md-12">
				<p class="pull-right">admin : <?php echo $this->session->userdata('logged_in')['username']; ?></p>
			</div>
			<div class="jumbotron">
				<h2>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></h2>
			</div>

			<input type="text" name="">
		</div>
	</div>
<?php
	$this->load->view('template/footer');
?>