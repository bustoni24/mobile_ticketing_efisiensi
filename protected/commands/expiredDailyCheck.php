<?php
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "https://efisiensi.id/api/notifyDailyCheck/?id=h3n5r5w5q584g4r4a4a356g4m5i484b4o4e4t5p5u5t4e4w2");
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
?>
