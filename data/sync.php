<?php

$url = 'https://example.com/stats/';

$file_all1 = $url . 'ranking-all1.csv';
$file_all6 = $url . 'ranking-all6.csv';
$file_all7 = $url . 'ranking-all7.csv';
$file_daily1 = $url . 'ranking-daily1.csv';
$file_daily6 = $url . 'ranking-daily6.csv';
$file_daily7 = $url . 'ranking-daily7.csv';
$file_weekly1 = $url . 'ranking-weekly1.csv';
$file_weekly6 = $url . 'ranking-weekly6.csv';
$file_weekly7 = $url . 'ranking-weekly7.csv';
$file_monthly1 = $url . 'ranking-monthly1.csv';
$file_monthly6 = $url . 'ranking-monthly6.csv';
$file_monthly7 = $url . 'ranking-monthly7.csv';
$file_username = $url . 'username.csv';

$data_all1 = file_get_contents($file_all1);
$data_all6 = file_get_contents($file_all6);
$data_all7 = file_get_contents($file_all7);
$data_daily1 = file_get_contents($file_daily1);
$data_daily6 = file_get_contents($file_daily6);
$data_daily7 = file_get_contents($file_daily7);
$data_weekly1 = file_get_contents($file_weekly1);
$data_weekly6 = file_get_contents($file_weekly6);
$data_weekly7 = file_get_contents($file_weekly7);
$data_monthly1 = file_get_contents($file_monthly1);
$data_monthly6 = file_get_contents($file_monthly6);
$data_monthly7 = file_get_contents($file_monthly7);
$data_username = file_get_contents($file_username);

$file_folder = './data/';
$now_date = date('Y-m-d', strtotime('-1 day'));

file_put_contents($file_folder . 'username.csv', $data_username);
file_put_contents($file_folder . 'all/1/' . $now_date . '.csv', $data_all1);
file_put_contents($file_folder . 'all/6/' . $now_date . '.csv', $data_all6);
file_put_contents($file_folder . 'all/7/' . $now_date . '.csv', $data_all7);
file_put_contents($file_folder . 'daily/1/' . $now_date . '.csv', $data_daily1);
file_put_contents($file_folder . 'daily/6/' . $now_date . '.csv', $data_daily6);
file_put_contents($file_folder . 'daily/7/' . $now_date . '.csv', $data_daily7);
file_put_contents($file_folder . 'weekly/1/' . $now_date . '.csv', $data_weekly1);
file_put_contents($file_folder . 'weekly/6/' . $now_date . '.csv', $data_weekly6);
file_put_contents($file_folder . 'weekly/7/' . $now_date . '.csv', $data_weekly7);
if (date("j") == 1) {
	$now_date = date('Y-m-d');
	file_put_contents($file_folder . 'monthly/1/' . $now_date . '.csv', $data_monthly1);
	file_put_contents($file_folder . 'monthly/6/' . $now_date . '.csv', $data_monthly6);
	file_put_contents($file_folder . 'monthly/7/' . $now_date . '.csv', $data_monthly7);
}
?>
