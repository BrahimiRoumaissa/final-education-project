<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
  $pageTitel = 'Login';
  include("function.php");
if(isset($_POST['formconnexion'])) {
   $email        = htmlspecialchars($_POST['email']);
   $pass         = sha1($_POST['pass']);
   if(!empty($email) AND !empty($pass)) {
      $requser   = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ? AND pass = ?");
      $requser->execute(array($email, $pass));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
        if(isset($_POST['rememberme'])) {
            setcookie('email',$email,time()+365*24*3600,null,null,false,true);
            setcookie('pass',$pass,time()+365*24*3600,null,null,false,true);
         }
         $userinfo          = $requser->fetch();
         $_SESSION['id']    = $userinfo['id'];
         $_SESSION['fname'] = $userinfo['fname'];
         $_SESSION['lname'] = $userinfo['lname'];
         header("Location: index.php?id=".$_SESSION['id']);
      } else {
         $erreur = "wrrong email or password!";
      }
   } else {
      $erreur = "you have to field all th gups!";
   }
}
?>
<?php
include("top1.php");?>
  <!-- begin nav bar -->
<nav class="navbar   navbar-expand-lg navbar-dark bg-dark">
  <!-- 
  navbar-expand-lg= to show all detailse of the navbar on large screen onely 
navbar-dark bg-dark= for de color and background-->
  <div class="container">
    <!-- container = to fixe compenente in the midall -->
 <div class="navbar-brand " ><span>MY</span><span>DESIGNE</span></div>
  <!-- brand = is the name of your web site or your logo -->

   <!-- the bigen of toggler -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#a" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    
    <!-- the  toggler is that icon you see in mobile screen to have nav details -->
    <span class="navbar-toggler-icon"></span>
  </button>
<!-- the end of toggler -->
  <div class="collapse navbar-collapse " id="a">
    <ul class="navbar-nav ml-auto ">
      <li class="nav-item active">
         <a class="nav-link " href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php"><i class="fa fa-info-circle"></i> About</a>
      </li>
    </ul>
  </div>
  </div>
  <!-- end of the container -->
</nav>
<!-- end nav bar -->
<!-- content of the page -->
<div class="container ">
 <div class="row foo">
    <div class="col-sm  description">
      <div class="welcom">
        <h1>welcom</h1>
      </div> 
      <h5>with Us we wish that you will may have<br> a good experience. </h5>
    </div> 
<form class="px-4 py-3  .form-control-sm
  col-lg form " method="post" action="">
    <span><h2>Login</h2></span><br>
    welcome: Please full Adress maile and the Password to sing into your account. 
    <div class="form-group">
      <label for="validationDefaultEmail"></label>
      <input type="email" class="form-control bor " id="validationDefaultEmail" placeholder="email@example.com" name="email">
          <label for="validationTooltipPassWord"></label>
      <input type="password"class="form-control bor"  id="validationDefaultPassWord" placeholder="Password" name="pass">
    </div>
    <div class="form-group">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck" name="rememberme">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <button type="submit" name="formconnexion" class="btn btn-primary">Sign in</button><br>
  <a  href="SingIN.php" >you dont have account,SingUp? </a> 
  </form>
  <?php
    if(isset($erreur)) {
      echo '<font color="red">'.$erreur."</font>";
         }
         ?>
  </div>
</div>
 <?php include("footer.php"); ?>