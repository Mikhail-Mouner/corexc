<?php

namespace App\Request;

class Request
{
    public $input = null;

    public function __construct()
    {
        parse_str(file_get_contents('php://input'), $this->input);
    }
    public function all()
    {
        return $this->input;
    }
    public function __get($name)
    {
        return isset($this->input[$name]) && !empty($this->input[$name]) ? $this->input[$name] : null;
    }
}
