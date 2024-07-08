<?php

require 'autoload.php';

function kirim_sms($no_hp, $pesan){
	require_once('smsGatewayV4.php');
	$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MTY4NTQ4MywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzNzAyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.GQCz4JCsLmiPlIkKynzoplycaA-TZErvBOLsBOVurFo";
	$deviceID = 104863;
	$options = [];

	$smsGateway = new SmsGateway($token);
	$result = $smsGateway->sendMessageToNumber($no_hp, $pesan, $deviceID, $options);
}

function batal(){
	new CancelMessageRequest([
    'id' => 63402678
]);
}
?>