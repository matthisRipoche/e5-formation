<?php
isSessionOK();
$enseignanthomeController = new EnseignantHomeController();
$prof = $_SESSION['user'];
?>

<?php include_once 'header.php'; ?>

<main class="admin-page container-fluid">

    <section class="welcome-message mt-4">
        <h2>Bienvenue, <?php echo htmlspecialchars($prof->getFirstname()) . ' ' . htmlspecialchars($prof->getLastname()); ?> !</h1>
    </section>

    <section class="admin-stats container mt-5">
        <h2>Voici vos cours du jour :</h2>
        <?php
        if ($prof->getId()) :
            $enseignant = $prof->getId();
            //get all cours for the class for the day
            $stmt = $pdo->prepare('SELECT * FROM cours WHERE enseignant = :enseignant' . ' AND date = CURDATE()');
            $stmt->bindParam(':enseignant', $enseignant, PDO::PARAM_INT);
            $stmt->execute();
            $coursListe = $stmt->fetchAll();
        ?>
            <?php if ($coursListe) : ?>
                <?php foreach ($coursListe as $cours) :
                    $matierename = new Matiere($cours['matiere']);
                    $classename = new Classe($cours['classe']);
                    $profname = new User($cours['enseignant']);
                ?>
                    <div class="card border-0 shadow-sm mb-4 rounded-lg mt-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($matierename->getName()); ?></h5>
                                    <p class="card-text small"><?php echo htmlspecialchars($classename->getName()); ?></p>
                                </div>
                                <div>
                                    <h5 class="card-title">Professeur: <?php echo htmlspecialchars('M. ' . $profname->getLastname()); ?></h5>
                                </div>
                                <div>
                                    <p class="card-texte small">Le <?php echo htmlspecialchars($cours['date']) ?></p>
                                    <p class="card-text small">De <?php echo htmlspecialchars($cours['timestart']); ?> à <?php echo htmlspecialchars($cours['timeend']); ?></p>
                                </div>

                                <form action="" method="post">
                                    <input type="hidden" name="sign-cours-id" value="<?php echo $cours['id']; ?>">
                                    <?php if ($cours['statut'] == 0): ?>
                                        <input class="btn btn-primary" type="submit" name="enablesign" value="Appel">
                                    <?php else: ?>
                                        <p>Validé</p>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    Aucun cours pour aujourd'hui
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</main>