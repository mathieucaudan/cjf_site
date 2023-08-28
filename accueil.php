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
    <div class="w3-row" style='background-color: rgb(32, 47, 74); color:white'>>
  <div class="w3-container w3-twothird w3-center">
    <h2>Qu'est ce que le</h2>
    <h2>Pentathlon Moderne?</h2>
    <p>Le pentathlon moderne est une compétition sportive exigeante qui combine cinq disciplines distinctes pour couronner un champion. Ces épreuves sont soigneusement conçues pour refléter les compétences essentielles d'un soldat d'élite. Les athlètes rivalisent pour obtenir le meilleur score global en combinant leurs performances dans ces cinq disciplines.</p>

    <p>La première épreuve consiste en l'escrime, où les compétiteurs s'affrontent en duel à l'épée. L'objectif est de toucher l'adversaire tout en évitant d'être touché, et des points sont attribués en fonction des touches réussies.</p>

    <p>La natation représente la deuxième épreuve, où les athlètes doivent parcourir une distance de 200 mètres en utilisant le style libre. Les temps de nage sont enregistrés et convertis en points en fonction des performances individuelles.</p>

    <p>La troisième discipline est l'équitation, plus précisément le saut d'obstacles. Chaque athlète se voit attribuer un cheval par tirage au sort et dispose d'un court laps de temps pour se familiariser avec le cheval. L'objectif est de parcourir un parcours d'obstacles sans commettre de faute dans un temps limité.</p>

    <p>La quatrième épreuve, le "Laser Run," est une combinaison unique de tir au pistolet et de course à pied. Les athlètes utilisent des pistolets laser pour viser des cibles situées à 10 mètres de distance, alternant avec des courses, et les scores sont déterminés par la précision des tirs et le temps de course. Enfin, la cinquième discipline, également intégrée au "Laser Run," consiste en des séries de tirs au pistolet laser entrelacées avec des courses, cette séquence étant répétée plusieurs fois au cours de la compétition.</p>

    <p>Le champion du pentathlon moderne est celui qui parvient à combiner habilement ses performances dans chacune de ces disciplines pour obtenir le score total le plus élevé. Ce sport, devenu une épreuve olympique en 1912, exige une polyvalence exceptionnelle et une grande capacité d'adaptation de la part des athlètes pour exceller dans l'ensemble de ces épreuves variées.</p>
  </div>
  <div class="w3-container w3-third">
    <h2>Dernier résultat/info</h2>
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
