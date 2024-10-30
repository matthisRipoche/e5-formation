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


</main>