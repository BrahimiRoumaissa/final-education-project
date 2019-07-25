<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
if(isset($_POST['envoyer'])) {
   if (isset($_POST['email']) AND isset($_POST['commande']) AND isset($_POST['class']) AND isset($_POST['class']) AND      !empty($_POST['email']) AND !empty($_POST['commande'])) {
   $email = htmlspecialchars($_POST['email']);
   $class = htmlspecialchars($_POST['class']);
   $commande = htmlspecialchars($_POST['commande']);
   $sessionid = $_SESSION['id'];
   if( !empty($_POST['email']) AND !empty($_POST['commande'])AND !empty($_POST['class'])) {
      
      if($commande <= 255) {
               if($mailexist == 0) {
                     $insertmbr = $bdd->prepare("INSERT INTO commandes(email,commande,idmember,class) VALUES(?, ?,?,?)");
                     $insertmbr->execute(array( $email, $commande,$sessionid,$class));
                     header('Location: profile.php'.$_SESSION['id']);
               }}}}



            }