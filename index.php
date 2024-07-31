<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quick start. Local server-side application</title>
</head>
<body>
	<div id="name">
		<?php
		require_once (__DIR__.'/crest.php');

		$result = CRest::call('user.current');

        echo '<pre>',print_r($result ?? []),'</pre>';

//		echo $result['result']['NAME'].' '.$result['result']['LAST_NAME'];
		?>
	</div>
</body>
</html>