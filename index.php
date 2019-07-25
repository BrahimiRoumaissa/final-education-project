<?php // Connect to server and select DB.
// -------------------------------------------------------------------------------------------------------
session_start();
$pageTitel = 'Home';
include("function.php");
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid    = intval($_GET['id']);
   $requser  = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $msg      = $requser->rowCount();
   $userinfo = $requser->fetchAll();
   $articles = $bdd->query('SELECT texte,produit FROM produits ORDER BY id DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q        = htmlspecialchars($_GET['q']);
   $articles = $bdd->query('SELECT texte,produit FROM produits WHERE texte LIKE "%'.$q.'%" ORDER BY id DESC');
   if($articles->rowCount() == 0) {
   $articles = $bdd->query('SELECT texte,produit FROM produits WHERE CONCAT(texte, class) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
} 
?>
<?php
include("top.php");?>
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
      <li class="nav-item  active">
        <a class="nav-link " href="index.php?id=<?php echo $_SESSION['id']; ?>">
         <i class="fa fa-home"></i> Home 
         <span class="sr-only">(current)</span></a>
      </li>
        <?php
         if(isset($_SESSION['id'])) {
		   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
		   $requser->execute(array($_SESSION['id']));
		   $user 	= $requser->fetch();
        if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
      if($_SESSION['id']==3 ) {?>
      	<li class="nav-item">
      		<a <a  class="nav-link " href="admin.php?id=<?php echo $_SESSION['id']; ?>"><i class="fa fa-black-tie"></i> Admin Page</a>
      		<?php }}}?>
       </li> 
       <?php
         if(isset($_SESSION['id'])) {
		   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
		   $requser->execute(array($_SESSION['id']));
		   $user 	= $requser->fetch();
         if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
         ?>
        <li class="nav-item">
         	<a  class="nav-link " href="profile.php?id=<?php echo $_SESSION['id']; ?>"> <i class="fa fa-user fa-x3"></i> profile</a>
         	<?php
         	}}
         	?>
        </li>

       <li class="nav-item dropdown">
	        <?php
	       if(isset($_SESSION['id'])) {
			   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
			   $requser->execute(array($_SESSION['id']));
			   $user 	= $requser->fetch();
	         if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
	         ?>
	         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	           <?php echo $user['fname']." ".$user['lname']; ?>
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	           <a  class="dropdown-item" href="deconnexion.php">log out</a></div>
	           <?php
	           }}
	          ?>
        </li>
        <li class="nav-item dropdown">
          <?php
		      if(!isset($_SESSION['id'])) {
			   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
			   $user    = $requser->fetch();
          ?>
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-user-plus"></i> Join Us
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	         <a  class="dropdown-item" href="login.php">Login</a>
	         <a class="dropdown-item" href="SingIN.php">SingUP</a>
        </div>
         <?php
         }
         ?>
      </li>
    </ul>
  </div>
 </div>
  <!-- end of the container -->
</nav>
<!-- end nav bar -->
<!-- begin  search screen -->
	<div class=" bg-search overly">
		<div class="main-search text-center">
			<p class="speak ">  Our objectif is to make it easy<br>
			                   to you to find the best design you may have   
			</p>
			<form method="get" action="search-result.php">
	  		   <input type="search" class="input-search " id="search" placeholder="search" name="q">
	  	    </form>
	  	    <p> try to use one of this key words in your search:<br>
	  	   logo, media, food covre or brand.</p>
		</div>
	</div> 
