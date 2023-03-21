<div class="container d-flex justify-content-center align-items-center" style="height: 700px;">
    <form action="" method="post" class="input-group-vertical" style="width: 20rem;">
        <h3 class="text-center mb-3">Please sign up</h3>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="login" class="form-control" id="floatingInput" placeholder="Login" value=<?= $login ?? null ?>>
                <label for="floatingInput">Login</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" name="confirmPassword" class="form-control" id="floatingPassword" placeholder="Confirm password">
                <label for="floatingPassword">Confirm password</label>
            </div>
            <div class="form-floating">
                <input type="text" name="age" class="form-control" id="floatingPassword" placeholder="Age">
                <label for="floatingPassword">Age</label>
            </div>
        </div>
        <input type="submit" name="submit" class="btn btn-primary w-100" value="Sign-up">
    </form>
</div>