<?php

session_start();

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

        $sql = "SELECT * FROM rejestr WHERE User = '$login' AND Pass = '$haslo'";

        if($result = @$conn->query($sql))
        {
            $ilu_userow = $result->num_rows;
            if($ilu_userow>0)
            {
                $_SESSION['zalogowany'] = true;
                
                $wiersz = $result->fetch_assoc();
                $_SESSION['user'] = $wiersz['User'];

                unset($_SESSION['blad']);
                $result->free_result();
                header('Location:sklep.php');
                
            }else{
                $_SESSION['blad'] = '<span style="color:red">Błędny login lub hasło!</span>';
                header('Location: index.php');
            }
        }


        $conn->close();
    }

?>