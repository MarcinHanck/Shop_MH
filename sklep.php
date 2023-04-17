<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}


require_once "connect.php";
   $conn = new mysqli($host,$db_user,$db_password,$db_name);

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   

   $select_cart = mysqli_query($conn, "SELECT * FROM `koszyk` WHERE Nazwa = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'produkt juz jest w koszyku';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `koszyk`(Nazwa, Cena, Zdjecie, Ilosc) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'produkt dodany do koszyka';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sklep</title>
</head>

<body>

<?php

 echo "<p>Witaj ".$_SESSION['User']." w naszym sklepie</p>";
 echo "<a href='logout.php'>Wyloguj się</a><br>";
?>


<?php

if(isset($message)){
   foreach($message as $message){
      echo '<br><span>'.$message.'</span>';
   };
};

?>


   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `produkt`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src=""<?php echo $fetch_product['Zdjecie']; ?>" alt="">
            <h3><?php echo $fetch_product['Nazwa']; ?></h3>
            <div class="price"><?php echo $fetch_product['Cena']; ?>zł /-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['Nazwa']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['Cena']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['Zdjecie']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

   <a href="koszyk.php">Przejdz do koszyka</a>





</body>
</html>