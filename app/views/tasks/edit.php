<?php require APPROOT . '/views/inc/header.php'; ?>
    <!-- <div class="row"> -->
    <a href="<? URLROOT; ?>/" class="btn btn-light"> <i class="fa fa-backward"></i> Back</a>
    <div class="col-md-6 mx-auto"><?= $data['id']; ?>
        <div class="card card-body bg-light mt-5">
            <h2>Add task</h2>
            <p>Create a task</p>
            <form action="<?= URLROOT ?>tasks/adminEdit/<?= $data['id']; ?>" method="post">
                <div class="form-group">
                    <label for="title">User name <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="title">Email <sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="body">Task : <sup>*</sup></label>
                    <input type="text" name="task_content" class="form-control form-control-lg <?= (!empty($data['content_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['task_content']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="body">Status : <sup>*</sup></label>
                    <select class="form-control" name="status">
                        <option value="pending">Pending</option>
                        <option value="finished">Finished</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-success" value="Submit">
            </form>
        </div>
        <!-- </div> -->
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>