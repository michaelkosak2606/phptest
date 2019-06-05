<?php 
 include('./config/db_connect.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";
    if(mysqli_query($connect, $sql)){
        //success
        header('Location: index.php');
    }else{
        echo "query error " . mysqli_error($connect);
    }
}

//check GET request id param
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($connect, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //get query result
    $result = mysqli_query($connect, $sql);

    //fetch result in array format
    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($connect);

    // print_r($pizza);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Document</title>
</head>
<body class="white light-4">
    <?php include('./partials/navbar.php')?>

    <section class="container center">
        <h2>Details</h2>
        <?php if($pizza):?>
            <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
            <p>Email:<?php echo htmlspecialchars($pizza['email']);?></p>
            <p>Created at:<?php echo date($pizza['created_at']);?></p>
            <h5>Ingredients</h5>
            <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
            <form action="./details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $id ?>">
                <input type="submit" name="delete" value="Delete Pizza" class="btn brand">
            </form>

        <?php else:?>
            <h5>No such pizza exists.</h5>
        <?php endif;?>

    </section>
    

    <?php include('./partials/footer.php')?>  
</body>
</html>