<?php // Connect to server and select DB.
// -------------------------------------------------------------------------------------------------------
session_start();
	$pageTitel = 'Profile';
	include("function.php");
$bdd = new PDO('mysql:host=127.0.0.1;dbname=data_base;charset=utf8', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid     = intval($_GET['id']);
   $requser   = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
   $requser->execute(array($getid));
   $msg       = $requser->rowCount();
   $userinfo  = $requser->fetchAll();
   //////////////////////////////////////////////
    if(isset($_POST['envoyer'])) {
   $email     = htmlspecialchars($_POST['email']);
    $class = htmlspecialchars($_POST['class']);
   $commande  = htmlspecialchars($_POST['commande']);
   $sessionid = $getid;
   if( !empty($_POST['email']) AND !empty($_POST['commande'])) {
     $insertmbr = $bdd->prepare("INSERT INTO commandes(email,commande,idmember,class) VALUES(?, ?,?,?)");
     $insertmbr->execute(array( $email, $commande,$sessionid,$class));
     header('Location: profile.php?id='.$getid);
               }}
               /////////////////////////////////////////
   if (isset($_POST['submit'])) {
       if(isset($_POST['class']) AND isset($_FILES['image']) AND !empty($_FILES['image'])  AND !empty($_POST['class'])){   
                           
                         $texte    =htmlspecialchars($_POST['texte']);
                        $class     =htmlspecialchars($_POST['class']);   
                        $image     = $_FILES['image'];
                        $imageName = $_FILES['image']['name'];
                        $imageSize = $_FILES['image']['size'];
                        $imageTmp  = $_FILES['image']['tmp_name'];
                    	$imageType = $_FILES['image']['type'];
  // List Of Allowed Files To 
                        $sliderAllowedExtenstion = array("jpg","png","jpeg");
                        $tmp       = (explode('.', $imageName));
						$sliderExtenstion = strtolower(end($tmp));
// Validate The Form
                        $formErrors = array();
						if (! empty($imageName) && ! in_array($sliderExtenstion, $sliderAllowedExtenstion)){
                            $formErrors[] = 'just :jpg ,png or jpeg files please ';
                        }
                        if ($imageSize > 2194304){
                            $formErrors[] = ' image size is not valide  ';
                        }
                        if (empty($formErrors)){
                        	$imagetarget_dir = "produit/";    
                            if (!file_exists($imagetarget_dir)) {
                                mkdir($imagetarget_dir, 0777, true);
                            }    
                            $imagerand = rand(0, 100000) . '_' . $imageName;
                            move_uploaded_file($imageTmp, $imagetarget_dir . $imagerand);
                            // Insert Partner In Database
                                $stmt = $bdd->prepare("INSERT INTO 
                                                            produits(produit,texte,class,idfname)
                                                       VALUES 
                                                            (:produit,:texte,:class,:idfname)");
                                $stmt->execute(array(
                                	       
                                    'produit'  => $imagerand ,
                                    'texte'    => $texte, 
                                    'class'    => $class,
                                    'idfname'  =>$_SESSION['id'],
                                )); }
                                
                         header('Location: profile.php?id='.$_SESSION['id']);
						}else{

               $erreur = "you have to express your product to make it easy to you find!";
            }

          }
          /////////////////////////////////////////////////
?>

<?php
include("top1.php");
include("head.php");
 ?>
<!-- begin of input img -->
<div class="container ">
		<div class="profile-bady ">
			<div class="row">
			   <div class="col-2">
			     <div class="circle">
				       <!-- User Profile Image -->
				          <?php 
	                   if(!empty($userinfo['avatar']))
	                   {?>
	                   <img class="profile-pic" src="members/avatars/<?php echo $userinfo['avatar'];?>" >
	                   <?php
	                    }?>
				       <!-- Default Image -->
				       <!-- <i class="fa fa-user fa-5x"></i> -->
			      </div>
			    </div>
			      <!-- begin user name's place -->
			    <div class="col-sm-12 col-lg-6 user-name ">
					<?php echo $userinfo['fname']." ".$userinfo['lname']; ?>
					
					<div class=" user-define">
						<?php echo $userinfo['job']; ?>  
					</div>
					<div class="social-mi-ico">
						<i class="fa fa-facebook" style="color: #4a769b;"></i>
						<i class="fa fa-youtube " style="color: #f51109;"></i>
						<i class="fa fa-twitter " style="color: #176eb8;"></i>
						<i class="fa fa-instagram"style="color: #b82d17;"></i>
						<i class="fa fa-google" style="color: #4a769b;"></i>
					</div>
				</div>
				<!-- end user name's place -->
			</div>
			<hr>
			<form class="loadpost " action="" method="post" enctype="multipart/form-data">
				<div class="container ">
					<div class="user-action">
						<div class="row actions ">
	                        <?php    
							if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {?>
							<div class="col text-center">
								<a  href="" data-toggle="modal" data-target="#mm"><i class="fa fa-comments"></i> my commends</a><?php
						         }
						         ?>
									<div class="modal fade bd-example-modal-lg  span-select" id="mm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-lg" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
								           <div class="modal-body">
								           	<?php
								    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
								      	$stmt= $bdd->prepare("SELECT * FROM commandes WHERE idmember=? ORDER BY id");
					                    $stmt->execute(array($getid));
					                    $msg_nbr = $stmt->rowCount();
					                    $rows = $stmt->fetchAll();
					                    foreach($rows as $row){
					                    ?>
					                    <?php echo '- ' . $row['email'] ; ?> : 
					                    <?php echo ' about " ' . $row['class'] . ' " product, ' ; ?>
					                    <?php echo $row['commande'];?>
					                    <a href="delete.php?id=<?php echo $row['id']; ?>">delete</a><br>
				                <?php }}?>
									            <hr>
									   		</div>
									      </div>
					                    <?php
					        			if(isset($erreur)) {
					           				echo '<font color="red">'.$erreur."</font>";
									         
									         } ?>
									  </div>
								</div>
							</div>
							<div class="col text-center">
								<a  href="" value="submit" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
									<i class="fa fa-image"></i>
									My posts
								</a>
							</div>
							<div class="col text-center">
 								<?php
        					 	if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         							?>
									<a  href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square"></i> Add post</a> <?php
						         }
						         ?>
									<div class="modal fade bd-example-modal-lg  span-select" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									  <div class="modal-dialog modal-lg" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <h5 class="modal-title" id="exampleModalLabel"> Products is:</h5>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span>
									        </button>
									      </div>
									       <div class="form-group">
									      <textarea type="text"class="form-control bor " name="texte" placeholder="express yourself"></textarea><br>
					                       </div>
								           <div class="modal-body">
									            <h5>A new product to Upload: </h5>
									  			<div class="row">
											        <span class="span-select">Select to upload new image :</span>
											        <div class="custom-input">
												       <button>chose image <i class="fa fa-upload"></i></button>
												        <input type="file" name="image" id="fileToUpload">
												    </div>
											    </div> 
									            <hr>
										        <h5>Your product is an </h5> <br>
										        <div class="row ">
										            <input type="texte" name="class" placeholder="express Your product" class="chose-product-type " /> 
										              chose if htis is a: logo, media, food covre , brand or others .
										        </div>
									   		</div>
									        <div class="modal-footer">
									            <input class="sub" type="submit" name="submit" value="Upload It"> <br>
									        </div>
									    </div>
					                    <?php
					        			if(isset($erreur)) {
					           				echo '<font color="red">'.$erreur."</font>";
									         }
									         ?>
									  </div>
									</div>
			  					<!-----fffffffffffffffffffffffffffffffffffffff----->
			  					<div class="col text-center"><!--dsddddddddddddddcol-3ddddddddddd-->				
		        			 <?php
		         				if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid) {
		         			 		?>
		                         	<a  data-toggle="modal" data-target="#Modal"    href="">
										messages
									</a>
								<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form method="post" action="send.php">
								          <div class="form-group">
								            <label for="recipient-name" class="col-form-label">Your e-mail:</label>
								            <input type="text" class="form-control" id="recipient-name" name="email">
								          </div>
								           <div class="form-group">
								            <label for="recipient-name" class="col-form-label">your order type:</label>
								            <input type="text" class="form-control" id="recipient-name" name="class">
								          </div>
								          <div class="form-group">
								            <label for="message-text" class="col-form-label">Message:</label>
								            <textarea class="form-control" id="message-text" name="commande"></textarea>
								          </div>
								        </form>
								      </div>
								      <div class="modal-footer">
								        <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Close" />
								        <input type="submit" class="btn btn-primary" name="envoyer" value="Send message">
								      </div>
								    </div>
								  </div>
								</div>
        			           <?php } ?>
	                         </div>
	                     <!--dsddddddddddddddddddddddddd-->
	                 </div>
	             </div>
	        </div>
		</form>
			
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
 			<div class="container">
	    		<div class="col-lg ">
					<?php  
					 if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
					 	$stmt       = $bdd->prepare("SELECT * FROM produits WHERE idfname=? ORDER BY id");
	                    $stmt->execute(array($getid));
	                    $msg_nbr    = $stmt->rowCount();
       					$rows       = $stmt->fetchAll();
						foreach($rows as $row){ 
						  $likes    = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
					      $likes->execute(array($row['id']));
					      $likes    = $likes->rowCount(); 
					      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
					      $dislikes->execute(array($row['id']));
					      $dislikes = $dislikes->rowCount();   
		              ?>
					<div class="container">
						<div class="row">
							<div class="col-2">
							<b><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><?php echo $userinfo['fname']; ?> </a>   </b><br>
							<?php echo $row['texte'];?><br></div>
								<img class="posts  col-6" src="produit/<?php echo $row['produit'] ;?>"><br>
								<div class="col">
									<a  href="php/action.php?t=1&id=<?php echo $row['id'] ; ?>">Like</a> (<?php echo $likes; ?>)
						   			<a href="php/action.php?t=2&id=<?php echo $row['id']; ?>">Dislikes</a> (<?php echo $dislikes; ?>) 
									<a href="supprimer.php?id=<?php echo $row['id']; ?>">Delete</a>
								</div>
							<?php } }?>
						</div>
					</div>
					<?php
		    		if(isset($_SESSION['id']) AND $_SESSION['id'] != $getid){
					$stmt    = $bdd->prepare("SELECT * FROM produits WHERE idfname=? ORDER BY id");
                    $stmt->execute(array($getid));
                    $msg_nbr = $stmt->rowCount();
                    $rows    = $stmt->fetchAll();
						
					foreach($rows as $row){ 
						$likes 	 = $bdd->prepare('SELECT id FROM likes WHERE id_article = ?');
			        $likes->execute(array($row['id']));
			        $likes   = $likes->rowCount();
				    $dislikes= $bdd->prepare('SELECT id FROM dislikes WHERE id_article = ?');
				    $dislikes->execute(array($row['id']));
				    $dislikes= $dislikes->rowCount(); 
				?>
				<div class="container">
					<div class="row">
						<div class="col-2">
							<b><a href="profile.php?id=<?php echo $getid; ?>"><?php echo $userinfo['fname']; ?> </a>   </b><br>
							<?php echo $row['texte'];?><br>
						</div>
						<img class="posts  col-6" src="produit/<?php echo $row['produit'] ;?>"><br>
						<div class="col">
							<a  href="php/action.php?t=1&id=<?php echo $row['id'] ?>">Like</a> (<?php echo $likes; ?>)
								<a href="php/action.php?t=2&id=<?php echo $row['id'] ?>">Dislikes</a> (<?php echo $dislikes; ?>) 
							</div>
					    <?php } }?>
					</div>
				<!-- ggggggggggggggggggggggggg -->
				<div class="col-lg ">
				<?php
				if(!isset($_SESSION['id']) ){
					$stmt    = $bdd->prepare("SELECT * FROM produits WHERE idfname=? ORDER BY id");
                    $stmt->execute(array($getid));
                    $msg_nbr = $stmt->rowCount();
                    $rows    = $stmt->fetchAll();
					foreach($rows as $row){    
					?>
					<div class="container">
						<div class="row">
							<div class="col-2">
								<b>
								<a href="profile.php?id=<?php echo $getid; ?>"><?php echo $userinfo['fname']; ?></a>   </b><br>
									<?php echo $row['texte'];?><br>
							</div>
							<img class="posts  col-6" src="produit/<?php echo $row['produit'] ;?>"><br>
								<?php } }?>
						</div>
					</div>
               </div>
			<!-- The Modal -->
			<div id="myModal" class="modal">
				<!-- The Close Button -->
				<span class="close">&times;</span>
				<!-- Modal Content (The Image) -->
				<img class="modal-contentt" id="img01">
				<!-- Modal Caption (Image Text) -->
				<div id="caption">
				</div>
			</div>    
	    </div>
   
<!-- end of input img -->
<?php
include("footer.php");

}
?>