<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
if(isset($_POST['envoie'])) {
   $email = htmlspecialchars($_POST['email']);
   $message = htmlspecialchars($_POST['message']);
   $sessionid = 1;
   if( !empty($_POST['email']) AND !empty($_POST['message'])) {
      
      if($message <= 255) {
               if($mailexist == 0) {
                     $insertmbr = $bdd->prepare("INSERT INTO messages(email,message,idmember) VALUES(?, ?,?)");
                     $insertmbr->execute(array( $email, $message,$sessionid));
                     header('Location: index.php');
               }}}}