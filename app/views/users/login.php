<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Login</h2>
            <p>Please fill the form</p>
            <form action="<?= URLROOT ?>users/login" method="post">
                <div class="form-group">
                    <label for="email">Login <sup>*</sup></label>
                    <input type="text" name="login" class="form-control form-control-lg <?= (!empty($data['login_err'])) ? 'is-invalid' : ''; ?>"">
                    <span class="invalid-feedback"><?= $data['login_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?= $data['password_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URLROOT; ?>users/register " class="btn btn-light btn-block">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <?php require APPROOT . '/views/inc/footer.php'; ?>