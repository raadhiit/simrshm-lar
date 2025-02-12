<?php
function convertMonthYear($date)
{
    $dateParts = explode('-', $date);
    $month = $dateParts[1];
    $year = $dateParts[0];

    $base_months = array(
        1 => 'Januari',
        2 => 'Februari',
        3  => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    $month =  $base_months[(int)$month] ?? '-';
    return $month . ' ' . $year;
}
