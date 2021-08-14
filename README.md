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

    $psnID = "hawkiq";
    $psnapi = new hawkiqPSApi($psnID);
   
note that the class take initial parameter which is Player PSN ID

    $playerInfo = $psnapi->getInfos();
    
this will return array of info and use it like you want :)

```
Array
(
    [username] => hawkiq 
    [about] => * Founder of Iraqi PlayStation Players Leaderboard  •  * instagram:hawkiq  •  oJJI IJI oJI IJ
    [avatar] => https://i.psnprofiles.com/avatars/l/G4613a5e4c.png
    [trophies] => Array
        (
            [total] => 5441
            [platinum] => 110
            [gold] => 401
            [silver] => 1068
            [bronze] => 3862
        )

    [level] => 406
    [lastgame] => Horizon Zero Dawn
    [played] => 153
    [completion] => 74.96
    [complgames] => 77
    [hiddentrophies] => 0
)
```
# More
see  https://github.com/hawkiq/PSNApi/blob/master/example.php
