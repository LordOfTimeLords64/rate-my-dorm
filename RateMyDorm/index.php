<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       The home page of our site
-->

<?php
session_start();
require_once 'header.php';

echo<<<_END

<html>
  <head>
    <title>
      Rate My Dorm - Home
    </title>
  </head>

  <body>
  <div class="hometitle">
    <h1>Rate My Dorm<span>Live in the right Dorm!</span></h1>
  </div>

    <br><br>
    <div class="slideshow-container">

      <div class="mySlides fade">
      <div class="slidecnt">1 / 3</div>
      <img src="DormIMGs/Humphreys.jpg" style="width:100%">
      <div class="caption">Humphreys Hall</div>
    </div>

    <div class="mySlides fade">
      <div class="slidecnt">2 / 3</div>
      <img src="DormIMGs/Emery.jpg" style="width:100%">
      <div class="caption">Emery Hall</div>
    </div>

    <div class="mySlides fade">
      <div class="slidecnt">3 / 3</div>
      <img src="DormIMGs/McCrady.jpg" style="width:100%">
      <div class="caption">McCrady Hall</div>
    </div>

  </div>
<br>

  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
  </div>


  <div class="objective" style="max-width:1000px">
    <h2>Our Objective</h2>
    <p><i>We Help you choose your Dorm</i></p>
    <p>Rate My Dorm is aimed towards Sewanee University
                          Students to help them make an informed decision about
                          which Dorm they want to live in. We help them identify
                          important qualities of that specific dorm and where it
                          places in comparison to the other dorms on campus. Our
                          goal is to increase student satisfaction rate by helping
                          them make that decision more easily and reduce the tension
                          surrounding the college's residential life. </p>
  </div>
  <br><br>


  </body>
</html>

_END;

?>


<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
} 
</script>

