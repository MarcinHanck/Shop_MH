<?php 
    session_start();

    if(isset($_POST['email']))
    {
        
        $wszytko_ok=true;

        $login = $_POST['login'];

        if(strlen($login)<3 || (strlen($login)>20))
        {
            $wszytko_ok=false;
            $_SESSION['error_login'] = "Login musi posiadac od 3 do 20 znakow";
        }

        if(ctype_alnum($login)==false)
        {
            $wszytko_ok =false;
            $_SESSION['error_login']= "Login moze skladac sie tylko z liter i cyfr (bez polskich znakow)";
        }


        $email = $_POST['email'];
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
        {
            $wszytko_ok = false;
            $_SESSION['error_email']= "Podaj poprawny email";
        }


        $haslo1 = $_POST['password1'];
        $haslo2 = $_POST['password2'];

        if(strlen($haslo1)<6 || (strlen($haslo1)>20))
        {
            $wszytko_ok=false;
            $_SESSION['error_haslo'] = "Haslo musi posiadac od 6 do 20 znakow";
        }

        if($haslo1 != $haslo2)
        {
            $wszytko_ok=false;
            $_SESSION['error_haslo'] = "Podane hasla nie sa indetyczne";
        }
        
        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);


        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try 
        {
            $conn = new mysqli($host,$db_user,$db_password,$db_name);
            if($conn->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {

                    //Czy email juz istnieje?
                    $result = $conn->query("SELECT id FROM rejestr Where Email='$email'");

                    if(!$result) throw new Exception($conn->error);
                    
                    $ile_takich_maili = $result->num_rows;
                    if($ile_takich_maili>0)
                    {
                        $wszytko_ok=false;
                        $_SESSION['error_email'] = "Istnieje juz konto z takim e-mailem";
                    }

                    //Czy login juz istnieje?
                    $result = $conn->query("SELECT id FROM rejestr Where User='$login'");

                    if(!$result) throw new Exception($conn->error);
                    
                    $ile_takich_loginow = $result->num_rows;
                    if($ile_takich_loginow>0)
                    {
                        $wszytko_ok=false;
                        $_SESSION['error_login'] = "Istnieje juz konto z takim loginem";
                    }

                    if($wszytko_ok == true)
                    {
                        if($conn->query("INSERT INTO rejestr VALUES (NULL,'$login','$haslo_hash','$email')"))
                        {
                            $_SESSION['zarejestrowany']='<span style="color:lightgreen">Uzytkownik zarejestrowany</span>';
                            header('Location: index.php');
                        }
                        else
                        {
                            throw new Exception($conn->error);
                        }
                    }
                    

                    $conn->close();
                }
        }
        catch(Exception $e)
        {
            echo "<span style='color:red'>Blad serwera</span>";
            echo "<br/> Informacja: ".$e;
        }


        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl-rejest.css"type="text/css">
    
    <title>Rejestracja</title>
   
  
</head>
<body>
    <p>Rejestracja </p>

    <div id="panel">
        <form method="POST" id="form">
            
            <a>Nazwa uzytkownika: </a><br>
            <input type="text" name="login" id="login" > <br>

            <?php 
                if(isset($_SESSION['error_login']))
                {
                    echo '<div class="error">'.$_SESSION['error_login'].'</div>';
                    unset($_SESSION['error_login']);
                }             
            ?>

            <a>Haslo:</a><br>
            <input type="password" name="password1" id="password"> <br>

            <?php 
                if(isset($_SESSION['error_haslo']))
                {
                    echo '<div class="error">'.$_SESSION['error_haslo'].'</div>';
                    unset($_SESSION['error_haslo']);
                }             
            ?>

            <a>Powtorz haslo:</a><br>
            <input type="password" name="password2" id="password"> <br>
            <a>Adres e-mail:</a><br>
            <input type="email" name="email" id="email"> <br>

            <?php 
                if(isset($_SESSION['error_email']))
                {
                    echo '<div class="error">'.$_SESSION['error_email'].'</div>';
                    unset($_SESSION['error_email']);
                }             
            ?>

            <input type="submit" name="submit" id="btn" value="Zarejestruj się">
             
        </form>
    </div>

    
</body>
</html>

