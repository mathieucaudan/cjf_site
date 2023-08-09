<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>
<h1 style="color: white;"><center>NOS PARTENAIRES</center></h1>

<!--
<div class="card" style="text-align: left; margin-left: 10px">
    <a href="https://www.google.fr"><img src="image/swisslife.png" style="width: 30vw;"></a>
    <div class="card-description">
        <h2 style="color: white;">Swiss Life</h2>
        <p style="color: white;">Description du partenaire</p>
    </div>
</div>-->


<div class="containerResponsive">

        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/swisslife.png">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/swisslife.png">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/coach_julien.jpg">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/coach_julien.jpg">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/coach_julien.jpg">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="flip-card">
                <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="image/swisslife.png">
                        </div>
                            <div class="flip-card-back">
                            <h1>John Doe</h1> 
                            <p>Architect & Engineer</p> 
                            <p>We love that guy</p>
                        </div>
                </div>
            </div>
        </div>
}
 
</div>

<style>
        .containerResponsive {
            display: grid;
            gap: 10px;
            justify-items: center;
        }
        
        .item {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
        }
        
        .item img {
            max-width: 100%;
            height: auto;
        }

        /* Utilisation des Media Queries pour ajuster le nombre d'images par ligne */
        @media screen and (max-width: 1100px) {
            .containerResponsive {
                grid-template-columns: repeat(1,1fr);
            }

            .flip-card {
                width: 50vw;
                height: 50vw;
                perspective: 1000px;
            }
        }


        @media screen and (min-width: 1100px) {
            .containerResponsive {
                grid-template-columns: repeat(auto-fit, minmax(30vw, 1fr));
            }

            .flip-card {
            /*background-color: transparent;*/
            width: 30vw;
            height: 30vw;
            perspective: 1000px;
            }
        }
        .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .flip-card-front img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ajuste l'image pour remplir l'espace */
        }

        .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        }

        .flip-card-front {
        background-color: #bbb;
        color: black;
        }

        .flip-card-back {
        background-color: #2980b9;
        color: white;
        transform: rotateY(180deg);
        }

</style>

<?php
footer();
echo "</body>";
?>