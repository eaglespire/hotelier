<?php

use App\Models\ProfileImage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (!function_exists('fire_up_cloudinary_upload'))
{
    function fire_up_cloudinary_upload($filename)
    {
        return Cloudinary::upload($filename->getRealPath(), [
            'folder'=>config('app.name').'/profile',
            'transformation'=>[
                'crop' => 'fit',
            ]
        ])->getSecurePath();
    }
}
if (!function_exists('load_up_image'))
{
    function load_up_image($image,$type,$userId) : bool
    {
        $src = fire_up_cloudinary_upload($image);
        //check to see if this user already has an existing profile image
        $user = ProfileImage::where('type',$type)->where('user_id', $userId)->first();
        if ($user){
            //update
            $user->update([
                'src'=> $src,
            ]);
        }else{
            //insert into the database
            DB::table('profile_images')->insert([
                'src'=> $src,
                'type' => $type,
                'user_id' => auth()->id()
            ]);
        }
        log_activity("Uploaded $type image ",auth()->id());
        return true;
    }
}
if (!function_exists('send_mail'))
{
    function send_mail($request): array
    {
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
            if (isset($request['emailCc'])){
                $mail->addCC($request['emailCc']);
            }
            if (isset($request['emailBcc'])){
                $mail->addBCC($request['emailBcc']);
            }
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

if (!function_exists('build_email_otp_code'))
{
    function build_email_otp_code() : string
    {
        $arr = [0,1,2,3,4,5,6,7,8,9];
        shuffle($arr);
        $shuffled = array_slice($arr,0,4);
        return implode('',$shuffled);
    }
}

if (!function_exists('set_otp'))
{
    function set_otp($request) : string
    {
        $otp = [];
        $otp[] = $request->digit_1;
        $otp[] = $request->digit_2;
        $otp[] = $request->digit_3;
        $otp[] = $request->digit_4;

        return implode('',$otp);
    }
}

if (!function_exists('send_email_message'))
{
    function send_email_message($recipient,$subject,$message) : bool
    {
        $request = [];
        $request['emailRecipient'] = $recipient;
        $request['emailSubject'] = $subject;
        $request['emailBody'] = $message;
        send_mail($request);
        return true;
    }
}
