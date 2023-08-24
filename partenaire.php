<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74);'>";
navbar();
?>
<div class="content-container">
    <h1 style="color: white;"><center>NOS PARTENAIRES</center></h1>


    <?php
        $dossierImage = './partenaires/partenaires_images/';
        $dossierJson = './partenaires/partenaires_json/partenaires.json';
                
        $jsonData = file_get_contents($dossierJson);
        $data = json_decode($jsonData, true);

        echo"<div class='containerResponsive'>";
        foreach ($data as $article) {
            echo "<div class='item'>
                    <div class='flip-card'>
                        <div class='flip-card-inner'>
                                <div class='flip-card-front'>
                                <img src='" .$dossierImage. $article['image'] . "'>
                                </div>
                                <div class='flip-card-back'>
                                    <h1>{$article['titre']}</h1> 
                                    <p>{$article['description']}</p> 
                                </div>
                        </div>
                    </div>
                </div>";
        
        }
        echo"</div>";
    ?>

    <a href="./partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf" target="_blank" class="center-button">
        <button class='glowing-btn'>
            <span class='glowing-txt'>NOUS <span class='faulty-letter'>REJOIN</span>DRE</span>
        </button>
    </a>
</div>





 
</div>

<style>

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .center-button {
            margin-top: 20px;
        }
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
        background-color: rgb(32, 47, 74);
        color: white;
        transform: rotateY(180deg);
        }

        @import url("https://fonts.googleapis.com/css?family=Raleway");

        :root {
        --glow-color: white;
        }
                 
                 
        .glowing-btn {
            position: relative;
            color: var(--glow-color);
            cursor: pointer;
            padding: 0.35em 1em;
            border: 0.15em solid var(--glow-color);
            border-radius: 0.45em;
            background: none;
            perspective: 2em;
            font-family: "Raleway", sans-serif;
            font-size: 2em;
            font-weight: 900;
            letter-spacing: 1em;

            -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                0px 0px 0.5em 0px var(--glow-color);
            -moz-box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                0px 0px 0.5em 0px var(--glow-color);
            box-shadow: inset 0px 0px 0.5em 0px var(--glow-color),
                0px 0px 0.5em 0px var(--glow-color);
            animation: border-flicker 2s linear infinite;
        }

        .glowing-txt {
        float: left;
        margin-right: -0.8em;
        -webkit-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
            0 0 0.45em var(--glow-color);
        -moz-text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3),
            0 0 0.45em var(--glow-color);
        text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3), 0 0 0.45em var(--glow-color);
        animation: text-flicker 3s linear infinite;
        }

        .faulty-letter {
        opacity: 0.5;
        animation: faulty-flicker 2s linear infinite;
        }

        .glowing-btn::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        opacity: 0.7;
        filter: blur(1em);
        transform: translateY(120%) rotateX(95deg) scale(1, 0.35);
        background: var(--glow-color);
        pointer-events: none;
        }

        .glowing-btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        z-index: -1;
        background-color: var(--glow-color);
        box-shadow: 0 0 2em 0.2em var(--glow-color);
        transition: opacity 100ms linear;
        }

        .glowing-btn:hover {
        color: rgb(32, 47, 74);
        text-shadow: none;
        animation: none;
        }

        .glowing-btn:hover .glowing-txt {
        animation: none;
        }

        .glowing-btn:hover .faulty-letter {
        animation: none;
        text-shadow: none;
        opacity: 1;
        }

        .glowing-btn:hover:before {
        filter: blur(1.5em);
        opacity: 1;
        }

        .glowing-btn:hover:after {
        opacity: 1;
        }

        @keyframes faulty-flicker {
        0% {
            opacity: 0.1;
        }
        2% {
            opacity: 0.1;
        }
        4% {
            opacity: 0.5;
        }
        19% {
            opacity: 0.5;
        }
        21% {
            opacity: 0.1;
        }
        23% {
            opacity: 1;
        }
        80% {
            opacity: 0.5;
        }
        83% {
            opacity: 0.4;
        }

        87% {
            opacity: 1;
        }
        }

        @keyframes text-flicker {
        0% {
            opacity: 0.1;
        }

        2% {
            opacity: 1;
        }

        8% {
            opacity: 0.1;
        }

        9% {
            opacity: 1;
        }

        12% {
            opacity: 0.1;
        }
        20% {
            opacity: 1;
        }
        25% {
            opacity: 0.3;
        }
        30% {
            opacity: 1;
        }

        70% {
            opacity: 0.7;
        }
        72% {
            opacity: 0.2;
        }

        77% {
            opacity: 0.9;
        }
        100% {
            opacity: 0.9;
        }
        }

        @keyframes border-flicker {
        0% {
            opacity: 0.1;
        }
        2% {
            opacity: 1;
        }
        4% {
            opacity: 0.1;
        }

        8% {
            opacity: 1;
        }
        70% {
            opacity: 0.7;
        }
        100% {
            opacity: 1;
        }
        }

        @media only screen and (max-width: 1000px) {
        .glowing-btn{
            font-size: 1em;
        }
        }

         
         

</style>

<?php
footer();
echo "</body>";
?>