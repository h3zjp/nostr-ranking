<?php
require('./page_header.php');
?>
<h2>About</h2>
<p>このページでは、nostr.h3z.jp の投稿数 (kind 1)・リアクション数 (kind 7) のランキングを掲載しております。<br />
合計、日間、週間、月間 の4項目で表示しております。<br />
データは毎日 0:02 に更新されます。(週間は日曜日、月間は 1 日の 0:02 に更新)</p>
<p>※集計対象の日時は DB の first_seen を採用しております。<br />
※合計ランキングは 100 以上の数値のみをカウントしております。</p>
<h2>RAW Data</h2>
<p>合計<br />
<a href="./data/ranking-all1.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-all1.csv</a><br />
<a href="./data/ranking-all7.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-all7.csv</a></p>
<p>日間<br />
<a href="./data/ranking-daily1.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-daily1.csv</a><br />
<a href="./data/ranking-daily7.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-daily7.csv</a></p>
<p>週間<br />
<a href="./data/ranking-weekly1.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-weekly1.csv</a><br />
<a href="./data/ranking-weekly7.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-weekly7.csv</a></p>
<p>月間<br />
<a href="./data/ranking-monthly1.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-monthly1.csv</a><br />
<a href="./data/ranking-monthly7.csv" target="_blank">https://nostr-ranking.h3z.jp/data/ranking-monthly7.csv</a></p>
<?php
require('./page_footer.php');
?>