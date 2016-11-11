<?php

require_once "ClanAPI.php";

class League extends ClanAPI
{

    private $url, $id, $seasonId;

    public function __construct($id = null)
    {
        $this->setUrl("https://api.clashofclans.com/v1/leagues/");
        $this->setId($id);

    }

    public function getLeagues(){

        return $this->call($this->getUrl());

    }
    public function getLeague(){

        return $this->call($this->getUrl(), null, $this->getId());

    }

    public function getSeasons(){

        return $this->call($this->getUrl(), null, $this->getId(), 'seasons');
    }
    public function getSeason(){


        $action = "seasons/" . $this->getSeasonId();
        return $this->call($this->getUrl(), null, $this->getId(), 'seasons');
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
    /**
     * @return null
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * @param null $seasonId
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;
    }

}