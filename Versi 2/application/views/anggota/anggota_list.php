<?php $this->load->view('template/header');?>
<h3 align="center"> Data Barang</h3>
<p><a href="<?php echo base_url() ?>anggota/tambah" class="btn btn-success">tambah anggota</a> </p>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
	<tr>
		<td>id angota</td>
		<td>nama anggota</td>
		<td>alamat</td>
		<td>no telp</td>
		<td>level</td>
		<td>action</td>
	</tr>
	<?php foreach ($anggota_list as $anggota): ?>
		<tr>
			<td><?php echo $anggota->id_anggota; ?></td>
			<td><?php echo $anggota->nama_anggota; ?></td>
			<td><?php echo $anggota->alamat_anggota; ?></td>
			<td><?php echo $anggota->telp_anggota; ?></td>
			<td><?php echo $anggota->hak_akses; ?></td>
			<td>
				<a href="<?php echo base_url(); ?>anggota/ubah/<?php echo $anggota->id_anggota ?>">ubah</a>
				<a href="<?php echo base_url(); ?>anggota/hapus/<?php echo $anggota->id_anggota ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach ?>
	<?php echo $link ?>
</table>
<a href="<?=site_url('anggota/cetak_pdf')?>" class="btn btn-danger">Cetak</a>
<?php $this->load->view('template/footer');?>