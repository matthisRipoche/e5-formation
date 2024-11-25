<?php
isSessionOK();
$eleveEDTController = new EleveEDTController();
//get user connected
$eleve = $_SESSION['user'];

$classID = $eleve->getClasse()->getID();
// Récupère les cours de la classe
$cours = $eleveEDTController->getCours($classID);

// Encode les cours en JSON
$coursJSON = json_encode($cours);
?>

<?php include_once 'header.php' ?>

<main class="admin-page container-fluid">
    <section class="admin-stats container mt-5">
        <h2>Voici vos cours du jour :</h2>
        <a href="/e5-formation/home" class="float-right"><small>Retour</small></a>

        <div class="calendar_container my-5">
            <div id="elevecalendar" data-cours='<?php echo $coursJSON; ?>'></div>
        </div>
    </section>
</main>