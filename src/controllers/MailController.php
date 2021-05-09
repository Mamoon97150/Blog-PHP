<?php


namespace App\Controller;

require_once '../config/mailConfig.php';

use App\Entity\Messages;
use App\HTTPRequest;
use App\Model\Messages as MessagesModel;
use App\Model\Users as UserModel;
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

    public function resetPassword(HTTPRequest $request)
    {
        $forgot = $request->validator([
            'username' => ['required', 'min:5']
        ]);


        if ((new UserModel())->userExists('username', $forgot['username']) || (new UserModel())->userExists('email', $forgot['username']))
        {
            $token = bin2hex(md5($forgot['username'].rand(10,9999)));
            $expFormat = mktime(
                date("H"), date("i"), date("s"), date("m") ,(date("d")+1), date("Y")
            );
            $expDate = date("Y-m-d H:i:s",$expFormat);

            $user = (new UserController)->getUser($request);
            (new UserModel())->addToken($user, $token, $expDate);
            $link ="<a href='djamina-marboeuf/user/change/".$user->getUsername()."/".$token."'>Click To Reset password</a>";
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername(EMAIL)
                ->setPassword(PASSWORD)
            ;
            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Reset Password'))
                ->setFrom([EMAIL => 'PHP Blog'])
                ->setTo([$user->getEmail()])
                ->setBody('Click On This Link to Reset Password '.$link.'', 'text/html')
            ;

            $mailer->send($message);

            return redirect('user.login');
        }
        return $request->validator([ 'username' => ['notExist'] ]);
    }
}