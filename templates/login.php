<main class="page-login d-flex align-items-center py-4 vh-100 bg-light">
    <div class="form-signin w-100 m-auto">
        <form action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingEmail" name="login-email" placeholder="name@example.com">
                <label for="floatingEmail">Email adresse</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput" name="login-password" placeholder="name@example.com">
                <label for="floatingPassword">Password</label>
            </div>
            <input type="hidden" name="login-submit">
            <button class="btn w-100 py-2 bg-dark text-white" type="submit">Sign in</button>
        </form>
        <div class="error">
            <?php if (!empty($formLogin->error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $formLogin->error; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>