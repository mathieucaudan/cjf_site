/*-----------------------------------------------------------accueil.php-----------------------------------------------------------*/

// Fonction pour ajuster la taille des images en fonction de la plus grande image
// Fonction pour ajuster la taille des images en fonction de la plus petite image
function adjustImageSizes() {
    const images = document.querySelectorAll('.acccustom-img');
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

// Appel pour ajuster les tailles d'images lors du redimensionnement de la fenêtre
window.addEventListener('resize', adjustImageSizes);

// Fonction pour faire défiler automatiquement les images
function startSlider() {
    let currentIndex = 0;
    const images = document.querySelectorAll('.acccustom-img');
    const numImages = images.length;

    setInterval(() => {
        currentIndex = (currentIndex + 1) % numImages;
        const translateValue = `translateX(-${currentIndex * 100}%)`;
        document.querySelector('.accslider').style.transform = translateValue;
    }, 3000); // Change l'image toutes les 3 secondes
}
        

/*-----------------------------------------------------------article.php-----------------------------------------------------------*/
function adjustContentHeight() {
    const cardsWrapper = document.getElementById('artcardsWrapper');
    const content = document.querySelector('.artcontent');
    const cards = cardsWrapper.querySelectorAll('.artcard');

    let totalHeight = 0;
    cards.forEach(card => {
      totalHeight += card.clientHeight;
    });

    // Déterminez le nombre d'articles par ligne en fonction de la largeur de l'écran
    let articlesPerRow = 3; // Par défaut, 3 articles par ligne
    if (window.innerWidth <= 1285 && window.innerWidth > 900) {
      articlesPerRow = 2; // 2 articles par ligne entre 900px et 1285px
    } else if (window.innerWidth <= 900) {
      articlesPerRow = 1; // 1 article par ligne en dessous de 900px
    }

    // Calculez la hauteur minimale de la section de contenu en fonction du nombre d'articles par ligne
    const minHeight = Math.ceil(cards.length / articlesPerRow) * totalHeight / articlesPerRow;
    content.style.minHeight = minHeight + 'px';

    console.log('Nouvelle hauteur de .artcontent:', minHeight + 'px');
  }

  document.addEventListener('DOMContentLoaded', adjustContentHeight);
  window.addEventListener('resize', adjustContentHeight);

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
