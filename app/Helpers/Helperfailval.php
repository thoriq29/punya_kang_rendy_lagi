<?php 

use Carbon\Carbon;

function setActive($uri, $output = 'active')
{
	if( is_array($uri) ) {
		foreach ($uri as $u) {
			if (Route::is($u)) {
				return $output;
			}
		}
	} else {
		if (Route::is($uri)){
			return $output;
		}
	}
}

function rupiah($number)
{
	return number_format($number,0,',','.');
}

function date_full($date)
{
	return Carbon::parse($date)->format('d F Y');
}

function date_dmy($date)
{
	return Carbon::parse($date)->format('d M Y');
}

function diff_days($start_date, $end_date)
{
	$start = Carbon::parse($start_date);
	$res = Carbon::parse($end_date)->diffInDays($start);

	return $res;
}

function nilai_text($nilai)
{
	$text = "";

	if ($nilai >= 90 && $nilai <= 100) {
		$text = "Disarankan";
	} else if ($nilai >= 80 && $nilai <= 89.99){
		$text = "Disarankan";
	} else if ($nilai >= 70 && $nilai <= 79.99){
		$text = "Disarankan";
	} else if ($nilai >= 60 && $nilai <= 69.99){
		$text = "Disarankan";
	} else if ($nilai <= 59) {
		$text = "Tidak Disarankan";
	}

	return $text;
}

function getCriteriaDisplayName($value, $criteriaName)
{
	if($criteriaName == "Harga") {
		return getDescendingType($value);
	} else if($criteriaName == "Wisata" || $criteriaName == "Fasilitas") {
		return getAscendingType($value);
	}
	else if($criteriaName == "Durasi") {
		return getDurasiType($value);
	}
	else if($criteriaName == "Ibadah") {
		return getIbadahType($value);
	}
		return '';
}

function getDurasiType($value)
{
	$text = "";
	if($value = 50) {
		$text = "9 Hari|Bobot"." ".$value;
	} else if($value = 60) {
		$text = "11 Hari|Bobot"." ".$value;
	} else if($value > 60 && $value <= 100) {
		$text = "12 Hari|Bobot"." ".$value;
	}  else {
		$text = "";
	}
	return $text;
}

function getDescendingType($value)
{
	$text = "";
	if($value <= 45) {
		$text = "Super|Bobot"." ".$value;
	} else if($value = 60) {
		$text = "Mewah|Bobot"." ".$value;
	} else if($value > 60 && $value <= 70) {
		$text = "Spesial|Bobot"." ".$value;
	} else if($value > 70 && $value <= 80) {
		$text = "Standar|Bobot"." ".$value;
	} else {
		$text = "Basic|Bobot"." ".$value;
	}
	return $text;
}

function getAscendingType($value)
{
	$text = "";
	if($value <= 45) {
		$text = "Basic|Bobot"." ".$value;
	} else if($value = 55) {
		$text = "Standar|Bobot"." ".$value;
	} else if($value = 65) {
		$text = "Spesial|Bobot"." ".$value;
	} else if($value > 70 && $value <= 80) {
		$text = "Mewah|Bobot"." ".$value;
	} else {
		$text = "Super|Bobot"." ".$value;
	}
	return $text;
}
function getIbadahType($value)
{
	$text = "";
	if($value <= 55) {
		$text = "Normal|Bobot"." ".$value;
	} else if($value > 55 && $value <= 66) {
		$text = "Khusyuk|Bobot"." ".$value;
	 } else {
		$text = "Sangat Khusyuk|Bobot"." ".$value;
	}
	return $text;
}

