<?php
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/textsearch/xml?query=bars+in+San+Antonio&pageToken=10&key=AIzaSyBeIAG4AZ3xv2NZWna31ssaPkyfI15IHZs'
));

// Send the request & save response to $resp
$resp = curl_exec($curl);
var_dump($resp);
// Close request to clear up some resources
curl_close($curl);