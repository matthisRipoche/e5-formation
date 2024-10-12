<main class="page-register d-flex align-items-center py-4 vh-100">
    <div class="form-register w-100 m-auto">
        <form action="home" method="POST">
            <h1 class="h3 mb-3 fw-normal">Please register</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingFisrtName">
                <label for="floatingFisrtName">First Name</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingLastName">
                <label for="floatingLastName">Last Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingEmail">
                <label for="floatingEmail">Email adresse</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingInput">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingConfirmPassword">
                <label for="floatingConfirmPassword">Confirm Password</label>
            </div>
            <input type="hidden" name="login-submit" value="1">
            <button class="btn w-100 py-2" type="submit">Register</button>
        </form>
    </div>
</main>