<?php

$client_id = 'app.66cd34d33ad5d0.48532094';
define('B24_API_KEY',$client_id);
$client_secret = 'glaGEa01E6q0jgLSxqghR8z7Xy9FF2JdKTFWO7sDQnRam0aHQf';
$B24_SECRET_KEY =$client_secret;

//$domain = $_POST['DOMAIN'];
$domain = 'b24-0o8tww.bitrix24.ru';
define('B24_DOMAIN',$domain);
$auth_code = $_POST['AUTH_ID'];


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//		$client_id = 'YOUR_CLIENT_ID';
//		$client_secret = 'YOUR_CLIENT_SECRET';
//		$domain = $_POST['DOMAIN'];
//		$auth_code = $_POST['AUTH_ID'];

		// Получение access_token
		$url = "https://$domain/oauth/token/?client_id=$client_id&client_secret=$client_secret&grant_type=authorization_code&code=$auth_code";
		$response = file_get_contents($url);
		$response = json_decode($response, true);

		if (isset($response['access_token'])) {
			$access_token = $response['access_token'];

			// Настройка вебхука для получения сообщений
			$hook_url = "https://$domain/rest/42/webhook_link";
			$webhook_data = [
				'EVENT' => 'OnImNewMessage',
				'HANDLER' => 'https://api-bitrix77.php-cat.com/msg.php', // URL-обработчик на вашем домене
			];
			$options = [
				'http' => [
					'header' => "Content-type: application/json\r\nAuthorization: Bearer $access_token\r\n",
					'method' => 'POST',
					'content' => json_encode($webhook_data),
				],
			];
			$context = stream_context_create($options);
			$result = file_get_contents($hook_url, false, $context);

			if ($result === false) {
				echo 'Error during webhook creation';
			} else {
				echo 'Webhook setup complete';
			}
		} else {
			echo 'Error during installation: ' . json_encode($response);
            echo '<pre>',print_r($_REQUEST,true),'</pre>';
		}
	} else {
		echo 'Invalid request';
	}


// Подключение к API Битрикс24
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://' . B24_DOMAIN . '/rest/1/openline/connector');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_USERPWD, B24_API_KEY . ':' . $B24_SECRET_KEY);

// Параметры для создания коннектора
$data = [
	'name' => 'Название вашего коннектора',
	'type' => 'Телеграмм',
	'access_token' => 'токен_телеграмма',
	'secret_key' => 'секретный_ключ_телеграмма'
];

// Отправка запроса на создание коннектора
$response = curl_exec($ch);

// Проверка статуса ответа
if ($response === false) {
	echo 'Ошибка при создании коннектора: ' . curl_error($ch);
} else {
	$result = json_decode($response, true);
	if ($result['result'] === 'ok') {
		echo 'Коннектор успешно создан.';
	} else {
		echo 'Ошибка при создании коннектора: ' . $result['error'];
	}
}

// Закрытие соединения
curl_close($ch);

// Настройка обработки сообщений
$address = 'https://php-cat.com/msg.php';
while (true) {
	$message = connector . getMessage();
	if ($message != null) {
		// Отправка сообщения на указанный адрес
		file_get_contents(
			$address,
			false,
			stream_context_create([
				'http' => [
					'method' => 'POST',
					'header' => 'Content-Type: application/x-www-form-urlencoded',
					'content' => http_build_query(['message' => $message])
				]
			])
		);
	}
}
