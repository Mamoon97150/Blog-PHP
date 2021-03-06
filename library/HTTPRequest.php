<?php

namespace App;


class HTTPRequest
{
    private $posts;
    private $errors;

    public function __construct()
    {
        $this->posts = $this->name();
    }

    /**
     * Récupère le nom des champs ou d'un champ e formulaire spécifique
     *
     * @param string|null $name
     * @return mixed
     */
    public function name(string $name = null): mixed
    {
        if ($name == null)
        {
            return $_POST;
        }
        return $_POST[$name];
    }

    /**
     * exclus un champs du formulaire de l'array
     *
     * @param string $name
     * @param array $data
     * @return mixed
     */
    public function except(string $name, $data = []): mixed
    {
        if (!empty($data))
        {
            if (array_key_exists($name, $data))
            {
                unset($data[$name]);
                return $data;
            }
        }

        if (array_key_exists($name, $this->name()))
        {
            unset($_POST[$name]);
            return $_POST;
        }

    }

    /**
     *  crée et assigne de valeur à la session
     *
     * @param $name
     * @param null $data
     * @return mixed
     */
    public function session($name, $data = null): mixed
    {
        if (!empty($data) | $data != null)
        {
            $_SESSION[$name] = $data;
        }
        return isset($_SESSION[$name]) ? $_SESSION[$name] : '';

    }

    /**
     * gère le téléchargement des images ou autre fichiers
     *
     * @param $name
     * @param $file_destination
     * @param array $datatype
     * @return string|null
     */
    public function loadFiles($name, $file_destination, array $datatype): ?string
    {
        $file_name = $_FILES[$name]['name'];
        $file_extension = strrchr($file_name, '.');
        $file_tmp = $_FILES[$name]['tmp_name'];
        $file_destination = $file_destination.$file_name;

        if (in_array($file_extension, $datatype))
        {
            if (move_uploaded_file($file_tmp, $file_destination))
            {
                return $file_destination;
            }
            return null;
        }
        return null;
    }

    /**
     * validation des formulaires
     *
     * @param array $rules
     * @return mixed
     */
    public function validator(array $rules): mixed
    {
        foreach ($rules as $key => $valueArray)
        {
            if (array_key_exists($key, $this->posts))
            {
                foreach ($valueArray as $rule)
                {
                    $this->checkRule($rule, $key);
                    $this->session('input', $this->posts);
                }
            }
        }

        if ($this->getErrors() !== null)
        {
            return $this->lastRedirect();
        }
        unset($_SESSION['errors']);
        return $this->name();

    }

    /**
     * déclare les différentes règles de validation
     *
     * @param $rule
     * @param $key
     */
    public function checkRule($rule, $key)
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

            case 'exists' :
                $this->errors[$key][] = "<i class='fas fa-exclamation-triangle'></i> This <span class='fw-bolder text-decoration-underline'>$key</span> already exists !";
                break;

            case 'incorrect' :
                $this->errors[$key][] = "<i class='fas fa-exclamation-triangle'></i> Incorrect <span class='fw-bolder text-decoration-underline'>$key</span> !";
                break;

            case 'notExist' :
                $this->errors[$key][] = "<i class='fas fa-exclamation-triangle'></i> This <span class='fw-bolder text-decoration-underline'>$key</span> does not exist !";
                break;

        }
    }

     /*
      * fonction détaillant les différentes règles
      */
    private function required( $name, $value)
    {
        $value = trim($value);
        if (!isset($value) || $value === null || empty($value))
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

    /**
     * récupère les erreurs  de la session
     *
     * @return mixed
     */
    public function getErrors(): mixed
    {
        if ($this->errors !== null)
        {
            $this->session('errors', $this->errors);
            return ($this->session('errors') !== null) ? $this->session('errors') : [];
        }

        return ($this->session('errors') !== null) ? null : [];

    }

    /**
     * recupère le dernier lien
     *
     * @return mixed
     */
    private function lastUrl(): mixed
    {
        return $_SERVER['HTTP_REFERER'];
    }



    /**
     * redirige vers la derniere page visité
     */
    public function lastRedirect()
    {
        header('location: '.$this->lastUrl());
    }
}