<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create An account</h2>
            <p>Please fill the form to register with us</p>
            <form action="<?= URLROOT ?>users/register" method="post">

                <div class="form-group">
                    <label for="email">Login <sup>*</sup></label>
                    <input type="text" name="login" class="form-control form-control-lg <?= (!empty($data['login_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['login']; ?>">
                    <span class="invalid-feedback"><?= $data['login_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['password']; ?>">
                    <span class="invalid-feedback"><?= $data['password_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?= (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?= $data['confirm_password_err']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT;?>users/login " class="btn btn-light btn-block">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <?php require APPROOT . '/views/inc/footer.php'; ?>