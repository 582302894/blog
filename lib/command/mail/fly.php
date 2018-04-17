<?php
namespace composer;
define('COMPOSER_SCRIPT_PATH', __DIR__ . '/../../../');
error_reporting(E_ALL);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require COMPOSER_SCRIPT_PATH . '/lib/autoload.php';
// require COMPOSER_SCRIPT_PATH . '/lib/obj/cache.php';
// require 'vendor/autoload.php';

function sendMail($content) {

    $mail = new PHPMailer(true); // Passing `true` enables exceptions
    try {
        //Server settings
        // $mail->SMTPDebug = 1; // Enable verbose debug output
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        // $mail->Host = 'smtp.qq.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        // $mail->Username = ''; // SMTP username
        // $mail->Password = ''; // SMTP password
        // $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        // $mail->Port = 465; // TCP port to connect to

        $mailConfig = config('mail_config');

        $mail->Host = $mailConfig[163]['host']; // Specify main and backup SMTP servers
        $mail->Username = $mailConfig[163]['email']; // SMTP username
        $mail->Password = $mailConfig[163]['key']; // SMTP password
        $mail->SMTPSecure = $mailConfig[163]['secure']; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $mailConfig[163]['port']; // TCP port to connect to

        $mail->setFrom('18373250360@163.com', 'sunhaobo');
        $mail->addAddress('1125477664@qq.com'); // Name is optional

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'subject';
        $mail->Body = $content;
        // $mail->AltBody = $content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
sendMail('alksjdklasd');
