<?php

namespace App\Model;


use App\Entity\Messages as Message;

class Messages extends Model
{
    public function addMessage(Message $data)
    {
        return self::create([
            'name' => $data->getName(),
            'email' => $data->getEmail(),
            'subject' => $data->getSubject(),
            'message' => $data->getMessage()
        ]);
    }
}