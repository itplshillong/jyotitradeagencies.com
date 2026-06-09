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
$captchaAnswer = (int)($_SESSION['captcha_answer'] ?? -999);
// Invalidate immediately so it can't be replayed
unset($_SESSION['captcha_answer']);
if ($captchaInput !== $captchaAnswer) {
    echo json_encode(['success' => false, 'message' => 'Incorrect security answer. Please refresh and try again.']);
    exit;
}

$name     = sanitize($_POST['name']                ?? '');
$company  = sanitize($_POST['company_name']        ?? '');
$country  = sanitize($_POST['country']             ?? '');
$email    = sanitizeEmail($_POST['email']          ?? '');
$phone    = sanitize($_POST['phone']               ?? '');
$category = sanitize($_POST['product_category']    ?? '');
$quantity = sanitize($_POST['quantity']            ?? '');
$details  = sanitize($_POST['requirement_details'] ?? '');
$ip       = getClientIP();

$errors = [];
if ($name === '')    $errors[] = 'Name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email address is required.';
if ($country === '') $errors[] = 'Country is required.';
if ($details === '') $errors[] = 'Requirement details are required.';

if ($errors) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$db = getDB();
$db->prepare('INSERT INTO quote_requests (name,company_name,country,email,phone,product_category,quantity,requirement_details,ip_address) VALUES (?,?,?,?,?,?,?,?,?)')
   ->execute([$name,$company,$country,$email,$phone,$category,$quantity,$details,$ip]);

// Notification email
$recipient   = getSetting('smtp_recipient') ?: getSetting('email');
$companyName = getSetting('company_name') ?: 'Jyoti Trade Agencies';

if ($recipient) {
    $subject = "New Quote Request — {$companyName}";
    $body = "
    <div style='font-family:Arial,sans-serif;max-width:600px'>
      <h2 style='color:#0F172A'>New Quote Request</h2>
      <table style='width:100%;border-collapse:collapse'>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Name</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($name) . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Company</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($company ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Country</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($country) . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Email</td><td style='padding:8px;border:1px solid #e5e7eb'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Phone</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($phone ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Product Category</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($category ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Quantity</td><td style='padding:8px;border:1px solid #e5e7eb'>" . htmlspecialchars($quantity ?: '—') . "</td></tr>
        <tr><td style='padding:8px;border:1px solid #e5e7eb;font-weight:bold'>Requirement Details</td><td style='padding:8px;border:1px solid #e5e7eb'>" . nl2br(htmlspecialchars($details)) . "</td></tr>
      </table>
      <p style='color:#6b7280;font-size:12px;margin-top:16px'>Received from IP: " . htmlspecialchars($ip) . "</p>
    </div>";
    $mailResult = sendMail($recipient, $companyName, $subject, $body);
    if ($mailResult !== true) {
        error_log('[Jyoti Quote] Mail failed to ' . $recipient . ': ' . $mailResult);
    }
}

echo json_encode(['success' => true, 'message' => 'Thank you! Your quote request has been submitted. Our team will contact you within 24 hours.']);
