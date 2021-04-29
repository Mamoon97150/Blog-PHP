<?php


namespace App\Controller;

require_once '../config/mailConfig.php';
use App\HTTPRequest;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailController extends FrontController
{
    public function answerMessage()
    {

    }

    public function sendContactEmail(HTTPRequest $request)
    {
        $contact = $request->validator([
            'name' => ['required'],
            'email' => ['required'],
            'subject' => ['required'],
            'message' => ['required']
        ]);

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername(EMAIL)
            ->setPassword(PASSWORD)
        ;
        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($contact['subject']))
            ->setFrom([EMAIL => 'PHP Blog'])
            ->setTo([$contact['email']])
            ->setBody($contact['message'])
        ;

        $mailer->send($message);
    }
}