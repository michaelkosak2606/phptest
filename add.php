<?php 
session_start();
    include('./config/db_connect.php');

    $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
    $email = $title = $ingredients = '';
    if(isset($_POST['submit'])){
        //echo 'hello';
        $email = $_POST['email'];
        $title = $_POST['title'];
        $ingredients = $_POST['ingredients'];
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredients']);
        if(empty($email)){
            $errors['email'] =  "Email is required <br>";
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email must be valid.";
            }
        }
        if(empty($title)){
            $errors['title'] = "Title is required <br>";
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = "Title must be letters only.";
            }
        }
        if(empty($ingredients)){
            $errors['ingredients'] = "Ingredients required <br>";
        }else{
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = "Ingredients must be a comma separated list.";
            }
        }

        
        // foreach ($errors as $key => $value) {
        //     echo $key . $value;
        // }
        if(array_filter($errors)){
            //echo 'errors int the form.';
        }else{
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $title = mysqli_real_escape_string($connect, $_POST['title']);
            $ingredients = mysqli_real_escape_string($connect, $_POST['ingredients']);

            //create sql
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";
           
           //save to db and check
           if(mysqli_query($connect, $sql)){

               //if success and no errors redirect to index.php
               header('Location: index.php');
           } else {
               echo "query error: " . mysqli_error($connect);
           }
           
        }
    }
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

    <section class="container">
        <h4 class="container center grey-text">Add a Pizza</h4>
        <form action="add.php" method="POST" class="white">
            <label for="">Your Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email)  ?>">
            <div class="red-text"><?php echo $errors['email']?></div>

            <label for="">Pizza Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title)  ?>">
            <div class="red-text"><?php echo $errors['title']?></div>

            <label for="">Ingredients(comma separated)</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)  ?>">
            <div class="red-text"><?php echo $errors['ingredients']?></div>

            <div class="center">
                <input class="btn brand" type="submit" value="submit" name="submit">
            </div>
        </form>
    </section>

    <?php include('./partials/footer.php')?>  
</body>
</html>