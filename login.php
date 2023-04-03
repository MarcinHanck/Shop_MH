<?php

    session_start();

    if(!isset($_POST['login']) || (!isset($_POST['password'])))
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
            $login = $_POST['login'];
            $haslo = $_POST['password'];
            $login = htmlentities($login, ENT_QUOTES, "UTF-8");
            
            

            if($result = @$conn->query(sprintf("SELECT * FROM rejestr  WHERE User = '%s'",
             mysqli_real_escape_string($conn,$login))))
            {
                $ilu_userow = $result->num_rows;
                if($ilu_userow>0)
                {
                    $wiersz = $result->fetch_assoc();

                    if(password_verify($haslo, $wiersz['Pass']))
                    {
                        $_SESSION['zalogowany'] = true;

                        $_SESSION['User'] = $wiersz['User'];
                        
                        if($wiersz['User'] == 'Admin'){                                        
                            unset($_SESSION['blad']);                                          
                            $result->free_result();
                            header('Location:Admin.php');
                        }elseif($wiersz['User'] == $login){
                            unset($_SESSION['blad']);
                            $result->free_result();
                            header('Location:sklep.php');
                        }

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