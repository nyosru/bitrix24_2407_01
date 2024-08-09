<?php
$logFile = __DIR__ . '/webhook.log';

// Получаем данные из вебхука
$data = file_get_contents('php://input');
$request = json_decode($data, true);

// Логируем полученные данные
writeToLog($request, $logFile);

if ($request['event'] == 'OnImMessageAdd') {
	$messageText = $request['data']['PARAMS']['MESSAGE'];

	// Логируем текст сообщения
	writeToLog("Received message: " . $messageText, $logFile);

	// Проверка, содержит ли сообщение текст '.su'
	if (strpos($messageText, '.su') !== false) {
		// Логируем факт совпадения условия
		writeToLog("Message contains '.su'. Moving chat to next stage.", $logFile);

		// Вызов метода для перемещения сделки или чата на следующий этап
		moveChatToNextStage($request['data']['PARAMS']['CHAT_ID']);
	}
}

// Функция для записи логов
function writeToLog($data, $logFile) {
	$logEntry = date('Y-m-d H:i:s') . " " . print_r($data, true) . "\n";
	file_put_contents($logFile, $logEntry, FILE_APPEND);
}

function moveChatToNextStage($chatId) {
	global $logFile;
	// Вызов API для перемещения чата или сделки на другой этап воронки
	// Пример: restCommand('crm.deal.update', [...]);

	// Логируем вызов перемещения чата
	writeToLog("Moving chat ID $chatId to next stage.", $logFile);
}
?>
