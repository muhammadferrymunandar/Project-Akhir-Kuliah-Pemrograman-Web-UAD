<?php
function tgl_indo($date){
   /* ARRAY untuk bulan */
   $Bulan = array ("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

/* Memisahkan format tanggal bulan dan tahun menggunakan substring */
$tahun 	 = substr($date, 0, 4);
$bulan 	 = substr($date, 5, 2);
$tgl	 = substr($date, 8, 2);
$waktu	 = substr($date,11, 5);


$result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu." WIB";
return $result;
}

?>
