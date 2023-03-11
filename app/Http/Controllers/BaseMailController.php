<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class BaseMailController extends Controller
{
    // ========== [ Compose Email ] ================
    protected function ComposeEmail(Request $request) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = config('mail.mailers.smtp.host');             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = config('mail.mailers.smtp.username');   //  sender username
            $mail->Password = config('mail.mailers.smtp.password');       // sender password
            $mail->SMTPSecure = config('mail.mailers.smtp.encryption');                  // encryption - ssl/tls
            $mail->Port = config('mail.mailers.smtp.port');                          // port - 465/587

            $mail->setFrom(config('mail.from.address'), config('mail.from.name'));
            $mail->addAddress($request['emailRecipient']);
            $mail->addCC($request['emailCc']);
            $mail->addBCC($request['emailBcc']);

            $mail->addReplyTo(config('mail.from.address'), config('mail.from.name'));

            if (isset($request['emailAttachments']))
            {
                if(!empty($_FILES['emailAttachments'])) {
                    for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                        $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                    }
                }
            }

            $mail->isHTML(true);                // Set email content format to HTML
            $mail->Subject = $request['emailSubject'];
            $mail->Body    = $request['emailBody'];
            // $mail->AltBody = plain text version of email body;
            if( !$mail->send() ) {
                return ["failed","Email not sent.", "$mail->ErrorInfo"];
                //return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            else {
                return ["success","Email has been sent.",null];
                //return back()->with("success", "Email has been sent.");
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ["error","Message could not be sent.",null];
            //return back()->with('error','Message could not be sent.');
        }
    }
}
