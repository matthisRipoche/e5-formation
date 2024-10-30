<?php
$adminUsers = new AdminUser($pdo);
?>

<main class="admin-page container-fluid">
    <?php require_once 'templates/dashboards/parts/admin/nav.php'; ?>

    <section class="admin-user container mt-2">
        <h2 class="mb-4 text-center">Admin User Management</h2>
        <p class="mb-4 text-center">Modify user details, assign roles and classes, or delete users.</p>

        <div class="table-users table-responsive shadow-sm p-1 mb-5 rounded">
            <table class="table text-center align-middle">
                <thead>
                    <tr>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Classe</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query('SELECT * FROM users');
                    while ($user = $stmt->fetch()) : ?>
                        <tr>
                            <form action="" method="post">
                                <!-- Modification des informations utilisateur -->
                                <td>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                                </td>
                                <td>
                                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['mail']); ?>" required>
                                </td>
                                <td>
                                    <select name="role" class="form-select" <?php echo ($user['role'] === 'admin') ? 'disabled' : ''; ?>>
                                        <?php foreach ($adminUsers->getListeRoles() as $role): ?>
                                            <option value="<?php echo $role; ?>" <?php echo ($role === $user['role']) ? 'selected' : ''; ?>>
                                                <?php echo $role; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="classe" class="form-select">
                                        <option value="">Unknow</option>
                                        <?php
                                        $stmt_classe = $pdo->query('SELECT * FROM classes');
                                        while ($classe = $stmt_classe->fetch()) :
                                        ?>
                                            <option value="<?php echo $classe['id']; ?>" <?php echo ($classe['id'] === $user['classe']) ? 'selected' : ''; ?>>
                                                <?php echo $classe['name']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </td>
                                <td>
                                    <!-- Actions: Sauvegarder ou Supprimer -->
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="update" value="<?php echo $user['id']; ?>" class="btn btn-success btn-sm me-2">
                                            <i class="bi bi-save"></i> Sauvegarder
                                        </button>
                                        <button type="submit" name="delete" value="<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" <?php echo ($user['role'] === 'admin') ? 'disabled' : ''; ?>>
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

        <?php require_once 'templates/dashboards/parts/admin/register-user.php'; ?>
    </section>
</main>