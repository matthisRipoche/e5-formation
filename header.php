<?php
include_once 'functions.php';
$baseUrl = '/e5-formation/'; // Définissez le chemin de base pour votre projet
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $baseUrl ?>style/style.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>bootstrap/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script src="libs/jSignature.min.js"></script>

    <title>Formation</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo_container">
                    <h2><a href="/e5-formation/home">Sign and Work</a></h2>
                </div>
                <div>
                    <?php
                    session_start();
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        echo '<a href="/e5-formation/logout">logout</a>';
                    } else {
                        echo '<a href="/e5-formation/login">login</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>