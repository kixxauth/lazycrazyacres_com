<?php
define('API_ENDPOINT', 'http://api.fwp-dyn.com/mail/send');
define('EMAIL_TARGET', 'info@lazycrazyacres.com');

function proxy_request($url, $post) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $body = curl_exec($ch);

    if ($body) {
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        switch ($status) {
            case 404:
                send_500('server used invalid API URL');
                break;
            case 500:
                send_500('API endpoint server error');
                break;
            case 400:
                send_500('invalid data sent to API enpoint');
                break;
            case 201:
                send_201('SUCCESS');
                break;
            default:
                send_500('unexpected API enpoint response: ' . $status);
        }
    } else {
        send_response(500, 'Server Error', curl_error($ch));
    }

    curl_close($ch);
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

if (empty($_POST['email'])) {
    $err = 'EMAIL_UNDEFINED';
}
else {
    $email = clean_var($_POST['email']);
    if (!valid_email($email)) {
        $err = 'EMAIL_INVALID';
    }
}

if (empty($_POST['comment'])) {
    $err = 'MESSAGE_UNDEFINED';
}
else {
  	$message = clean_var($_POST['comment']);
    if (function_exists('htmlspecialchars')) {
        $message = htmlspecialchars($message, ENT_QUOTES);  	
    }
}
if (!empty($_POST['name'])) {
  	$name = clean_var($_POST['name']);
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
        'text' => $message,
        'replyto' => $email,
        'confirm' => '1'
    );

    proxy_request(API_ENDPOINT, $post);
}
?>
