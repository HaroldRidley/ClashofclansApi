<?php

require_once "ClanAPI.php";

class Location extends ClanAPI
{

    private $url, $id;

    public function __construct($id = null)
    {
        $this->setUrl("https://api.clashofclans.com/v1/locations/");
        $this->setId($id);

    }

    public function getLocations(){

        return $this->call($this->getUrl());

    }
    public function getLocation(){

        return $this->call($this->getUrl(), null, $this->getId());

    }

    public function getPlayerRankings(){

        return $this->call($this->getUrl(), null, $this->getId(), 'players');
    }

    public function getClanRankings(){
        return $this->call($this->getUrl(), null, $this->getId(), 'clans');


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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}