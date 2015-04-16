<?php
require_once '../../../../../../wp-load.php';

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$toto = get_option('quick_email', false);
if($toto != '')
{
    $to = $toto;
}
else 
{
    $to = get_option('admin_email', false);
}

$sub = 'From Contact';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <'.$email.'>' . "\r\n";
wp_mail( $to, $sub, $message, $headers);

echo 1;