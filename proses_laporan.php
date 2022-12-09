<?php
    include "koneksi.php";
    $Lapor = "SELECT nis, nama, jenis_kelamin, telp, alamat FROM siswa";
    $Hasil = $pdo->query($Lapor);
    $Data = array();
    foreach ($Hasil as $row) {
        array_push($Data, $row);
    }
    $Judul = "Data Mahasiswa";
    $tgl= "Time : ".date("l, d F Y");
    $Header= array(
        array("label"=>"NIS", "length"=>20, "align"=>"L"),
        array("label"=>"Nama Mahasiswa", "length"=>60, "align"=>"L"),
        array("label"=>"Jenis Kelamin", "length"=>40, "align"=>"L"),
        array("label"=>"Telepon", "length"=>25, "align"=>"L"),
        array("label"=>"Alamat", "length"=>33, "align"=>"L"),
    );
    require ("fpdf185/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage('P','A4');
    $pdf->SetFont('arial','B','15');
    $pdf->Cell(0, 15, $Judul, '0', 1, 'C');
    $pdf->SetFont('arial','i','9');
    $pdf->Cell(0, 10, $tgl, '0', 1, 'P');
    $pdf->SetFont('arial','','12');
    $pdf->SetFillColor(190,190,0);
    $pdf->SetTextColor(255);
    $pdf->setDrawColor(128,0,0);
    foreach ($Header as $Kolom){
        $pdf->Cell($Kolom['length'], 8, $Kolom['label'], 1, '0', $Kolom['align'], true);
    }
    $pdf->Ln();
    $pdf->SetFillColor(244,235,255);
    $pdf->SettextColor(0);
    $pdf->SetFont('arial','','10');
    $fill =false;
    foreach ($Data as $Baris){
        for ($i = 0; $i <= 4; $i++) {
            $pdf->Cell ($Header[$i]['length'], 7, $Baris[$i], 2, '0', $Kolom['align'], $fill);
          }
        $fill = !$fill;
        $pdf->Ln();
    }
    $pdf->Output();
?>