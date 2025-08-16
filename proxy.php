<?php
/* proxy.php */
$url = $_GET['url'] ?? '';
if (empty($url)) { http_response_code(400); exit('URL vacía'); }

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Origin: https://lefttoplay.xyz',
        'Referer: https://lefttoplay.xyz/',
        'User-Agent: Mozilla/5.0 (iPad; CPU OS 13_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148'
    ],
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false
]);
$stream = curl_exec($ch);
if (curl_errno($ch)) { http_response_code(500); exit('Error CURL'); }
curl_close($ch);

header('Content-Type: application/vnd.apple.mpegurl');
echo $stream;
?>
