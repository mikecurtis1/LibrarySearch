<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="<?php echo $css_default_href; ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $css_custom_href; ?>" media="screen" />
<title><?php echo $head_title; ?></title>
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
function toggleDiv(divId) {
   $("#"+divId).toggle("slow");
}
</script>
</head>
<body>
<h1><img class="library_logo" src="<?php echo $logo_src; ?>" alt="library icon" /></h1>
<?php echo $html_form; ?>
<?php echo $html_results; ?>
<div class='lorem_ipsum'><?php echo $lorem_ipsum; ?></div>
<div class='lorem_ipsum'><?php echo truncateStr($lorem_ipsum, 140, TRUE); ?></div>
<div class="search_info">
<pre>
<?php echo var_dump($search_info); ?>
</pre>
</div>
<div class="http_request_data">
<?php foreach ( $values['http_request'] as $key => $value): ?>
<li><?php echo htmlspecialchars($key); ?>=<?php echo htmlspecialchars($value); ?></li>
<?php endforeach; ?>
</div>
<pre>
<?php echo var_dump($results); ?>
</pre>
</body>
</html>