<?php 
include('./config/db_connect.php');

//query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

//write query and ger result from db
$result = mysqli_query($connect, $sql);

//fetch the resulting rows as array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
//print_r($pizzas);

mysqli_free_result($result);
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body class="white light-4">
    <?php include('./partials/navbar.php')?>
    <h4 class="center grey-text">Pizzas List</h4>
    <div class="container">
        <div class="row">
            <?php foreach ($pizzas as $pizza) : ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($pizza['title'])?></h5>
                            <!-- <div><?php echo htmlspecialchars($pizza['ingredients'])?></div> -->
                            <ul>
                                <?php foreach (explode(',',$pizza['ingredients']) as $ing) : ?>
                                   <li><?php echo htmlspecialchars($ing); ?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">
                                more info
                            </a>
                        </div>
                    </div>
                </div>
                    
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('./partials/footer.php')?>  
</body>
</html>