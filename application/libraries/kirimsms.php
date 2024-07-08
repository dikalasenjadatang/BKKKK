<?php

require 'autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MTY4NTQ4MywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYzNzAyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.GQCz4JCsLmiPlIkKynzoplycaA-TZErvBOLsBOVurFo');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '07791064781',
    'message' => 'test1',
    'deviceId' => 1
]);
$sendMessageRequest2 = new SendMessageRequest([
    'phoneNumber' => '07791064781',
    'message' => 'test2',
    'deviceId' => 2
]);
$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1,
    $sendMessageRequest2
]);
print_r($sendMessages);

?>