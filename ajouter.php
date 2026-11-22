<?php
require_once 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personne_id = (int)($_POST['personne_id'] ?? 0);
    $poids       = (float)($_POST['poids'] ?? 0);
    $taille      = (float)($_POST['taille'] ?? 0);

    if ($personne_id > 0 && $poids >= 20 && $poids <= 300 && $taille >= 0.5 && $taille <= 2.5) {

        $imc = round($poids / ($taille * $taille), 1);

        if ($imc < 18.5)     $categorie = 'Sous-poids';
        elseif ($imc < 25)   $categorie = 'Normal';
        elseif ($imc < 30)   $categorie = 'Surpoids';
        else                 $categorie = 'Obésité';

        $stmt = $pdo->prepare("INSERT INTO mesures (personne_id, poids, taille, imc, categorie)
                               VALUES (:personne_id, :poids, :taille, :imc, :categorie)");
        $stmt->execute([
            ':personne_id' => $personne_id,
            ':poids'       => $poids,
            ':taille'      => $taille,
            ':imc'         => $imc,
            ':categorie'   => $categorie,
        ]);
    }
}

header('Location: index.php');
exit;