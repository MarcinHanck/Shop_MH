<?php

session_start();

if(!isset($_POST['login1']) || (!isset($_POST['password1'])))
{
    header('Location: index.php');
    exit();
}

require_once"connect.php";

$conn = @new mysqli($host,$db_user,$db_password,$db_name); //@ - wylacza pokazywanie konkretnych bledow na stronie
    
    if($conn->connect_errno!=0)
    {
        echo "Error: ".$conn->connect_errno;
    }
    else
    {
        $login = $_POST['login1'];
        $haslo = $_POST['password1'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
         

        if($result = @$conn->query(sprintf("SELECT * FROM rejestr  WHERE User = '%s'", mysqli_real_escape_string($conn,$login))))
        {
            $ilu_userow = $result->num_rows;
            if($ilu_userow>0)
            {
                $wiersz = $result->fetch_assoc();

                if(password_verify($haslo, $wiersz['Pass']))
                {
                    $_SESSION['zalogowany'] = true;

                    
                    $_SESSION['user'] = $wiersz['User'];

                    unset($_SESSION['blad']);
                    $result->free_result();
                    header('Location:sklep.php');
                }else{
                    $_SESSION['blad'] = '<span style="color:red">Błędny login lub hasło!</span>';
                    header('Location: index.php');
                }
                
            }else{
                $_SESSION['blad'] = '<span style="color:red">Błędny login lub hasło!</span>';
                header('Location: index.php');
            }
        }


        $conn->close();
    }

?>