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
  }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  // Fonction pour ajuster la taille des images en fonction de la plus petite image
  function adjustImageSizes() {
    const images = document.querySelectorAll('.custom-img');
    const promises = [];

    images.forEach((image) => {
      promises.push(loadImage(image.src));
    });

    Promise.all(promises)
      .then((loadedImages) => {
        let minHeight = Number.MAX_SAFE_INTEGER;

        loadedImages.forEach((img) => {
          if (img.height < minHeight) {
            minHeight = img.height;
          }
        });

        const windowWidth = window.innerWidth;
        const ratio = loadedImages[0].width / loadedImages[0].height;
        const newHeight = Math.min(minHeight, windowWidth / ratio);

        images.forEach((image) => {
          image.style.width = '100%';
          image.style.height = `${newHeight}px`;
        });
      })
      .catch((error) => {
        console.error('Error loading images:', error);
      });
  }

  // Fonction pour charger une image et retourner une promesse
  function loadImage(src) {
    return new Promise((resolve, reject) => {
      const img = new Image();
      img.onload = () => resolve(img);
      img.onerror = reject;
      img.src = src;
    });
  }

  // Appel initial pour ajuster les tailles d'images au chargement de la page
  window.addEventListener('load', adjustImageSizes);

  // Appel pour ajuster les tailles d'images lors du redimensionnement de la fenêtre
  window.addEventListener('resize', adjustImageSizes);
</script>








<?php
  footer();
  echo "</body>";
?>

