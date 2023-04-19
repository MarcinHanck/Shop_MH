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
            

 if (isset($_POST["add_product"])){
        $nazwa=$_POST['name'];
        $cena = $_POST['price'];
        //$zdj = $_FILES['image'];
        if($_FILES['image']['error'] === 4){
            echo "<script> alert('Image Does Not Exist');</script>";
        }else{
            $zdj = $_FILES['image']['name'];

        }
        
    }

          
if($conn->connect_errno!=0)
        {
            echo "Error: ".$conn->connect_errno;
        }
        else
        {
            if (isset($nazwa) && isset($cena) && isset($zdj))
            {
                $sql = "INSERT INTO produkt(`id`, `Nazwa`, `Cena`, `Zdjecie`) VALUES (NULL,'$nazwa','$cena','$zdj')";

                $result = mysqli_query($conn, $sql);
                $_SESSION['success'] = "Produkt został dodany do bazy";
            }	
            

            $conn->close();
        }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep - Admin</title>

<style>
*{
    margin: 0;
    padding: 0;
    font-family:sans-serif;
    
 } 

 section{
   
   min-height: 100vh;
   width: 100%;
   background: url(tlo2.jpg)no-repeat;
   background-position: center;
   background-size: cover;
 } 

 .panele{
    display: flex;
    justify-content: center;
   align-items: center;
   margin-top: 150px;
   
   

 }

.box{
    border-radius: 20px;
    background: transparent;
    backdrop-filter: blur(15px);
    position: relative;
    border: 2px solid rgba(255,255,255,0.5);
    margin: 30px;
    padding: 20px;
    
    
    
}

 h2{
    font-size: 2em;
    color: white;
    text-align: center;
    margin-bottom: 15px;
 }

 a{
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    border:1px solid white;
    padding: 5px;
    position: relative;
    top: 10px;
    left: 5px;
}
a:hover{
    text-decoration: underline;
}

.btn{
    width: 130px;
    height: 20px;
    border-radius: 20px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight:600 ;
    margin-top: 15px;
}

table, th, td, tr {
    border:1px solid white;
    color: #fff;
    padding: 5px;
    border-collapse: collapse;
    text-align: center;
}
th, td ,tr {
    background: transparent;
    backdrop-filter: blur(2px);
}
    
  

  .input input{
    width: 250px;
    height: 20px;
    background: transparent;
    border: 1px solid whitesmoke;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;
    border-radius: 15px;
    margin: 5px;
}

.blad{
    position: relative;
    top: 10px;
    display: flex;
    justify-content: center;
    color: #fff;
}
</style>

</head>
<body>

<section>

    <?php
    echo "<a href='logout.php'>Wyloguj się</a><br><br>";
    echo "<h2>Witaj ".$_SESSION['User']."</h2>";
    
    ?>

<div class="panele">

    <div class="box">

            <h2>Panel administracyjny</h2>
        <form method="POST" enctype="multipart/form-data">
                <div class="input">
                    <input type="text" name="name" placeholder="Nazwa produktu"  required>
                </div>

                <div class="input">
                    <input type="number" name="price" min="0" placeholder="Cena produktu"  required>
                </div>

                <div class="input">
                    <input type="file" name="image" accept=".png, .jpg, .jpeg" required>
                </div>
                        
                        <?php  
                        if(isset($_SESSION['success']))
                        {
                            echo '<div class="blad">'.$_SESSION['success'].'</div><br>';
                            unset($_SESSION['success']);
                        }           
                    ?>
                        <input type="reset" name="czysc" class="btn" value="Wyczyść">
                        <input type="submit" value="Dodaj produkt" name="add_product" class="btn">
                        
        </form>

    </div>


    <div class="box">
        <h2>Produkty w sklepie</h2>
        <?php

        if(isset($message)){
        foreach($message as $message){
            echo '<div class="message"><span>'.$message.'</span>';
        };
        };

        ?>
        

        <table>

            <thead>
                <th>Zdjecie</th>
                <th>Nazwa</th>
                <th>Cena</th>
            </thead>

            <tbody>
                <?php
                    require_once "connect.php";
                    $conn = new mysqli($host,$db_user,$db_password,$db_name);
                    $select_products = mysqli_query($conn, "SELECT * FROM `produkt`");
                    if(mysqli_num_rows($select_products) > 0){
                    while($row = mysqli_fetch_assoc($select_products)){
                ?>

                <tr>
                    <td><img src="uploaded_img/<?php echo $row['Zdjecie']; ?>" height="100" alt=""></td>
                    <td><?php echo $row['Nazwa']; ?></td>
                    <td><?php echo $row['Cena']; ?> zł</td>
                </tr>

                <?php
                    };    
                    }else{
                    echo "<div class='empty'>Nie ma dodanych zadnych produktow</div>";
                    };
                ?>
            </tbody>    
        </table>

    </div>

    <div class="box">

            <h2>Lista zamówień</h2>
                
                        <table>
                            <tr>
                                <th>Imie</th>
                                <th>Nazwisko</th>
                                <th>Numer telefonu</th>
                                <th>Email</th>
                                <th>Miasto</th>
                                <th>Ulica</th>
                                <th>Numer mieszkania</th>
                                <th>Zamowione produkty</th>
                                <th>Koszt</th>
                            </tr>
                            
                                <?php
                                    $query = "SELECT * FROM zamowienia"; 
                                    $result = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr><td>".$row['Imie']."</td><td>".$row['Nazwisko']."</td><td>".$row['NrTel']."</td><td>".$row['Email']."</td><td>".$row['Miasto']."</td><td>".$row['Ulica']."</td><td>".$row['Mieszkanie']."</td><td>".$row['Produkty']."</td><td>".$row['Cena']." zł</td></tr>";
                                        }
                                    }
                                ?>
                            
                        </table>
                    
    </div>

</div>

</section>

</body>
</html>