<?php

/**
 * Created by OsaMa Soft.
 * User: Osama
 * Date: 19/7/2017
 * Update Date: 14/8/2021
 * Time: 01:57 PM
 * Update Time: 10:06 AM
 * @author OsaMa hawkiq
 * @version 1.0 ($Rev: 1 $)
 * @package hawkiqPSApi
 * @subpackage simple_html_dom
 */

/*
This API uses simple_html_dom and depent on it so you must first download this class from their website http://simplehtmldom.sourceforge.net/ 
 */
include('simple_html_dom.php');

class hawkiqPSApi
{
    private $psnid;

    /**
     * hawkiqPSApi constructor.
     * @param $psnid
     */
    public function __construct($psnid)
    {
        $this->psnid = $psnid;
    }

    private function createHtmlObject($psnID, $type = 1)
    {
        switch ($type) {
            case 1:
                $url = 'https://psnprofiles.com/' . $psnID . '/';
                break;
            case 2:
                $url = 'https://psnprofiles.com/' . $psnID . '/stats';
                break;
            default:
                $url = 'https://psnprofiles.com/' . $psnID . '/';
                break;
        }
        $html = file_get_html($url);
        return $html;
    }
    private function getAvatar($html)
    {
        $avatar = "";
        $avatar = $html->find('meta [property="og:image"]', 0)->content;
        return $avatar;
    }
    private function getTrophies($html)
    {
        $trophies = array();
        $total = $html->find('li[class=total]', 0)->plaintext;
        $platinum = $html->find('li[class=platinum]', 0)->plaintext;
        $gold = $html->find('li[class=gold]', 0)->plaintext;
        $silver = $html->find('li[class=silver]', 0)->plaintext;
        $bronze = $html->find('li[class=bronze]', 0)->plaintext;
        $searchfor = array(",", "%");
        $total = str_replace($searchfor, '', $total);
        $platinum = str_replace($searchfor, '', $platinum);
        $gold = str_replace($searchfor, '', $gold);
        $silver = str_replace($searchfor, '', $silver);
        $bronze = str_replace($searchfor, '', $bronze);
        $trophies = array("total" => (int)$total, "platinum" => (int)$platinum, "gold" => (int)$gold, "silver" => (int)$silver, "bronze" => (int)$bronze);
        return $trophies;
    }
    public function getInfos()
    {
        $html = $this->createHtmlObject($this->psnid);
        $username = $html->find('span[class=username]', 0)->plaintext;
        $about = $html->find('span[class=comment]', 0)->plaintext;
        $level = $html->find('li[class=icon-sprite level]', 0)->plaintext;
        $trophies = $this->getTrophies($html);
        $avatar = $this->getAvatar($html);
        for ($i = 0; $i < 3; $i++) {
            $element = $html->find('span[class=stat grow]', $i)->plaintext;
            $search = array("Games Played ", "Completed Games ", "Completion ", "Unearned Trophies  ", "Trophies Per Day  ", "Average Rarity  ", "Views  ", "%");
            $newstr = str_replace($search, '', $element);
            $stats[$i] = $newstr;
        }
        $lastgame = $html->find('a[rel=nofollow]', 2)->plaintext;
        $stats[3] =  $lastgame;
        $hidden = 0;
        $hiddensrc = $html->find('div[id=hidden-trophies]', 0) != null ? $html->find('div[id=hidden-trophies]', 0)->title : '';
        if (strlen($hiddensrc) > 0) {
            $hide = explode(' ', $hiddensrc);
            $hidden = strip_tags($hide[4]);
        }
        $info = array("username" => $username, "about" => $about, "avatar" => $avatar, "trophies" => $trophies, "level" => $level, "lastgame" => $stats[3], "played" => $stats[0], "completion" => $stats[2], "complgames" => $stats[1], "hiddentrophies" => $hidden);
        return $info;
    }


    public function getRarity()
    {
        $info_r = array();
        $html = $this->createHtmlObject($this->psnid, 2);
        $rares = $html->find('ul[class=legend]', 3)->plaintext;
        $search = array("Ultra", "Very", "Rare", "Uncommon", "Common", "(", ")", ",");
        $rares = str_ireplace($search, '', $rares);
        $array_rare = explode(' ', $rares);
        $info_r = array("ultrarare" => $array_rare[4], "veryrare" => $array_rare[8], "rare" => $array_rare[11], "uncommon" => $array_rare[14], "common" => $array_rare[17]);
        return $info_r;
    }
}
