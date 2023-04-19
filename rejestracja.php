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
    <title>Rejestracja</title>
 
<style>
*{
    margin: 0;
    padding: 0;
    font-family:sans-serif;
    
 } 

section{
   display: flex;
   justify-content: center;
   align-items: center;
   min-height: 100vh;
   width: 100%;
   background: url(tlo.png)no-repeat;
   background-position: center;
   background-size: cover;
 } 

 .form-box{
    position: relative;
    width: 400px;
    height: 550px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;
 }

 h2{
    font-size: 2.2em;
    color: white;
    text-align: center;
 }

 .input{
    position: relative;
    margin: 20px 0;
    width: 310px;
    border-bottom: 2px solid #fff;
}

.input label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}

input:focus ~ label,
input:valid ~ label{
top: -5px;
}

.input input{
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;
}

.input ion-icon{
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2em;
    top: 20px;
}

.btn{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight:600 ;
}

.error{
    color: red;
    position: relative;
    bottom: 10px;
}
</style>
  
</head>
<body>
<section>

    <div class="form-box">

        <div id="form-value">

            <form method="POST" id="form">

                <h2>Rejestracja</h2>

                <div class="input">

                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="login" id="login" required> 
                    <label for="">Login</label>

                </div>
                    <?php 
                        if(isset($_SESSION['error_login']))
                        {
                            echo '<div class="error">'.$_SESSION['error_login'].'</div>';
                            unset($_SESSION['error_login']);
                        }             
                    ?>
                <div class="input">

                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password1" id="password" required> 
                    <label for="">Hasło</label>

                </div>

                    <?php 
                        if(isset($_SESSION['error_haslo']))
                        {
                            echo '<div class="error">'.$_SESSION['error_haslo'].'</div>';
                            unset($_SESSION['error_haslo']);
                        }             
                    ?>

                <div class="input">

                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password2" id="password" required> 
                    <label for="">Powtorz haslo</label>

                </div>

                <div class="input">

                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" id="email" required>
                    <label for="">Adres e-mail</label>

                </div>

                    <?php 
                        if(isset($_SESSION['error_email']))
                        {
                            echo '<div class="error">'.$_SESSION['error_email'].'</div>';
                            unset($_SESSION['error_email']);
                        }             
                    ?>

                <input type="submit" name="submit" class="btn" value="Zarejestruj się">
                
            </form>

        </div>

    </div>

</section>
    
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>

