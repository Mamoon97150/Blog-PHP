<?php


namespace App\Controller;

require_once '../config/mailConfig.php';

use App\Entity\Messages;
use App\HTTPRequest;
use App\Model\Messages as MessagesModel;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailController extends FrontController
{
    public function answerMessage(HTTPRequest $request)
    {
        $contact = $request->validator([
            'answer' => ['required']
        ]);

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(EMAIL)
            ->setPassword(PASSWORD)
        ;
        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Re:'.$contact['subject']))
            ->setFrom([EMAIL => 'PHP Blog'])
            ->setTo([$contact['email']])
            ->setBody($contact['answer'], 'text/html')
        ;

        $mailer->send($message);

        (new MessagesModel())->markAnswered($contact['messageId'], $contact['answer']);
        redirect('admin.Messages');
    }

    //TODO: add forgotPassword()
}