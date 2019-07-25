<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
$pageTitel = 'Admin';
include("function.php");
if(isset($_GET['type']) AND $_GET['type'] == 'membre') {
   if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
      $confirme = (int) $_GET['confirme'];
      $req      = $bdd->prepare('UPDATE utilisateurs SET confirme = 1 WHERE id = ?');
      $req->execute(array($confirme));
      header('Location: admint.php?id='.$_SESSION['id']);
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req      = $bdd->prepare('DELETE FROM utilisateurs WHERE id = ?');
      $req->execute(array($supprime));
       header('Location: admint.php?id='.$_SESSION['id']);
   }
} elseif(isset($_GET['type']) AND $_GET['type'] == 'produit') {
   if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
      $approuve = (int) $_GET['approuve'];
      $req      = $bdd->prepare('UPDATE produits SET approuve = 1 WHERE id = ?');
      $req->execute(array($approuve));
       header('Location: admint.php?id='.$_SESSION['id']);
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req      = $bdd->prepare('DELETE FROM produits WHERE id = ?');
      $req->execute(array($supprime));
       header('Location: admint.php?id='.$_SESSION['id']);
   }
}elseif(isset($_GET['type']) AND $_GET['type'] == 'message') {
      if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
        $confirme = (int) $_GET['confirme'];
        $req      = $bdd->prepare('UPDATE messages SET confirme = 1 WHERE id = ?');
        $req->execute(array($confirme));
         header('Location: admint.php?id='.$_SESSION['id']);
   }
      if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
        $supprime = (int) $_GET['supprime'];
        $req      = $bdd->prepare('DELETE FROM messages WHERE id = ?');
        $req->execute(array($supprime));
         header('Location: admint.php?id='.$_SESSION['id']);
       }}
$membres      = $bdd->query('SELECT * FROM utilisateurs ORDER BY id DESC ');
$produit = $bdd->query('SELECT * FROM produits ORDER BY id DESC ');
$messages     = $bdd->query('SELECT * FROM messages ORDER BY id DESC ');
?>
<?php
include("top1.php");
include("head.php");
 ?>
<div class="container">
  <div class="row text-center" id="0">
    <div class="col list">
      <a href="#1"> Users Liste</a>
    </div>
    <div class="col list">
      <a href="#2"> Products Liste</a>
    </div>
    <div class="col list">
      <a href="#3"> Messages Liste</a>
    </div>
  </div>
   <div class=" Users-Liste text-center"id="1">
      Users Liste
   </div>
   <div class="list-of-users">
      <?php while($m = $membres->fetch()) { ?>
      <div class="row">
            <a class="col-6 " href="profile.php?id=<?php echo $m['id']; ?>"><?php echo $m['fname']." ".$m['lname'] ;?><?php if($m['confirme'] == 0) { ?>  
              <a class="col" href="admint.php?type=membre&confirme=<?php echo  $m['id']; ?>">Aprouve
              </a>
                 <?php } ?>  
              <a class="col Delete" href="admint.php?type=membre&supprime=<?php echo  $m['id']; ?>">Delete
              </a>
            </a>
      </div>
      <?php } ?>
   </div>
   <br /><br />
   <div>
      <div class=" Users-Liste text-center" id="2">
         Products Liste
      </div>
      <?php while($c = $produit->fetch()) { ?>
      <div class="products">   
         <img class="posts col" src="produit/<?php echo $c['produit']; ?>">
         <br>
         <?php if($c['approuve'] == 0) { ?> 
         <div class="row"> 
            <a  class="products-a" href="admint.php?type=produit&approuve=<?php echo $c['id']; ?>">Aprouve
            </a>
            <?php } ?> 
            <a class=" products-a Delete" href="admint.php?type=produit&supprime=<?php echo  $c['id']; ?>">
            Delete
         </a> 
         </div>
         <br>
      </div>
      <?php } ?>
   </div>
</div>
<br><br>
<div class="container">
   <div class=" Users-Liste text-center" id="3">
      Messages Liste <a href="#0"><i class="fa fa-arrow-up"></i></a>
   </div>
   <div class="list-of-users">
      <?php while($m = $messages->fetch()) { ?>
      <div class="row">
            <?php echo $m["email"]; ?> :<?php echo $m['message'] ?>
            <?php if($m['confirme'] == 0) { ?>  
              <a class="col" href="admint.php?type=message&confirme=<?php echo  $m['id']; ?>">Aprouve
              </a>
               <?php } ?>  
              <a class="col Delete" href="admint.php?type=message&supprime=<?php echo  $m['id']; ?>">Delete
              </a>
      </div>
      <?php } ?>
    </div>
    <br><br>
<?php include("footer.php");?>