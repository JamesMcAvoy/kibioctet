<?php

/** exit function */
function bad_rq() {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

//POST fields used
$postfields = array(
    'name',
    'email',
    'phone',
    'message'
);

foreach($postfields as $postfield)
    if(!isset($_POST[$postfield])) bad_rq();

$to = 'contact@kibioctet.fr';
$subject = $_POST['name'].'a envoyé un message !';
$message = $_POST['message']
           ."\r\n\r\n"
           .'Téléphone : '
           .$_POST['phone']
           ."\r\n\r\n"
           .'Courriel : '
           .$_POST['email'];

//If error => bad request
if(!@mail($to, $subject, $message)) bad_rq();
