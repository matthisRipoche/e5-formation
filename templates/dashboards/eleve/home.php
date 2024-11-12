<?php
$eleveHomeController = new EleveHomeController();
//get user connected
$eleve = $_SESSION['user'];

dump($_POST)
?>

<main class="admin-page container-fluid">

    <!-- Je veux le code ici -->
    <section class="welcome-message mt-4">
        <h2>Bienvenue, <?php echo htmlspecialchars($eleve->getFirstname()) . ' ' . htmlspecialchars($eleve->getLastname()); ?> !</h1>
    </section>

    <section class="admin-stats container mt-5">
        <h2>Voici vos cours du jour :</h2>
        <?php
        if ($eleve->getClasse()->getId()) :
            $classe = $eleve->getClasse()->getId();
            //get all cours for the class for the day
            $stmt = $pdo->prepare('SELECT * FROM cours WHERE classe = :class_id' . ' AND date = CURDATE()');
            $stmt->bindParam(':class_id', $classe, PDO::PARAM_INT);
            $stmt->execute();
            $coursListe = $stmt->fetchAll();
        ?>
            <?php if ($coursListe) : ?>
                <?php foreach ($coursListe as $cours) :
                    $matierename = new Matiere($cours['matiere']);
                    $classename = new Classe($cours['classe']);
                    $profname = new User($cours['enseignant']);


                    $eleveID = $eleve->getId();
                    $coursID = $cours['id'];
                    $stmt = $pdo->prepare('SELECT * FROM signature WHERE eleve = :eleve AND cour = :cours');
                    $stmt->bindParam(':eleve', $eleveID, PDO::PARAM_INT);
                    $stmt->bindParam(':cours', $coursID, PDO::PARAM_INT);
                    $stmt->execute();
                    $sign = $stmt->fetch();
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
                                    <?php if (isset($sign) && !empty($sign)): ?>
                                        <p>Signé</p>
                                    <?php else: ?>
                                        <input class="btn btn-primary openmodal" type="submit" name="sign-cours" value="Signer">
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