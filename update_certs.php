#!/usr/bin/env php
<?php
\chdir(__DIR__);

\set_time_limit(0); // unlimited max execution time

$fp = \fopen(__DIR__ . '/data/ca-certificates.crt', 'w');
// $fp = \fopen('/Applications/XAMPP/xamppfiles/htdocs/floospay.com/flospaySDKs/Flospay_php_python_07_09_2021/Flospay.php/data/ca-certificates.crt', 'w+b');

$options = [
    \CURLOPT_FILE => $fp,
    \CURLOPT_TIMEOUT => 3600,
    \CURLOPT_RETURNTRANSFER => true,
    \CURLOPT_HTTPGET => true,
    \CURLOPT_URL => 'https://curl.se/ca/cacert.pem',
];

$ch = \curl_init('https://curl.se/ca/cacert.pem');
\curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
\curl_setopt($ch,CURLOPT_FILE,$fp);
// \curl_setopt_array($ch, $options);
\curl_exec($ch);
\curl_setopt($ch,CURLOPT_FILE,$fp);
// \curl_exec($ch);

// echo $certffilecontents;
\fclose($fp);
\curl_close($ch);

// $fcontext = @file_get_contents('https://curl.se/ca/cacert.pem');
// echo $fcontext;
// @file_put_contents('./data/ca-certificates.crt', $fcontext);
