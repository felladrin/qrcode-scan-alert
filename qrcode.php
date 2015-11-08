<?php

mail_utf8(
	'john@doe.com',         // Recipient mail.
	'John Doe',             // Recipient name.
	'alert@yoursite.com',   // Sender mail.
	'QR Code Scan Alert',   // Mail title.
	'Someone has just scanned your QR Code!<br/><pre>' . print_r(array('HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'], 'IP' => $_SERVER['REMOTE_ADDR']), true). '</pre>' // Mail content.
);

header("Location: http://www.google.com/"); // The URL to redirect the vistor.

/**
 * Improved mail function to correctly send UTF-8 characters.
 */
function mail_utf8($to, $from_name, $from_email, $subject = '(No subject)', $message = '', $cc = '', $bcc = '')
{
    $from_name = "=?UTF-8?B?".base64_encode($from_name)."?=";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
    $headers = "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "From: $from_name <$from_email>\r\n";

    if (!empty($cc))
        $headers .= 'Cc: ' . $cc . "\r\n";

    if (!empty($bcc))
        $headers .= 'Bcc: ' . $bcc . "\r\n";

    return mail($to, $subject, $message, $headers);
}
