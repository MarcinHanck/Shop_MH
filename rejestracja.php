<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styl-rejest.css">
    <title>Sklep</title>
   
  
</head>
<body>
    <p>Rejestracja </p>

    <div id="panel">
        <form action="index.php" method="POST" id="form">
            
            <a>Nazwa uzytkownika: </a><br>
            <input type="text" name="login" id="login" > <br>
            <a>Haslo:</a><br>
            <input type="password" name="password" id="password"> <br>
            <a>Adres e-mail:</a><br>
            <input type="text" name="email" id="email"> <br>
            <button type="submit" id="btn">Zarejestruj się</button> 
            
            
        </form>
    </div>

    <!-- <?php 
        $conn = mysqli_connect("localhost","root","","logowanie");
        
        

        if(isset($_POST['submit']))
        {    
            $login = $_POST['login'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $sql = "INSERT INTO `rejestracja` (`id`, `Uzytkownik`, `Haslo`, `Email`) VALUES (NULL,'$login','$pass','$email')";
            
            if (mysqli_query($conn, $sql)) {
                echo "Uzytkownik zarejestrowany !";
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    
    ?> -->
</body>
</html>