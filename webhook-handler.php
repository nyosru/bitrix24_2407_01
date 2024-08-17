<?php


// Включение CORS для работы с браузером
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


function send_msg2($text)
{
	file_get_contents(
		'https://api.php-cat.com/telegram.php?' . http_build_query([
			's' => md5(1),
			'msg' => $text,
			'domain' => $_SERVER['HTTP_HOST'] ?? 'z'
		])
	);
}

send_msg2( __FILE__. ' '.__LINE__ );


// Пример обработчика вебхука
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Логирование
writeToLog('старт');
writeToLog($data);

send_msg2( 'webhook api777:data: '.json_encode($data) );
send_msg2( 'webhook api777:input: '.json_encode($input) );
send_msg2( 'webhook api777:request: '.json_encode($_REQUEST) );

// Пример: Проверка сообщения
if (isset($data['data']['PARAMS']['MESSAGE']) && strpos($data['data']['PARAMS']['MESSAGE'], '.su') !== false) {
	// Логика обработки
	writeToLog('обработка');
}

function writeToLog($data) {
	$logFile = './webhook.log';
	$logEntry = date('Y-m-d H:i:s') . " " . print_r($data, true) . "\n";
	file_put_contents($logFile, $logEntry, FILE_APPEND);
}
