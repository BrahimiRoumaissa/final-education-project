<?php // Connect to server and select DB.
// -------------------------------------------------------------------------------------------------------


$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<?php 
include("top.php");
 ?>
  <!-- begin nav bar -->
<nav class="navbar  navbar-fixed-top navbar-expand-lg navbar-dark bg-dark  ">
  <!--  navbar-fixed-top= to don't desapear when it gose down
  navbar-expand-lg= to show all detailse of the navbar on large screen onely 
navbar-dark bg-dark= for de color and background-->
  <div class="container">
    <!-- container = to fixe compenente in the midall -->
  <div class="navbar-brand " ><span>MY</span><span>DESIGNE</span></div>
  <!-- brand = is the name of your web site or your logo -->

   <!-- the bigen of toggler -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main" aria-controls="main" aria-expanded="false" aria-label="Toggle navigation">
    
    <!-- the  toggler is that icon you see in mobile screen to have nav details -->
    <span class="navbar-toggler-icon"></span>
  </button>
<!-- the end of toggler -->
  <div class="collapse navbar-collapse  " id="main">
    <ul class="navbar-nav ml-auto ">
      <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
        <li class="nav-item  active">
         <a  class="nav-link " href="index.php?id=<?php echo $_SESSION['id']; ?>">
           <i class="fa fa-home"></i> Home 
         <span class="sr-only">(current)</span></a>
      </li>
         <?php
         }
         ?>
          <?php
          if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid){
         ?>
        <li class="nav-item  active">
         <a  class="nav-link " href="index.php?id=<?php echo $_SESSION['id']; ?>">
           <i class="fa fa-home"></i> Home 
         <span class="sr-only">(current)</span></a>
      </li>
         <?php
         }
         ?>
          <?php
          if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
      if($_SESSION['id']==22 ) {?>
        <li class="nav-item">
        <a <a  class="nav-link " href="admin.php?id=<?php echo $_SESSION['id']; ?>">Admin Page</a>

      <?php }}?> </li> 
          <?php
          if(!isset($_SESSION['id'])){
         ?>
        <li class="nav-item  active">
         <a  class="nav-link " href="index.php">
           <i class="fa fa-home"></i> Home 
         <span class="sr-only">(current)</span></a>
         </li>
      <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="login.php" >
          <i class="fa fa-user-plus"></i> Join Us
        </a>
      </li>
 <?php
         }
         ?>  
     
        <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <li class="nav-item">
         <a  class="nav-link " href="EditProfile.php">  <i class="fa fa-edit fa-x3"></i> Edit profile </a>
         <?php
         }
         ?>
       </li>
        <li class="nav-item"> 
        <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
        <li class="nav-item">
         <a  class="nav-link confirme" href="delete_compte.php?id=<?php echo $_SESSION['id']; ?>"> <i class="fa fa-close fa-x3"></i> Delete profile </a></li> 
         <?php
         }
         ?>
          <?php
         if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid){
         ?>
        <li class="nav-item">
         <a  class="nav-link " href="profile.php?id=<?php echo $_SESSION['id']; ?>"> <i class="fa fa-user fa-x3"></i> profile </a></li>
         <?php
         }
         ?>
        <?php
        if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid){
         ?> 
        <li class="nav-item">
         <a  class="nav-link " href="EditProfile.php">  <i class="fa fa-edit fa-x3"></i> Edit profile </a>
         <?php
         }
         ?>
       </li>
       <li class="nav-item dropdown">
       <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <a  class="nav-link " href="deconnexion.php"> Log out <i class="fa fa-sign-out fa-x3"></i></a>
         <?php
         }
         ?>
         <?php
          if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid){
         ?>
         <a  class="nav-link " href="deconnexion.php"> Log out <i class="fa fa-sign-out fa-x3"></i></a>
         <?php
         }
         ?>
        </div>
      </li>
    </ul>
  </div>
  </div>
  <!-- end of the container -->
</nav>
<!-- end nav bar -->
  <?php include("footer.php");
}
?>