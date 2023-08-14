<?php
include 'fonction.php';
entete();
navbar();
echo "<body style='background-color: rgb(32, 47, 74);'>";
?>

<div class="tab" style='background-color: rgb(32, 47, 74); font-size: 40px'><center>
<h1 style='color: white;'>Record</h1>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutarticle')">Ajouter un article</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'supparticle')">Supprimer un article</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'ajoutimagecarousel')">Ajouter une image</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'suppimagecarousel')">Supprimer une image</button>
  <button class="tablinks" style='background-color: rgb(32, 47, 74); color: white' onclick="openTab(event, 'changerecord')">Changer un record</button>
</center></div>
<div id="messageDiv">
    <?php
    if (isset($_SESSION['ajoutimagecarousel_message'])) {
        $message = $_SESSION['ajoutimagecarousel_message'];
        echo "<div style='background-color: rgb(32, 47, 74);'>
            <center><p class='w3-text-green' style='font-size: 24px;'>$message</p></center>
        </div>";
        unset($_SESSION['ajoutimagecarousel_message']); // Efface le message après l'affichage
    }
    ?>
</div>

<div id="ajoutarticle" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutarticle();
    if (isset($_GET['ajoutarticle_message'])) {
        echo "<div style='background-color: rgb(32, 47, 74);'>
                <center><p class='w3-text-green' style='font-size: 24px;'>{$_GET['ajoutarticle_message']}</p></center>
              </div>";
    }
    ?>
  </table>
</div>

<div id="supparticle" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    supparticle();
    if (isset($_GET['supparticle_message'])) {
        echo "<div style='background-color: rgb(32, 47, 74);'>
                <center><p class='w3-text-green' style='font-size: 24px;'>{$_GET['supparticle_message']}</p></center>
              </div>";
    }
    ?>
  </table>
</div>

<div id="ajoutimagecarousel" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    ajoutimagecarousel();
    if (isset($_GET['ajoutimagecarousel_message'])) {
        echo "<div style='background-color: rgb(32, 47, 74);'>
                <center><p class='w3-text-green' style='font-size: 24px;'>{$_GET['ajoutimagecarousel_message']}</p></center>
              </div>";
    }
    ?>
  </table>
</div>

<div id="suppimagecarousel" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    suppimagecarousel();
    if (isset($_GET['suppimagecarousel_message'])) {
        echo "<div style='background-color: rgb(32, 47, 74);'>
                <center><p class='w3-text-green' style='font-size: 24px;'>{$_GET['suppimagecarousel_message']}</p></center>
              </div>";
    }
    ?>
  </table>
</div>

<div id="changerecord" class="tabcontent" style='background-color: rgb(32, 47, 74); color: white; margin: 0 auto;'>
  <table>
  <?php
    changerecord();
    if (isset($_GET['changerecord_message'])) {
        echo "<div style='background-color: rgb(32, 47, 74);'>
                <center><p class='w3-text-green' style='font-size: 24px;'>{$_GET['changerecord_message']}</p></center>
              </div>";
    }
    ?>
  </table>
</div>

<?php
footer();
echo "</body>";
?>
<style>
    .tab {
  overflow: hidden;
}

.tab button {
  background-color: #ccc;
  border: none;
  color: black;
  padding: 10px 20px;
  cursor: pointer;
}

.tab button:hover {
  background-color: #ddd;
}

.tab button.active {
  background-color: #fff;
}

.tabcontent {
  display: none;
  padding: 20px;
  border: 1px solid #ccc;
}
</style>
<script>
    function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
