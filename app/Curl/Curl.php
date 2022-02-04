<?php

namespace App\Curl;

abstract class Curl
{
    protected $url = null;
    private $curl = null;
    protected $q = null;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->curl = curl_init();
    }

    abstract public function setParam(...$params);
    
    private function setUrl()
    {
        $this->url = $this->base_url .'?'. $this->q;
    }

    private function setHeader()
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($this->curl, CURLOPT_USERAGENT, 'COREXC');
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
    }

    private function exec()
    {
        $this->setUrl();
        $this->setHeader();
        return curl_exec($this->curl);
    }
    public function httpStatus()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    private function reset()
    {
        curl_close($this->curl);
        $this->url = null;
        $this->curl = null;
        $this->q = null;
    }

    public function getData()
    {
        $content = $this->exec();
        $this->reset();
        return $content;
    }
}
