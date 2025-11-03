<?php
include 'fonction.php';
entete();
echo "<link rel='stylesheet' href='style/parametres.css'>";
navbar();
echo "<body style='background-color: rgb(32, 47, 74); color:white'>";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<div class='w3-center w3-padding-48 w3-xxlarge'>
            <h2>Autorisation non accordée</h2>
          </div>";
    footer();
    exit;
}

// --- Paramètres ---
$discipline = $_GET['discipline'] ?? null;
$competition = $_GET['competition'] ?? null;

if (!$discipline || !$competition) {
    echo "<p style='color:red;'>Paramètres manquants (discipline ou compétition).</p>";
    echo "<a class='w3-button w3-gray' href='creer_competition.php'>Retour</a>";
    footer();
    exit;
}

// --- Fichier JSON de la compétition ---
$competition_path = "competitions/{$discipline}/{$competition}";
$file_json = "$competition_path/athletes.json";

// --- Création du fichier si inexistant ---
if (!file_exists($file_json)) {
    file_put_contents($file_json, json_encode(['athletes' => []], JSON_PRETTY_PRINT));
}
?>

<center>
    <h1>Gestion des athlètes - <?= ucfirst($discipline) ?> / <?= htmlspecialchars($competition) ?></h1>

    <div style="margin-bottom: 20px;">
        <button class="w3-button w3-gray" onclick="window.location.href='ouvrir_competition.php'">← Retour</button>
    </div>

    <div style="width: 80%; text-align: left; margin-bottom: 20px;">
        <h3>Ajouter un athlète</h3>
        <form id="form-add" class="w3-container" style="background:#20304a; padding:15px; border-radius:10px;">
            <input type="hidden" name="discipline" value="<?= htmlspecialchars($discipline) ?>">
            <input type="hidden" name="competition" value="<?= htmlspecialchars($competition) ?>">

            <label>Nom :</label>
            <input class="w3-input w3-border" style="background:#20304a; color:white" name="nom" required>

            <label>Club :</label>
            <input class="w3-input w3-border" style="background:#20304a; color:white" name="club" required>

            <label>Catégorie :</label>
            <select class="w3-input w3-border" style="background:#20304a; color:white" name="categorie" required>
                <option value="">-- Choisir --</option>
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
            </select>

            <button class="w3-button w3-blue" type="submit" style="margin-top:10px;">Ajouter</button>
        </form>
    </div>

    <h3>Liste des athlètes</h3>
    <table id="athletes-table" class="w3-table w3-bordered w3-hoverable" style="width:80%; color:white;">
        <thead>
            <tr style="background-color:#1e2f4d;">
                <th>Nom</th>
                <th>Club</th>
                <th>Catégorie</th>
                <th style="text-align:center;">Actions</th>
            </tr>
        </thead>
        <tbody id="athletes-body"></tbody>
    </table>
</center>

<script>
const tableBody = document.getElementById('athletes-body');
const formAdd = document.getElementById('form-add');

// Charger les athlètes existants
async function loadAthletes() {
    const res = await fetch('endpoints/get_athletes.php?discipline=<?= urlencode($discipline) ?>&competition=<?= urlencode($competition) ?>');
    const data = await res.json();
    tableBody.innerHTML = '';
    if (data.ok && data.athletes) {
        Object.entries(data.athletes).forEach(([id, a]) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input data-id="${id}" data-field="nom" class="edit w3-input" style="background:#20304a; color:white" value="${a.nom}"></td>
                <td><input data-id="${id}" data-field="club" class="edit w3-input" style="background:#20304a; color:white" value="${a.club}"></td>
                <td>
                    <select data-id="${id}" data-field="categorie" class="edit w3-input" style="background:#20304a; color:white">
                        ${getCategories(a.categorie)}
                    </select>
                </td>
                <td style="text-align:center;">
                    <button class="w3-button w3-green save" data-id="${id}">💾</button>
                    <button class="w3-button w3-red delete" data-id="${id}">🗑️</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    } else {
        tableBody.innerHTML = "<tr><td colspan='4'>Aucun athlète trouvé.</td></tr>";
    }
}

function getCategories(selected) {
    const cats = [
        "u9 garcons","u9 filles","u11 garcons","u11 filles","u13 garcons","u13 filles","u15 garcons","u15 filles",
        "u17 hommes","u17 femmes","u19 hommes","u19 femmes","senior hommes","senior femmes","m40 hommes","m40 femmes",
        "m50 hommes","m50 femmes","m60 hommes","m60 femmes","m70 hommes","m70 femmes","para hommes","para femmes"
    ];
    return cats.map(c => `<option value="${c}" ${c === selected ? 'selected' : ''}>${c}</option>`).join('');
}

// Ajouter un athlète
formAdd.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(formAdd);
    const res = await fetch('endpoints/add_athlete.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.ok) {
        alert('Athlète ajouté ✅');
        formAdd.reset();
        loadAthletes();
    } else {
        alert('Erreur : ' + data.error);
    }
});

// Sauvegarde / suppression
tableBody.addEventListener('click', async e => {
    const id = e.target.dataset.id;
    if (e.target.classList.contains('save')) {
        const row = tableBody.querySelectorAll(`[data-id="${id}"]`);
        const payload = {
            discipline: "<?= $discipline ?>",
            competition: "<?= $competition ?>",
            id: id
        };
        row.forEach(el => payload[el.dataset.field] = el.value);
        const res = await fetch('endpoints/update_athlete.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.ok) alert('Modifié ✅'); else alert('Erreur: ' + data.error);
    }
    if (e.target.classList.contains('delete')) {
        if (confirm("Supprimer cet athlète ?")) {
            const res = await fetch('endpoints/delete_athlete.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    discipline: "<?= $discipline ?>",
                    competition: "<?= $competition ?>",
                    id: id
                })
            });
            const data = await res.json();
            if (data.ok) {
                alert('Supprimé ✅');
                loadAthletes();
            } else alert('Erreur: ' + data.error);
        }
    }
});

loadAthletes();
</script>

<?php
footer();
echo "</body>";
?>
