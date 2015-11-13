<?php
mail_utf8(
	'john@doe.com',         // Receiver email.
	'John Doe',             // Receiver name.
	'alert@yoursite.com',   // Sender email.
	'QR Code Scan Alert',   // Mail subject.
	'Someone has just scanned your QR Code!<br/><pre>' . print_r(array('HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'], 'IP' => $_SERVER['REMOTE_ADDR']), true). '</pre>' // Mail content.
);

header("Location: http://www.example.com/"); // The URL to redirect the vistor.

/**
 * Improved mail function to correctly send UTF-8 characters.
 *
 * @param string $to Receiver email.
 * @param string $from_name Receiver name.
 * @param string $from_email Sender email.
 * @param string $subject Mail subject.
 * @param string $message Mail content.
 * @param string $cc CC emails.
 * @param string $bcc BCC emails.
 *
 * @return bool true if the mail was successfully accepted for delivery, false otherwise.
 */
function mail_utf8($to, $from_name, $from_email, $subject = '(No subject)', $message = '', $cc = '', $bcc = '')
{
	$from_name = "=?UTF-8?B?".base64_encode($from_name)."?=";
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$headers = "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n" . "From: $from_name <$from_email>\r\n";
	if (!empty($cc)) $headers .= 'Cc: ' . $cc . "\r\n";
	if (!empty($bcc)) $headers .= 'Bcc: ' . $bcc . "\r\n";
	return mail($to, $subject, $message, $headers);
}
