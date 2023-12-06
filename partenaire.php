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
        <button class="tablinks partenaire active" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'partenaire')">Nos Partenaires</button>
        <button class="tablinks evenement" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'evenement')">Evenements</button>
    </div>
</center>
<div id="partenaire" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; display: block; text-align:center;'>
    <h3>Nos partenaires</h3>
    <table class='table'>
        <div class='parcontainerResponsive'>
            <div class='paritem'>
                <div class='parflip-card'>
                    <div class='parflip-card-inner'>
                        <div class='parflip-card-front'>
                            <img src='./partenaires/partenaires_images/swisslife.png'>
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
                        <div class='parflip-card-front' style="display: flex; align-items: center; justify-content: center; background-color: white;">
                            <img src='./partenaires/partenaires_images/logo_ans.jpg' style="height: 55%;">
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
<div id="evenement" class="tabcontent" style='text-align:center;'>
    <img src='./partenaires/LR_Entreprise.jpg'>
</div>
<?php
footer();
echo "</body>";
?>