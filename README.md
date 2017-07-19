# PSNApi
PlayStation unofficial API to bring basic information for players such as number of platinums or their avatar
# Installation
This API uses simple_html_dom and depent on it so you must first download this class from their website 
http://simplehtmldom.sourceforge.net/
then put it in the same folder as hawkiqPSApi.php

as you see from example .php you must include class file into your project

    include('hawkiqPSApi.php');

# Usage
create new object from class

    $psnapi = new hawkiqPSApi($psnID);
   
note that the class take initial parameter which is Player PSN ID

    $playerInfo = $psnapi->get_infos();
    
this will return array of info and use it like you want :)
# More
see example.php 
