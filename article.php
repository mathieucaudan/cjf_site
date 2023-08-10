<?php
include 'fonction.php';
entete();
echo "<body>";
navbar();
showarticle();
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ... autres balises meta et liens ... -->
</head>

<section class="cards-wrapper">
  <div class="card-grid-space">
    <a class="card" href="https://codetheweb.blog/2017/10/06/html-syntax/" style="--bg-img: url(https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&resize_w=1500&url=https://codetheweb.blog/assets/img/posts/html-syntax/cover.jpg)">
      <div>
        <h1>Aziliz NAOUR</h1>
        <p>Championnat de France U22</p>
        <div class="date">6 Oct 2017</div>
        <div class="tags">
          <div class="tag">
            <button class="card-button">Télécharger</button>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="card-grid-space">
    <a class="card" href="https://codetheweb.blog/2017/10/09/basic-types-of-html-tags/" style="--bg-img: url('https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&resize_w=1500&url=https://codetheweb.blog/assets/img/posts/basic-types-of-html-tags/cover.jpg')">
      <div>
        <h1>Championnat de France laser-run</h1>
        <p>Learn about some of the most common HTML tags…</p>
        <div class="date">9 Oct 2017</div>
        <div class="tags">
            <div class="tag">
                <button class="card-button">Télécharger</button>
            </div>
        </div>
      </div>
    </a>
  </div>
  <div class="card-grid-space">
    <a class="card" href="https://codetheweb.blog/2017/10/14/links-images-about-file-paths/" style="--bg-img: url('https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&resize_w=1500&url=https://codetheweb.blog/assets/img/posts/links-images-about-file-paths/cover.jpg')">
      <div>
        <h1>Triathlé</h1>
        <p>Learn how to use links and images along with file paths…</p>
        <div class="date">14 Oct 2017</div>
        <div class="tags">
            <div class="tag">
                <button class="card-button">Télécharger</button>
            </div>
        </div>
      </div>
    </a>
  </div>
  <div class="card-grid-space">
    <a class="card" href="https://codetheweb.blog/2017/10/14/links-images-about-file-paths/" style="--bg-img: url('https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&resize_w=1500&url=https://codetheweb.blog/assets/img/posts/links-images-about-file-paths/cover.jpg')">
      <div>
        <h1>Bilan Championnat du monde</h1>
        <p>Learn how to use links and images along with file paths…</p>
        <div class="date">14 Oct 2017</div>
        <div class="tags">
            <div class="tag">
                <button class="card-button">Télécharger</button>
            </div>
        </div>
      </div>
    </a>
  </div>
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