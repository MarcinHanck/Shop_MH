<?php 
    session_start();

    if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
    {
        header('Location: sklep.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" >
    <title>Sklep</title>
   
  
</head>
<body>
    <p>Logowanie</p>

    <div id="panel">
        <form action="login.php" method="POST" id="form">
            
            <a>Nazwa uzytkownika: </a><br>
            <input type="text" name="login" id="login" > <br>
            <a>Haslo:</a><br>
            <input type="password" name="password" id="password"> <br>
            <?php 
                if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
            ?>
            <input type="submit" name="submit" class="btn" value="Zaloguj"> <br>
            <?php 
                if(isset($_SESSION['zarejestrowany'])) echo $_SESSION['zarejestrowany'];
            ?>
            <a href="rejestracja.php" id="rejestracja">Rejestracja</a>
            
        </form>
    </div>
    
</body>
</html>

<!-- INSERT INTO `rejestr` (`id`, `User`, `Pass`, `Email`) VALUES (NULL, 'Admin', 'Admin123', 'admin@wp.pl'); -->