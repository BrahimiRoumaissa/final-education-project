
<?php
session_start();
$pageTitel = 'Search';
include("function.php");
$bdd         = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
$articles    = $bdd->query('SELECT texte,produit,idfname FROM produits ORDER BY id DESC');
$articles    = $bdd->query('SELECT fname FROM sign ORDER BY id DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q        = htmlspecialchars($_GET['q']);
   $articles= $bdd->query('SELECT texte,produit,idfname FROM produits WHERE texte LIKE "%'.$q.'%" ORDER BY id DESC');
   if($articles->rowCount() == 0) {
   $articles = $bdd->query('SELECT texte,produit,idfname FROM produits WHERE CONCAT(texte, class) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
}
?>
<?php
include("top.php");?>
	<!-- begin nav bar -->
  <nav class="navbar  navbar-fixed-top navbar-expand-lg navbar-dark bg-dark  ">
  	<!--  navbar-fixed-top= to don't desapear when it gose down
  	navbar-expand-lg= to show all detailse of the navbar on large screen onely 
  navbar-dark bg-dark= for de color and background-->
  	<div class="container">
  		<!-- container = to fixe compenente in the midall -->
    <div class="navbar-brand" ><span>MY</span><span>DESIGNE</span></div>
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
              if(isset($_SESSION['id'])) {?>
              <li class="nav-item  active">
                <a class="nav-link " href="index.php?id=<?php echo $_SESSION['id']; ?> ">
                 <i class="fa fa-home"></i> Home 
                 <span class="sr-only">(current)</span></a>
              </li>
              <?php
                 }
               ?>
                 <?php
              if(!isset($_SESSION['id'])) {?>
              <li class="nav-item  active">
                <a class="nav-link " href="index.php ">
                 <i class="fa fa-home"></i> Home 
                 <span class="sr-only">(current)</span></a>
              </li>
              <?php
                 }
                 ?>  
              <?php
              if(isset($_SESSION['id'])) {
                $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                $requser->execute(array($_SESSION['id']));
                $user    = $requser->fetch();
                if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
                 ?>
                <li class="nav-item">
                 <a  class="nav-link " href="profile.php?id=<?php echo $_SESSION['id']; ?>"> <i class="fa fa-user fa-x3"></i> Profile</a>
                 <?php
                 }}
                 ?>
                </li>
               <li class="nav-item dropdown">
                <?php
              if(isset($_SESSION['id'])) {
                 $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                 $requser->execute(array($_SESSION['id']));
                 $user    = $requser->fetch();
                 if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
                 ?>
                 <a  class="nav-link " href="deconnexion.php">log out <i class="fa fa-sign-out fa-x3"></i></a>
                 <?php
                 }}
                 ?></li>
              <li class="nav-item dropdown">
                	 <?php
              if(!isset($_SESSION['id'])) {
                 $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                 $user    = $requser->fetch();
                 
                 ?>
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Join Us
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a  class="dropdown-item" href="login.php">Login</a>
                   <a class="dropdown-item" href="SingIN.php">SingUP</a>
                </div>
                 <?php
                 }
                 ?> 
              </li>
          </div>
      </ul>
    </div>
  </div>
    <!-- end of the container -->
  </nav>
<!-- end nav bar -->
<!-- begin  search screen -->
      		<div class="main-searchh text-center">
      			
      			<form method="GET">
      	  		<input type="search" class="input-search " id="search" placeholder="search" name="q">
      	  		<input class="btn btn-outline-secondary" type="submit" value="Go" />
              <p> try to use one of this key words in your search:<br>
         logo, media, food covre or brand.</p>
      	  	</form>
      		</div>
      <br><h1 class="headerr" id="reasalt">Reasalt :</h1>

<!-- end  search screen -->
      <div class="container">
        <div class="row">
              <?php
              if($articles->rowCount() > 0) { 
              while($a = $articles->fetch()) {   ?>   
              <div class="col" >
                  <div class="card text-center" style="width: 18rem;">
                      <img id="myImg" src="produit/<?php echo $a['produit'] ;?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $a['texte'] ;?></h5>
                        <a href="profile.php?id=<?php echo $a['idfname']; ?>" class="btn btn-primary">see all works</a>
                      </div>
                  </div>
              </div>
              <?php } ?>
          </div>
          <?php } 
          else { ?>
          <div class="reslt-description">
              <span class="text-center"> we are sorry, we don't have your request! </span><br>
              <img src="img/sorry.gif">
          </div>
               <?= $q ?>...
            <?php } ?>
        </div>
    <?php
    include("footer.php");
      ?>