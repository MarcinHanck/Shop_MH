<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

//Dodawanie produktu do bazy 

require_once "connect.php";
$conn = new mysqli($host,$db_user,$db_password,$db_name);
            

 if (isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["comment"])){
        $nazwa=$_POST['name'];
        $cena = $_POST['price'];
        $opis = $_POST['comment'];
    }



            
if($conn->connect_errno!=0)
        {
            echo "Error: ".$conn->connect_errno;
        }
        else
        {
            if(empty($nazwa) || empty($cena) || empty($opis))
            {
                $_SESSION['error'] = "Nie podano wszystkich danych produktu"; 
            }
            else if (isset($nazwa) && isset($cena) && isset($opis))
            {
                $sql = "INSERT INTO produkt(`id`, `Nazwa`, `Cena`, `Opis`) VALUES (NULL,'$nazwa','$cena','$opis')";

                $result = mysqli_query($conn, $sql);
                $_SESSION['success'] = "Produkt został dodany do bazy";
            }	
            

            $conn->close();
        }

// -----------------------------
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl-Admin.css" type="text/css" >
    <title>Sklep - Admin</title>
</head>
<body>
<?php
 echo "<h3>Witaj ".$_SESSION['User']."</h3>";
 echo "<a href='logout.php'>Wyloguj się</a><br><br>";
?>

    <p id="panel_admin">Panel administratora</p>
<form method="POST" id="panel1">
                <div class="row">
				<label>Nazwa produktu: </label><input type="text" name="name"></br></br>
                </div>
                <div class="row">
				<label>Cena produktu: </label><input type="float" name="price"></br></br>
                </div>
                <div class="row">
				<label>Opis produktu: </label><textarea name="comment" rows='4' cols='23'></textarea></br></br>
				</div>
                <?php 
                if(isset($_SESSION['error']))
                {
                    echo '<div class="blad">'.$_SESSION['error'].'</div><br>';
                    unset($_SESSION['error']);
                }  
                if(isset($_SESSION['success']))
                {
                    echo '<div class="blad">'.$_SESSION['success'].'</div><br>';
                    unset($_SESSION['success']);
                }           
            ?>
				<input type="reset" name="czysc" class="btn" value="Reset">
				<input type="submit" name="wyslij" class="btn" value="Dodaj">
				<br />
</form>

<p id="lista">Lista zamowien</p>
<div id="panel2">
<?php 

?>

</div>



</body>
</html>