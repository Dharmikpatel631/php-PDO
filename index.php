<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<pre></pre>
<h1 style="text-align: center;">CRUD APP using PHP PDO MySQL and Ajax</h1>
<pre></pre>
<div class="wrapper">
    <div class="container">
        <div class="col-lg-12">

            <center><h2>Add Record</h2></center>

            <div class="card">
                <div class="card-body">
                     <form id="insert_form" method="post" class="form-horizontal">

                     <div class="mb-3">
                     <label for="exampleInputEmail1" class="form-label">Firstname</label>
                    
                        <input type="text" class="form-control" id="txt_firstname" placeholder="enter firstname"/>
                   
                </div>

                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Lastname</label>
                   
                        <input type="text" class="form-control" id="txt_lastname" placeholder="enter lastname"/>
                    
                </div>

                <div class="mb-3">
                    <div class="col-sm-offset-3 col-sm-6 m-t-15">
                        <button type="submit" id="btn_create" class="btn btn-success">Insert</button>
                    </div>
                </div>

            </form>
                </div>
            </div>

            <br/>

            <div class="col-lg-12">
                <div id="message"></div>
                <div id="fetch"></div>
            </div>

        </div>
    </div>
</div>

<!-- Update Modal Start-->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update data form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
      <div id="message1"></div>
      <div id="update_data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btn_update" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script>

    //Create New Record

    $(document).on('click','#btn_create',function(e){

        e.preventDefault();

        var firstname = $('#txt_firstname').val();
        var lastname = $('#txt_lastname').val();
        var create = $('#btn_create').val();

        $.ajax({
            url: 'view/create.php',
            type: 'post',
            data:
                {studentfirstname:firstname,
                    studentlastname:lastname,
                    insertbutton:create
                },
            success: function(response){
                fetch();
                $('#message').html(response);
            }
        });

        $('#insert_form')[0].reset();

    });

    //Fetch All Records

    function fetch(){

        $.ajax({
            url: 'view/read.php',
            type: 'post',
            success: function(response){
                $('#fetch').html(response);
            }
        });
    }

    fetch();

    //Delete Record

    $(document).on('click','#delete',function(e){

        e.preventDefault();

        if(window.confirm('are you sure to delete data'))
        {
            var delete_id = $(this).attr('value');

            $.ajax({
                url: 'view/delete.php',
                type: 'post',
                data:{studentdelete_id:delete_id},
                success: function(response){
                    fetch();
                    $('#message').html(response);
                }
            });
        }
        else
        {
            return false;
        }
    });

    //Get Specific Id record or Edit Record

    $(document).on('click','#edit', function(e){

        e.preventDefault();

        var update_id = $(this).attr('value');

        $.ajax({
            url: 'view/edit.php',
            type: 'post',
            data: {studentupdate_id:update_id},
            success: function(response){
                $('#update_data').html(response);
            }
        });

    });

    //Update Record

    $(document).on('click','#btn_update',function(e){

        e.preventDefault();

        var firstname = $('#edit_firstname').val();
        var lastname = $('#edit_lastname').val();
        var edit_id = $('#edit_id').val();
        var update_btn = $('#btn_update').val();

        $.ajax({
            url: 'view/update.php',
            type: 'post',
            data:
                {update_firstname:firstname,
                    update_lastname:lastname,
                    update_id:edit_id,
                    update_button:update_btn
                },
            success: function(response){
                fetch();
                $('#message1').html(response);
            }
        });

    });
</script>
</body>
</html>