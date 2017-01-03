<?php
class PDF extends FPDF
{
	//Page header
	function Header()
	{
                $this->setFont('Arial','',10);
                $this->setFillColor(255,255,255);
                $this->cell(100,6,"Sub Sistem Penjualan Barang Koperasi",0,0,'L',1); 
                $this->cell(100,6,"Printed date : " . date('d/m/Y'),0,1,'R',1); 
                //$this->Image(base_url().'assets/dist/img/user7-128x128.jpg', 10, 25,'20','20','jpeg');
                
                $this->Ln(12);
                $this->setFont('Arial','',14);
                $this->setFillColor(255,255,255);
                $this->cell(25,6,'',0,0,'C',0); 
                $this->cell(100,6,'Laporan Anggota Koperasi',0,1,'L',1); 
                $this->cell(25,6,'',0,0,'C',0); 
                $this->cell(100,6,"Periode : ".date('M Y'),0,1,'L',1); 
                $this->cell(25,6,'',0,0,'C',0); 
                $this->cell(100,6,'Lokasi : Malang, Jawa Timur',0,1,'L',1); 
                
                
                $this->Ln(5);
                $this->setFont('Arial','',10);
                $this->setFillColor(230,230,200);
                $this->cell(35,6,'ID',1,0,'C',1);
                $this->cell(35,6,'Nama Anggota',1,0,'C',1);
                $this->cell(30,6,'Username',1,0,'C',1);
                $this->cell(55,6,'Alamat',1,0,'C',1);
                $this->cell(40,6,'Telp',1,0,'C',1);
                $this->cell(40,6,'Hak Akses',1,1,'C',1);
                
	}
 
	function Content($anggota)
	{
            $ya = 46;
            $rw = 6;
            $no = 1;
                foreach ($anggota as $key) {
                        $this->setFont('Arial','',10);
                        $this->setFillColor(255,255,255);	
                        $this->cell(35,10,$key->id_anggota,1,0,'L',1);
                        $this->cell(35,10,$key->nama_anggota,1,0,'L',1);
                        $this->cell(30,10,$key->username_anggota,1,0,'L',1);
                        $this->cell(55,10,$key->alamat_anggota,1,0,'L',1);
                        $this->cell(40,10,$key->telp_anggota,1,0,'L',1);
                        $this->cell(40,10,$key->hak_akses,1,1,'L',1);
                        $ya = $ya + $rw;
                        $no++;
                }            

	}
	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(10,$this->GetY(),210,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
                $this->Cell(0,10,'copyright Polinema ' . date('Y'),0,0,'L');
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->Content($anggota);
$pdf->Output();