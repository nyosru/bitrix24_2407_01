<?php

// Включение CORS для работы с браузером
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


include_once(__DIR__ . '/cextrest.php');


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

send_msg(__FILE__ . ' ' . __LINE__);

$install_result = CRestExt::installApp();

// embedded for placement "placement.php"
$handlerBackUrl = ($_SERVER['HTTPS'] === 'on' || $_SERVER['SERVER_PORT'] === '443' ? 'https' : 'http') . '://'
	. $_SERVER['SERVER_NAME']
	. (in_array($_SERVER['SERVER_PORT'], ['80', '443'], true) ? '' : ':' . $_SERVER['SERVER_PORT'])
	. str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__)
	. '/handler.php';

//$result = CRestExt::call('events');
//CRest::setLog(['update' => $result], 'installation');
//send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result));
$all_action = [
"ONAPPUNINSTALL","ONAPPINSTALL","ONAPPUPDATE","ONAPPPAYMENT","ONSUBSCRIPTIONRENEW",
"ONAPPTEST","ONAPPMETHODCONFIRM","ONOFFLINEEVENT","ONIMCONNECTORLINEDELETE",
"ONIMCONNECTORMESSAGEADD",
"ONIMCONNECTORMESSAGEUPDATE","ONIMCONNECTORMESSAGEDELETE","ONIMCONNECTORSTATUSDELETE",
"ONIMBOTMESSAGEADD",
"ONIMBOTMESSAGEUPDATE","ONIMBOTMESSAGEDELETE","ONIMBOTJOINCHAT","ONIMBOTDELETE","ONIMCOMMANDADD",
"ONUSERADD",
"ONUSERADD","ONCRMINVOICEADD","ONCRMINVOICEUPDATE","ONCRMINVOICEDELETE","ONCRMINVOICESETSTATUS",
"ONCRMLEADADD","ONCRMLEADUPDATE","ONCRMLEADDELETE","ONCRMLEADUSERFIELDADD","ONCRMLEADUSERFIELDUPDATE",
"ONCRMLEADUSERFIELDDELETE","ONCRMLEADUSERFIELDSETENUMVALUES","ONCRMDEALADD","ONCRMDEALUPDATE","ONCRMDEALDELETE",
"ONCRMDEALMOVETOCATEGORY","ONCRMDEALUSERFIELDADD","ONCRMDEALUSERFIELDUPDATE","ONCRMDEALUSERFIELDDELETE",
"ONCRMDEALUSERFIELDSETENUMVALUES","ONCRMCOMPANYADD","ONCRMCOMPANYUPDATE","ONCRMCOMPANYDELETE",
"ONCRMCOMPANYUSERFIELDADD","ONCRMCOMPANYUSERFIELDUPDATE","ONCRMCOMPANYUSERFIELDDELETE",
"ONCRMCOMPANYUSERFIELDSETENUMVALUES","ONCRMCONTACTADD","ONCRMCONTACTUPDATE","ONCRMCONTACTDELETE",
"ONCRMCONTACTUSERFIELDADD","ONCRMCONTACTUSERFIELDUPDATE","ONCRMCONTACTUSERFIELDDELETE",
"ONCRMCONTACTUSERFIELDSETENUMVALUES","ONCRMQUOTEADD","ONCRMQUOTEUPDATE","ONCRMQUOTEDELETE",
"ONCRMQUOTEUSERFIELDADD","ONCRMQUOTEUSERFIELDUPDATE","ONCRMQUOTEUSERFIELDDELETE",
"ONCRMQUOTEUSERFIELDSETENUMVALUES","ONCRMINVOICEUSERFIELDADD","ONCRMINVOICEUSERFIELDUPDATE",
"ONCRMINVOICEUSERFIELDDELETE","ONCRMINVOICEUSERFIELDSETENUMVALUES","ONCRMCURRENCYADD","ONCRMCURRENCYUPDATE",
"ONCRMCURRENCYDELETE","ONCRMPRODUCTADD","ONCRMPRODUCTUPDATE","ONCRMPRODUCTDELETE","ONCRMPRODUCTPROPERTYADD",
"ONCRMPRODUCTPROPERTYUPDATE","ONCRMPRODUCTPROPERTYDELETE","ONCRMPRODUCTSECTIONADD","ONCRMPRODUCTSECTIONUPDATE",
"ONCRMPRODUCTSECTIONDELETE","ONCRMACTIVITYADD","ONCRMACTIVITYUPDATE","ONCRMACTIVITYDELETE","ONCRMREQUISITEADD",
"ONCRMREQUISITEUPDATE","ONCRMREQUISITEDELETE","ONCRMREQUISITEUSERFIELDADD","ONCRMREQUISITEUSERFIELDUPDATE",
"ONCRMREQUISITEUSERFIELDDELETE","ONCRMREQUISITEUSERFIELDSETENUMVALUES","ONCRMBANKDETAILADD",
"ONCRMBANKDETAILUPDATE","ONCRMBANKDETAILDELETE","ONCRMADDRESSREGISTER","ONCRMADDRESSUNREGISTER",
"ONCRMMEASUREADD","ONCRMMEASUREUPDATE","ONCRMMEASUREDELETE","ONCRMDEALRECURRINGADD","ONCRMDEALRECURRINGUPDATE",
"ONCRMDEALRECURRINGDELETE","ONCRMDEALRECURRINGEXPOSE","ONCRMINVOICERECURRINGADD","ONCRMINVOICERECURRINGUPDATE",
"ONCRMINVOICERECURRINGDELETE","ONCRMINVOICERECURRINGEXPOSE","ONCRMTIMELINECOMMENTADD","ONCRMTIMELINECOMMENTUPDATE",
"ONCRMTIMELINECOMMENTDELETE","ONCRMDYNAMICITEMADD","ONCRMDYNAMICITEMUPDATE","ONCRMDYNAMICITEMDELETE",
"ONCRMDYNAMICITEMADD_31","ONCRMDYNAMICITEMUPDATE_31","ONCRMDYNAMICITEMDELETE_31","ONCRMTYPEADD","ONCRMTYPEUPDATE",
"ONCRMTYPEDELETE","ONCRMDOCUMENTGENERATORDOCUMENTADD","ONCRMDOCUMENTGENERATORDOCUMENTUPDATE",
"ONCRMDOCUMENTGENERATORDOCUMENTDELETE","ONCRMTYPEUSERFIELDADD","ONCRMTYPEUSERFIELDUPDATE",
"ONCRMTYPEUSERFIELDDELETE","ONCRMTYPEUSERFIELDSETENUMVALUES","ONCRMTIMELINEITEMACTION","ONTASKADD",
"ONTASKUPDATE","ONTASKDELETE","ONTASKCOMMENTADD","ONTASKCOMMENTUPDATE","ONTASKCOMMENTDELETE",
"ONLIVEFEEDPOSTADD","ONLIVEFEEDPOSTUPDATE","ONLIVEFEEDPOSTDELETE"
]
//,"time":{"start":1723813068.2665911,"finish":1723813068.3042049,"duration":0.037613868713378906,"processing":7.8916549682617188e-5,"date_start":"2024-08-16T15:57:48+03:00","date_finish":"2024-08-16T15:57:48+03:00","operating_reset_at":172381
;
//
//$dada = [
//	'EVENT' => 'events',
//	'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
//];
//$result = CRestExt::call('event.bind', $dada);
//CRest::setLog(['update' => $result], 'installation');
//send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);

