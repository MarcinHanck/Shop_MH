<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styl-index.css">
    <title>Sklep</title>
   
  
</head>
<?php  



?>



<body>
    <p>Logowanie</p>

    <div id="panel">
        <form action="login.php" method="POST" id="form">
            
            <a>Nazwa uzytkownika: </a><br>
            <input type="text" name="login1" id="login" > <br>
            <a>Haslo:</a><br>
            <input type="password" name="password1" id="password"> <br>
            <input type="submit" name="submit1" id="btn" value="Zaloguj"> <br>
            <a href="rejestracja.php" id="rejestracja">Rejestracja</a>
            
        </form>
    </div>
    
 <?php 

 
 
 
 ?>


    
</body>
</html>

<!-- INSERT INTO `rejestr` (`id`, `User`, `Pass`, `Email`) VALUES (NULL, 'Admin', 'Admin123', 'admin@wp.pl'); -->