<!-- end  search screen -->
<!-- begin exempels postes -->
<div class="exemp-posts" style="background-color: #fff;">
	    <div class="container">
				<h2 class="headerr text-center">
					Exempels postes
				</h2 >
		        <p class=" sec-desc text-center">  Those are such design exmples <br>
					that our website gives to you,<br> 
					for more results try to make search on top
				</p>
				<!-- start exemples cards -->
				<div class="row">
					<div class="col-sm-6 col-lg-3">
					<div class="card">
						<?php
						$stmt = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 2,1");
                        $stmt->execute(array($getid));
                        $userinfo = $stmt->fetchAll();
   						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
									<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
						<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3" >
					<div class="card">
						<?php $stmt = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 1,1");
                  		$stmt->execute(array($getid));
                    	$userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?> 
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
						<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<?php $stmt = $bdd->prepare("SELECT * FROM produits  ORDER BY id DESC LIMIT 0,1");
                    	$stmt->execute(array($getid));
                    	$userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<?php
						$stmt = $bdd->prepare("SELECT * FROM produits  ORDER BY id DESC LIMIT 3,1");
                     	$stmt->execute(array($getid));
                    	$userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- end exemples cards -->
	    </div>
	</div>
	<!-- end exempels postes -->
	<!-- begin overview -->
	<div class="overview text-center">
		<div class="container">
			<h2 class="h1v headerr">
				groupe overview
			</h2>
			<p>
			Locking for a spicial design?
			perfect with a hieght quality?
			the best place you may have for you
			try to make any search about your requast and with one click you gone it!
			for any other requastes please contact Us . 
			</p>
			<h4> let's start now</h4>
			<?php
         		if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
         			 ?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">contact us</button>
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <form method="post" action="sendes.php">
				          <div class="form-group">
				            <label for="recipient-name" class="col-form-label">Your e-mail:</label>
				            <input type="text" class="form-control" id="recipient-name" name="email">
				          </div>
				          <div class="form-group">
				            <label for="message-text" class="col-form-label">Message:</label>
				            <textarea class="form-control" id="message-text" name="message"></textarea>
				          </div>
      				   </div>
				      <div class="modal-footer">
				        <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Close" />
				        <input type="submit" class="btn btn-primary" name="envoie" value="Send message">
				        </form>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
			<?php }?>
<!-- end overviewn -->
<!-- start features-->
<div class="features text-center" >
	<div class="container">
		<div class="row">
			<div class="col">
				<i class="fa fa-print fa-3x rounded-circle"></i>
				<h3>Print</h3>
				<p>
					we do our best to give you a
					hieght quality for your picks 
					you may ever have
					
				</p>
				
			</div>
			<div class="col">
				<i class="fa fa-users fa-3x rounded-circle"></i>
				<h3>Companies</h3>
				<p>
					chosing us make you closer for a profitionel companies for a succefull work

				</p>
			</div>
			<div class="col">
				<i class="fa fa-user fa-3x rounded-circle"></i>
				<h3>Designers</h3>
				<p>
					peapole my work for your comand any time they can ,
					that to make you happy and make them work.

				</p>
			</div>

		</div>
	</div>
</div>
<?php include("footer.php");
         }
         ?>
