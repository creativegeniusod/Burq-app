<?php
$config=array(
'DB_HOST'=>'localhost',
'DB_USERNAME'=>'burq',
'DB_PASSWORD'=>'aDxFnIwu3dpvjoui',
'DB_DATABASE'=>'burq'
);

$base_url="https://stagingwebsites.info/odz/burq/app";
$app_api_key="139960863abaf8fc7812a8a72d85f6e0";
$app_api_secret="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";


$conn = mysqli_connect($config['DB_HOST'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_DATABASE']);
	if (mysqli_connect_errno($conn)) {
		if(mysqli_connect_error()=='SSL connection is required. Please specify SSL options and retry.')
		{
			$conn = mysqli_init();
			mysqli_ssl_set($conn,NULL,NULL,"BaltimoreCyberTrustRoot.crt.pem", NULL, NULL);
			mysqli_real_connect($conn, $config['DB_HOST'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_DATABASE'], 3306, MYSQLI_CLIENT_SSL);
			if (mysqli_connect_errno($conn)) {
			die('Failed to connect to MySQL: '.mysqli_connect_error());
			}
			
		}
		else
		{
			echo 'Error:-'.mysqli_connect_error();
	
		}
	}

?>
