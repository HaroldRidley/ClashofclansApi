<?php

require_once "ClanAPI.php";

class Location extends ClanAPI
{

    private $url, $tag;

    public function __construct()
    {
        $this->setUrl("https://api.clashofclans.com/v1/locations/");

    }

    public function getLocations(){

        return $this->call($this->getUrl());

    }

    public function getPlayerRankings(){

    }

    public function getClanRankings(){

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