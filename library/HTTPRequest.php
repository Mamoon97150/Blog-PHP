<?php

namespace App;


class HTTPRequest
{
    protected $posts;
    protected $errors;

    public function __construct()
    {
        $this->posts = $this->name();
    }

    public function name(string $name = null)
    {
        if ($name == null)
        {
            return $_POST;
        }
        else
        {
            return $_POST[$name];
        }

    }

    public function session($name, $data = null)
    {
        if (!empty($data) | $data != null)
        {
            $_SESSION[$name] = $data;
        }
        else
        {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
        }
    }

    public function validator(array $rules)
    {
        foreach ($rules as $key => $valueArray)
        {
            if (array_key_exists($key, $this->posts))
            {
                foreach ($valueArray as $rule)
                {
                    switch ($rule)
                    {
                        case 'required' :
                            $this->required($key, $this->posts[$key]);
                            break;

                        case substr($rule, 0, 3) === 'max' :
                            $this->max($key, $this->posts[$key], $rule);
                            break;

                        case substr($rule, 0, 3) === 'min' :
                            $this->min($key, $this->posts[$key], $rule);
                            break;

                    }
                    $this->session('input', $this->posts);
                }
            }
        }
        if ($this->getErrors() != null)
        {
            header('location: '.$this->lastUrl());
        }
        else
        {
            unset($_SESSION['errors']);
            return $this->name();
        }
    }

    private function required( $name, $value)
    {
        $value = trim($value);
        if (!isset($value) || is_null($value) || empty($value))
        {
            $this->errors[$name][] = '<i class="fas fa-exclamation-triangle"></i>'.ucfirst($name)." is required</br>";
        }

    }

    private function max($name ,  $value,  $rule)
    {
        preg_match_all('#(\d+)#', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) > $limit)
        {
            $this->errors[$name][] = "<i class='fas fa-exclamation-triangle'></i> The number of characters in <span class='fw-bolder text-decoration-underline'>$name</span> must be less than or equal to $limit";
        }

    }

    private function min( $name ,  $value,  $rule)
    {
        preg_match_all('#(\d+)#', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit)
        {
            $this->errors[$name][] = "<i class='fas fa-exclamation-triangle'></i> The number of characters in <span class='font-weight-bolder' style='text-decoration: underline'>$name</span> must be greater than or equal to $limit";
        }
    }

    public function getErrors()
    {
        if ($this->errors !== null)
        {
            $this->session('errors', $this->errors);
            return ($this->session('errors') !== null) ? $this->session('errors') : [];
        }
        else
        {
            return ($this->session('errors') !== null) ? null : [];
        }
    }

    private function lastUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public function lastRedirect()
    {
        header('location: '.$this->lastUrl());
    }


}