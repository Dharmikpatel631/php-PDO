<?php

require_once '../controller/functions.php';

$delete_id = $_POST['studentdelete_id'];

$model = new Model();

$delete = $model->deleteRecords($delete_id);

?>
