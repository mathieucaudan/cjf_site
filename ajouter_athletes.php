<?php
include 'fonction.php';
exiger_admin('Athlètes');

$discipline = $_GET['discipline'] ?? '';
$competition = $_GET['competition'] ?? '';
if (!competition_valide($discipline, $competition)) {
    header('Location: ouvrir_competition.php');
    exit;
}

$file_json = "competitions/{$discipline}/{$competition}/athletes.json";
if (!file_exists($file_json)) {
    file_put_contents($file_json, json_encode(['athletes' => []], JSON_PRETTY_PRINT));
}
$q = 'competition=' . urlencode($competition) . '&discipline=' . urlencode($discipline);
$categories = [
    'u9 garcons' => 'U9 Garçons', 'u9 filles' => 'U9 Filles', 'u11 garcons' => 'U11 Garçons', 'u11 filles' => 'U11 Filles',
    'u13 garcons' => 'U13 Garçons', 'u13 filles' => 'U13 Filles', 'u15 garcons' => 'U15 Garçons', 'u15 filles' => 'U15 Filles',
    'u17 hommes' => 'U17 Hommes', 'u17 femmes' => 'U17 Femmes', 'u19 hommes' => 'U19 Hommes', 'u19 femmes' => 'U19 Femmes',
    'u22 hommes' => 'U22 Hommes', 'u22 femmes' => 'U22 Femmes', 'senior hommes' => 'Senior Hommes', 'senior femmes' => 'Senior Femmes',
    'm40 hommes' => 'Master 40 Hommes', 'm40 femmes' => 'Master 40 Femmes', 'm50 hommes' => 'Master 50 Hommes', 'm50 femmes' => 'Master 50 Femmes',
    'm60 hommes' => 'Master 60 Hommes', 'm60 femmes' => 'Master 60 Femmes', 'm70 hommes' => 'Master 70 Hommes', 'm70 femmes' => 'Master 70 Femmes',
    'para hommes' => 'Para Hommes', 'para femmes' => 'Para Femmes', 'open hommes' => 'Open Hommes', 'open femmes' => 'Open Femmes',
];

entete('Athlètes : ' . $competition);
navbar();
bandeau($competition, 'Athlètes inscrits en ' . ($discipline === 'triathle' ? 'triathlé' : 'laser run') . '.', true);
?>

<section class="section section--serre">
  <div class="wrap">
    <p class="fil"><a href="compet.php">Compétitions</a> / <a href="ouvrir_competition.php?discipline=<?= urlencode($discipline) ?>">Ouvrir</a> / Athlètes</p>
    <?php if (isset($_GET['cree'])) message_admin('Compétition créée. Ajoutez maintenant les athlètes.'); ?>

    <div class="admin-panel">
      <h2>Ajouter un athlète</h2>
      <form id="form-add" class="formulaire">
        <input type="hidden" name="discipline" value="<?= e($discipline) ?>">
        <input type="hidden" name="competition" value="<?= e($competition) ?>">
        <label for="ath-nom">Nom et prénom</label>
        <input id="ath-nom" class="w3-input" name="nom" required>
        <label for="ath-club">Club</label>
        <input id="ath-club" class="w3-input" name="club" required>
        <label for="ath-cat">Catégorie</label>
        <select id="ath-cat" class="w3-input" name="categorie" required>
          <option value="">Choisir une catégorie</option>
          <?php foreach ($categories as $val => $lib): ?>
            <option value="<?= e($val) ?>"><?= e($lib) ?></option>
          <?php endforeach; ?>
        </select>
        <button class="w3-button" type="submit">Ajouter l'athlète</button>
      </form>
    </div>

    <div class="admin-panel">
      <h2>Athlètes inscrits</h2>
      <p>Cliquez sur une catégorie pour modifier ou retirer ses athlètes.</p>
      <div id="athletes-container"></div>
    </div>

    <div class="boutons">
      <?php if ($discipline === 'triathle'): ?>
        <a class="btn" href="ajouter_temps_nat.php?<?= $q ?>">Saisir les temps de natation</a>
      <?php endif; ?>
      <a class="btn" href="ajouter_temps_lr.php?<?= $q ?>">Saisir les temps de laser run</a>
      <a class="btn btn--contour" href="resultats.php?title=<?= urlencode('Résultats ' . $competition) ?>&file=<?= urlencode($file_json) ?>&discipline=<?= urlencode($discipline) ?>">Voir les résultats</a>
    </div>
  </div>
