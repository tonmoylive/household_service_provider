
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css?v=4.1">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css?v=4.6">

  <title>SHEBA</title>
   <link rel="icon" type="icon" href="images/icon.png">
</head>

<body>
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-danger pl-5 fixed-top">
    <a href="index.php" class="navbar-brand">SHEBA</a>
    <span class="navbar-text">Trusted Hands for Your Everyday Needs</span>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myMenu">
      <ul class="navbar-nav pl-5 custom-nav">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#Services" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#registration" class="nav-link">Registration</a></li>
        <li class="nav-item"><a href="Requester/RequesterLogin.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </nav> <!-- End Navigation (ml-auto)for nav-item in right side -->

  <!-- Start Header Jumbotron-->
  <header class="jumbotron back-image" style="background-image: url(images/Banner1.webp);">
    <div class="myclass mainHeading">
      <h1 class="text-uppercase text-danger font-weight-bold">Welcome to SHEBA</h1>
      <p class="font-italic">Trusted Hands for Your Everyday Needs</p>
      <a href="Requester/RequesterLogin.php" class="btn btn-success mr-4">Login</a>
      <a href="#registration" class="btn btn-danger mr-4">Sign Up</a>
    </div>
  </header> <!-- End Header Jumbotron -->

  <div class="container">
    <!--Introduction Section-->
    <div class="jumbotron">
      <h3 class="text-center">About SHEBA</h3>
	  </br>
      <p>
        Welcome to SHEBA – Trusted Hands for Your Everyday Needs! </br>
		SHEBA is a Web-based Household Service Platform, we specialize in connecting you with trusted 
		and experienced service providers for all your HOME, OFFICE & SOCIAL needs. 
		Whether you need an Electrician, Plumber, Carpenter, Cleaner, 
		Handyman etc, we’ve got you covered!
		Our platform makes it easy to find and book services with just a few 
		clicks. From quick fixes to major repairs, our team ensures <b><i> Fast, 
		Reliable and Affordable </b></i> solutions tailored to your schedule.</br>
		Experience hassle-free service with SHEBA – 
		Because your time and comfort matter!
      </p>

    </div>
  </div>
  <!--Introduction Section End-->

  <!-- Start Services -->
  <div class="container text-center border-bottom" id="Services" style="padding-top: 110px; padding-bottom: 28px;">
    <h2>Our Services</h2>
    </br>
    <!-- Desktop View: 4-icon Slideshow -->
    <div class="row mt-4 d-none d-md-block">
      <div class="col-12">
        <div id="service-slideshow-desktop" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fas fa-wrench fa-6x text-success"></i></a>
                  <h5 class="mt-4">Plumbing</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fas fa-bolt fa-6x text-primary"></i></a>
                  <h5 class="mt-4">Electrician</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fas fa-broom fa-6x text-info"></i></a>
                  <h5 class="mt-4">Cleaner</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fa-solid fa-hammer fa-6x text-warning"></i></a>
                  <h5 class="mt-4">Carpenter</h5>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fas fa-paint-roller fa-6x text-danger"></i></a>
                  <h5 class="mt-4">Painter</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fa-solid fa-wind fa-6x text-info"></i></a>
                  <h5 class="mt-4">AC Technician</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fas fa-video fa-6x text-secondary"></i></a>
                  <h5 class="mt-4">CCTV Installation</h5>
                </div>
                <div class="col-md-3 mb-4">
                  <a href="#"><i class="fa-solid fa-satellite-dish fa-6x text-primary"></i></a>
                  <h5 class="mt-4">Cable/DTH Service</h5>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#service-slideshow-desktop" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#service-slideshow-desktop" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Mobile View: 2-icon Slideshow -->
    <div class="row mt-4 d-block d-md-none">
      <div class="col-12">
        <div id="service-slideshow-mobile" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-6 mb-4">
                  <a href="#"><i class="fas fa-wrench fa-6x text-success"></i></a>
                  <h5 class="mt-4">Plumbing</h5>
                </div>
                <div class="col-6 mb-4">
                  <a href="#"><i class="fas fa-bolt fa-6x text-primary"></i></a>
                  <h5 class="mt-4">Electrician</h5>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-6 mb-4">
                  <a href="#"><i class="fas fa-broom fa-6x text-info"></i></a>
                  <h5 class="mt-4">Cleaner</h5>
                </div>
                <div class="col-6 mb-4">
                  <a href="#"><i class="fa-solid fa-hammer fa-6x text-warning"></i></a>
                  <h5 class="mt-4">Carpenter</h5>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-6 mb-4">
                  <a href="#"><i class="fas fa-paint-roller fa-6x text-danger"></i></a>
                  <h5 class="mt-4">Painter</h5>
                </div>
                <div class="col-6 mb-4">
                  <a href="#"><i class="fa-solid fa-wind fa-6x text-info"></i></a>
                  <h5 class="mt-4">AC Technician</h5>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-6 mb-4">
                  <a href="#"><i class="fas fa-video fa-6x text-secondary"></i></a>
                  <h5 class="mt-4">CCTV Installation</h5>
                </div>
                <div class="col-6 mb-4">
                  <a href="#"><i class="fa-solid fa-satellite-dish fa-6x text-primary"></i></a>
                  <h5 class="mt-4">Cable/DTH</h5>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#service-slideshow-mobile" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#service-slideshow-mobile" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div> <!-- End Services -->

  <!-- Start Registration  -->
  <div class="container mt-5 mb-5" id="registration" style="padding-top: 75px; padding-bottom: 48px;">
	<?php include('userRegistration.php') ?>
  </div>
  <!-- End Registration  -->

