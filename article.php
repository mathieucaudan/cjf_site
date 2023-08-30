<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();

$dossierPdf = './article/article_pdf';
$dossierImage = './article/article_image';
$dossierJson = './article/article_json/article.json';
        
$jsonData = file_get_contents($dossierJson);
$data = json_decode($jsonData, true);
?>

<main class="artcontent">
  <div id="cardsWrapper">
    <section class="artcards-wrapper"  >
      <?php
      foreach ($data as $article) {
        echo "<div class='artcard-grid-space'>
        <a class='artcard' href='$dossierPdf/" . pathinfo($article['image'], PATHINFO_FILENAME) . ".pdf' target='_blank' style='--bg-img: url($dossierImage/{$article['image']})'>
            <div>
                <h1>{$article['titre']}</h1>
                <p>{$article['description']}</p>
                <div>{$article['date']}</div>
                <div class='arttags'>
                    <div class='arttag'>
                        <form action='download.php' method='post' style='display:inline;'>
                            <input type='hidden' name='pdf' value='" . rawurlencode(pathinfo($article['image'], PATHINFO_FILENAME) . ".pdf") . "'>
                            <button type='submit' class='artcard-button' name='download'>Télécharger</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
      </div>";
      }
      ?>
    </section>
  </div>
</main>


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
  text-decoration : none;
}

.artcontent {
        min-height: calc(300vh); /* Adjust the value as needed */
}

.artcards-wrapper {
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

.artcard {
    font-family: 'Heebo';
    --bg-filter-opacity: 0.5;
    background-image: linear-gradient(rgba(0, 0, 0, var(--bg-filter-opacity)), rgba(0, 0, 0, var(--bg-filter-opacity))), var(--bg-img);
    width: 100%;
    font-size: 1em;
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

.artcard:hover {
  transform: rotate(0);
}

.artcard h1 {
  margin: 50px;
  font-size: 1.2em;
  line-height: 1.2em;
}

.artcard p {
  font-size: 0.75em;
  font-family: 'Open Sans';
  margin-top: 0.5em;
  line-height: 2em;
}

.artcard .arttags {
  display: flex;
}

.artcard .arttags .arttag {
  font-size: 0.75em;
  background: rgba(255,255,255,0.5);
  border-radius: 0.3rem;
  padding: 0 0.5em;
  margin-right: 0.5em;
  line-height: 1.5em;
  transition: all, var(--transition-time);
}

.artcard:hover .arttags .arttag {
  background: var(--color);
  color: white;
}

.artcard .artdate {
  position: absolute;
  top: 0;
  right: 0;
  font-size: 0.75em;
  padding: 1em;
  line-height: 1em;
  opacity: .8;
}

.artcard:before, .artcard:after {
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

.artcard:before {
  background: #ddd;
  width: 250%;
  height: 250%;
}

.artcard:after {
  background: white;
  width: 200%;
  height: 200%;
}

.artcard:hover {
  color: var(--color);
}

.artcard:hover:before, .artcard:hover:after {
  transform: scale(1);
}

/* MEDIA QUERIES */
@media screen and (max-width: 1285px) {
  .artcards-wrapper {
    grid-template-columns: 1fr 1fr;
  }
  .artcard {
    max-width: calc(100vw - 4rem);
  }
}

@media screen and (max-width: 900px) {
  .cartards-wrapper {
    grid-template-columns: 1fr;
  }
  .artinfo {
    justify-content: center;
  }
  .artcard-grid-space .num {
    /margin-left: 0;
    /text-align: center;
  }
}

@media screen and (max-width: 500px) {
  .artcards-wrapper {
    padding: 4rem 2rem;
  }
  .artcard {
    max-width: calc(100vw - 4rem);
  }
}

@media screen and (max-width: 450px) {
  .artinfo {
    display: block;
    text-align: center;
  }
  .artinfo h1 {
    margin: 0;
  }
}

.artcard-button {
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

.artfooter {
        position : bottom;
    }
</style>


<div class="artfooter">
  <div style="clear: both">
  <?php
  footer();
  ?>
    </div>
</div>






