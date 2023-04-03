<?php 
    session_start();

    if(isset($_SESSION['Udanarejestracja']) )
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        unset($_SESSION['Udanarejestracja']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl-index.css" type="text/css" >
    <title>Sklep</title>
   
  
</head>
<body>
    <p>Uzytkownik zarejestrowany</p>

    <div id="panel">
        <form action="login.php" method="POST" id="form">
            
    
            <a href="index.php" id="rejestracja">Zaloguj sie</a>
            
        </form>
    </div>
    
</body>
</html>

<!-- INSERT INTO `rejestr` (`id`, `User`, `Pass`, `Email`) VALUES (NULL, 'Admin', 'Admin123', 'admin@wp.pl'); -->