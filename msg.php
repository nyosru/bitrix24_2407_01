<?php

// Получаем данные из POST-запроса
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!empty($data)) {
	// Отправляем данные на указанный адрес
	$url = 'https://php-cat.com/msg'; // Адрес, куда нужно передавать данные
	$options = [
		'http' => [
			'header'  => "Content-type: application/json\r\n",
			'method'  => 'POST',
			'content' => json_encode($data),
		],
	];
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	// Логирование результата для отладки
	file_put_contents('log.txt', $result.PHP_EOL, FILE_APPEND);
	echo 'Message forwarded successfully';
} else {
	echo 'No data received';
}