<!--////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base', 'root', '');
if (!isset($_SESSION['id'])) {
$articles    = $bdd->query('SELECT texte,produit FROM produits ORDER BY id DESC');
if(isset($_GET['q']) AND !empty($_GET['q'])) {
   $q        = htmlspecialchars($_GET['q']);
   $articles = $bdd->query('SELECT texte,produit FROM produits WHERE texte LIKE "%'.$q.'%" ORDER BY id DESC');
   if($articles->rowCount() == 0) {
   $articles = $bdd->query('SELECT texte,produit FROM produits WHERE CONCAT(texte, class) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
}

  

?>
<?php include("top.php"); ?>
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
      <li class="nav-item  active">
        <a class="nav-link " href="index.php">
         <i class="fa fa-home"></i> Home 
         <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php"><i class="fa fa-info-circle"></i> About</a>
          <?php
	      if(isset($_SESSION['id'])) {
		   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
		   $requser->execute(array($_SESSION['id']));
		   $user = $requser->fetch();
        	if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
         	?>
        	<li class="nav-item">
         		<a  class="nav-link " href="profile.php?id=<?php echo $_SESSION['id']; ?>">My profile</a><
	         	<?php
	         	}}
        		 ?>
      		</li>
       		<li class="nav-item dropdown">
       			 <?php
	      		if(isset($_SESSION['id'])) {
			   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
			   $requser->execute(array($_SESSION['id']));
			   $user = $requser->fetch();
	         	if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) {
	        	 ?>
		         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	<?php echo $user['fname']." ".$user['lname']; ?>
		        </a>
	        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	         		<a  class="dropdown-item" href="deconnexion.php">log out</a></div>
	         		<?php
	         		}}
	         		?>
         	</li>
      		<li class="nav-item dropdown">
	        	 <?php
			      if(!isset($_SESSION['id']) ) {
				   $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
				   $user    = $requser->fetch();
	             ?>
		         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		         	<i class="fa fa-user-plus"></i>  Join Us
	        	</a>
	        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			         <a  class="dropdown-item" href="login.php">Login</a>
			         <a class="dropdown-item" href="SingIN.php">SingUP</a>
	          	</div>
	         	<?php
	         	}
	         	?>
	        </li>
	    </ul>
	</div>
</div>
  <!-- end of the container -->
</nav>

<!-- end nav bar -->
<!-- begin  search screen -->

	<div class=" bg-search overly">
		<div class="main-search text-center">
			<p class="speak ">  Our objectif is to make it easy<br>
			                   to you to find the best design you may have   
			</p>
			<form method="get" action="search-result.php">
	  			<input type="search" class="input-search " id="search" placeholder="search" name="q">
	  	    </form>
		</div>
	</div>
<!-- end  search screen -->
<!-- begin exempels postes -->
<div class="exemp-posts">
	    <div class="container" style="background-color: #fff;">
				<h2 class=" text-center headerr">
					Exempels postes
				</h2 >
		        <p class=" sec-desc text-center">  Those are such design exmples <br>
					that our website gives to you,<br> 
					for more results try to make search on top
				</p> 
				</p>
				<!-- start exemples cards -->
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<div class="card">
						<?php
						$stmt = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 2,1");
	                    $stmt->execute();
	                    $userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3" >
					<div class="card">
						<?php $stmt = $bdd->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 1,1");
	                    $stmt->execute();
	                    $userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<?php $stmt = $bdd->prepare("SELECT * FROM produits  ORDER BY id DESC LIMIT 0,1");
	                    $stmt->execute();
	                    $userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card">
						<?php
						$stmt = $bdd->prepare("SELECT * FROM produits  ORDER BY id DESC LIMIT 3,1");
	                    $stmt->execute();
	                    $userinfo = $stmt->fetchAll();
						foreach($userinfo as $row){?>
						<img  class="card-img-top" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="card-body car-bod">
							<h5 class="card-title"><?php echo $row['class']; ?></h5>
							<p class="card-text">
								<?php echo $row['texte'];?>
							</p>
							<a href="profile.php?id=<?php echo $row['idfname']; ?>" class="btn btn-outline-info">see all works</a>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- end exemples cards -->
	    </div>
	</div>
<!-- end exempels postes -->

<!-- begin overview -->
<div class="overview text-center">
	<div class="container">
		<h2 class="h1 headerr">
			groupe overview
		</h2>
		<p>
			Locking for a spicial design?
			perfect with a hieght quality?
			the best place you may have for you
			try to make any search about your requast and with one click you gone it!
			for any other requastes please contact Us . 
			</p>
		<h4> let's start now</h4>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">contact us</button>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
        		</button>
     		  </div>
		      <div class="modal-body">
		       <form method="post" action="sendnonsession.php">
		          <div class="form-group">
		            <label for="recipient-name" class="col-form-label">Your e-mail:</label>
		            <input type="text" class="form-control" id="recipient-name" name="email">
		          </div>
		          <div class="form-group">
		            <label for="message-text" class="col-form-label">Message:</label>
		            <textarea class="form-control" id="message-text" name="message"></textarea>
		          </div>
      			</div>
		        <div class="modal-footer">
			        <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Close" />
			        <input type="submit" class="btn btn-primary" name="envoie" value="Send message">
		      </form>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<!-- end overviewn -->
<!-- start features-->
<div class="features text-center" >
	<div class="container">
		<div class="row">
			<div class="col">
				<i class="fa fa-print fa-3x rounded-circle"></i>
				<h3>Print</h3>
				<p>
					we do our best to give you a
					hieght quality for your picks 
					you may ever have
					
				</p>
				
			</div>
			<div class="col">
				<i class="fa fa-users fa-3x rounded-circle"></i>
				<h3>Companies</h3>
				<p>
					chosing us make you closer for a profitionel companies for a succefull work

				</p>
			</div>
			<div class="col">
				<i class="fa fa-user fa-3x rounded-circle"></i>
				<h3>Designers</h3>
				<p>
					peapole my work for your comand any time they can ,
					that to make you happy and make them work.

				</p>
			</div>

		</div>
	</div>
</div>
<!-- end featurs -->
<?php include("footer.php");
         }
         ?>