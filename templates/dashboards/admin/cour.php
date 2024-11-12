<?php
$adminClasse = new AdminCour();
?>

<main class="admin-page container-fluid">
    <?php require_once 'templates/dashboards/parts/admin/nav.php'; ?>

    <section class="admin-cour container mt-5">
        <h2>Cour</h2>

        <form action="" method="post">
            <div class="form-group d-flex">
                <div class="flex-grow-1">
                    <label for="classe">Classe</label>
                    <select class="form-select" id="classe" name="classe" required>
                        <option selected>Choisir une classe</option>
                        <?php
                        $stmt = $pdo->query('SELECT * FROM classes');
                        while ($row = $stmt->fetch()) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="flex-grow-1 ms-2">
                    <label for="matiere">Matière</label>
                    <select class="form-select" id="matiere" name="matiere" required>
                        <option selected>Choisir une matière</option>
                        <?php
                        $stmt = $pdo->query('SELECT * FROM subjects');
                        while ($row = $stmt->fetch()) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="flex-grow-1 ms-2">
                    <label for="professeur">Professeur</label>
                    <select class="form-select" id="professeur" name="enseignant" required>
                        <option selected>Choisir un professeur</option>
                        <?php
                        $stmt = $pdo->query('SELECT * FROM users WHERE role = "enseignant"');

                        while ($prof = $stmt->fetch()) : ?>
                            <option value="<?php echo $prof['id']; ?>"><?php echo  $prof['lastname'] . ' ' . $prof['firstname']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="flex-grow-1 ms-2">
                    <label for="datetime">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="flex-grow-1 ms-2">
                    <label for="timeInput">Choisissez une heure (pile ou demi-heure) :</label>
                    <input type="time" class="form-control" id="timeStart" name="timeStart" step="1800">
                </div>
                <div class="flex-grow-1 ms-2">
                    <label for="timeInput">Choisissez une heure (pile ou demi-heure) :</label>
                    <input type="time" class="form-control" id="timeEnd" name="timeEnd" step="1800">
                </div>
                <div class="flex-grow-1 ms-2">
                    <input type="hidden" name="add-cour" value="add">
                    <button type="submit" class="btn btn-primary mt-3">Ajouter un cour</button>
                </div>
            </div>
        </form>


        <!-- Liste des cours -->

        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">Classe</th>
                    <th scope="col">Matière</th>
                    <th scope="col">Professeur</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure de début</th>
                    <th scope="col">Heure de fin</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query('SELECT * FROM cours');
                while ($cour = $stmt->fetch()) : ?>
                    <tr>
                        <form action="" method="post">
                            <td>
                                <select name="classe" class="form-select">
                                    <option value="">Unknow</option>
                                    <?php
                                    $stmt_classe = $pdo->query('SELECT * FROM classes');
                                    while ($classe = $stmt_classe->fetch()) :
                                    ?>
                                        <option value="<?php echo $classe['id']; ?>" <?php echo ($classe['id'] === $cour['classe']) ? 'selected' : ''; ?>>
                                            <?php echo $classe['name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                            <td>
                                <select name="matiere" class="form-select">
                                    <option value="">Unknow</option>
                                    <?php
                                    $stmt_classe = $pdo->query('SELECT * FROM subjects');
                                    while ($matiere = $stmt_classe->fetch()) :
                                    ?>
                                        <option value="<?php echo $matiere['id']; ?>" <?php echo ($matiere['id'] === $cour['matiere']) ? 'selected' : ''; ?>>
                                            <?php echo $matiere['name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>

                            <td>
                                <select name="enseignant" class="form-select">
                                    <option value="">Unknow</option>
                                    <?php
                                    $stmt_prof = $pdo->query('SELECT * FROM users WHERE role = "enseignant"');
                                    while ($prof = $stmt_prof->fetch()) :
                                    ?>
                                        <option value="<?php echo $prof['id']; ?>" <?php echo ($prof['id'] === $cour['enseignant']) ? 'selected' : ''; ?>>
                                            <?php echo $prof['lastname'] . ' ' . $prof['firstname']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </td>

                            <td>
                                <input type="date" name="date" value="<?php echo date('Y-m-d', strtotime($cour['date'])); ?>" class="form-control">
                            </td>
                            <td><input type="time" name="timeStart" value="<?php echo date('H:i', strtotime($cour['timestart'])) ?>" class="form-control"></td>
                            <td><input type="time" name="timeEnd" value="<?php echo date('H:i', strtotime($cour['timeend'])) ?>" class="form-control"></td>
                            <td>
                                <div class="d-flex">
                                    <button type="submit" name="update-cour" value="<?php echo $cour['id']; ?>" class="btn btn-success btn-sm me-2">
                                        <i class="bi bi-save"></i> Sauvegarder
                                    </button>
                                    <button type="submit" name="delete-cour" value="<?php echo $cour['id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </section>
</main>