</br></br>

  <!--Start Contact Us-->
  <div class="container" id="Contact">
    <!--Start Contact Us Container-->
    <h2 class="text-center mb-4">Contact US</h2> <!-- Contact Us Heading -->
    <div class="row">

      <!--Start Contact Us Row-->
      <?php include('contactform.php'); ?>
      <!-- End Contact Us 1st Column -->

      <div class="col-md-4 text-center">
        <!-- Start Contact Us 2nd Column-->
        <strong>Headquarter:</strong> <br>
        SHEBA Pvt Ltd, <br>
        Kalabagan, Dhanmondi <br>
        Dhaka - 1207 <br>
        Phone: +8809638185261 <br>
        <a href="#" target="_blank">www.sheba.infy.uk</a> <br>

        <br><br>
        <strong>Rajshahi Branch:</strong> <br>
        SHEBA Pvt Ltd, <br>
        Alokar Mor, Boalia <br>
        Rajshahi - 6200 <br>
        Phone: +8809638185261 <br>
        <a href="#" target="_blank">www.sheba.infy.uk</a> <br>
      </div> <!-- End Contact Us 2nd Column-->
    </div> <!-- End Contact Us Row-->
  </div> <!-- End Contact Us Container-->
  <!-- End Contact Us -->

  <!-- Start Footer-->
  <footer class="container-fluid bg-dark text-white mt-5" style="border-top: 3px solid #DC3545;">
    <div class="container">
      <!-- Start Footer Container -->
      <div class="row py-3">
        <!-- Start Footer Row -->
        <div class="col-md-6">
          <!-- Start Footer 1st Column -->
          <span class="pr-2">Follow Us: </span>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-twitter"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-youtube"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fab fa-google-plus-g"></i></a>
          <a href="#" target="_blank" class="pr-2 fi-color"><i class="fas fa-rss"></i></a>
        </div> <!-- End Footer 1st Column -->

        <div class="col-md-6 text-right">
          <!-- Start Footer 2nd Column -->
          <small>
				Developed by <a href="https://www.linkedin.com/in/mdanikbiswas" class="text-white" target="_blank">MD ANIK BISWAS</a> &copy; 2025
          </small>
          <small class="ml-2">||&nbsp&nbsp&nbsp<a href="Admin/login.php"class="text-white" >ADMIN</a></small>
        </div> <!-- End Footer 2nd Column -->
      </div> <!-- End Footer Row -->
    </div> <!-- End Footer Container -->
  </footer> <!-- End Footer -->

  <!-- Boostrap JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script>
  <!-- navbar collapse automatically JavaScript -->
  <script>
  $(document).ready(function () {
    // Close navbar when clicking outside
    $(document).click(function (event) {
      var clickover = $(event.target);
      var _opened = $(".navbar-collapse").hasClass("show");
      if (_opened === true && !clickover.closest('.navbar').length) {
        $(".navbar-toggler").click();
      }
    })
    // Close navbar when clicking a nav-link
    $('.navbar-nav>li>a').on('click', function(){
      $('.navbar-collapse').collapse('hide');
      });
	});
	</script>

  <script>
    // Activate the carousel
    $('#service-slideshow').carousel();
  </script>
</body>

</html>