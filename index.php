<?php

	# ヘッダーファイル読み込み
	require('./page_header.php');

	# About ページ
	$about_html = <<< EOM
<h2>About</h2>
<p>このページでは、nostr.h3z.jp の投稿数 (kind 1)、リポスト数 (kind 6)、リアクション数 (kind 7) のランキングを掲載しております。<br />
合計、日間、週間、月間 の 4 項目で表示しております。<br />
データは毎日 0:02 に更新されます。(月間は 1 日の 0:02 に更新)</p>
<p>※集計で使用する日時は DB の first_seen を採用しております。<br />
※合計ランキングと月間ランキングは 100 以上の数値のみ、週間ランキングは 20 以上の数値のみをカウントしております。</p>

<h2>Ranking bot</h2>
<p>毎日 0:02 に、前日のランキングを自動的に呟く bot を運用中です。<br />
@nostr-ranking.h3z.jp (npub1nay0tzxrrpfau6x0tgzv9adcv4ml5l8k5lm7nvex5t07j05fp9psqdggwe)<br />
をフォローしてみて下さい。</p>
EOM;

	# GET リクエストに ranking が入っているか
	if (isset($_GET['ranking'])) {

		# username ファイル読み込み
		$file2 = "./data/username.csv";

		# 日付指定を確認
		if (isset($_GET['date'])) {

			$req_date = ($_GET['date']);

			$date_check = explode('-', $req_date);
			if (checkdate($date_check[1], $date_check[2] , $date_check[0]) === false) {
				echo "<p>エラー：不正な日付です</p>\n";
				require('./page_footer.php');
				exit;
			}

			$date_check1 = strtotime($req_date);
			$date_check2 = strtotime('2023-02-06');
			$date_check3 = strtotime(date('Y-m-d', strtotime('-1 day')));

			if ($date_check1 < $date_check2) {
				echo "<p>エラー：2023-02-06 よりも過去の日付が指定されています</p>\n";
				require('./page_footer.php');
				exit;
			}
			if ($date_check1 > $date_check3) {
				echo "<p>エラー：" . date('Y-m-d', strtotime('-1 day')) . " よりも未来の日付が指定されています</p>\n";
				require('./page_footer.php');
				exit;
			}
			if ($date_check1 == $date_check3 && date("H") == 00 && date("i") == 00 || $date_check1 == $date_check3 && date("H") == 00 && date("i") == 01) {
				$req_date = date('Y-m-d', strtotime('-2 day'));
			}

		} else {

			if ($date_check1 == $date_check3 && date("H") == 00 && date("i") == 00 || $date_check1 == $date_check3 && date("H") == 00 && date("i") == 01) {
				$req_date = date('Y-m-d', strtotime('-2 day'));
			} else{
				$req_date = date('Y-m-d', strtotime('-1 day'));
			}
		}

		# リクエスト種別を確認
		# 日別
		if ($_GET['ranking'] == 'daily') {

			$title1 = date('Y年m月d日', strtotime($req_date)) . "の";

			# kind 6
			if ($_GET['kind'] == '6') {
				$title2 = "リポスト数";
				$file1  = './data/daily/6/' . $req_date . '.csv';

			# kind 7
			} else if ($_GET['kind'] == '7') {
				$title2 = "リアクション数";
				$file1  = './data/daily/7/' . $req_date . '.csv';

			# それ以外
			} else {
				$title2 = "投稿数";
				$file1  = './data/daily/1/' . $req_date . '.csv';
			}

		# 週別
		} else if ($_GET['ranking'] == 'weekly') {

			$date_check1 = strtotime($req_date);
			$date_check2 = strtotime('2023-02-12');

			if ($date_check1 < $date_check2) {
				echo "<p>エラー：2023-02-12 よりも過去の日付が指定されています</p>\n";
				require('./page_footer.php');
				exit;
			}

			$title1 = date('Y年m月d日', strtotime($req_date)) . "から過去1週間の";

			# kind 6
			if ($_GET['kind'] == '6') {
				$title2 = "リポスト数";
				$file1  = './data/weekly/6/' . $req_date . '.csv';

			# kind 7
			} else if ($_GET['kind'] == '7') {
				$title2 = "リアクション数";
				$file1  = './data/weekly/7/' . $req_date . '.csv';

			# それ以外
			} else {
				$title2 = "投稿数";
				$file1  = './data/weekly/1/' . $req_date . '.csv';
			}

		# 月別
		} else if ($_GET['ranking'] == 'monthly') {

			$req_date_tmp = strtotime($req_date);
			$req_date = date('Y-m-d', strtotime('first day of this month', $req_date_tmp));
			$req_date_tmp2 = strtotime($req_date);
			$req_date2 = date('Y年m月', strtotime('-1 month', $req_date_tmp2));

			$date_check1 = $req_date_tmp;
			$date_check2 = strtotime('2023-03-01');

			if ($date_check1 < $date_check2) {
				echo "<p>エラー：2023-03-01 よりも過去の日付が指定されています</p>\n";
				require('./page_footer.php');
				exit;
			}

			$title1 = $req_date2 . "の";

			# kind 6
			if ($_GET['kind'] == '6') {
				$title2 = "リポスト数";
				$file1  = './data/monthly/6/' . $req_date . '.csv';

			# kind 7
			} else if ($_GET['kind'] == '7') {
				$title2 = "リアクション数";
				$file1  = './data/monthly/7/' . $req_date . '.csv';

			# それ以外
			} else {
				$title2 = "投稿数";
				$file1  = './data/monthly/1/' . $req_date . '.csv';
			}

		# それ以外 (累計)
		} else {

			$req_date_tmp = strtotime($req_date);
			$req_date2 = date('Y-m-d', strtotime('+1 day', $req_date_tmp));
			$title1 = date('Y年m月d日 0時', strtotime($req_date2)) . "時点の累計";

			# kind 6
			if ($_GET['kind'] == '6') {
				$title2 = "リポスト数";
				$file1  = './data/all/6/' . $req_date . '.csv';

			# kind 7
			} else if ($_GET['kind'] == '7') {
				$title2 = "リアクション数";
				$file1  = './data/all/7/' . $req_date . '.csv';

			# それ以外
			} else {
				$title2 = "投稿数";
				$file1  = './data/all/1/' . $req_date . '.csv';
			}

		}

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

		echo '<h2>' . $title1 . $title2 . "ランキング</h2>\n";
		echo "<table>\n";
		echo "	<tr>\n";
		echo "		<td></td>\n";
		echo "		<td>name</td>\n";
		echo "		<td>count</td>\n";
		echo "	</tr>\n";

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

		echo "</table>\n";

	} else {

		echo $about_html;

	}

	require('./page_footer.php');

?>
