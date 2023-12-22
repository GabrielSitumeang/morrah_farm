<?php

function formatRupiah($nominal, $prefix = null){
    $prefix = $prefix ? $prefix : 'Rp. ';
    return $prefix   . number_format($nominal, 0, ',', '.');
}

function formatRupiahTeks($x) {
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
  
    if ($x < 12)
      return " " . $angka[$x];
    elseif ($x < 20)
      return formatRupiahTeks($x - 10) . " belas";
    elseif ($x < 100)
      return formatRupiahTeks($x / 10) . " puluh" . formatRupiahTeks($x % 10);
    elseif ($x < 200)
      return "seratus" . formatRupiahTeks($x - 100);
    elseif ($x < 1000)
      return formatRupiahTeks($x / 100) . " ratus" . formatRupiahTeks($x % 100);
    elseif ($x < 2000)
      return "seribu" . formatRupiahTeks($x - 1000);
    elseif ($x < 1000000)
      return formatRupiahTeks($x / 1000) . " ribu" . formatRupiahTeks($x % 1000);
    elseif ($x < 1000000000)
      return formatRupiahTeks($x / 1000000) . " juta" . formatRupiahTeks($x % 1000000);
  }