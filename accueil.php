<?php
  include 'fonction.php';
  entete();
  navbar();
  
  echo "<body>";
?>

<div class="CSSgal">

  <!-- Don't wrap targets in parent -->
  <s id="s1"></s> 
  <s id="s2"></s>
  <s id="s3"></s>


  <div class="slider">
    <div>
      <img class="custom-img" src="image/lisbonne_wc.jpeg" alt="Image 1">
    </div>
    <div>
      <img class="custom-img" src="image/podium_indiv.jpg" alt="Image 2">
    </div>
    <div>
      <img class="custom-img" src="image/podium_mixte.jpg" alt="Image 3">
    </div>
  </div>
  
</div>

<style>
*{box-sizing: border-box; -webkit-box-sizing: border-box; }
html, body { height: 100%; }
body { margin: 0; font: 16px/1.3 sans-serif; }

.CSSgal {
  position: relative;
  overflow: hidden;
  height: 100%; /* Or set a fixed height */
}

/* SLIDER */

.CSSgal .slider {
  height: auto;
  white-space: nowrap;
  font-size: 0;
  transition: 0.8s;
  width: 100%; /* Ajustez la largeur comme nécessaire */
  display: flex;
}

/* SLIDES */

.CSSgal .slider > * {
  font-size: 1rem;
  display: inline-block;
  white-space: normal;
  vertical-align: top;
  /*height: 100%;*/
  background: none 50% no-repeat;
  background-size: cover;
  flex: 0 0 100%; /* Chaque slide occupe 100% de la largeur du slider */
  transition: transform 0.8s;
}

/* SLIDER ANIMATION POSITIONS */

#s1:target ~ .slider {transform: translateX(0%); -webkit-transform: translateX(0%);}
#s2:target ~ .slider {transform: translateX(-100%); -webkit-transform: translateX(-100%);}
#s3:target ~ .slider {transform: translateX(-200%); -webkit-transform: translateX(-200%);}



@keyframes slideAnimation {
  0%, 100% {
    transform: translateX(0%);
  }
  20% {
    transform: translateX(0%);
  }
  40% {
    transform: translateX(-100%);
  }
  60% {
    transform: translateX(-100%);
  }
  80% {
    transform: translateX(-200%);
  }
}

.CSSgal .slider {
  animation: slideAnimation 15s infinite; /* La valeur "15s" est la durée de l'animation, ajustez-la selon vos besoins */
}

</style>


<script>
// Fonction pour ajuster la taille des images en fonction de la plus grande image
// Fonction pour ajuster la taille des images en fonction de la plus petite image
function adjustImageSizes() {
  const images = document.querySelectorAll('.custom-img');
  const windowWidth = window.innerWidth;

  // Trouver la hauteur minimale à partir des dimensions de la plus petite image
  let minHeight = Number.MAX_SAFE_INTEGER;

  images.forEach((image) => {
    const originalWidth = image.naturalWidth;
    const originalHeight = image.naturalHeight;
    const newWidth = windowWidth;
    const newHeight = (originalHeight / originalWidth) * newWidth;

    if (newHeight < minHeight) {
      minHeight = newHeight;
    }
  });

  // Ajuster toutes les images en fonction de la hauteur minimale
  images.forEach((image) => {
    const originalWidth = image.naturalWidth;
    const originalHeight = image.naturalHeight;
    const newWidth = windowWidth;
    const newHeight = (originalHeight / originalWidth) * newWidth;

    image.style.width = `${newWidth}px`;
    image.style.height = `${minHeight}px`;
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

  // Appel pour ajuster les tailles d'images lors du redimensionnement de la fenÃªtre
  window.addEventListener('resize', adjustImageSizes);
</script>


<?php
  footer();
  echo "</body>";
?>
