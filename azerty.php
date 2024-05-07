<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir JPEG en WebP</title>
</head>

<body>
    <h1>Convertir une image JPEG en WebP</h1>

    <?php
    // Vérifier si le formulaire a été soumis et que le fichier a été sélectionné
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['imageFile'])) {
        $errors = array();
        $file_name = $_FILES['imageFile']['name'];
        $file_tmp = $_FILES['imageFile']['tmp_name'];
        $file_parts = explode('.', $_FILES['imageFile']['name']);
        $file_ext = strtolower(end($file_parts));


        // Extensions autorisées
        $extensions = array("jpeg", "jpg", "png");

        // Vérifier l'extension du fichier
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension non autorisée, veuillez choisir une image JPEG ou PNG.";
        }

        // Si pas d'erreurs
        if (empty($errors) == true) {
            // Création de l'image à partir du fichier
            if ($file_ext == "jpeg" || $file_ext == "jpg") {
                $image = imagecreatefromjpeg($file_tmp);
            } elseif ($file_ext == "png") {
                $image = imagecreatefrompng($file_tmp);
            }

            // Chemin de destination pour l'image WebP
            $webpFilePath = pathinfo($file_name, PATHINFO_FILENAME) . '.webp';

            // Enregistrement de l'image au format WebP
            imagewebp($image, $webpFilePath);

            // Libération de la mémoire
            imagedestroy($image);

            echo 'L\'image a été convertie en WebP avec succès! <a href="' . $webpFilePath . '" download>Télécharger</a>';
        } else {
            print_r($errors);
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="imageFile" accept="image/jpeg, image/png" required>
        <input type="submit" value="Convertir JPEG en WebP">
    </form>
</body>

</html>