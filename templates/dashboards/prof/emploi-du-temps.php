<?php
isSessionOK();
$enseignantEDTController = new EnseignantEDTController();
//get user connected
$enseignant = $_SESSION['user'];

$cours = $enseignantEDTController->getCours($enseignant->id);

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