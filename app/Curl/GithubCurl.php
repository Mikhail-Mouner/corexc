<?php

namespace App\Curl;

class GithubCurl extends Curl
{
    static public $current_page = 1;
    public static $per_page = 20;
    public $base_url = 'https://api.github.com/search/repositories';

    public function setParam(...$params)
    {
        if (!is_null($params[0]) && !is_null($params[1])) {

            switch ($params[0]) {
                case 'q':
                    $param = $params[0] . '=' . $params[1];
                    break;
                case 'sort':
                    $param = $params[0] . '=' . $params[1];
                    break;
                case 'order':
                    $param = $params[0] . '=' . (in_array($params[1], ['desc', 'asc']) ? $params[1] : 'asc');
                    break;
                case 'per_page':
                    $param = $params[0] . '=' . (intval($params[1]) > 1 ? intval($params[1]) : self::$per_page);
                    break;
                case 'page':
                    $param = $params[0] . '=' . (intval($params[1]) > 1 ? intval($params[1]) : self::$current_page);
                    break;
                default:
                    $param = '';
                    break;
            }
            $this->q = $this->q . '&' . $param;
            $this->q = trim($this->q, '&');
        }
        return $this;
    }

    private function checkPassQuery()
    {
        if (!strpos($this->q, '&page=')) {
            $this->setParam('page', self::$current_page);
        }
        if (!strpos($this->q, '&per_page=')) {
            $this->setParam('per_page', self::$per_page);
        }
    }

    public function getData()
    {
        $this->checkPassQuery();
        return parent::getData();
    }
}
