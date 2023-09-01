/*-----------------------------------------------------------article.php-----------------------------------------------------------*/
function adjustContentHeight() {
  const cardsWrapper = document.getElementById('cardsWrapper'); // Utilisez 'cardsWrapper' au lieu de 'artcardsWrapper'
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
