<?php

require_once '../controller/functions.php';

$update_id = $_POST['studentupdate_id'];

$model = new Model();

$row = $model->edit($update_id);

if (!empty($row)) {
?>

    <form id="edit_form" method="post" class="form-horizontal">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Firstname</label>

            <input type="text" class="form-control" id="edit_firstname" value="<?php echo $row['firstname']; ?>" placeholder="enter firstname" />

        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Lastname</label>

            <input type="text" class="form-control" id="edit_lastname" value="<?php echo $row['lastname']; ?> " placeholder="enter lastname" />

        </div>

        <input type="hidden" id="edit_id" value="<?php echo $row['users_id']; ?>">

    </form>

<?php
}

?>