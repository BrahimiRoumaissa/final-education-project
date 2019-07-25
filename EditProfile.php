<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
$pageTitel = 'Edit profile';
include("function.php");
if(isset($_SESSION['id'])) {
   $requser        = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user           = $requser->fetch();
   if(isset($_POST['fname']) AND !empty($_POST['fname']) AND $_POST['fname'] != $user['fname']) {
      $fname       = htmlspecialchars($_POST['fname']);
      $insertfname = $bdd->prepare("UPDATE utilisateurs SET fname = ? WHERE id = ?");
      $insertfname->execute(array($fname, $_SESSION['id']));
      header('Location: profile.php?id='.$_SESSION['id']);
   }
    if(isset($_POST['lname']) AND !empty($_POST['lname']) AND $_POST['lname'] != $user['lname']) {
      $lname       = htmlspecialchars($_POST['lname']);
      $insertlname = $bdd->prepare("UPDATE utilisateurs SET lname = ? WHERE id = ?");
      $insertlname->execute(array($lname, $_SESSION['id']));
      header('Location: profile.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['job']) AND !empty($_POST['job']) AND $_POST['job'] != $user['job']) {
      $job         = htmlspecialchars($_POST['job']);
      $insertjob   = $bdd->prepare("UPDATE utilisateurs SET job = ? WHERE id = ?");
      $insertjob->execute(array($job, $_SESSION['id']));
      header('Location: profile.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['email']) AND !empty($_POST['email']) AND $_POST['email'] != $user['email']) {
      $email       = htmlspecialchars($_POST['email']);
      $insertmail  = $bdd->prepare("UPDATE utilisateurs SET email = ? WHERE id = ?");
      $insertmail->execute(array($email, $_SESSION['id']));
      header('Location: profile.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['pass']) AND !empty($_POST['pass']) AND isset($_POST['pass2']) AND !empty($_POST['pass2'])) {
      $pass        = sha1($_POST['pass']);
      $pass2       = sha1($_POST['pass2']);
      if($pass == $pass2) {
        $insertmdp = $bdd->prepare("UPDATE utilisateurs SET pass = ? WHERE id = ?");
        $insertmdp->execute(array($pass, $_SESSION['id']));
         header('Location: profile.php?id='.$_SESSION['id']);
      } else {
         $msg = "not compatible pass words !";
      }
   }
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
   $tailleMax          = 2194304;
   $extensionsValides  = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['avatar']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin    = "members/avatars/".$_SESSION['id'].".".$extensionUpload;
         $resultat  = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $bdd->prepare(' UPDATE utilisateurs SET avatar = :avatar WHERE id = :id');
            $updateavatar->execute(array(
               'avatar' => $_SESSION['id'].".".$extensionUpload,
               'id'     => $_SESSION['id']
               ));
            header('Location: profile.php?id='.$_SESSION['id']);
         } else {
            $msg = "Erreur duran importation of you profil's image";
         }
      } else {
            $msg = "Your profile's image must be in format jpg, jpeg, gif ou png";
      }
   } else {
            $msg = "Your profile's image mustn't be biger than 2Mo";
   }
}
?>
<?php
include("top.php");
include("head.php");
 ?>
<body class="profile">
<div class="editebox">
	<div class="container">
		<div class="edit-head">
			Edit My Profile
		</div>
		<form class="edit-form" method="POST" action="" enctype="multipart/form-data">
	    <div class="container edit">
          <label class="col-3"> 
               First Name :
          </label>
          <input type="text" name="fname" placeholder="first name"value="<?php echo $user['fname']; ?>"><br>
          <label class="col-3">
                Last Name : 
          </label>
          <input type="text" name="lname" placeholder="last name" value="<?php echo $user['lname']; ?>"><br>
          <label class="col-3">
                your job :
          </label>
          <input type="text" name="job" placeholder=".." value="<?php echo $user['job']; ?>"><br>
          <label class="col-3">
               Email :
          </label>
          <input type="text" name="email" placeholder=".." value="<?php echo $user['email']; ?>"><br>
          <label class="col-3">
               passWord :
          </label>
          <input type="password" name="pass" placeholder="*****"><br>
          <label class="col-3">
               Confirme passWord:
          </label>
          <input type="password" name="pass2" placeholder="****"><br><br>
          <div class="row ">
						<span class="span-select col-4">your photos:</span>
						  <div class="edit-input">
							  <button>chose image <i class="fa fa-upload"></i></button>
							  <input type="file" name="avatar" id="fileToUpload">
							</div>
				  </div>
				  <button class="btn-danger back-edit"><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"> BACK <i class="fa fa-arrow-right"></i></button>
          <button class="edit-sub"> EDIT <i class="fa fa-check"></i></button>
      </div>
    <footer>
     <div>
      <br><br><br>
     </div>
    </footer>
   </form>
	 <?php if(isset($msg)) { echo $msg; } ?>
	</div>
</div>
		





	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<!--<script src="js/plugins.js"></script>-->
	
</body>
</html>
<?php   
}
else {
   header("Location: login.php");
}
?>
