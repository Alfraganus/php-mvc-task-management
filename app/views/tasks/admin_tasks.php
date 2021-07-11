<?php require APPROOT . '/views/inc/header.php';
?>
<div class="row">
    <div class="col-md-6">
        <h1>Tasks</h1>
    </div>

</div>
<?php flash('post_message'); ?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>
            User name
        </th>
        <th>
            Email
        </th>
        <th>Task  </th>
        <th>
            Status
        </th>
        <th  class="text-center">
        edit
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $task) : ?>
        <tr>
            <td> <?= $task->name; ?></td>
            <td> <?= $task->email; ?></td>
            <td> <?= $task->task_content; ?></td>
            <td class="text-center"> <?= $task->status=='finished'?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-ban" aria-hidden="true"></i>'; ?></td>
            <td class="text-center">
                <a target="_blank" href="<?= URLROOT; ?>tasks/adminEdit/<?= $task->id; ?>"  <i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>


<?php require APPROOT . '/views/inc/footer.php'; ?>