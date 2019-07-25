<?php
session_start();
$bdd = new PDO("mysql:host=127.0.0.1;dbname=data_base;charset=utf8", "root", "");
include("../function.php");
if(isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_GET['t']) AND !empty($_GET['t'])) {
   $getid1 = intval($_GET['id']);
   $gett = (int) $_GET['t'];
   $sessionid = $_SESSION['id'];
   if($gett == 1) {
         $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_article = ? AND id_membre = ?');
         $check_like->execute(array($getid1,$sessionid));
         $del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
         $del->execute(array($getid1,$sessionid));
         if($check_like->rowCount() == 1) {
            $del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
            $del->execute(array($getid1,$sessionid));
         } else {
            $ins = $bdd->prepare('INSERT INTO likes (id_article, id_membre) VALUES (?, ?)');
            $ins->execute(array($getid1, $sessionid));
         }
         
      } elseif($gett == 2) {
         $check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ? AND id_membre = ?');
         $check_like->execute(array($getid1,$sessionid));
         $del = $bdd->prepare('DELETE FROM likes WHERE id_article = ? AND id_membre = ?');
         $del->execute(array($getid1,$sessionid));
         if($check_like->rowCount() == 1) {
            $del = $bdd->prepare('DELETE FROM dislikes WHERE id_article = ? AND id_membre = ?');
            $del->execute(array($getid1,$sessionid));
         } else {
            $ins = $bdd->prepare('INSERT INTO dislikes (id_article, id_membre) VALUES (?, ?)');
            $ins->execute(array($getid1, $sessionid));
         }
      } 
}
 $theMasg = "";
     rdirectFun($theMasg, 'back', 0);
     ?>
   <?php/*header('Location: profile.php?id='.$getid1);*/?>
