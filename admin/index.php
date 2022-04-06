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
            <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter</a></h1>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category 
                                FROM items LEFT JOIN categories ON items.category = categories.id
                                ORDER BY items.id DESC');

                        while($item = $statement->fetch()) {

                               echo '<tr>'  ;  
                               echo "<td>" . $item['name'] . "</td>";
                               echo "<td>" . $item['description'] ."</td>";
                               echo "<td>" .number_format((float)$item['price'],2,'.','')  . " €</td>";
                               echo "<td>" . $item["category"] . "</td>";
                               echo "<td width=300>" ;    
                               echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Voir</a>';         
                               echo " ";
                               echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] .'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Modifier</a>';         
                               echo " ";
                               echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] .'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>supprimer</a>';         
                               echo "</td>";     
                               echo "</tr>";


                        }
                        Database::disconnect();
                    
                    
                    
                    
                    ?>
                    
                </tbody>

            </table>
        
        </div>

    </div>    
</body>
</html>