</section>

<script>
const container = document.getElementById('athletes-container');
const formAdd = document.getElementById('form-add');

// ✅ Correction : cette fonction doit retourner le tableau !
function getCategoriesList() {
    return [
        "u9 garcons","u9 filles","u11 garcons","u11 filles","u13 garcons","u13 filles","u15 garcons","u15 filles",
        "u17 hommes","u17 femmes","u19 hommes","u19 femmes","u22 hommes","u22 femmes","senior hommes","senior femmes",
        "m40 hommes","m40 femmes","m50 hommes","m50 femmes","m60 hommes","m60 femmes","m70 hommes","m70 femmes",
        "para hommes","para femmes","open femmes","open hommes"
    ];
}

function categoryLabel(cat) {
    return cat.replace(/(^|\s)\S/g, t => t.toUpperCase());
}

async function loadAthletes() {
    const res = await fetch('endpoints/get_athletes.php?discipline=<?= urlencode($discipline) ?>&competition=<?= urlencode($competition) ?>');
    const data = await res.json();
    if (!data.ok) {
        container.innerHTML = "<div class='message message--erreur'>La liste des athlètes n'a pas pu être chargée. Rechargez la page.</div>";
        return;
    }

    const athletes = Object.entries(data.athletes || {});
    const grouped = {};

    athletes.forEach(([id, a]) => {
        if (!grouped[a.categorie]) grouped[a.categorie] = [];
        grouped[a.categorie].push({ id, ...a });
    });

    const categories = Object.keys(grouped).sort();
    for (const cat in grouped) {
        grouped[cat].sort((a,b) => a.nom.localeCompare(b.nom, 'fr', { sensitivity: 'base' }));
    }

    container.innerHTML = '';
    categories.forEach(cat => {
        const athletesList = grouped[cat];
        const section = document.createElement('div');
        section.classList.add('cat-section');

        const header = document.createElement('h3');
        header.innerHTML = `▶ ${categoryLabel(cat)} <span style="font-size:0.8em; color:var(--granite);">(${athletesList.length})</span>`;
        header.tabIndex = 0;
        header.setAttribute('role', 'button');
        header.addEventListener('keydown', ev => { if (ev.key === 'Enter' || ev.key === ' ') { ev.preventDefault(); header.click(); } });

        const table = document.createElement('table');
        table.className = "w3-table tableau";
        table.style.display = "none";

        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr>
                <th>Nom</th><th>Club</th><th>Catégorie</th><th>Actions</th>
            </tr>`;
        table.appendChild(thead);

        const tbody = document.createElement('tbody');
        athletesList.forEach(a => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input data-id="${a.id}" data-field="nom" class="edit w3-input" value="${a.nom}"></td>
                <td><input data-id="${a.id}" data-field="club" class="edit w3-input" value="${a.club}"></td>
                <td>
                    <select data-id="${a.id}" data-field="categorie" class="edit w3-input">
                        ${getCategoriesList().map(c => `<option value="${c}" ${c===a.categorie?'selected':''}>${categoryLabel(c)}</option>`).join('')}
                    </select>
                </td>
                <td style="white-space:nowrap;">
                    <button class="btn btn--petit save" data-id="${a.id}">Enregistrer</button>
                    <button class="btn btn--danger btn--petit delete" data-id="${a.id}">Retirer</button>
                </td>`;
            tbody.appendChild(row);
        });
        table.appendChild(tbody);
        section.appendChild(header);
        section.appendChild(table);
        container.appendChild(section);

        // Déroulement
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

// Ajouter
formAdd.addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(formAdd);
    const res = await fetch('endpoints/add_athlete.php', { method: 'POST', headers: {'X-CSRF-Token': window.CJF_CSRF}, body: formData });
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
            discipline: <?= json_encode($discipline) ?>,
            competition: <?= json_encode($competition) ?>,
            id: id
        };
        inputs.forEach(el => payload[el.dataset.field] = el.value);
        const res = await fetch('endpoints/update_athlete.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-Token': window.CJF_CSRF},
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.ok) loadAthletes(); else alert(data.error);
    }
    if (e.target.classList.contains('delete')) {
        if (confirm("Supprimer cet athlète ?")) {
            const res = await fetch('endpoints/delete_athlete.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-Token': window.CJF_CSRF},
                body: JSON.stringify({
                    discipline: <?= json_encode($discipline) ?>,
                    competition: <?= json_encode($competition) ?>,
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

<?php footer(); ?>
