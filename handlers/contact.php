<?php
session_start();
header('Content-Type: application/json');

require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/security.php';
require_once dirname(__DIR__) . '/mailer/Mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// CSRF — csrf_verify() calls die() with 403 on failure; no return value needed
csrf_verify();

// CAPTCHA verification
$captchaInput  = (int)($_POST['captcha'] ?? -1);
$captchaAnswer = (int)($_SESSION['captcha_answer_contact'] ?? -999);
unset($_SESSION['captcha_answer_contact']); // One-time use
if ($captchaInput !== $captchaAnswer) {
    echo json_encode(['success' => false, 'message' => 'Incorrect security answer. Please refresh and try again.']);
    exit;
}

$name    = sanitize($_POST['name']         ?? '');
$company = sanitize($_POST['company_name'] ?? '');
$email   = sanitizeEmail($_POST['email']   ?? '');
$phone   = sanitize($_POST['phone']   ?? '');
$message = sanitize($_POST['message'] ?? '');
$ip      = getClientIP();

$errors = [];
if ($name === '')               $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email address is required.';
if ($message === '')            $errors[] = 'Message is required.';

if ($errors) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$db = getDB();
$db->prepare('INSERT INTO inquiries (name,company_name,email,phone,message,ip_address) VALUES (?,?,?,?,?,?)')
   ->execute([$name,$company,$email,$phone,$message,$ip]);

// Send notification email
$recipient   = getSetting('smtp_recipient') ?: getSetting('email');
$companyName = getSetting('company_name') ?: 'Jyoti Trade Agencies';

if ($recipient) {
    $subject = "New Contact Inquiry — {$companyName}";
    $body = "
    <div style='font-family:Arial,sans-serif;max-width:600px'>
      <h2 style='color:#0F172A'>New Contact Inquiry</h2>
      <table style='width:100%;border-collapse:collapse'>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Name</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($name) . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Company</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($company ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Email</td><td style='padding:8px;border:1px solid #e5e7eb'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Phone</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($phone ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Message</td><td style='padding:8px;border:1px solid #e5e7eb'>" . nl2br(htmlspecialchars($message)) . "</td></tr>
      </table>
      <p style='color:#6b7280;font-size:12px;margin-top:16px'>Received from IP: " . htmlspecialchars($ip) . "</p>
    </div>";
    $mailResult = sendMail($recipient, $companyName, $subject, $body);
    if ($mailResult !== true) {
        error_log('[Jyoti Contact] Mail failed to ' . $recipient . ': ' . $mailResult);
    }
}

echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent. We will get back to you shortly.']);
