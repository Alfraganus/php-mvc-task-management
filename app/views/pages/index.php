<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <a href="<?= URLROOT; ?>/tasks/add">
            <button class="btn btn-primary pull-right">Create new task</button>
        </a>
        <h1 class="display-3"><?php echo $data['title'] ?></h1>
        <p class="lead"><?= $data['description']; ?></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>