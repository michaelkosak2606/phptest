<?php 
    session_start();
    
    $_SESSION['name'] = "Username";
    echo $_SESSION['name'];

   //unsetting session variables
   if($_SERVER['QUERY_STRING'] == 'noname'){
       unset($_SESSION['name']);
       //unset();
    }
    $name = $_SESSION['name'] ?? 'Guest';
    $gender = $_COOKIE['gender'] ?? 'Unknown';
?>


<nav class="white z-depth-0">
    <div class="container">
        <a href="./index.php" class="brand-logo brand-text">Pizza Project</a>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li class="grey-text"> Hello, <?php echo htmlspecialchars($name) ?>!</li>   
            <li class="grey-text">... <?php echo htmlspecialchars($gender) ?></li>   
            <li>
            <a href="./add.php" class="btn brand z-depth-0">Add a Pizza</a>
            </li>

        </ul>
    </div>
</nav>