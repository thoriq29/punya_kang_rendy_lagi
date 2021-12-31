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

function diff_full_date($start_date, $end_date)
{
	$start = Carbon::parse($start_date);
	if(strtotime($start) <= strtotime($end_date)) {
		return diff_days($start_date, $end_date);
	}
	return -1;
}

function nilai_text($nilai)
{
	$text = "";

	if ($nilai >= 90 && $nilai <= 100) {
		$text = "Sangat Butuh";
	} else if ($nilai >= 80 && $nilai <= 89.99){
		$text = "Butuh";
	} else if ($nilai >= 70 && $nilai <= 79.99){
		$text = "Cukup Butuh";
	} else if ($nilai >= 60 && $nilai <= 69.99){
		$text = "Tidak Terlalu Butuh";
	} else if ($nilai <= 59) {
		$text = "Tidak Butuh";
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
	if($value <= 50) {
		$text = "9 Hari";
	} else if($value > 50 && $value <= 60) {
		$value=55;
		$text = "11 Hari";
	} else if($value > 60 && $value <= 100) {
		$text = "12 Hari";
	}  else {
		$text = "";
	}
	return $text;
}

function getDescendingType($value)
{
	$text = "";
	if($value <= 45) {
		$text = "Super";
	} else if($value > 45 && $value <= 60) {
		$text = "Mewah";
	} else if($value > 60 && $value <= 70) {
		$text = "Spesial";
	} else if($value > 70 && $value <= 80) {
		$text = "Standar";
	} else {
		$text = "Basic";
	}
	return $text;
}

function getAscendingType($value)
{
	$text = "";
	if($value <= 45) {
		$text = "Basic";
	} else if($value > 45 && $value <= 60) {
		$text = "Standar";
	} else if($value > 60 && $value <= 70) {
		$text = "Spesial";
	} else if($value > 70 && $value <= 80) {
		$text = "Mewah";
	} else {
		$text = "Super";
	}
	return $text;
}
function getIbadahType($value)
{
	$text = "";
	if($value <= 55) {
		$text = "Normal";
	} else if($value > 55 && $value <= 66) {
		$text = "Khusyuk";
	 } else {
		$text = "Sangat Khusyuk";
	}
	return $text;
}

