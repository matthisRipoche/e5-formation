<div class="form-register w-100 m-auto">
    <form action="home?page=user" method="POST">
        <h1 class="h3 mb-3 fw-normal">Register an account</h1>

        <div class="row ">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingFirstName" name="register-firstname" required>
                    <label for="floatingFirstName">First Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingLastName" name="register-lastname" required>
                    <label for="floatingLastName">Last Name</label>
                </div>
            </div>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="register-email" required>
            <label for="floatingEmail">Email address</label>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="register-password" required>
                    <label for="floatingPassword">Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingConfirmPassword" name="register-confirmpassword" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="role" id="floatingRole" class="form-control">
                        <?php foreach ($adminUsers->getListeRoles() as $role): ?>
                            <option value="<?php echo $role; ?>" <?php echo ($role === 'eleve') ? 'selected' : ''; ?>>
                                <?php echo $role; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingRole">Role</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <select name="classe" id="floatingClasse" class="form-control">
                        <option value="">Unknow</option>
                        <?php
                        $stmt = $pdo->query('SELECT * FROM classes');
                        while ($classe = $stmt->fetch()) :
                        ?>
                            <option value="<?php echo $classe['id']; ?>">
                                <?php echo $classe['name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <label for="floatingClasse">Classe</label>
                </div>
            </div>
        </div>

        <input type="hidden" name="register-submit">
        <input class="btn w-100 py-2 bg-dark text-white" type="submit" value="Register">
    </form>

    <div class="error">
        <?php if (!empty($formRegister->error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $formRegister->error; ?>
            </div>
        <?php endif; ?>
    </div>
</div>