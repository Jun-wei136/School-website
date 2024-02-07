<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to BUC</title>
    <link rel="stylesheet" type="text/css" href="Design.css">
    <link rel="icon" type="image/x-icon" href="Images/logo_org.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
    <script type="text/javascript">
      window.addEventListener("scroll", function()
      {
        var header=document.querySelector("header");
        var defaultLogo=document.getElementById("defaultLogo");
        var stickyLogo=document.getElementById("stickyLogo");
        var textLogo=document.getElementById("textLogo");
        var textLogo2=document.getElementById("textLogo2");

        header.classList.toggle("sticky", window.scrollY>0);

        if(window.scrollY>0)
        {
          defaultLogo.style.display = "none";
          stickyLogo.style.display = "block";
          textLogo.style.display = "none";
          textLogo2.style.display = "block";
        }
        else
        {
          defaultLogo.style.display = "block";
          stickyLogo.style.display = "none";
          textLogo.style.display = "block";
          textLogo2.style.display = "none";
        }
      });

      window.addEventListener("scroll", function()
      {
        var reveals = document.querySelectorAll('.text-box, .card');

        for(var i=0; i<reveals.length; i++)
        {
          var windowheight = window.innerHeight;
          var revealtop = reveals[i].getBoundingClientRect().top;
          var revealpoint = 150;

          if(revealtop < windowheight - revealpoint)
          {
            reveals[i].classList.add('active');
          }
          else
          {
            reveals[i].classList.remove('active');
          }
        }
      });
    </script>
  </head>

  <body>
    <div>
      <header>
        <a href="#" class="logo"><img src="Images/logo_blue.jpg" id="defaultLogo"></a>
        <a href="#" class="logo"><img src="Images/logo_org.jpg" id="stickyLogo" style="display: none"></a>
        <p id="textLogo">BRITISH UNIVERSITY COLLEGE</p>
        <p id="textLogo2" style="display: none">BRITISH UNIVERSITY COLLEGE</p>
        <ul>
          <li><a href="#">HOME</a></li>
          <li><a href="About.html">ABOUT</a></li>
          <li><a href="Contact.html">CONTACT</a></li>
          <li><a href="#admission">ADMISSION</a></li>
          <li><a href="Login.php">LOGIN</a></li>
        </ul>
      </header>
    </div>

    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="Images/slide1.jpg" class="d-block w-100" alt="You, The Student & Higher Education">
        </div>

        <div class="carousel-item" data-bs-interval="2000">
          <img src="Images/slide2.jpg" class="d-block w-100" alt="School Activities">
        </div>

        <div class="carousel-item">
          <img src="Images/slide3.jpg" class="d-block w-100" alt="Our Chairman">
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
            
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <br><br>

    <div width="100%">
      <div class="image-container"> 
        <video controls autoplay muted src="Images/BUC video.mp4"></video>
        <div class="text-box">
          <br><br>
          <h4>ABOUT</h4>
          <h2>British University College</h2><br>
          British University College is one of the Private Higher Education Institution that offers undergraduate and postgraduate programmes in Myanmar. Our mission is to provide the best education to fulfill every student’s ambition and we make sure that quality is our top priority. Our groups of education have produced millions of outstanding students in Myanmar, Singapore, Vietnam, and China over 30 years and currently, over 6,000 students are attending their respective programme. We are the very first education group who had installed BTEC-HND in Myanmar and supported and delivered our academic programmes in one of the famous colleges in Myanmar from 2006 to 2016.
        </div>
      </div>
    </div>

    <div width="100%">
      <div class="image-container">
        <div class="card" id="card1">
          <h2>Our <b>Vision</b></h2>
          <center><img class="board-img-1" src="Images/vision.png" alt="our vision"></center>
          To be the Top<br>Private Higher Education Institution<br> in Myanmar.
        </div>

        <div class="card" id="card2">
          <h2>Our <b>Mission</b></h2>
          <center><img class="board-img-2" src="Images/mission.png" alt="our mission"></center>
          Providing the best education<br> to fulfill every student’s ambition.
        </div>

        <div class="card" id="card3">
          <h2>Our <b>Culture</b></h2>
          <center><img class="board-img-1" src="Images/culture.png" alt="our culture"></center>
          An excellent Institution with<br> care & support, nurturing creativity<br> for students and staff.
        </div>
            
        <div class="card" id="card4">
          <h2>Our <b>Value</b></h2>
          <center><img class="board-img-2" src="Images/value.png" alt="our value"></center>
          Care & Support<br> Excellence Creativity.
        </div>
      </div>
    </div>
        
    <div class="blue-back" id="admission">
      <div class="we-offer">
        <p>COURSES WE OFFER</p>
      </div>
      <div class="image-container">
        <a href="HDBusiness.php"><img src="Images/HDB.png" alt="This is HDB"></a>
        <a href="HDIT.php"><img src="Images/HDIT.png" alt="This is HDIT"></a>
      </div>
    </div>

    <div class="middle-text">
      <p>OUR STUDENT COMMUNITY</p>
    </div>

    <div class="wrapper">
      <?php
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'cos209';
      $table_name = 'application';
      $table_name1 = 'student';
      
      $conn = mysqli_connect($host, $user, $password, $database) or die("Could not connect to database");

      $query = "SELECT COUNT(Aid) FROM $table_name";
      mysqli_select_db($conn, $database);
      $result = mysqli_query($conn, $query);
      $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $total_app = $myrow['COUNT(Aid)'];

      $query = "SELECT COUNT(Sid) FROM $table_name1 WHERE Status='Studying'";
      mysqli_select_db($conn, $database);
      $result = mysqli_query($conn, $query);
      $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $current_std = $myrow['COUNT(Sid)'];

      $query = "SELECT COUNT(Sid) FROM $table_name1 WHERE Status='Graduated'";
      mysqli_select_db($conn, $database);
      $result = mysqli_query($conn, $query);
      $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $graduate_std = $myrow['COUNT(Sid)'];
      ?>

      <div class="container">
        <i class="fa-solid fa-id-card"></i>
        <span class="text">TOTAL APPLICANTS</span>
        <span class="num" data-val="<?php echo $total_app ?>">000</span>
      </div>

      <div class="container">
        <i class="fa-solid fa-book-open-reader"></i>
        <span class="text">CURRENT STUDENTS</span>
        <span class="num" data-val="<?php echo $current_std ?>">000</span>
      </div>

      <div class="container">
        <i class="fa-solid fa-user-graduate"></i>
        <span class="text">TOTAL GRADUATES</span>
        <span class="num" data-val="<?php echo $graduate_std ?>">000</span>
      </div>
    </div>
    <script src="script.js"></script>

    <div class="partner">
      <div class="left-partner">
        <p>OUR PARTNERS</p>
        <span>We proudly collaborate with top ranked universities in the UK, Singapore and Thailand as part of our commitment to enriching the higher educational journey. These partnerships opens up doors to diverse perspectives and unique opportunities, nurturing a global learning community. We celebrate the exchange of knowledge and ideas that thrives within these collaborative networks. Together, our aim is to prepare students for success in an interconnected world.<span>
      </div>
      <div class="right-partner">
        <img src="Images/partner.png" alt="Our Partners">
      </div>
    </div>
    
    <div class="std-voice-title"><p>OUR STUDENT VOICES</p></div>
    <div class="std-voice-contain">
      <div class="std-voice">
        <i id="left" class="fa-solid fa-angle-left"></i>

        <ul class="std-voice-carousel">
          <li class="std-voice-card">
            <div class="img"><img src="Images/stz.jpg" alt="<3" draggable="false"></div>
            <h2>San Tun Zaw</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/sywm.jpg" alt="<3" draggable="false"></div>
            <h2>Shwe Yee</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/hymm.jpg" alt="<3" draggable="false"></div>
            <h2>Hsu Yamin Myat</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/mtp.jpg" alt="<3" draggable="false"></div>
            <h2>May Thwe Phuu</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/ttr.jpg" alt="<3" draggable="false"></div>
            <h2>Thaint Thiri Kyaw</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/mpp.jpg" alt="<3" draggable="false"></div>
            <h2>Min Phone Pyae</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>

          <li class="std-voice-card">
            <div class="img"><img src="images/zmh.jpg" alt="<3" draggable="false"></div>
            <h2>Zun Myat Hsu</h2>
            <span>Being a student at BUC has been an incredible journey of growth and discovery. From engaging classes that spark curiosity to exciting extracurricular activities, this school has provided a platform for me to explore my interests and develop new skills. I appreciate the emphasis on both academic excellence and personal development, which has prepared me for the next chapter of my life. Proud to be a part of BUC family!</span>
          </li>
        </ul>

        <i id="right" class="fa-solid fa-angle-right"></i>
      </div>
    </div>
    <script src="script1.js" defer></script>

    <div class="why-buc">
      <div class="left-why">
        <p>WHY BUC</p>
        <span>British University College is one of the Private Higher Education Institution that offers undergraduate and postgraduate programmes in Myanmar. Our groups of education have produced millions of outstanding students in Myanmar, Singapore, Vietnam, and China (nearly 40 years) and currently, over 8,000 students are attending their respective programme.<span><br><br>
        <span>We have been appointed as Indo-China Regional Office of the University of Sunderland. As the University of Sunderland "Regional Office", we have been entrusted in the management of UoS Transationals Education programmes in Vietnam, Laos, Cambodia, and Myanmar.</span>
      </div>
      <div class="right-why">
        <ol>
          <li>Attractive Progression Routes</li>
          <li>Financial Assistance</li>
          <li>Learning & opportunities</li>
          <li>Industry Relevant</li>
        </ol>
      </div>
    </div>

    <div class="footer">
      <div class="footer-content">
        <p>British University College</p>
        S-25, U Chit Mg Housing, U Chit Mg Road,<br> Tamwe Tsp, Yangon<br>
        Phone No: <a href="tel:+959426265550">+959 426 26 5550</a><br>
        Email: <a href="mailto:buc@gmail.com">buc@gmail.com</a>
      </div>

      <div class="footer-content">
        <p>Study Programmes</p>
        <a href="HDIT.php">Higher Diploma in Infocomm Technology</a><br>
        <a href="HDBusiness.php">Higher Diploma in Business</a><br>
      </div>

      <div class="footer-content">
        <p>Life At BUC</p>
        Facilities & Campus<br>
        Students' Activities<br>
        Benefits & Privilege
      </div>
    </div>

    <div class="social">
      <p>Contact Us:</p>
      <a href="https://www.facebook.com/buc.edu.mm" target="_blank"><i class="fa-brands fa-facebook"></i></a>
      <a href="https://www.linkedin.com" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
      <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a>
      <a href="https://www.instagram.com/buc_universitycollege/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
    </div>

  </body>
</html>