<?php
if(!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['pass']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['pass']))
 {
   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ? AND pass = ?");
   $requser->execute(array($_COOKIE['email'], $_COOKIE['pass']));
   $userexist = $requser->rowCount();
   if($userexist == 1)
   {
      $userinfo          = $requser->fetch();
      $_SESSION['id']    = $userinfo['id'];
      $_SESSION['fname'] = $userinfo['fname'];
      $_SESSION['email'] = $userinfo['email'];
   }
}
?>