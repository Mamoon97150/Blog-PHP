<?php

namespace App;


class HTTPRequest
{

    public function all()
    {
        return $_POST;
    }

    public function name(string $field)
    {
        return $_POST[$field];
    }
}