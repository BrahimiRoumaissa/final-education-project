
<?php
//in pages with $pageTitel echo th page titel else echo default
function getTitel() {

  global $pageTitel;// to be accecebal from any page

  if (isset($pageTitel)) {

    echo $pageTitel;
  }
    else{
      echo 'default';
    }
}

function rdirectFun($theMasg, $url = null,  $seconds = 3){
      if ($url === null) {
      	$url ='index.php';
      }
      else{
      	if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
      	$url = $_SERVER['HTTP_REFERER'];
      	}
      	else{
      		$url ='index.php';
      	}
      }
	    echo'<div class="container">';
        echo $theMasg ;
        echo'<div class="alert alert-info text-center">you ll be redirect after' . ' ' . $seconds . ' ' . 'seconds</div>';
        echo'</div>';
        header("refresh:$seconds; url=$url");
        exit();
}?>