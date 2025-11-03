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

$discipline = $_GET['discipline'] ?? null;
$competition = $_GET['competition'] ?? null;

if (!$discipline || !$competition) {
    echo "<p style='color:red;'>Paramètres manquants (discipline ou compétition).</p>";
    echo "<a class='w3-button w3-gray' href='creer_competition.php'>Retour</a>";
    footer();
    exit;
}

$competition_path = "competitions/{$discipline}/{$competition}";
$file_json = "$competition_path/athletes.json";
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
            </select>

            <button class="w3-button w3-blue" type="submit" style="margin-top:10px;">Ajouter</button>
        </form>
    </div>

    <h3>Liste des athlètes</h3>
    <div id="athletes-container" style="width:80%; text-align:left;"></div>
</center>

<script>
const container = document.getElementById('athletes-container');
const formAdd = document.getElementById('form-add');

function getCategoriesList() {
    const cats = [
        "u9 garcons","u9 filles","u11 garcons","u11 filles","u13 garcons","u13 filles","u15 garcons","u15 filles",
        "u17 hommes","u17 femmes","u19 hommes","u19 femmes","u22 hommes","u22 femmes","senior hommes","senior femmes",
        "m40 hommes","m40 femmes","m50 hommes","m50 femmes","m60 hommes","m60 femmes","m70 hommes","m70 femmes",
        "para hommes","para femmes"
    ];
}

function categoryLabel(cat) {
    return cat.replace(/(^|\s)\S/g, t => t.toUpperCase());
}

// Charger les athlètes triés
async function loadAthletes() {
    const res = await fetch('endpoints/get_athletes.php?discipline=<?= urlencode($discipline) ?>&competition=<?= urlencode($competition) ?>');
    const data = await res.json();
    if (!data.ok) {
        container.innerHTML = "<p style='color:red;'>Erreur lors du chargement.</p>";
        return;
    }

    const athletes = Object.entries(data.athletes || {});
    // Regrouper par catégorie
    const grouped = {};
    athletes.forEach(([id, a]) => {
        if (!grouped[a.categorie]) grouped[a.categorie] = [];
        grouped[a.categorie].push({ id, ...a });
    });

    // Trier les catégories et les athlètes par nom
    const categories = Object.keys(grouped).sort();
    for (const cat in grouped) {
        grouped[cat].sort((a,b) => a.nom.localeCompare(b.nom, 'fr', { sensitivity: 'base' }));
    }

    // Construction HTML
    container.innerHTML = '';
    categories.forEach(cat => {
        const athletesList = grouped[cat];
        const section = document.createElement('div');
        section.classList.add('cat-section');

        const header = document.createElement('h3');
        header.innerHTML = `▶ ${categoryLabel(cat)} <span style="font-size:0.8em; color:gray;">(${athletesList.length})</span>`;
        header.style.cursor = "pointer";
        header.style.background = "#1e2f4d";
        header.style.padding = "8px";
        header.style.borderRadius = "8px";

        const table = document.createElement('table');
        table.className = "w3-table w3-bordered";
        table.style.marginBottom = "15px";
        table.style.display = "none"; // masqué par défaut

        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr style="background-color:#14233d;">
                <th>Nom</th><th>Club</th><th>Catégorie</th><th style="text-align:center;">Actions</th>
            </tr>`;
        table.appendChild(thead);

        const tbody = document.createElement('tbody');
        athletesList.forEach(a => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input data-id="${a.id}" data-field="nom" class="edit w3-input" style="background:#20304a; color:white" value="${a.nom}"></td>
                <td><input data-id="${a.id}" data-field="club" class="edit w3-input" style="background:#20304a; color:white" value="${a.club}"></td>
                <td>
                    <select data-id="${a.id}" data-field="categorie" class="edit w3-input" style="background:#20304a; color:white">
                        ${getCategoriesList().map(c => `<option value="${c}" ${c===a.categorie?'selected':''}>${categoryLabel(c)}</option>`).join('')}
                    </select>
                </td>
                <td style="text-align:center;">
                    <button class="w3-button w3-green save" data-id="${a.id}">💾</button>
                    <button class="w3-button w3-red delete" data-id="${a.id}">🗑️</button>
                </td>`;
            tbody.appendChild(row);
        });
        table.appendChild(tbody);
        section.appendChild(header);
        section.appendChild(table);
        container.appendChild(section);

        // Toggle ouverture/fermeture catégorie
        header.addEventListener('click', () => {
            const open = table.style.display === "table";
            document.querySelectorAll('.cat-section table').forEach(t => t.style.display = 'none');
            document.querySelectorAll('.cat-section h3').forEach(h => h.innerHTML = h.innerHTML.replace('▼','▶'));
            if (!open) {
                table.style.display = "table";
                header.innerHTML = header.innerHTML.replace('▶','▼');
            }
        });
    });
}

// Ajouter un athlète
formAdd.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(formAdd);
    const res = await fetch('endpoints/add_athlete.php', { method: 'POST', body: formData });
    const data = await res.json();
    if (data.ok) {
        formAdd.reset();
        loadAthletes();
    } else alert(data.error);
});

// Sauvegarde / suppression
container.addEventListener('click', async e => {
    const id = e.target.dataset.id;
    if (e.target.classList.contains('save')) {
        const inputs = container.querySelectorAll(`[data-id="${id}"]`);
        const payload = {
            discipline: "<?= $discipline ?>",
            competition: "<?= $competition ?>",
            id: id
        };
        inputs.forEach(el => payload[el.dataset.field] = el.value);
        const res = await fetch('endpoints/update_athlete.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.ok) loadAthletes(); else alert(data.error);
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
            if (data.ok) loadAthletes(); else alert(data.error);
        }
    }
});

loadAthletes();
</script>

<?php
footer();
echo "</body>";
?>
