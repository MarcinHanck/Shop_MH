<?php
session_start();

require_once "connect.php";
$conn = new mysqli($host,$db_user,$db_password,$db_name);

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `koszyk` SET Ilosc = '$update_value' WHERE id = '$update_id'");
    if($update_quantity_query){
       header('location:koszyk.php');
    };
 };

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `koszyk` WHERE id = '$remove_id'");
   header('location:koszyk.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `koszyk`");
   header('location:koszyk.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>

<style>
*{
    margin: 0;
    padding: 0;
    font-family:sans-serif;
    
}
.page{
   display: flex;
    justify-content: center;
    align-items: center;
   position: relative;
   top: 200px;
   }
section{
   
   min-height: 100vh;
   width: 100%;
   background: url(tlo3.jpg)no-repeat;
   background-position: center;
   background-size: cover;
}

table, th, td, tr {
    border:1px solid white;
    color: #fff;
    padding: 5px;
    border-collapse: collapse;
    text-align: center;
}
.form-box{
   position: relative;
    width: 800px;
    height: 350px;
    background: transparent;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    
 }

.box1{
   display: flex;
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 40px;
}
.box2{
   display: flex;
    justify-content: center;
}
.box3{
   display: flex;
    justify-content: center;
    margin-top: 10px;
}
h2{
   color: #00ffbf;
}
.icona{
   display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 80px;
    position: relative;
    top: 190px;
}

a{
   text-decoration: none;
    color: #fff;
    font-weight: 600;   
    }

a:hover{
    text-decoration: underline;
}

.box3 a{
   color: #00ffbf;
}
</style>

</head>
<body>

<section>
<div class="icona">
   <ion-icon name="bag-outline"></ion-icon>
</div>
<div class="page">

<div class="form-box">

<div class="box1">
<h2 class="heading">Podsumowanie koszyka</h2>
</div>

<div class="box2">
   <table>
   
      <thead>
        <th>Zdjecie</th>
         <th>Nazwa</th>
         <th>Cena</th>
         <th>Ilosc</th>
         <th>Cena</th>
         <th>Usuwanie</th>
      </thead>

      

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `koszyk`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['Zdjecie']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['Nazwa']; ?></td>
            <td><?php echo number_format($fetch_cart['Cena']); ?>zł /-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['Ilosc']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td><?php echo $sub_total = number_format($fetch_cart['Cena'] * $fetch_cart['Ilosc']); ?>zł /-</td>
            <td><a href="koszyk.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Usunać produkt z koszyka?')" class="delete-btn"> Usun</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="sklep.php" class="option-btn" style="margin-top: 0;">Kontynuuj zakupy</a></td>
            <td colspan="3">Cena za wszytsko</td>
            <td><?php echo $grand_total; ?>zł /-</td>
            <td><a href="koszyk.php?delete_all" onclick="return confirm('Na pewno usunąć wszystkie produkty?');" class="delete-btn"> Usun wszytsko </a></td>
         </tr>

      

   </table>
   </div>
   
   <div class="box3">
      <a href="kasa.php" class="btn">Przejdz do kasy</a>
      
   </div>

 </div>

 </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>