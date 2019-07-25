<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base', 'root', '');
  $pageTitel = 'SingUP';
  include("function.php");
if(isset($_POST['forminscription'])) {
   $fname = htmlspecialchars($_POST['fname']);
   $lname = htmlspecialchars($_POST['lname']);
   $email = htmlspecialchars($_POST['email']);

   $pass = sha1($_POST['pass']);
   if(!empty($_POST['fname']) AND !empty($_POST['lname']) AND !empty($_POST['email']) AND !empty($_POST['pass'] )) {
      $fnamelength = strlen($fname);
      if($fnamelength <= 255) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = ?");
               $reqmail->execute(array($email));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                     $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(fname,lname, email,pass) VALUES(?, ?,?,?)");
                     $insertmbr->execute(array($fname,$lname, $email, $pass));
                     header('Location: login.php');
               } else {
                  $erreur = "Adresse mail allready used !";
               }
            } else {
               $erreur = "Yuor adresse mail is not  valid !";
            }
         
      } else {
         $erreur = "Your pseudo mustn't be mor than 255 caracters !";
      }
   } else {
      $erreur = "All must be completed !";
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
      <span class="l"><h2>SingUP</h2></span>  
        <div class="error-message">
      <?php
           if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
        </div><br>
        welcome: Please full the information to singUp with us.
        <div class="form-group">
            <label for="validationDefaultFirstname"></label>
            <input type="text" class="form-control  bor" id="validationDefaultFirstname" placeholder="Your Firstname" name="fname" value="<?php if(isset($fname)) { echo $fname; } ?>">
            <label for="validationDefaultLastname"></label>
            <input type="text" class="form-control bor " id="validationDefaultLastname" placeholder="Your Lastname" name="lname" value="<?php if(isset($lname)) { echo $lname; } ?>">
            <label for="validationDefaultEmail"></label>
            <input type="email" class="form-control bor " id="validationDefaultEmail" placeholder="email@example.com" name="email" value="<?php if(isset($email)) { echo $email; } ?>">
            <label for="validationTooltipPassWord"></label>
            <input type="password"class="form-control bor"  id="validationDefaultPassWord" placeholder="Password" name="pass"><br>
        </div>
        <button type="submit" name="forminscription" class="btn btn-primary">Sign in</button><br>
        <a  href="login.php" >You have account? </a>
    </form>
  </div>
</div>
   <?php include("footer.php"); ?>