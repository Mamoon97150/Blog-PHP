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
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
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

    public function deleteMessage()
    {

    }

    public function showMessage()
    {

    }

}