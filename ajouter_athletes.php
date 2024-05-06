<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
?>

        <script>
            // Fonction pour sauvegarder la dernière catégorie sélectionnée
            function saveLastCategory() {
                var selectedCategory = document.getElementById("categorie").value;
                localStorage.setItem("lastCategory", selectedCategory);
            }

            // Fonction pour sélectionner la dernière catégorie choisie
            function selectLastCategory() {
                var lastCategory = localStorage.getItem("lastCategory");
                if (lastCategory) {
                    document.getElementById("categorie").value = lastCategory;
                }
            }
        </script>
        </head>

        <body style='background-color: rgb(32, 47, 74);' onload="selectLastCategory()">
            <center>
                <h1>Ajouter des athlètes</h1>
            </center>

            <?php
            // Vérifier si la compétition est spécifiée dans l'URL
            if (isset($_GET["competition"])) {
                $nom_competition = $_GET["competition"];
            } else {
                // Rediriger si la compétition n'est pas spécifiée
                header("Location: creer_competition.php");
                exit();
            }

            // Traitement des données lors de la soumission du formulaire d'ajout d'athlète
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom"]) &&  isset($_POST["club"])) {
                // Récupérer les valeurs du formulaire
                $nom_athlete = $_POST["nom"];
                $club_athlete = $_POST["club"];
                $categorie = $_POST["categorie"];

                // Charger les données JSON existantes s'il y en a
                $fileName = "competitions/{$nom_competition}/athletes.json";
                $database  = "competitions/base_athletes.json";;
                $data = [];
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);
                }
                if (file_exists($database)) {
                    $data_athletes = json_decode(file_get_contents($database), true);
                }

                // Vérifier si l'athlète existe déjà dans une catégorie différente
                foreach ($data as $cat => $athletes) {
                    if ($cat !== $categorie) {
                        foreach ($athletes as $key => $athlete) {
                            if ($athlete['nom'] === $nom_athlete) {
                                // Supprimer l'athlète de l'ancienne catégorie
                                unset($data[$cat][$key]);
                                // Si la catégorie devient vide, la supprimer
                                if (empty($data[$cat])) {
                                    unset($data[$cat]);
                                }
                            }
                        }
                    }
                }

                // Ajouter les données dans le tableau
                $data[$categorie][] = array(
                    'nom' => $nom_athlete,
                    'club' => $club_athlete
                );
                $athleteExists = false;
                foreach ($data_athletes['athletes'] as $row) {
                    if ($row['nom'] == $nom_athlete && $row['club'] == $club_athlete) {
                        $athleteExists = true;
                        break;
                    }
                }

                if (!$athleteExists) {
                    $data_athletes['athletes'][] = array(
                        'nom' => $nom_athlete,
                        'club' => $club_athlete
                    );
                    file_put_contents($database, json_encode($data_athletes));
                    echo "<p>Athlète ajouté avec succès à la base de données.</p>";
                }
                // Enregistrer les données dans le fichier JSON
                file_put_contents($fileName, json_encode($data));

                // Afficher un message de succès
                echo "<p>Athlète ajouté avec succès à la catégorie {$categorie}.</p>";
            }

            // Traitement du changement de catégorie
            if (isset($_POST['change_categorie']) && isset($_POST['new_categorie'])) {
                $nom_athlete = $_POST['change_categorie'];
                $new_categorie = $_POST['new_categorie'][0]; // Prendre seulement la première catégorie sélectionnée

                // Charger les données JSON existantes
                $fileName = "competitions/{$nom_competition}/athletes.json";
                $data = [];
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);
                }

                // Supprimer l'athlète de l'ancienne catégorie
                foreach ($data as $cat => $athletes) {
                    foreach ($athletes as $key => $athlete) {
                        if ($athlete['nom'] === $nom_athlete) {
                            unset($data[$cat][$key]);
                            // Si la catégorie devient vide, la supprimer
                            if (empty($data[$cat])) {
                                unset($data[$cat]);
                            }
                        }
                    }
                }

                // Ajouter l'athlète à la nouvelle catégorie
                $data[$new_categorie][] = array('nom' => $nom_athlete);

                // Enregistrer les données mises à jour dans le fichier JSON
                file_put_contents($fileName, json_encode($data));

                // Afficher un message de succès
                echo "<p>Changement de catégorie pour l'athlète '{$nom_athlete}' effectué avec succès.</p>";
            }

            // Traitement du changement de nom
            if (isset($_POST['modify_name']) && isset($_POST['athlete_name']) && isset($_POST['new_name'])) {
                $athlete_name = $_POST['athlete_name'];
                $new_name = $_POST['new_name'][0]; // Utiliser $_POST['new_name'] pour obtenir le nouveau nom

                // Charger les données JSON existantes
                $fileName = "competitions/{$nom_competition}/athletes.json";
                $data = [];
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);
                }

                // Parcourir les données pour trouver l'athlète et modifier son nom
                foreach ($data as $category => $athletes) {
                    foreach ($athletes as $key => $athlete) {
                        if ($athlete['nom'] === $athlete_name) {
                            $data[$category][$key]['nom'] = $new_name;
                        }
                    }
                }

                // Enregistrer les données mises à jour dans le fichier JSON
                file_put_contents($fileName, json_encode($data));

                // Afficher un message de succès
                echo "<p>Changement de nom pour l'athlète {$new_name} effectué avec succès.</p>";
            }

            // Traitement du changement de club
            if (isset($_POST['modify_club']) && isset($_POST['athlete_club']) && isset($_POST['new_club'])) {
                $athlete_club = $_POST['athlete_club'];
                $new_club = $_POST['new_club'][0]; // Utiliser $_POST['new_club'] pour obtenir le nouveau nom

                // Charger les données JSON existantes
                $fileName = "competitions/{$nom_competition}/athletes.json";
                $data = [];
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);
                }

                // Parcourir les données pour trouver l'athlète et modifier son nom
                foreach ($data as $category => $athletes) {
                    foreach ($athletes as $key => $athlete) {
                        if ($athlete['club'] === $athlete_club) {
                            $data[$category][$key]['club'] = $new_club;
                            $athlete_name = $athlete['nom'];
                        }
                    }
                }

                // Enregistrer les données mises à jour dans le fichier JSON
                file_put_contents($fileName, json_encode($data));

                // Afficher un message de succès
                echo "<p>Changement de club pour l'athlète {$athlete_name} vers {$new_club} effectué avec succès.</p>";
            }


            // Traitement de la suppression d'un athlète
            if (isset($_POST['delete_athlete']) && isset($_POST['athlete_name'])) {
                $athlete_name = $_POST['athlete_name'];

                // Charger les données JSON existantes
                $fileName = "competitions/{$nom_competition}/athletes.json";
                $data = [];
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);

                    // Parcourir les données pour trouver l'athlète et le supprimer
                    foreach ($data as $category => $athletes) {
                        foreach ($athletes as $key => $athlete) {
                            if ($athlete['nom'] === $athlete_name) {
                                unset($data[$category][$key]);
                                // Si la catégorie devient vide, la supprimer
                                if (empty($data[$category])) {
                                    unset($data[$category]);
                                }
                                break; // Sortir de la boucle dès que l'athlète est trouvé et supprimé
                            }
                        }
                    }

                    // Enregistrer les données mises à jour dans le fichier JSON
                    file_put_contents($fileName, json_encode($data));

                    // Afficher un message de succès
                    echo "<p>L'athlète '{$athlete_name}' a été supprimé avec succès.</p>";
                }
            }
            ?>

            <div class='w3-center w3-padding-48 w3-large'>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?competition={$nom_competition}"; ?>">
                    <label for="nom">Nom de l'athlète :</label>
                    <input class='w3-input w3-border name' style='background-color: rgb(32, 47, 74); color: white;' type="text" id="nom" name="nom" required oninput="showSuggestions()">
                    <div id="suggestions"></div> <!-- Div pour afficher les suggestions -->
                    <label for="club">Club de l'athlète :</label>
                    <input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type="text" id="club" name="club" required><br><br>
                    <script>
                        var searchInput = document.getElementById('nom');
                        var clubInput = document.getElementById('club');
                        var suggestionsDiv = document.getElementById('suggestions');
                        var athletes = []; // Liste pour stocker les noms d'athlètes et leurs clubs

                        // Charger le fichier JSON des athlètes
                        fetch('competitions/base_athletes.json')
                            .then(response => response.json())
                            .then(data => {
                                // Extraire les noms d'athlètes et leurs clubs du fichier JSON
                                athletes = data.athletes;
                            })
                            .catch(error => console.error('Erreur lors du chargement du fichier JSON:', error));

                        // Fonction pour afficher les suggestions correspondant à la recherche
                        function showSuggestions() {
                            var searchQuery = searchInput.value.toLowerCase();
                            suggestionsDiv.innerHTML = ''; // Effacer les suggestions précédentes
                            // Filtrer les suggestions en fonction de la recherche
                            var filteredSuggestions = athletes.filter(function(athlete) {
                                return athlete.nom.toLowerCase().indexOf(searchQuery) !== -1;
                            });
                            // Prendre seulement les 5 premières suggestions filtrées
                            var limitedSuggestions = filteredSuggestions.slice(0, 5);
                            // Afficher les suggestions limitées
                            limitedSuggestions.forEach(function(athlete) {
                                var suggestionElement = document.createElement('div');
                                suggestionElement.textContent = athlete.nom;
                                suggestionElement.onclick = function() {
                                    // Remplacer le contenu du champ de recherche par la suggestion cliquée
                                    searchInput.value = athlete.nom;
                                    clubInput.value = athlete.club; // Remplir le champ de club avec le club de l'athlète sélectionné
                                    suggestionsDiv.innerHTML = ''; // Effacer les suggestions après avoir choisi une suggestion
                                };
                                suggestionsDiv.appendChild(suggestionElement);
                            });
                            // Afficher les suggestions si le champ de recherche est non vide
                            suggestionsDiv.style.display = searchQuery.length > 0 ? 'block' : 'none';
                        }
                    </script>
                    <label for="categorie">Catégorie :</label>
                    <select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' id="categorie" name="categorie" onchange="saveLastCategory()" required>
                        <option value="u9 garcons">U9 Garçons</option>
                        <option value="u9 filles">U9 Filles</option>
                        <option value="u11 garcons">U11 Garçons</option>
                        <option value="u11 filles">U11 Filles</option>
                        <option value="u13 garcons">U13 Garçons</option>
                        <option value="u13 filles">U13 Filles</option>
                        <option value="u15 garcons">U15 Garçons</option>
                        <option value="u15 filles">U15 Filles</option>
                        <option value="u17 hommes">U17 Hommes</option>
                        <option value="u17 femmes">U17 Femmes</option>
                        <option value="u19 hommes">U19 Hommes</option>
                        <option value="u19 femmes">U19 Femmes</option>
                        <option value="u22 hommes">U22 Hommes</option>
                        <option value="u22 femmes">U22 Femmes</option>
                        <option value="senior hommes">Senior Hommes</option>
                        <option value="senior femmes">Senior Femmes</option>
                        <option value="m40 hommes">Master 40 Hommes</option>
                        <option value="m40 femmes">Master 40 Femmes</option>
                        <option value="m50 hommes">Master 50 Hommes</option>
                        <option value="m50 femmes">Master 50 Femmes</option>
                        <option value="m60 hommes">Master 60 Hommes</option>
                        <option value="m60 femmes">Master 60 Femmes</option>
                        <option value="m70 hommes">Master 70 Hommes</option>
                        <option value="m70 femmes">Master 70 Femmes</option>
                        <option value="para hommes">Para Hommes</option>
                        <option value="para femmes">Para Femmes</option>
                    </select><br><br>
                    <button class='w3-button' type="submit">Ajouter l'athlète</button>
                </form>
            </div>

            <center>
                <h2>Liste des athlètes :</h2>

                <?php
                // Afficher la liste des athlètes par catégorie
                $fileName = "competitions/{$nom_competition}/athletes.json";
                if (file_exists($fileName)) {
                    $data = json_decode(file_get_contents($fileName), true);
                    foreach ($data as $category => $athletes) {
                        echo "<h3>{$category}</h3>";
                        echo "<table style='width: 90%;' border='1'>";
                        echo "<tr><th>Nom</th><th>Modifier catégorie</th><th>Supprimer</th></tr>";
                        foreach ($athletes as $athlete) {
                            echo "<tr>";
                            echo "<form method='post' action='{$_SERVER["PHP_SELF"]}?competition={$nom_competition}'>";
                            echo "<td><center>";
                            echo "<div style='display: inline-block;'>";
                            echo "<input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='new_name[]' value='{$athlete['nom']}' required>";
                            echo "<input type='hidden' name='athlete_name' value='{$athlete['nom']}'>";
                            echo "</div>";
                            echo "<div style='display: inline-block;'>";
                            echo "<button class='w3-button' type='submit' name='modify_name' value=''>Modifier nom</button>";
                            echo "</div>";
                            echo "</center></td>";

                            echo "<td><center>";
                            echo "<div style='display: inline-block;'>";
                            echo "<input class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' type='text' name='new_club[]' value='{$athlete['club']}' required>";
                            echo "<input type='hidden' name='athlete_club' value='{$athlete['club']}'>";
                            echo "</div>";
                            echo "<div style='display: inline-block;'>";
                            echo "<button class='w3-button' type='submit' name='modify_club' value=''>Modifier club</button>";
                            echo "</div>";
                            echo "</center></td>";

                            echo "<td><center>";
                            echo "<div style='display: inline-block;'>";
                            echo "<select class='w3-input w3-border' style='background-color: rgb(32, 47, 74); color: white;' name='new_categorie[]' required>";
                            foreach ($data as $cat => $value) {
                                $selected = ($category === $cat) ? 'selected' : '';
                                echo "<option value='{$cat}' {$selected}>{$cat}</option>";
                            }
                            echo "</select>";
                            echo "</div>";
                            echo "<div style='display: inline-block;'>";
                            echo "<button class='w3-button' type='submit' name='change_categorie' value='{$athlete['nom']}'>Changer de catégorie</button>";
                            echo "</div>";
                            echo "</center></td>";


                            echo "<td><center>";
                            echo "<button class='w3-button' type='submit' name='delete_athlete' value='Delete'>Supprimer</button>";
                            echo "</center></td>";
                            echo "</form>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    }
                } else {
                    echo "<p>Aucun athlète ajouté pour le moment.</p>";
                }
                ?>

                <h2>Ajouter les temps :</h2>
                <button class='w3-button' onclick="window.location.href='ajouter_temps_nat.php?competition=<?php echo $nom_competition; ?>'">Ajouter temps de natation</button>
                <button class='w3-button' onclick="window.location.href='ajouter_temps_lr.php?competition=<?php echo $nom_competition; ?>'">Ajouter temps de laser run</button></br>
                <a class='w3-button' href="compet.php">Retour à l'accueil</a>
            </center>
    <?php }
} else {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge' style='background-color: rgb(32, 47, 74); color: white;'>
  <h2 class='w3-center'>Autorisation non accordée</h2>
  </div>";
}
footer();
echo "</body>";
    ?>