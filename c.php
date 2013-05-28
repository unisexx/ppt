<?php
$url = 'http://intranet.opp.go.th/pdfsystem/Default.aspx?dt=042013&p=A';
$ch = curl_init();
   // set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HEADER, 0);

   // grab URL and pass it to the browser
   $chk = curl_exec($ch);
   //curl_multi_getcontent($ch);
   // close cURL resource, and free up system resources
   curl_close($ch);
   var_dump($chk);