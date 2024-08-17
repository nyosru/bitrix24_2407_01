<?php

function isTokenValid($domain, $accessToken) {

	// Проверка токена с помощью простого запроса на получение информации о пользователе
	$response = callRestAPI('user.current', [], $domain, $accessToken);

	// Если ошибка авторизации, токен недействителен
	if (isset($response['error']) && $response['error'] === 'INVALID_TOKEN') {
		return false;
	}

	return true;
}

function refreshToken($domain, $clientId, $clientSecret, $refreshToken) {
	$url = "https://$domain/oauth/token/";

	$params = [
		'grant_type' => 'refresh_token',
		'client_id' => $clientId,
		'client_secret' => $clientSecret,
		'refresh_token' => $refreshToken,
	];

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_POSTFIELDS => http_build_query($params),
	]);

	$result = curl_exec($curl);
	curl_close($curl);

	return json_decode($result, true);
}


function send_msg($text)
{
	file_get_contents(
		'https://api.php-cat.com/telegram.php?' . http_build_query([
			's' => md5(1),
			'msg' => $text,
			'domain' => $_SERVER['HTTP_HOST'] ?? 'z'
		])
	);
}

// Функция для вызова методов REST API
function callRestAPI($method, $params, $domain, $accessToken)
{
	$url = "https://$domain/rest/$method.json?auth=$accessToken";
	$queryData = http_build_query($params);

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_POST => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
		CURLOPT_POSTFIELDS => $queryData,
	]);

	$result = curl_exec($curl);
	curl_close($curl);

	return json_decode($result, true);
}
