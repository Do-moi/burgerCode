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
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">


    <title>Burger Code</title>
</head>
<body>
    
    <div class="container site">
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Burger Code <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></h1>
        <?php
        require 'admin/database.php';
        echo '<nav>
                <ul class="nav nav-pills"> ';
        $db = Database::connect();  
        $statement = $db->query('SELECT * FROM categories') ;
        $categories = $statement->fetchAll();

        foreach($categories as $category){

            if($category['id'] == "1"){
               echo  '<li role="presentation" class="active " ><a  href="#'.$category['id'].'" data-toggle="tab">'. $category['name'].'</a></li>';
            }else{
                echo  '<li role="presentation"><a  href="#'.$category['id'].'" data-toggle="tab">'. $category['name'].'</a></li>';
            }
            
        }
        echo    '</ul>
              </nav>';
        
        echo  ' <div class="tab-content ">';
        foreach($categories as $category){

            if($category['id'] == "1"){
               echo    '<div class="tab-pane active " id="'. $category['id'] .'">' ;
            }else{
                echo    '<div class="tab-pane" id="'. $category['id'] .'">' ;
            }
            echo '<div class="row ">';
            $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
            $statement ->execute(array($category['id']));

            while($item = $statement->fetch()){
                echo '<div class="col-sm-6 col-md-4 ">
                <div class="thumbnail">
                    <img src="images/'. $item['image'] . '">
                    <div class="price">'.number_format($item['price'],2,'.',''). '€</div>
                    <div class="caption">
                        <h4>'. $item['name'].'</h4>
                        <p>'. $item['description'].'</p>
                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Commander</a>
                    </div>
                  </div>
                
                </div>';

            }
            echo '</div>
            </div>';

        }
        Database::disconnect();
        echo '</div>';

        
        ?>
        

    </div>
    
</body>
</html>