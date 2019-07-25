<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $suppr_id = htmlspecialchars($_GET['id']);
   $suppr    = $bdd->prepare('DELETE FROM commandes WHERE id = ?');
   $suppr->execute(array($suppr_id));
   header('Location: profile.php?id='.$_SESSION['id']);
}
?>