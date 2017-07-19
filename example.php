<?php
/**
 * Created by OsaMa Soft.
 * User: Osama
 * Date: 19/7/2017
 * Time: 01:57 PM
 */
include('hawkiqPSApi.php');
$psnID = "hawkiq";

$psnapi = new hawkiqPSApi($psnID);
$playerInfo = $psnapi->get_infos();

$playerInfoRare = $psnapi->get_rarety();

echo '<pre>';
print_r($playerInfo);
print_r($playerInfoRare);
echo '</pre>';