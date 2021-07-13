<?php require APPROOT . '/views/inc/header.php';
?>
<div class="row">
    <div class="col-md-6">
        <h1>Tasks</h1>
    </div>

</div>
<?php flash('post_message'); ?>
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
                <th>
                    <div class="dropdown" >
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           User name
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="?orderByName=ASC">Accending</a>
                            <a class="dropdown-item" href="?orderByName=DESC">Decending</a>
                        </div>
                    </div>
                </th>
            <th>
                <div class="dropdown" >
                    <button  class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Email
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="?orderByEmail=ASC">Accending</a>
                        <a class="dropdown-item" href="?orderByEmail=DESC">Decending</a>
                    </div>
                </div>
            </th>
            <th>Task </th>
            <th>
                <div class="dropdown" >
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Status
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="?orderByStatus=DESC">finished</a>
                        <a class="dropdown-item" href="?orderByStatus=ASC">not-finished</a>
                    </div>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
    <?php foreach ($data['tasks'] as $task) : ?>
        <tr>
            <td> <?= $task->name; ?></td>
            <td> <?= $task->email; ?></td>
            <td> <?= $task->task_content; ?></td>
            <td class="text-center"> <?= $task->status=='finished'?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-ban" aria-hidden="true"></i>'; ?></td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>

<?php
echo yidas\widgets\Pagination::widget([
    'pagination' => $data['pagination'],
]);
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>