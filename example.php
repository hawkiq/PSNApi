<?php

/**
 * Created by OsaMa Soft.
 * User: Osama
 * Date: 19/7/2017
 * Update Date: 14/8/2021
 * Time: 01:57 PM
 * Update Time: 10:06 AM
 */
// include Class API
include('hawkiqPSApi.php');
$psnID = "hawkiq";
// init Class with PSN ID
$psnapi = new hawkiqPSApi($psnID);
// use getInfos to bring All information needed
$playerInfo = $psnapi->getInfos();
// You might use getRarity to get stats of rare trophies
//$playerInfoRare = $psnapi->getRarity();

echo '<pre>';
print_r($playerInfo);
//print_r($playerInfoRare);
echo '</pre>';
