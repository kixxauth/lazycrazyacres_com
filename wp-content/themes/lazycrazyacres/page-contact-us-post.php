<?php
/*
Template Name: contact-us-post
*/
define('EMAIL_TARGET', 'info@lazycrazyacres.com');

function proxy_request($post) {
    if (wp_mail($post['to'], $post['subject'], $post['text'])) {
        send_201('SUCCESS');
    } else {
        send_response(500, 'Server Error', "Uknown mail sending error.");
    }
}

function send_response($status, $statusMessage, $message) {
    header("HTTP/1.1 " . $status . " " . $statusMessage);
    header('Content-Type: text/plain');
    header('Cache-Control: no-cache');
    header('Expires: -1');
    echo $message;
    echo "\n";
}

function send_500($msg) {
    send_response(500, 'Internal Server Error', $msg);
}

function send_201($msg) {
    send_response(201, 'Created', $msg);
}

function send_400($msg) {
    send_response(400, 'Bad Request', $msg);
}

function clean_var($variable) {
    return strip_tags(stripslashes(trim(rtrim($variable))));
}

/**
Email validation function. Thanks to http://www.linuxjournal.com/article/9585
*/
function valid_email($email) {
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && function_exists('checkdnsrr'))
      {
        if (!(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
         // domain not found in DNS
         $isValid = false;
       }
      }
   }
   return $isValid;
}

$err = 0;
$email = 0;
$name = 'anonymous';
$message = 0;

if (empty($_POST['contact_email'])) {
    $err = 'EMAIL_UNDEFINED';
}
else {
    $email = clean_var($_POST['contact_email']);
    if (!valid_email($email)) {
        $err = 'EMAIL_INVALID';
    }
}

if (empty($_POST['contact_comment'])) {
    $err = 'MESSAGE_UNDEFINED';
}
else {
    $message = clean_var($_POST['contact_comment']);
    if (function_exists('htmlspecialchars')) {
        $message = htmlspecialchars($message, ENT_QUOTES);
    }
}
if (!empty($_POST['contact_name'])) {
    $name = clean_var($_POST['contact_name']);
    if (function_exists('htmlspecialchars')) {
        $name = htmlspecialchars($name, ENT_QUOTES);
    }
}

if ($err) {
    send_400($err);
} else {

    $post = Array(
        'to' => EMAIL_TARGET,
        'subject' => 'Message from LCA website: ' . $name,
        'text' => $message . "\n\nFrom: " . $name . ' ' . $email . "\n"
    );

    proxy_request($post);
}
?>