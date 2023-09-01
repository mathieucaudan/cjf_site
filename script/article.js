/*-----------------------------------------------------------article.php-----------------------------------------------------------*/
function adjustContentHeight() {
    const cardsWrapper = document.getElementById('cardsWrapper');
    const content = document.querySelector('.artcontent');
    const cards = cardsWrapper.querySelectorAll('.artcard');
  
    let maxHeightInRow = 0;
    let totalHeight = 0;
    let articlesInCurrentRow = 0;

    let multiplier = 1.5;
    
    // Déterminez le nombre d'articles par ligne en fonction de la largeur de l'écran
    let articlesPerRow = 3; // Par défaut, 3 articles par ligne
    if (window.innerWidth <= 1285) {
      multiplier = 1.8;
      articlesPerRow = 1; // 1 article par ligne entre 900px et 1285px
    } 
  
    cards.forEach(card => {
      const cardContent = card.querySelector('div');
      const cardHeight = cardContent.scrollHeight;
      const cardStyles = getComputedStyle(card);
  
      // Ajoutez la marge supérieure et inférieure de la balise .artcard
      const marginTop = parseFloat(cardStyles.marginTop);
      const marginBottom = parseFloat(cardStyles.marginBottom);
      const totalCardHeight = cardHeight + marginTop + marginBottom;
  
      if (articlesInCurrentRow < articlesPerRow) {
        // Ajoutez la hauteur du plus grand article dans la ligne actuelle
        maxHeightInRow = Math.max(maxHeightInRow, totalCardHeight);
        articlesInCurrentRow++;
      } else {
        // La ligne actuelle est complète, ajoutez la hauteur au total
        totalHeight += maxHeightInRow;
        // Réinitialisez les variables pour la nouvelle ligne
        maxHeightInRow = totalCardHeight;
        articlesInCurrentRow = 1;
      }
    });
  
    // Ajoutez la hauteur du plus grand article de la dernière ligne
    totalHeight += maxHeightInRow;
  
    // Calculez la hauteur minimale de la section de contenu en fonction du nombre d'articles par ligne
    const minHeight = totalHeight * multiplier;
  
    // Appliquez la hauteur minimale à la section de contenu
    content.style.minHeight = minHeight + 'px';
  
    console.log('Nouvelle hauteur de .artcontent:', minHeight + 'px');
  }
  
  
  

document.addEventListener('DOMContentLoaded', adjustContentHeight);
window.addEventListener('resize', adjustContentHeight);
