<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function send_sms($to, $msg) {
    $msg = urlencode($msg);
    $to = $to;
  //  $url = "http://sms.bulk24sms.com/api/sendhttp.php?authkey=1887AMkJaQHJkhF5d5427a3&mobiles=" . $to . "&message=" . $msg . "&sender=CLCXFGICKS&route=4";
    $rsponse = file_get_contents($url);
    return true;
}

function send_webmail($to, $subject, $html) {
    /***** Start Sending Mail ***/   
    // $from = 'no_reply@happyeasyrides.com';
    // $cc = 'hello@happyeasyrides.com';
    // $bcc1 = 'lalit.rv@live.com';
    // $bcc2 = 'lalit@happyeasyrides.com';
    
    /* To send HTML mail, the Content-type header must be set */
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    /* Create email headers*/
    $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'CC: '.$cc."\r\n".
        'Bcc: '."$bcc1,$bcc2"."\r\n".
        'X-Mailer: PHP/' . phpversion();
    /* Compose a simple HTML email message*/
    $message = $html;
    /* Sending email*/
    mail($to, $subject, $message, $headers);
    /*****  END Sending Mail ***/
}


