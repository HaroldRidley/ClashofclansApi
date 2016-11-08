<?php

require_once "ClanAPI.php";

class Clan extends ClanAPI
{

    private $url, $tag;

    public function __construct($tag)
    {
        $this->setUrl("https://api.clashofclans.com/v1/clans/");

        $good_tag = $this->validateTag($tag);

        if($good_tag === false){
            throw new \Exception('Invalid Clan Tag.',1);
        }

        $this->setTag($good_tag);

    }

    public function getClan(){

        return $this->call($this->getUrl(), $this->getTag());

    }

    public function getClanIcon(){

        $clan = $this->getClan();

        return $clan['badgeUrls']['small'];
    }

    public function getClanMembers(){
        return $this->call($this->getUrl(), $this->getTag(), 'members');

    }

    public function getClanWarLog(){
        return $this->call($this->getUrl(), $this->getTag(), 'warlog');

    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param null $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

}