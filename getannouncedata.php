<?php
// This script gets event-ids via HTTP-GET from the AMIV announce tool, queries the API and posts an array containing the relevant data to the following program in the toolchain

$input = $_GET["id"]; //Use get on URL
$out = []; // Initialize output

$baseurl = "https://amiv-apidev.vsos.ethz.ch/";
$targeturl = "";
$runs = 0; // runtimevariable

foreach($input as $id){
    $push_name = "id".$runs;
    
    $url = $baseurl . "events/" . $id;
    
    //Send HTTP-GET via curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);
    
    $decoded = json_decode($result, true); // Decode returned data
    
    // Define variables
    $title_de = $decoded['title_de'];
    $title_en = $decoded['title_en'];
    $catchphrase_de = $decoded['catchphrase_de'];
    $catchphrase_en = $decoded['catchphrase_en'];	
    $location = $decoded['location'];			
    $description = $decoded['description_de'];
    $description_en = $decoded['description_en'];		
    $price = $decoded['price'];
    $signuplink = $baseurl . "eventsignup/" . $id;
    $time_start = $decoded['time_start'];
    $time_end = $decoded['time_end'];

    // Specify array to be returned
    $push = [ "title_de" => $title_de , "title_en" => $title_en , "catchphrase_de" => $catchphrase_de , "catchphrase_en" => $catchphrase_en , "location" => $location , "description_de" => $description_de , "description_en" => $description_en , "price" => $price , "signuplink" => $signuplink , "time_start" => $time_start , "time_end" => $time_end];
    $out[$push_name] = $push;
    $runs = $runs + 1;
}

$transfer = urlencode(serialize($out));

// Send data
$curl_tar = curl_init();
curl_setopt($curl_tar, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl_tar, CURLOPT_HEADER, false);
curl_setopt($curl_tar, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl_tar, CURLOPT_URL, $targeturl);
curl_setopt($curl_tar, CURLOPT_REFERER, $targeturl);
curl_setopt($curl_tar, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_tar, CURLOPT_POST, true);
$result = curl_exec($curl_tar);
curl_close($curl_tar);

?>
