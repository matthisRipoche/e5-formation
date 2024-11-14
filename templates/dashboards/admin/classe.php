<?php
isSessionOK();
$adminClasse = new AdminClasse();
?>

<div class="container-fluid vh-100">
    <div class="row vh-100">

        <?php require_once 'templates/dashboards/parts/admin/sidebar.php'; ?>

        <main class="col-10 bg-light">
            <section class="admin-classe container mt-5">
                <h2>Classes</h2>

                <form action="" method="post">
                    <div class="form-group d-flex">
                        <div class="flex-grow-1">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="ms-2 align-self-end">
                            <button type="submit" name="create" class="btn btn-primary">Créer</button>
                        </div>
                    </div>
                </form>

                <div class="table-classes table-responsive shadow-sm p-3 mb-5 mt-5 rounded">
                    <table class="table table-striped text-center align-middle rounded">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $pdo->query('SELECT * FROM classes');
                            while ($row = $stmt->fetch()) : ?>
                                <tr>
                                    <form action="" method="post">
                                        <td><?php echo $row['id']; ?></td>
                                        <td>
                                            <input type="text" name="name" class="form-control text-center" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" name="update" value="<?php echo $row['id']; ?>" class="btn btn-success btn-sm me-2">
                                                    <i class="bi bi-pencil"></i> Modifier
                                                </button>
                                                <button type="submit" name="delete" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Supprimer
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </section>
        </main>
    </div>
</div>