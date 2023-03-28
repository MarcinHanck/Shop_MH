<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styl.css">
    <title>Sklep</title>
   
  
</head>
<body>
    <p>Logowanie</p>

    <div id="panel">
        <form action="index.php" method="POST" id="form">
            
            <a>Nazwa uzytkownika: </a><br>
            <input type="text" name="login" id="login" > <br>
            <a>Haslo:</a><br>
            <input type="password" name="password" id="password"> <br>
            <button type="submit" id="btn">Zaloguj</button> <br>
            <a href="rejestracja.php" id="rejestracja">Rejestracja</a>
            
        </form>
    </div>
    
</body>
</html>