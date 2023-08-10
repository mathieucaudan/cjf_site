<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ... autres balises meta et liens ... -->
</head>
<?php
$dossierPdf = './article/article_pdf';
$dossierImage = './article/article_image';
$dossierJson = './article/article_json/article.json';
        
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>
<section class="cards-wrapper">

<?php


foreach ($data as $article) {
    echo "<div class='card-grid-space'>

            <a class='card' href='$dossierPdf/{$article['titre']}.pdf' target='_blank' style='--bg-img: url($dossierImage/{$article['image']})'>

        
            <div>
                <h1>{$article['titre']}</h1>
                <p>{$article['description']}</p>
                <div>{$article['date']}</div>
                <div class='tags'>
                    <div class='tag'>
                        <button class='card-button'>Télécharger</button>
                    </div>
                </div>
            </div>
        </a>
    </div>";
}
?>
</section>


<style>
    @import url('https://fonts.googleapis.com/css?family=Heebo:400,700|Open+Sans:400,700');

:root {
  --color: #3c3163;
  --transition-time: 0.5s;
}

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  min-height: 100vh;
  font-family: 'Open Sans';
  background: #fafafa;
}

a {
  color: inherit;
}

.cards-wrapper {
    display: grid;
    justify-content: center;
    align-items: stretch;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap: 4rem;
    padding: 4rem;
    margin: 0 auto;
    width: 100%; /* Remplacez max-content par 100% */
    max-width: 1800px; /* Ajoutez une largeur maximale pour les cartes */
}


.card {
    font-family: 'Heebo';
    --bg-filter-opacity: 0.5;
    background-image: linear-gradient(rgba(0, 0, 0, var(--bg-filter-opacity)), rgba(0, 0, 0, var(--bg-filter-opacity))), var(--bg-img);
    width: 100%;
    font-size: 2em;
    height: 100%;
    color: white;
    border-radius: 2em;
    padding: 1em;
    display: flex;
    align-items: flex-end;
    background-size: cover;
    background-position: center;
    box-shadow: 0 0 5em -1em black;
    transition: all, var(--transition-time);
    position: relative;
    overflow: hidden;
    border: 10px solid #ccc;
    text-decoration: none;
}


.card:hover {
  transform: rotate(0);
}

.card h1 {
  margin: 50px;
  font-size: 1.2em;
  line-height: 1.2em;
}

.card p {
  font-size: 0.75em;
  font-family: 'Open Sans';
  margin-top: 0.5em;
  line-height: 2em;
}

.card .tags {
  display: flex;
}

.card .tags .tag {
  font-size: 0.75em;
  background: rgba(255,255,255,0.5);
  border-radius: 0.3rem;
  padding: 0 0.5em;
  margin-right: 0.5em;
  line-height: 1.5em;
  transition: all, var(--transition-time);
}

.card:hover .tags .tag {
  background: var(--color);
  color: white;
}

.card .date {
  position: absolute;
  top: 0;
  right: 0;
  font-size: 0.75em;
  padding: 1em;
  line-height: 1em;
  opacity: .8;
}

.card:before, .card:after {
  content: '';
  transform: scale(0);
  transform-origin: top left;
  border-radius: 50%;
  position: absolute;
  left: -50%;
  top: -50%;
  z-index: -5;
  transition: all, var(--transition-time);
  transition-timing-function: ease-in-out;
}

.card:before {
  background: #ddd;
  width: 250%;
  height: 250%;
}

.card:after {
  background: white;
  width: 200%;
  height: 200%;
}

.card:hover {
  color: var(--color);
}

.card:hover:before, .card:hover:after {
  transform: scale(1);
}





/* MEDIA QUERIES */
@media screen and (max-width: 1285px) {
  .cards-wrapper {
    grid-template-columns: 1fr 1fr;
  }
  .card {
    max-width: calc(100vw - 4rem);
  }
}

@media screen and (max-width: 900px) {
  .cards-wrapper {
    grid-template-columns: 1fr;
  }
  .info {
    justify-content: center;
  }
  .card-grid-space .num {
    /margin-left: 0;
    /text-align: center;
  }
}

@media screen and (max-width: 500px) {
  .cards-wrapper {
    padding: 4rem 2rem;
  }
  .card {
    max-width: calc(100vw - 4rem);
  }
}

@media screen and (max-width: 450px) {
  .info {
    display: block;
    text-align: center;
  }
  .info h1 {
    margin: 0;
  }
}

.card-button {
  font-family: 'Open Sans';
  font-size: 0.75em;
  background: transparent; /* Modifier la couleur de fond en transparent */
  border-radius: 0.3rem;
  padding: 0.3em 0.5em;
  margin-right: 0.5em;
  line-height: 1.5em;
  color: white;
  border: none;
  cursor: pointer;
  transition: all, var(--transition-time);
}




</style>

<?php
footer();
echo "</body>";
?>