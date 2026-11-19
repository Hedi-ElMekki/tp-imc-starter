<?php
// ==========================================================
// EXERCICE 7.1 : CONNEXION À LA BASE DE DONNÉES VIA PDO
// ==========================================================
 
$host = 'localhost';
$dbname = 'imc_db';
$username = 'root';
$password = ''; // Vide par défaut sur XAMPP
 
try {
    // TODO 1 : Instancier l'objet $pdo avec le DSN mysql, charset=utf8mb4
    
    // TODO 2 : Configurer le mode d'erreur sur PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
