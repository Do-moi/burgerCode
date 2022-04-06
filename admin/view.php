<?php
    require 'database.php';

    if(!empty($_GET['id'])) {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category 
    FROM items LEFT JOIN categories ON items.category = categories.id
    WHERE items.id = ?');

    $statement->execute(array($id));
    $item =$statement->fetch();

    Database::disconnect();



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
                <h1><strong>Voir un item </strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom:</label><?php echo ' ' . $item["name"]; ?>
                    
                    </div>
                    <div class="form-group">
                        <label>Description:</label><?php echo ' ' . $item["description"]; ?>
                    
                    </div>
                    <div class="form-group">
                        <label>Prix:</label><?php echo ' ' . number_format((float)$item['price'],2,'.','')." €"; ?>
                    
                    </div>
                    <div class="form-group">
                        <label>Catégorie:</label><?php echo ' ' . $item["category"]; ?>
                    
                    </div>
                    <div class="form-group">
                        <label>Image:</label><?php echo ' ' . $item["image"]; ?>
                    
                    </div>
                
                </form>
                <br>
                <div class="form-action">
                <a href="index.php" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour</a>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 site ">
                        <div class="thumbnail">
                            <img src="<?php echo'../images/' . $item["image"]; ?>">
                            <div class="price"><?php echo ' ' . number_format((float)$item['price'],2,'.','') . " €"; ?></div>
                            <div class="caption">
                                <h4><?php echo ' ' . $item["name"]; ?></h4>
                                <p><?php echo ' ' . $item["description"]; ?></p>
                                <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Commander</a>
                            </div>
                        </div>
                        
                    </div>
            

            
        
        </div>

    </div>    
</body>
</html>