<?php

	require('./page_header.php');
	$file1 = "./data/ranking-weekly7.csv";
	$file2 = "./data/username.csv";

	$mfile = fopen($file1, 'r');
	$mcsv = fgetcsv($mfile, 1);
	$mget_time = $mcsv[0];
	while ($line = fgetcsv($mfile)) {
		$data[] = array_combine(Array('0','1'), $line);
	}
	$count = count($data);
	fclose($mfile);

	$mfile2 = fopen($file2, 'r');
	$mcsv2 = fgetcsv($mfile2, 1);
	$mget_time2 = $mcsv2[0];
	while ($line2 = fgetcsv($mfile2)) {
		$username[] = array_combine(Array('0','1','2'), $line2);
	}
	fclose($mfile2);

?>
<h2>先週のリアクション数ランキング (<?php echo $mget_time; ?>)</h2>
<table>
	<tr>
		<td></td>
		<td>name</td>
		<td>count</td>
	</tr>
<?php
	for ($i = 0; $i < $count; $i++) {

        $name_num = array_search($data[$i][0], array_column($username, 0));

        if ($name_num != false) {
                $name = $username[$name_num][1];
            if ($name == "") {
                $name = $username[$name_num][2];
            }
        } else {
            $name = $data[$i][0];
        }

		echo "	<tr>\n";
		echo "		<td style=\"background-color:#" . substr($data[$i][0], 1, 6) . ";\">&emsp;</span></td>\n";
		echo "		<td>" . $name . "</td>\n";
		echo "		<td>" . $data[$i][1] . "</td>\n";
		echo "	</tr>\n";
	}
?>
</table>
<?php
require('./page_footer.php');
?>