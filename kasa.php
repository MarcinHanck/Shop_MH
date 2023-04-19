<?php

require_once "connect.php";
$conn = new mysqli($host,$db_user,$db_password,$db_name);

if(isset($_POST['order_btn'])){

   $name = $_POST['Imie'];
   $surname = $_POST['Nazwisko'];
   $phone = $_POST['Telefon'];
   $email = $_POST['Email'];
   $city = $_POST['Miasto'];
   $street = $_POST['Ulica'];
   $flat = $_POST['Mieszkanie'];

   $koszyk_query = mysqli_query($conn, "SELECT * FROM `koszyk`");
   $price_total = 0;
   if(mysqli_num_rows($koszyk_query) > 0){
      while($product_item = mysqli_fetch_assoc($koszyk_query)){
         $product_name[] = $product_item['Nazwa'] .' ('. $product_item['Ilosc'] .') ';
         $product_price = number_format($product_item['Cena'] * $product_item['Ilosc']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `zamowienia`(`Imie`, `Nazwisko`, `NrTel`, `Email`, `Miasto`, `Ulica`, `Mieszkanie`, `Produkty`, `Cena`) VALUES ('$name','$surname','$phone','$email','$city','$street','$flat','$total_product','$price_total')") or die('query failed');

   if($koszyk_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
      <h3>Dziekujemy za zamowienie</h3>
      <div class='order-detail'>
         <span>".$total_product."</span>
         <span class='total'> Koszt całkowity : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p> Imie : <span>".$name."</span> </p>
            <p> Nazwisko : <span>".$surname."</span> </p>
            <p> Numer telefonu : <span>".$phone."</span> </p>
            <p> Email : <span>".$email."</span> </p>
            <p> Adres dostawy : <span>".$city.", ".$street.", ".$flat."</span> </p>
            <p>(*Platnosc przy odbiorze*)</p>
         </div>
            <a href='sklep.php' class=''>Kontynuuj zakupy</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Podsumowanie</title>
   

</head>
<body>


<div class="container">

<section class="checkout-form">

   <h1 class="heading">Podsumowanie twojego zamowienia</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `koszyk`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['Cena'] * $fetch_cart['Ilosc']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['Nazwa']; ?>(<?= $fetch_cart['Ilosc']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>Twój koszyk jest pusty!</span></div>";
      }
      ?>
      <br>
      <span class="grand-total"> Koszt całkowity : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
      <div class="inputBox">
            <span>Imie: </span>
            <input type="text" placeholder="Wprowadz imie" name="Imie" required>
         </div>
         <div class="inputBox">
            <span>Nazwisko: </span>
            <input type="text" placeholder="Wprowadz nazwisko" name="Nazwisko" required>
         </div>
         <div class="inputBox">
            <span>Numer telefonu: </span>
            <input type="number" placeholder="Wprowadz nr tel" name="Telefon" required>
         </div>
         <div class="inputBox">
            <span>Email: </span>
            <input type="email" placeholder="Wprowadz email" name="Email" required>
         </div>
         <div class="inputBox">
            <span>Miasto: </span>
            <input type="text" placeholder="Wprowadz miasto" name="Miasto" required>
         </div>
         <div class="inputBox">
            <span>Ulica: </span>
            <input type="text" placeholder="Wprowadz ulice" name="Ulica" required>
         </div>
         <div class="inputBox">
            <span>Numer mieszkania: </span>
            <input type="number" placeholder="Wprowadz nr mieszkania" name="Mieszkanie" required>
         </div>
      <input type="submit" value="Zamów" name="order_btn" class="btn">
   </form>

</section>

</div>


   
</body>
</html>