<?php


namespace App\Controller;


use App\Entity\Messages;
use App\Model\Messages as MessageModel;
use App\HTTPRequest;

class MessageController extends FrontController
{
    /**
     * Récupère les données du message depuis le formulaire,
     * hydrate l'objet Messages et l'ajoute à la base de données
     *
     * @param HTTPRequest $request
     */
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

    /**
     * Récupère les information du message et le supprime de la base de données
     *
     * @param $messageId
     */
    public function deleteMessage($messageId)
    {
        (new MessageModel())->eraseMessage($messageId);
        return redirect('admin.Messages');
    }

    /**
     *  Récupère la liste des messages depuis la base de donnée,
     *  hydrate l'objet Messages par un message, l'ajoute a un array et l'affiche
     *
     * @param $data
     * @return array
     */
    public function showMessageList($data): array
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

    /**
     *  Récupère un message depuis la base de donnée,
     * hydrate l'objet Messages et l'affiche
     *
     * @param $messageId
     * @return Messages
     */
    public function showMessage($messageId): Messages
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