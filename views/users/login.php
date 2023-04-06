<div class="container d-flex justify-content-center align-items-center" style="height: 700px;">
    <form action="" method="post" class="input-group-vertical" style="width: 20rem;">
        <h3 class="text-center mb-3">Please login</h3>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <div class="form-floating">
                <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email" value=<?= $email ?? null ?>>
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
        </div>
        <input type="submit" name="submit" class="btn btn-primary w-100" value="Login">
    </form>
</div>