function adjustContentHeight() {
  const cardsWrapper = document.getElementById("cardsWrapper");
  const content = document.querySelector(".galcontent");
  const cards = cardsWrapper.querySelectorAll(".galcard");

  let maxHeightInRow = 0;
  let totalHeight = 0;
  let galleriesInCurrentRow = 0;

  let multiplier = 1.5;

  // Déterminez le nombre de galeries par ligne en fonction de la largeur de l'écran
  let galleriesPerRow = 3; // Par défaut, 3 galeries par ligne
  if (window.innerWidth <= 1285) {
    multiplier = 1.8;
    galleriesPerRow = 1; // 1 galerie par ligne entre 900px et 1285px
  }

  cards.forEach((gallery) => {
    const galleryContent = gallery.querySelector("div");
    const galleryHeight = galleryContent.scrollHeight;
    const galleryStyles = getComputedStyle(gallery);

    // Ajoutez la marge supérieure et inférieure de la balise .galcard
    const marginTop = parseFloat(galleryStyles.marginTop);
    const marginBottom = parseFloat(galleryStyles.marginBottom);
    const totalGalleryHeight = galleryHeight + marginTop + marginBottom;

    if (galleriesInCurrentRow < galleriesPerRow) {
      // Ajoutez la hauteur de la plus grande galerie dans la ligne actuelle
      maxHeightInRow = Math.max(maxHeightInRow, totalGalleryHeight);
      galleriesInCurrentRow++;
    } else {
      // La ligne actuelle est complète, ajoutez la hauteur au total
      totalHeight += maxHeightInRow;
      // Réinitialisez les variables pour la nouvelle ligne
      maxHeightInRow = totalGalleryHeight;
      galleriesInCurrentRow = 1;
    }
  });

  // Ajoutez la hauteur de la plus grande galerie de la dernière ligne
  totalHeight += maxHeightInRow;

  // Calculez la hauteur minimale de la section de contenu en fonction du nombre de galeries par ligne
  const minHeight = totalHeight * multiplier;

  // Appliquez la hauteur minimale à la section de contenu
  content.style.minHeight = minHeight + "px";

  console.log("Nouvelle hauteur de .galcontent:", minHeight + "px");
}

document.addEventListener("DOMContentLoaded", adjustContentHeight);
window.addEventListener("resize", adjustContentHeight);
