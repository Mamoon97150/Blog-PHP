<?php


namespace App\Controller;


use App\Entity\Messages;
use App\Model\Messages as MessageModel;
use App\HTTPRequest;

class MessageController extends FrontController
{
    public function createMessage(HTTPRequest $request)
    {
        $value = $request->validator([
            'name' => ['required'],
            'email' => ['required'],
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $message = (new Messages())
            ->setName($value['name'])
            ->setEmail($value['email'])
            ->setSubject($value['subject'])
            ->setMessage($value['message'])
            ;
        (new MessageModel())->addMessage($message);

        return redirect('home.show');
    }

    public function deleteMessage($messageId)
    {
        (new MessageModel())->eraseMessage($messageId);
        return redirect('admin.Messages');
    }

    public function showMessageList($data)
    {
        $messages = [];
        foreach ($data as $message)
        {
            $messages[] = (new Messages())
                ->setId($message['id'])
                ->setName($message['name'])
                ->setEmail($message['email'])
                ->setSubject($message['subject'])
                ->setAnswered($message['answered'])
                ->setCreatedAt($message['created_at'])
            ;
        }
        return $messages;
    }

    public function showMessage($messageId)
    {
        $data = (new MessageModel())->findMessage($messageId);
        return (new Messages())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setSubject($data['subject'])
            ->setMessage($data['message'])
            ->setAnswer($data['answer'])
            ->setCreatedAt($data['created_at'])
            ;
    }

}