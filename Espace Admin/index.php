<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=topnet_store;','root','');

if (!$_SESSION['mdp']){
    header('Location: connexion.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPNET STORE</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- header section starts  -->

    <header class="headeradmin">

        <a href="#" class="logo">
            <img src="image/toplogo.png" alt="">
        </a>


        <nav class="navbar">
            
            <a href="livrer.php">Delivred</a>
            <a href="ajout.php">add product</a>
            <a href="commande.php">Commands</a>
            
        </nav>

    </header>
<?php
$totalProd= $bdd->query('SELECT count(*)  FROM produits ');
$totalCommande=$bdd->query('SELECT count(*) FROM commandes ');
$totallivrer=$bdd->query('SELECT count(*) FROM commandes where confirmer = 1 ');

?>
    <section class="menuadmin" id="menu">

        <h1 class="heading" > dash<span>board</span> </h1>

        <div class="box-container">

            <div class="box">
                <img src="images/p1.png" alt="">
                <?php
                 while($prod = $totalProd->fetch()){
                 ?>
                <h3>PRODUCTS</h3>
             
                <div class="price"><?php echo $prod[0] ;}?></div>
                
            </div>

            <div class="box">
                <img src="images/p2.png" alt="">
                <?php
                 while($comm = $totalCommande->fetch()){
                 ?>
                <h3>COMMANDS</h3>
                <div class="price"><?php echo $comm[0] ;}?></div>
                
            </div>

            <div class="box">
                <img src="images/p3.png" alt="">
                <?php
                 while($livrerr = $totallivrer->fetch()){
                 ?>
                <h3>DELIVRED</h3>
                <div class="price"><?php echo $livrerr[0] ;}?></div>
               
            </div>

          
    </section>



</body>

</html>