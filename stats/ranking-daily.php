<?php

	$filename1 = '/var/www/html/stats/ranking-daily1.csv';
	$filename6 = '/var/www/html/stats/ranking-daily6.csv';
	$filename7 = '/var/www/html/stats/ranking-daily7.csv';

	$sql1   = "SELECT encode(event_pubkey::bytea, 'hex'), COUNT(*) AS event_count FROM events WHERE first_seen >= '" . date('Y-m-d', strtotime('-1 day')) . " 00:00:00' AND first_seen < '" . date('Y-m-d') . " 00:00:00' AND event_kind = 1 GROUP BY event_pubkey ORDER BY event_count DESC";
	$sql6   = "SELECT encode(event_pubkey::bytea, 'hex'), COUNT(*) AS event_count FROM events WHERE first_seen >= '" . date('Y-m-d', strtotime('-1 day')) . " 00:00:00' AND first_seen < '" . date('Y-m-d') . " 00:00:00' AND event_kind = 6 GROUP BY event_pubkey ORDER BY event_count DESC";
	$sql7   = "SELECT encode(event_pubkey::bytea, 'hex'), COUNT(*) AS event_count FROM events WHERE first_seen >= '" . date('Y-m-d', strtotime('-1 day')) . " 00:00:00' AND first_seen < '" . date('Y-m-d') . " 00:00:00' AND event_kind = 7 GROUP BY event_pubkey ORDER BY event_count DESC";

	$pgcon = pg_connect("host=127.0.0.1 port=5432 dbname=nostr user=nostr password=password");
	$res1 = pg_query($pgcon, $sql1);
	$res6 = pg_query($pgcon, $sql6);
	$res7 = pg_query($pgcon, $sql7);
	$record1 = pg_fetch_all($res1);
	$record6 = pg_fetch_all($res6);
	$record7 = pg_fetch_all($res7);
	pg_close($pgcon);

	$filew1 = fopen($filename1, 'w');
	$filew6 = fopen($filename6, 'w');
	$filew7 = fopen($filename7, 'w');

	$req_date = date("Y-m-d H:i T", $_SERVER['REQUEST_TIME']);
	$last_generated = "Last generated: " . $req_date;

	$wcsv1 = array($last_generated);
	fputcsv($filew1, $wcsv1);

	$count1 = count($record1);
	for ($i = 0; $i < $count1; $i++) {

		$wcsv1 = array($record1[$i][encode], $record1[$i][event_count]);
		fputcsv($filew1, $wcsv1);

	}

	fclose($filew1);

	$wcsv6 = array($last_generated);
	fputcsv($filew6, $wcsv6);

	$count6 = count($record6);
	for ($i = 0; $i < $count6; $i++) {

		$wcsv6 = array($record6[$i][encode], $record6[$i][event_count]);
		fputcsv($filew6, $wcsv6);

	}

	fclose($filew6);

	$wcsv7 = array($last_generated);
	fputcsv($filew7, $wcsv7);

	$count7 = count($record7);
	for ($i = 0; $i < $count7; $i++) {

		$wcsv7 = array($record7[$i][encode], $record7[$i][event_count]);
		fputcsv($filew7, $wcsv7);

	}

	fclose($filew7);

?>