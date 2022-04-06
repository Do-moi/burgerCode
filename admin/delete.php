<?php
    require 'database.php';
    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)){
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header('Location: index.php');

    }

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">


    <title>Burger Code</title>
</head>
<body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Burger Code <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span></h1>
    <div class="container  admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Supprimer un item </strong></h1>
                <br>
                <form class='form' role="form" action="delete.php" method='post'>
                <br>
                    <input type="hidden" name='id' value="<?php echo $id ;?>"/>
                    <p class='alert alert-warning'>Etes vous sûr de vouloir supprimer ?</p>
                    <div class="form-action">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a href="index.php" class="btn btn-primary" role="button">Non</a>
                    </div>
                
                </form>
                
            </div>

            
            

            
        
        </div>

    </div>    
</body>
</html>