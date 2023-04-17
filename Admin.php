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

// -----------------------------




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css" >
    <title>Sklep - Admin</title>
</head>
<body>
<?php
 echo "<h3>Witaj ".$_SESSION['User']."</h3>";
 echo "<a href='logout.php'>Wyloguj się</a><br><br>";
?>

    <p id="panel_admin">Panel administratora</p>
<form method="POST" id="panel1" enctype="multipart/form-data">
            
            <input type="text" name="name" placeholder="enter the product name" class="box" required><br>
            <input type="number" name="price" min="0" placeholder="enter the product price" class="box" required><br>
            <input type="file" name="image" accept=".png, .jpg, .jpeg" class="box" required><br>
                
                <?php  
                if(isset($_SESSION['success']))
                {
                    echo '<div class="blad">'.$_SESSION['success'].'</div><br>';
                    unset($_SESSION['success']);
                }           
            ?>
				<input type="reset" name="czysc" class="btn" value="Reset">
				<input type="submit" value="Dodaj produkt" name="add_product" class="btn">
				<br />
</form>


<div id="panel2">
<p >Produkty w sklepie</p>

<section class="tabela">

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
            <td>$<?php echo $row['Cena']; ?>/-</td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

</div>



</body>
</html>