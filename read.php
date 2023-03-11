<?php
require_once '../controller/functions.php';

$model = new Model();

$rows = $model->fetchAllRecords();
?>

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $i = 1;

    if(!empty($rows))
    {
        foreach($rows as $row)
        {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><a id="edit" value="<?php echo $row['users_id']; ?>" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a></td>
                <td><a id="delete" value="<?php echo $row['users_id']; ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
