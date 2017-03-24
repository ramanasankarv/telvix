<?php
$client_id = '3623fdcfd074495ebca2e0d5f8a8166f';
$client_secret = 'd41db934d2e644a9b2de5c767f4f17de';
$redirect_uri = 'http://snapshotadmin.havasstaging.com/article/testing_insta/';
$apiData = array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,        
    'aspect' => "media",
    'object' => "tag",
    'object_id' => "tattoo",
    'callback_url' => $redirect_uri
);

$apiHost = 'https://api.instagram.com/v1/subscriptions/';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiHost);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$jsonData = curl_exec($ch);
curl_close($ch);
var_dump($jsonData);

?>