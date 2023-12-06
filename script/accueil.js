/*-----------------------------------------------------------accueil.php-----------------------------------------------------------*/

// Fonction pour ajuster la taille des images en fonction de la plus grande image
// Fonction pour ajuster la taille des images en fonction de la plus petite image
function adjustImageSizes() {
  const images = document.querySelectorAll(".acccustom-img");
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
window.addEventListener("load", adjustImageSizes);

// Appel pour ajuster les tailles d'images lors du redimensionnement de la fenêtre
window.addEventListener("resize", adjustImageSizes);

// Fonction pour faire défiler automatiquement les images
function startSlider() {
  let currentIndex = 0;
  const images = document.querySelectorAll(".acccustom-img");
  const numImages = images.length;

  setInterval(() => {
    currentIndex = (currentIndex + 1) % numImages;
    const translateValue = `translateX(-${currentIndex * 100}%)`;
    document.querySelector(".accslider").style.transform = translateValue;
  }, 3000); // Change l'image toutes les 3 secondes
}

/*-----------------------------------------------------------calendrier.php-----------------------------------------------------------*/

/*-----------------------------------------------------------creaneaux.php-----------------------------------------------------------*/

/*-----------------------------------------------------------galerie_photo.php-----------------------------------------------------------*/

/*-----------------------------------------------------------nous.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_article.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_calendrier.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_carousel.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_galerie.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_partenaire.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_reseultat.php-----------------------------------------------------------*/

/*-----------------------------------------------------------parametres_section.php-----------------------------------------------------------*/

/*-----------------------------------------------------------partenaire.php-----------------------------------------------------------*/

/*-----------------------------------------------------------record.php-----------------------------------------------------------*/

/*-----------------------------------------------------------section.php-----------------------------------------------------------*/
