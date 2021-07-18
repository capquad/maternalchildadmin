<?php

function constructPatientNumber(string $category, string $number): string
{
	// $number = explode('-', $number)[1];

	preg_match("/(\d{2,3})(\d{2})(\d{2})/", $number, $matches);

	[$number, $count, $month, $year] = $matches;
	$count += 1;
	if ($count < 100) {
		$count = "0" . $count;
	}

	if ($month !== date('m')) {
		$month = date('m');
	}

	if ($year !== date('y')) {
		$year = date('y');
	}

	$number = "$category-$count$month$year";
	return $number;
}

function constructHeaderLinks()
{
}
