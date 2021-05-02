<?php

namespace App\Model;


use App\Entity\Messages as Message;

class Messages extends Model
{
    protected $guarded = [];

    public function addMessage(Message $data)
    {
        return self::create([
            'name' => $data->getName(),
            'email' => $data->getEmail(),
            'subject' => $data->getSubject(),
            'message' => $data->getMessage()
        ]);
    }

    public function allMessages()
    {
        return self::orderBy('created_at', 'desc')->get()->toArray();
    }

    public function messageAnswered()
    {
        return self::where('answered', '=', '0' )->get()->toArray();
    }

    public function findMessage($messageId)
    {
        return self::find($messageId)->toArray();
    }

    public function eraseMessage($messageId)
    {
        return self::destroy($messageId);
    }

    public function markAnswered($messageId, $answer)
    {
        $message = self::find($messageId);

        $message->answer = $answer;
        $message->answered = true;
        $message->save();
    }
}