<?php
/**
 * Created by OsaMa Soft.
 * User: Osama
 * Date: 19/7/2017
 * Time: 01:57 PM
 * @author OsaMa hawkiq
 * @version 1.0 ($Rev: 1 $)
 * @package hawkiqPSApi
 * @subpackage simple_html_dom
 */

include('simple_html_dom.php');

class hawkiqPSApi {
    private $psnid;

    /**
     * hawkiqPSApi constructor.
     * @param $psnid
     */
    public function __construct($psnid)
    {
        $this->psnid = $psnid;
    }
    public function get_avatar(){
        $url = 'https://psnprofiles.com/'.$this->psnid.'/';
        $html = file_get_html($url);
        $avatar = $html->find('meta [property="og:image"]',0)->content;
        return $avatar;
    }
    public function get_trophies(){
        $url = 'https://psnprofiles.com/'.$this->psnid.'/';
        $html = file_get_html($url);
        $total = $html->find('li[class=icon-sprite total]',0)->plaintext;
        $platinum = $html->find('li[class=icon-sprite platinum]',0)->plaintext;
        $gold = $html->find('li[class=icon-sprite gold]',0)->plaintext;
        $silver = $html->find('li[class=icon-sprite silver]',0)->plaintext;
        $bronze = $html->find('li[class=icon-sprite bronze]',0)->plaintext;
        $searchfor = array(",","%");
        $total = str_replace($searchfor, '', $total);
        $platinum = str_replace($searchfor, '', $platinum);
        $gold = str_replace($searchfor, '', $gold);
        $silver = str_replace($searchfor, '', $silver);
        $bronze = str_replace($searchfor, '', $bronze);
        $trophies = array("total"=>(int)$total,"platinum"=>(int)$platinum,"gold"=>(int)$gold,"silver"=>(int)$silver,"bronze"=>(int)$bronze);
        return $trophies;
    }
    public function get_infos(){
	$url = 'https://psnprofiles.com/'.$this->psnid.'/';
	$html = file_get_html($url);
	$username = $html->find('span[class=username]',0)->plaintext;
	$about = $html->find('span[class=comment]',0)->plaintext;
	$level = $html->find('li[class=icon-sprite level]',0)->plaintext;
	$total = $html->find('li[class=icon-sprite total]',0)->plaintext;
	$platinum = $html->find('li[class=icon-sprite platinum]',0)->plaintext;
	$gold = $html->find('li[class=icon-sprite gold]',0)->plaintext;
	$silver = $html->find('li[class=icon-sprite silver]',0)->plaintext;
	$bronze = $html->find('li[class=icon-sprite bronze]',0)->plaintext;
	$searchfor = array(",","%");
	$total = str_replace($searchfor, '', $total);
	$platinum = str_replace($searchfor, '', $platinum);
	$gold = str_replace($searchfor, '', $gold);
	$silver = str_replace($searchfor, '', $silver);
	$bronze = str_replace($searchfor, '', $bronze);
	$avatar = $html->find('meta [property="og:image"]',0)->content;
    for ($i=0; $i<3;$i++){
        $element = $html->find('span[class=stat grow]', $i)->plaintext;
        $search = array("Games Played  ","Completed Games  ","Completion  ","Unearned Trophies  ","Trophies Per Day  ","Average Rarity  ","Views  ","%");
        $newstr = str_replace($search, '', $element);
        $stats[$i]=$newstr;
    }
	$lastgame = $html->find('a[rel=nofollow]', 2)->plaintext;
	$stats[3] =  $lastgame;
	    $hiddensrc = $html->find('div[id=hidden-trophies]', 0)->title;
	if (strlen($hiddensrc) > 0){
		$hide = explode(' ',$hiddensrc);
    $hideen = strip_tags($hide[4]);
    if ($hideen < 1){
        $hideen = 0;
		}
	}
	$info = array("username"=>$username,"about"=>$about,"avatar"=>$avatar,"total"=>(int)$total,"platinum"=>(int)$platinum,"gold"=>(int)$gold,"silver"=>(int)$silver,"bronze"=>(int)$bronze,"level"=>$level,"lastgame"=>$stats[3],"played"=>$stats[0],"completion"=>$stats[2],"complgames"=>$stats[1],"hiddentrophies"=>$hideen);
	return $info;

}


	public function get_rarety(){
    $url = 'https://psnprofiles.com/'.$this->psnid.'/stats';
    $html = file_get_html($url);
	$rares = $html->find('ul[class=legend]', 3)->plaintext;
	$search = array("Ultra","Very","Rare","Uncommon","Common","(",")",",");
        $rares = str_ireplace($search, '', $rares);
		$array_rare = explode(' ',$rares);
		$info_r = array("ultrarare"=>$array_rare[4],"veryrare"=>$array_rare[8],"rare"=>$array_rare[11],"uncommon"=>$array_rare[14],"common"=>$array_rare[17]);
    return $info_r;
}
}
