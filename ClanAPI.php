<?php

class ClanAPI
{

    public function call($url, $tag = null, $id = null, $action = null)
    {
        $this->parseini();
        $token = $this->getToken();

        if(!is_null($tag)){
            $encoded_tag = $this->encodeTag($tag, true);
            $full_url = $url . $encoded_tag;
            $full_url = (!is_null($action)) ? $full_url . "/" . $action : $full_url;
        }
        elseif(!is_null($id)){
            $full_url = $url . $id . "/" .$action;
        }
        else{
            $full_url = $url;
        }

        $ch = curl_init($full_url);

        $headr = array();
        $headr[] = "Accept: application/json";
        $headr[] = "Authorization: Bearer " . $token;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $res = curl_exec($ch);
        $data = json_decode($res, true);
        curl_close($ch);

        return $data;
    }


    public function encodeTag($tag, $url_encode = false)
    {
        if ($url_encode) {
            return urlencode($tag);
        }

        $encoded_tag = str_replace('#', '%', $tag);

        return $encoded_tag;
    }

    public function validateTag($tag = null)
    {

        // if tag has any of these, not even trying.
        $special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "*", "(", ")", "|", "~", "`", "!", "{", "}", "@");

        $count = count(array_intersect(str_split($tag), $special_chars));

        if ($count > 0) {
            return false;
        }

        //if we start with "#" we assume its not encoded and good
        if (preg_match("/#[0-9A-Z]+/", $tag)) {
            return $tag;
        } // else if we start with "%" we assume we decode
        elseif (preg_match("/%[0-9A-Z]+/", $tag)) {
            return urldecode($tag);
        } // if we do not have either symbol, and just alplha numeric characters, prepend a "#" and let it fly
        elseif (preg_match("/[0-9A-Z]+/", $tag)) {

            return "#" . $tag;
        } // if we get here... I got nothing
        else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    private function parseini()
    {
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);

        $ini_array = parse_ini_file($root.'/clashofclans/ini/clash.ini');
//        die(var_dump($ini_array));

        if (empty($ini_array['token'])) {
            throw new \Exception('Token not found.');
        }

        $this->setToken($ini_array['token']);

    }

}