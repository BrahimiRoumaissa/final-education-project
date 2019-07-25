<?php
$pageTitel = 'About';
include("function.php");
include("top1.php");
 ?>
<nav class="navbar  navbar-fixed-top navbar-expand-lg navbar-dark bg-dark  ">
	<div class="container">
  <div class="navbar-brand " ><span>MY</span><span>DESIGNE</span></div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>

  </div>
</div>
</nav>

      <div>
          <div class="servise text-center">
            <span> [ </span>About<span> ]</span>
          </div>
        <div id="carousel-id" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-id" data-slide-to="0"class="active"></li>
            <li data-target="#carousel-id" data-slide-to="1"></li>
            <li data-target="#carousel-id" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/imgma.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-lg-block">
                <h2>hello world,</h2>
                <p>we are<span> web devlopers</span> &<span> designers</span><br>
               group, working togther to make it easy on your designe searching</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/imgma.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-lg-block">
                <h2>our website,</h2>
                <p>helpe you to find your <span> request </span><br>
              by searching on all products designers put on.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/imgma.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-lg-block">
               <h2>for more reasults,</h2>
                <p>try to<span><a href="login.php"> jion us</a></span><br>
               that's make you abele to contact the designers<br> and give your opinion about thier works.</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carousel-id" role="button" data-slide="prev">
            <i class="fa fa-angle-left fa-3x" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel-id" role="button" data-slide="next">
            <i class="fa fa-angle-right fa-3x" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

 <?php include("footer.php"); ?>