

<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // Check if user session exists
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>ThreatHalt</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <a class="navbar-brand" href="index.html">
            <img src="images/logo.png" alt="" />
            <span>
              Threat Halt
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin/admin_login.php">Admin </a>
              </li>
            </ul>
            <div class="user_option">
              <a href="login.php">
                <span>
                  Login
                </span>
              </a>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
              </form>
            </div>
          </div>
          <div>
            <div class="custom_menu-btn ">
              <button>
                <span class=" s-1">

                </span>
                <span class="s-2">

                </span>
                <span class="s-3">

                </span>
              </button>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div class="carousel_btn-container">
     
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Stay Ahead <br>
                      Of Hackers With <br>
                      Advanced Security
                    </h1>
                    <p>
                      It is a long established fact that a reader will be distracted by
                      the readable content of a page
                    </p>
                    <div class="btn-box">
  <a href="<?php echo $isLoggedIn ? 'basic.html' : 'login.php'; ?>" class="btn-1">
    Scan Here
  </a>
</div>

                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </div>

      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- experience section -->

  <section class="experience_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="img-box">
            <img src="images/experience-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                🔒 Stay Secure. Stay Ahead.
              </h2>
            </div>
            <p>
              **ThreatHalt** is an advanced web vulnerability scanner designed to detect threats like **SQL Injection, XSS, and malware**. It **crawls and analyzes websites**, providing real-time security insights and automated reports. With **detailed scanning and instant alerts**, protect your website from cyber attacks effortlessly. 🚀🔒 </p>
              <div class="btn-box">
  <a href="<?php echo $isLoggedIn ? 'basic.html' : 'login.php'; ?>" class="btn-1">
    Scan Here
  </a>
</div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end experience section -->

  <!-- category section -->

  <section class="category_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Cyber Attacks
        </h2>
      </div>
      <div class="category_container">
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-sql-injection-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              SQL Injection (SQLi)
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-scripting-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Cross-Site Scripting (XSS)
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-ddos-attack-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Denial of Service (DDoS) Attacks 
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-phishing-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Phishing Attacks
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-hacker-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Man-in-the-Middle (MITM) Attack
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/icons8-website-100.png" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Cross-Site Request Forgery (CSRF)
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end category section -->

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-9 mx-auto">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
          </div>
        </div>
      </div>
      <div class="detail-box">
        <h2>
          About ThreatHalt
        </h2>
        <p>
         Welcome to ThreatHalt , a powerful web vulnerability scanner designed to detect and prevent cyber threats. Our system identifies security weaknesses like SQL Injection, XSS attacks, and other vulnerabilities, ensuring your website stays protected from malicious attacks. With real-time scanning, automated reports, and advanced security insights, we help developers and businesses fortify their digital presence.</p>
      </div>
    </div>
  </section>

  <!-- end about section -->


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>


</body>
</body>

</html>