<?php
include 'fonction.php';
entete();
navbar();
?>

<body>
    <style>
      *{box-sizing: border-box; -webkit-box-sizing: border-box; }
html, body { height: 100%; }
body { margin: 0; font: 16px/1.3 sans-serif; }

.slider-container {
    position: relative;
    overflow: hidden;
    height: auto;
    max-height: 80%;
    display: flex; /* Ajout pour centrer verticalement et horizontalement */
    align-items: center; /* Ajout pour centrer verticalement */
    justify-content: center; /* Ajout pour centrer horizontalement */
}


        /* SLIDER */
        .slider-container .slider {
            height: auto;
            white-space: nowrap;
            font-size: 0;
            transition: 2s;
            width: 100%; /* Ajustez la largeur comme nécessaire */
            display: flex;
            /* Pas besoin d'animation CSS ici */
        }

        /* SLIDES */
        .slider-container .slider > * {
            font-size: 1rem;
            display: inline-block;
            white-space: normal;
            vertical-align: top;
            background: none 50% no-repeat;
            background-size: cover;
            flex: 0 0 100%; /* Chaque slide occupe 100% de la largeur du slider */
            transition: transform 2s;
        }

        /* Ancien CSS pour ajuster la taille des images */
        .custom-img {
            width: 100%;
            height: auto;
        }
        
    </style>
    <div class="slider-container">
        <div class="slider">
            <?php
            $imageFolder = "image/carousel/";
            $images = glob($imageFolder . "*.{jpg,png,gif,JPG,Jpg}", GLOB_BRACE);

            foreach ($images as $image) {
                echo "<img src='$image' alt='Image' class='custom-img'>";
            }
            ?>
        </div>
    </div>
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

        // Appel pour ajuster les tailles d'images lors du redimensionnement de la fenêtre
        window.addEventListener('resize', adjustImageSizes);

        // Fonction pour faire défiler automatiquement les images
        function startSlider() {
            let currentIndex = 0;
            const images = document.querySelectorAll('.custom-img');
            const numImages = images.length;

            setInterval(() => {
                currentIndex = (currentIndex + 1) % numImages;
                const translateValue = `translateX(-${currentIndex * 100}%)`;
                document.querySelector('.slider').style.transform = translateValue;
            }, 3000); // Change l'image toutes les 3 secondes
        }

        // Appeler la fonction pour démarrer le slider automatique
        startSlider();
    </script>
</body>

<?php
footer();
?>
