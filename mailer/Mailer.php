<?php
/**
 * Mailer helper — wraps PHPMailer with SMTP settings from the database.
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Send an email via configured Gmail SMTP.
 *
 * @param string $toEmail     Recipient email address
 * @param string $toName      Recipient name
 * @param string $subject     Email subject
 * @param string $body        HTML body
 * @param string $plainBody   Plain-text fallback
 * @return bool|string        true on success, error string on failure
 */
function sendMail(string $toEmail, string $toName, string $subject, string $body, string $plainBody = '')
{
    $host      = getSetting('smtp_host')        ?: 'smtp.gmail.com';
    $port      = (int)(getSetting('smtp_port')  ?: 587);
    $username  = getSetting('smtp_username')    ?: '';
    $password  = getSetting('smtp_password')    ?: '';
    $senderName = getSetting('smtp_sender_name') ?: getSetting('company_name') ?: 'Jyoti Trade Agencies';

    if (empty($username) || empty($password)) {
        return 'SMTP credentials not configured.';
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $port;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($username, $senderName);
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $plainBody ?: strip_tags($body);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}
