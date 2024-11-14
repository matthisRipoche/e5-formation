<?php
isSessionOK();
$adminHomeController = new AdminHomeController();
?>

<div class="container-fluid vh-100">
    <div class="row vh-100">

        <?php require_once 'templates/dashboards/parts/admin/sidebar.php'; ?>

        <main class="col-10 bg-light">
            <section class="admin-stats col-md-9 mt-5 mx-auto">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm mb-4 rounded-lg text-white bg-dark">
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
                        <div class="card border-0 shadow-sm mb-4 rounded-lg text-white bg-dark">
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
                        <div class="card border-0 shadow-sm mb-4 rounded-lg text-white bg-dark">
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
                <form action="" method="post" id="select-class-calendar">
                    <div class="form-group d-flex row">
                        <div class="flex-grow-1 ms-2 col-10">
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
                        <div class="flex-grow-1 ms-2 col-2">
                            <input type="submit" class="form-control bg-dark text-white mt-3" value="Selectionner un cour">
                        </div>
                    </div>
                </form>
            </section>

            <div class="calendar_container my-5">
                <div id="calendar"></div>
            </div>
        </main>
    </div>
</div>