// регаем все доступные действия
if( 1 == 1 ){
	foreach( $all_action as $aa ){

		$dada = [
			'EVENT' => $aa,
			'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
		];
		$result = CRestExt::call('event.bind', $dada);
		CRest::setLog(['update' => $result], 'installation');
		send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);


	}
}else {
	$dada = [
		'EVENT' => 'ONAPPINSTALL',
		'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
	];
	$result = CRestExt::call('event.bind', $dada);
	CRest::setLog(['update' => $result], 'installation');
	send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);

	$dada = [
		'EVENT' => 'ONIMCONNECTORMESSAGEADD',
		'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
	];
	$result = CRestExt::call('event.bind', $dada);
	CRest::setLog(['update' => $result], 'installation');
	send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);
}


//$dada = [
//	'EVENT' => 'NewMessageInOpenLines',
//	'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
//];
//$result = CRestExt::call('event.bind', $dada);
//CRest::setLog(['update' => $result], 'installation');
//send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);
//
//$dada = [
//	'EVENT' => 'OnImOpenLinesMessageAdd',
//	'handler' => 'https://api-bitrix77.php-cat.com/webhook-handler.php'
//];
//$result = CRestExt::call('event.bind', $dada);
//CRest::setLog(['update' => $result], 'installation');
//send_msg(__FILE__ . ' ' . __LINE__ . ' ' . json_encode($result) . PHP_EOL . 'dada:' . $dada['EVENT']);


//$result = CRestExt::call(
//	'event.bind',
//	[
//		'EVENT' => 'ONCRMCONTACTUPDATE',
//		'HANDLER' => $handlerBackUrl,
//		'EVENT_TYPE' => 'online'
//	]
//);
//
//CRest::setLog(['update' => $result], 'installation');
//
//$result = CRestExt::call(
//	'event.bind',
//	[
//		'EVENT' => 'ONCRMCONTACTADD',
//		'HANDLER' => $handlerBackUrl,
//		'EVENT_TYPE' => 'online'
//	]
//);
//
//CRestExt::setLog(['add' => $result], 'installation');

if ($install_result['rest_only'] === false):?>
    <head>
        <script src="//api.bitrix24.com/api/v1/"></script>
		<?
		if ($install_result['install'] == true):?>
            /*
            <script>
              BX24.init(function() {
                BX24.installFinish();
              });
            </script>
            */
		<?
		endif; ?>
    </head>
    <body>
	<?
	if ($install_result['install'] == true):?>
        installation has been finished
	<?
	else:?>
        <pre><?
			print_r($install_result); ?></pre>
        installation error
	<?
	endif; ?>
    </body>
<?
endif;