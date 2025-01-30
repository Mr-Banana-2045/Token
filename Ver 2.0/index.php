<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Token</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
<form id="del">
<input type="text" placeholder="Enter your ID ..." name="id" id="input" required>
<input type="submit" value="send">
</form>
<code>
<pre id="txt"></pre>
<?php 
$file = file_get_contents('tokens.json');
$data = json_decode($file, true);
$device = $_SERVER['HTTP_USER_AGENT'];
$foundTokens = false;
foreach($data as $item){
	if ($item['device'] === $device){
		echo $item['user']  . "<br>" ?? 'none';
        echo $item['token'] . "<br>" ?? 'none';
        echo $item['device'] . "<br>" ?? 'none';
        $foundTokens = true;
    }
}
if (!$foundTokens) {
    echo 'none';
}
?>
</code>
<script src="fetch.js"></script>
</body>
</html>
