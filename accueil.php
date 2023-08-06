<?php
  include 'fonction.php';
  entete();
  navbar();
  echo "<body>";
?>

<!-- Carousel -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block custom-img" src="image/lisbonne_wc.jpeg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block custom-img" src="image/podium_indiv.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block custom-img" src="image/podium_mixte.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<style>
  .custom-img {
    width: 100%;
    height: auto;
    object-fit: cover;
    max-height: 70vh; /* Utiliser une hauteur maximale en pourcentage */
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('.carousel').carousel();
  });
</script>

<?php
  footer();
  echo "</body>";
?>
