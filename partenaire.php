<link rel='stylesheet' href='style/partenaire.css'> <!-- Ajout de la référence au fichier CSS -->
<link rel='stylesheet' href='style/global_tab.css'> <!-- Ajout de la référence au fichier CSS -->
<script src='script/global_tab.js'></script> <!-- Ajout de la référence au fichier JS -->

<?php
include 'fonction.php';
entete();
echo "<body style='background-color: rgb(32, 47, 74); color:white;'>";
navbar();
?>

<h1 style='color:white'>
    <center>Partenaires</center>
</h1>
<center>
    <div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'>
        <button class="tablinks prive active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'prive')">Partenaire Privés</button>
        <button class="tablinks public" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'public')">Partenaire Publics</button>
        <button class="tablinks evenement" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'evenement')">Evenement</button>
    </div>
</center>


<div id="prive" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
    <table class='table'>
        <div class='parcontainerResponsive'>
            <div class='paritem'>
                <div class='parflip-card'>
                    <div class='parflip-card-inner'>
                        <div class='parflip-card-front'>
                            <img src='./image/partenaires_images/swisslife.webp'>
                        </div>
                        <div class='parflip-card-back' onclick="window.open('https://agences.swisslife-direct.fr/assurance/agence-valentin-vivier-id0065363', '_blank');">
                            <h3>Valentin Vivier</h3>
                            <h3>Swiss Life</h3>
                            <h4>Expertise en protection sociale et patrimoniale</h4>
                            <h4>Accompagnement du dirigeant d'entreprise :</h4>
                            <p>Audit et solutions prévoyance, complémentaire santé et retraite, protection sociale des salariés, respect des obligations conventionnelles, indemnités de fin de carrière, trésorerie d'entreprise.</p>
                            <h4>Conseil auprès des particulier:</h4>
                            <p>Assurance emprunteru, protection de la famille, complémentaire santé, l'optimisation fiscale, placement, gestion de patrimoine.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class='paritem'>
                <div class='parflip-card'>
                    <div class='parflip-card-inner'>
                        <div class='parflip-card-front'>
                            <img src='./image/partenaires_images/axa.webp'>
                        </div>
                        <div class='parflip-card-back' onclick="window.open('https://agence.axa.fr/bretagne/ille-et-vilaine/saint-malo/ludmila-pozdejeva', '_blank');">
                            <h3>Ludmila Pozdejeva</h3>
                            <h3>Allianz</h3>
                            <h4>Meilleur rapport protection/cotisation en MUTUELLE SANTÉ, PRÉVOYANCE, ASSURANCE DE PRÊT</h4>
                            <h4>Optimisation fiscale d'ASSURANCE VIE, ÉPARGNE RETRAITE</h4>
                            <h4>Contrats Collectifs et Individuels en Prévoyance / Santé</h4>
                            <p>Expert en Protection Sociale & Gestion du Patrimoine - J'accompagne les clients Particuliers, les Professions Libérales et les Chefs d'Entreprises sur les volets de l'investissement, la retraite et de la prévoyance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href=" ./partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf" target="_blank" class="parcenter-button">
            <button class='parglowing-btn'>
                <span class='parglowing-txt'>NOUS<span class='parfaulty-letter'>REJOIN</span>DRE</span>
            </button>
        </a>
    </table>
</div>

<div id="public" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
    <table class='table'>
        <div class='parcontainerResponsive'>
            <div class='paritem'>
                <div class='parflip-card'>
                    <div class='parflip-card-inner'>
                        <div class='parflip-card-front' style="display: flex; align-items: center; justify-content: center; background-color: white;">
                            <img src='./image/partenaires_images/logo_ans.webp' style="height: 55%;">
                        </div>
                        <div class='parflip-card-back' onclick="window.open('https://www.agencedusport.fr/', '_blank');">
                            <h3>ANS</h3>
                            <h3>Agence National du Sport</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href=" ./partenaires/Dossier partenaires CJF Pentathlon Moderne.pdf" target="_blank" class="parcenter-button">
            <button class='parglowing-btn'>
                <span class='parglowing-txt'>NOUS<span class='parfaulty-letter'>REJOIN</span>DRE</span>
            </button>
        </a>
    </table>
</div>

<div id="evenement" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
    <img src='./partenaires/LR_Entreprise.jpg'>
</div>
<?php
footer();
echo "</body>";
?>