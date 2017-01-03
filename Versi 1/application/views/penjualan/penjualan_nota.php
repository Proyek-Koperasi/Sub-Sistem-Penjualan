
<?php
    $this->load->view('template/header');
    foreach ($nota as $isi) {
        $id_penjualan = $isi->id_penjualan;
       
        $tanggal_penjualan = $isi->tanggal_penjualan;
    }
?>
<div class="judul">E-KOPERASI INDONESIA</div>
<div class="judul">Tanggal Pembelian : <?=$tanggal_penjualan?></div>
<div class="sub-judul">Jalan Bersama no.15</div>
<b class="sub-judul">No. Nota : <?=$id_penjualan?></b>
<table class="table">
    <tr>
        <td>No</td>
        <td>Daftar Belanja</td>
        <td>Harga</td>
        <td>Qty</td>
        <td>Sub Total</td>
    </tr>
    
    <?php 
        $i=0;
        foreach ($nota as $isi_nota) {
            $id_barang = $isi_nota->id_barang;
            $jumlah_barang = $isi_nota->jumlah_barang;
            $harga_satuan = $isi_nota->harga_satuan;
            $sub_total = $isi_nota->subtotal;
            $total_akhir = $isi_nota->total_harga_penjualan;
            $id_admin = $isi_nota->id_admin;
            
            $i++;
    ?>
    <tr>
        <td><?=$i?></td>
        <td><?=$id_barang?></td>
        <td><?=$harga_satuan?></td>
        <td><?=$jumlah_barang?></td>
        <td><?=$sub_total?></td>
    </tr>
    <?php } ?>
</table>
<table class="table">
    <tr class="tebal">
        <td colspan="5">Total</td>
        <td>:</td>
        <td><?=$total_akhir?></td>
    </tr>
    <tr class="tebal">
        <td colspan="5">Bayar</td>
        <td>:</td>
        <td><?=$jumlah_bayar?></td>
    </tr>
</table>
<table class="table">
    <tr class="tebal">
        <td colspan="5">Kembalian</td>
        <td>:</td>
        <td>
            <?php
                echo $sisa = $jumlah_bayar - $total_akhir;
            ?>
           
        </td>
    </tr>
</table>

<div class="sub-judul">Terima Kasih dan Selamat Datang Kembali</div>
<a href="<?=site_url('penjualan/cetak_nota_pdf/'.$id_penjualan.'/'.$jumlah_bayar)?>">Cetak</a>
<?php
    $this->load->view('template/footer');
?>