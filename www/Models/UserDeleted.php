<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Models\User;
use App\Models\UserValidator;
use App\Models\UserLoginValidator;
use App\Core\View;
use App\Core\SQL;

session_start(); 


if (isset($_SESSION['email'])) { 
    $email = $_SESSION['email'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=nom_de_ta_base", "utilisateur", "mot_de_passe");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $email, PDO::PARAM_INT);
        $stmt->execute();

        session_destroy();

        header("Location: index.php?message=compte_supprime");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Utilisateur non connecté.";
}
?>
