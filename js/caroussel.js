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