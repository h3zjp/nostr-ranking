<!DOCTYPE html>
<html dir="ltr">
<head>
<meta charset="UTF-8" />
<title>Nostr Ranking</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta name="format-detection" content="telephone=no,address=no,email=no" />
<meta name="robots" content="all" />
<link rel="stylesheet" type="text/css" href="./index.css" />
<link rel="stylesheet" type="text/css" href="https://media.h3z.jp/css/font-awesome/5.9.0/font-awesome.min.css" media="screen,projection" />
</head>
<body>
<header id="page_header">
Nostr Ranking
</header>

<nav class="page_menu">
<form name="form1" method="get" action=".">
<ul>
<li><a href="./">Home</a></li>
<li><input type="date" name="date" min="2023-02-06" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" /></li>
<li>All<input type="radio" name="ranking" value="all" checked /> Daily<input type="radio" name="ranking" value="daily" /> Weekly<input type="radio" name="ranking" value="weekly" /> Monthly<input type="radio" name="ranking" value="monthly" /></li>
<li>Post<input type="radio" name="kind" value="1" checked /> Repost<input type="radio" name="kind" value="6" /> Reacticon<input type="radio" name="kind" value="7" /></li>
<li><input type="submit" value="View" /></li>
</ul>
</form>
</nav>

<div id="page_main">
