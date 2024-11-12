<?php
$adminHomeController = new AdminHomeController();
?>

<main class="admin-page container-fluid">
    <?php require_once 'templates/dashboards/parts/admin/nav.php'; ?>

    <section class="admin-stats container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4 rounded-lg text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="icon me-3">
                                <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1"><?php echo $adminHomeController->getNbEleves(); ?> Elèves</h5>
                                <p class="card-text small">Total des étudiants inscrits</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4 rounded-lg text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="icon me-3">
                                <i class="bi bi-person-badge-fill" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1"><?php echo $adminHomeController->getNbProfs(); ?> Professeurs</h5>
                                <p class="card-text small">Nombre de professeurs actifs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm mb-4 rounded-lg text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="icon me-3">
                                <i class="bi bi-person-check-fill" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1"><?php echo $adminHomeController->getNbAdmins(); ?> Admins</h5>
                                <p class="card-text small">Administrateurs actifs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Faire des cartes des cours de la journée pour une classe donnée -->

    <section class="admin-stats container mt-5">
        <form action="" method="post">
            <div class="form-group d-flex">
                <div class="flex-grow-1 ms-2">
                    <label for="classe">Classe</label>
                    <select class="form-select" id="classe" name="select-classe" required>
                        <option selected>Choisir une classe</option>
                        <?php
                        $stmt = $pdo->query('SELECT * FROM classes');
                        while ($row = $stmt->fetch()) : ?>
                            <option value="<?php echo $row['id']; ?>" <?php if (isset($_POST['select-classe'])) {
                                                                            echo ($_POST['select-classe'] == $row['id'] ? 'selected' : '');
                                                                        } ?>><?php echo htmlspecialchars($row['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Selectionner un cour</button>
            </div>
        </form>

        <?php
        if (isset($_POST['select-classe'])) {
            $stmt = $pdo->prepare('SELECT * FROM cours WHERE classe = :class_id');
            $stmt->bindParam(':class_id', $_POST['select-classe']);
            $stmt->execute();
            $coursListe = $stmt->fetchAll();
            foreach ($coursListe as $cours) :
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
                        </div>
                    </div>
                </div>
        <?php endforeach;
        }
        ?>
    </section>

</main>