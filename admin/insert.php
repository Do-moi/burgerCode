<?php
    require 'database.php';
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";
    

    if(!empty($_POST)){
        $name = checkInput($_POST['name']);
        $description = checkInput($_POST['description']);
        $price = checkInput($_POST['price']);
        $category = checkInput($_POST['category']);
        $image = checkInput($_FILES['image']['name']);
        $imagePath = '../images/'.basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($name)){
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description)){
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($price)){
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)){
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }else {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != 'gif'){
                $imageError = "Les fichiers autorisés sont: .jpg, .png, .jpeg, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)){
                $imageError = "Le fichier existe déjà";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000){
                $imageError = "Lefichier ne doit pas dépasser 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess){
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                    $imageError = "Il y a eu une erreur lord de l'upload";
                    $isUploadSuccess = "false";
                }
            }
        }
        if($isSuccess && $isUploadSuccess){
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO items (name,description,price,category,image) values(?,?,?,?,?)');
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header('location: index.php');

        }

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
                <h1><strong>Ajouter un item </strong></h1>
                <br>
                <form class='form' role="form" action="insert.php" method='post' enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name='name' placeholder="Nom" value="<?php echo $name ?>">
                        <span class="help_inline"><?php echo $nameError ; ?></span>
                    
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description ?>">
                        <span class="help_inline"><?php echo $descriptionError ; ?></span>
                    
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="prix" value="<?php echo $price ?>">
                        <span class="help_inline"><?php echo $priceError ; ?></span>
                    
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                                $db = Database::connect();
                                foreach($db->query("SELECT * FROM categories") as $row) {

                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';

                                }
                                Database::disconnect();
                            ?>

                        </select>
                        <span class="help_inline"><?php echo $categoryError ; ?></span>
                    
                    </div>
                    <div class="form-group">
                        <label for='image'>Sélectionner une image:</label>
                        <input type="file" id="image" name="image">
                        <span class="help_inline"><?php echo $imageError ; ?></span>
                    
                    </div>
                    <br>
                    <div class="form-action">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Ajouter</button>
                        <a href="index.php" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Retour</a>
                    </div>
                
                </form>
                
            </div>

            
            

            
        
        </div>

    </div>    
</body>
</html>