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
    <title>Sklep</title> 

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
    height: 450px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;
 }

 h2{
    font-size: 2em;
    color: white;
    text-align: center;
 }

 .input{
    position: relative;
    margin: 30px 0;
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

.rejestr{
    font-size: .9em;
    color: #fff;
    text-align: center;
    margin: 25px 0 10px;
}
.rejestr p a{
    text-decoration: none;
    color: #fff;
    font-weight: 600;
}
.rejestr p a:hover{
    text-decoration: underline;
}

.komunikat{
    position: relative;
    bottom: 10px;
    display: flex;
    justify-content: center;
   
}

</style>

</head>
<body>
    
 <section>

    <div class="form-box">

        <div class="form-value">

            <form action="login.php" method="POST" id="form">

                <h2>Logowanie</h2>

                    <div class="input">

                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="login" id="login" required>
                        <label for="">Login</label>

                    </div>

                    <div class="input">

                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" id="password" required> 
                        <label for="">Hasło</label>

                    </div>

                        <?php 
                            if(isset($_SESSION['blad'])) echo "<div class='komunikat'>".$_SESSION['blad']."</div>";
                            if(isset($_SESSION['zarejestrowany'])) echo "<div class='komunikat'>".$_SESSION['zarejestrowany']."</div>";
                        ?>

                        <input type="submit" name="submit" class="btn" value="Zaloguj"> <br>

                    <div class="rejestr">

                        <p>Nie masz konta <a href="rejestracja.php" id="rejestracja">zarejestruj się</a></p>

                    </div>

            </form>

        </div>

    </div>

</section>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
