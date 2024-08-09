<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quick start. Local server-side application</title>
</head>
<body>
<div id="name">
	<?php
	require_once(__DIR__ . '/crest.php');

	$result = CRest::call('user.current');

	echo '<pre style="font-size: 10px;">', print_r($result ?? []), '</pre>';
	echo $result['result']['NAME'] . ' ' . $result['result']['LAST_NAME'];


	// Получение сообщений
	$result = CRest::call('im.message.list', [
		'FILTER' => [
			'DATE_CREATE' => [
				'>=DATE' => date('Y-m-d H:i:s', strtotime('-10 hour'))
			]
		],
		'ORDER' => [
			'DATE_CREATE' => 'DESC'
		]
	]);

	echo '<br/>2222<br/><pre style="font-size: 10px;">', print_r($result ?? []), '</pre>';

	?>
</div>
</body>
</html>