<?php
class Model{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'php_pdo_crud';
    private $connection;

    //create connection
    public function __construct()
    {
        try
        {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database",
                $this->username, $this->password);
        }
        catch (PDOException $e)
        {
            echo "Connection error " . $e->getMessage();
        }
    }

    // insert student new record into database and handle ajax request
    public function insert()
    {
        if(isset($_POST['insertbutton']))
        {
            if(isset($_POST['studentfirstname']) && isset($_POST['studentlastname']))
            {
                if(!empty($_POST['studentfirstname']) && !empty($_POST['studentlastname']))
                {
                    $firstname = $_POST['studentfirstname'];
                    $lastname = $_POST['studentlastname'];

                    $insert_stmt=$this->connection->prepare('INSERT INTO tbl_users(firstname, 
																						 lastname) 
																					 VALUES
																						 (:fname,
																						  :lname)');
                    $insert_stmt->bindParam(':fname',$firstname);
                    $insert_stmt->bindParam(':lname',$lastname);

                    if($insert_stmt->execute())
                    {
                        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Inserted :</strong> data insert successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> ';
                    }
                    else
                    {
                        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning :</strong> fail to insert data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> ';
                       
                    }
                }
                else
                {
                    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Warning :</strong> all fields are required !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> ';
                   
                }
            }
        }
    }

    //fetch all student record from database and handle ajax request
    public function fetchAllRecords()
    {

        $data = null;

        $select_stmt = $this->connection->prepare('SELECT * FROM tbl_users');

        $select_stmt->execute();

        $data = $select_stmt->fetchAll();

        return $data;
    }

    //delete student record from database and handle ajax request
    public function deleteRecords($delete_id)
    {
        $delete_stmt = $this->connection->prepare('DELETE FROM tbl_users WHERE users_id = :sid ');
        $delete_stmt->bindParam(':sid',$delete_id);

        if ($delete_stmt->execute())
        {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Deleted :</strong> data deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> ';
        }
        else
        {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning :</strong> fail to delete data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> ';
           
        }
    }

    //fetch student record from database and handle ajax request
    public function edit($update_id)
    {
        $data = null;

        $edit_stmt = $this->connection->prepare('SELECT * FROM tbl_users WHERE users_id = :sid');
        $edit_stmt->bindParam(':sid',$update_id);

        $edit_stmt->execute();

        $data = $edit_stmt->fetch();

        return $data;
    }

    //update student record and handle ajax request
    public function update($data)
    {
        $update_stmt=$this->connection->prepare('UPDATE tbl_users SET firstname=:fname, 
																			lastname=:lname 
																		WHERE 
																		    users_id=:id');
        $update_stmt->bindParam(':fname',$data['edit_firstname']);
        $update_stmt->bindParam(':lname',$data['edit_lastname']);
        $update_stmt->bindParam(':id',$data['edit_id']);

        if($update_stmt->execute())
        {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Updated :</strong> data update successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> 

          <script> $("#exampleModal").modal("hide"); </script> ';
           
        }
        else
        {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Warning :</strong> fail to update data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> ';
           
        }
    }

}
