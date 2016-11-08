<?php

class Player extends ClanAPI
{

    private $tag;
    private $url = "https://api.clashofclans.com/v1/players/";

    public function __construct($tag)
    {
        $this->setUrl("https://api.clashofclans.com/v1/players/");

        $good_tag = $this->validateTag($tag);

        if($good_tag === false){
            throw new \Exception('Invalid Player Tag.');
        }

        $this->setTag($good_tag);
    }

    public function getPlayer(){
        return $this->call($this->getUrl(), $this->getTag());
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * @param mixed $tag
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }
}