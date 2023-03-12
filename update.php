<?php

if(isset($_POST['update_button']))
{
    if(isset($_POST['update_firstname']) && isset($_POST['update_lastname']) && isset($_POST['update_id']))
    {
        if(!empty($_POST['update_firstname']) && !empty($_POST['update_lastname']) && !empty($_POST['update_id']))
        {
            $data['edit_firstname'] = $_POST['update_firstname'];
            $data['edit_lastname'] = $_POST['update_lastname'];
            $data['edit_id'] = $_POST['update_id'];

            require_once '../controller/functions.php';

            $model = new Model();

            $update = $model->update($data);
        }
        else
        {
            // echo '<script> alert("all fields are required"); </script>' ;
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning :</strong> all fields are required.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> ';
        }
    }
}

?>