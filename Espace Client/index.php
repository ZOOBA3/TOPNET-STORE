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
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <a href="#" class="logo">
            <img src="images/toplogo.png" alt="">
        </a>


        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#menu">products</a>
        </nav>


    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">
            <h3>TOP e-SHOP</h3>
            <p> leader des Fournisseurs d'accès à Internet Tunisiens <br>
                #TOPNET #TOPNETESHOP #VENTEFLASH #ECOMMERCE #BOUTIQUEENLIG</p>
            <a href="#menu" class="btn">STORE</a>
        </div>

    </section>

    <!-- home section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">

        <h1 class="heading"> <span>about</span> us </h1>

        <div class="row">

            <div class="image">
                <img src="images/5G.jpg" alt="">
            </div>

            <div class="content">
                <h3>why we are the best<h3>
                        <p>TOPNET is a Tunisian company which started its activities on May 2, 2001, it is the leader,
                            today, of Internet Service Providers in Tunisia
                        </p>
                        <p>TOPNET devient une filiale de groupe Tunisie Télécom, en Juin 2010, cette acquisition est
                            considérée par Tunisie Télécom comme étant une opération stratégique permettant le
                            renforcement de son leadership à travers un acteur qui, en quelques années, a réussi à se
                            hisser en leader sur le marché des fournisseurs de services Internet (FSI).

                            Notre valeur est claire : « Garantir la pérennité de notre entreprise en devenant le
                            Fournisseur de Service Internet préféré de nos clients par notre niveau de Qualité »<br>...
                            <a href="https://www.topnet.tn/pages/qui-sommes-nous" class="btn">learn more</a>...
                        </p>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- menu section starts  -->

    <section class="menu" id="menu">

        <h1 class="heading" > our <span>store</span> </h1>

        <div class="box-container">

        <?php
    $bdd= new PDO('mysql:host=localhost; dbname=topnet_store;','root','');
    $recupproduit= $bdd->query('SELECT * FROM produits ORDER BY id_produit DESC');
    while($produits = $recupproduit->fetch()){

?>

            <div class="box">
                <img src="../Espace Admin/files/<?php echo $produits['imagep']?>" >
                <h3><?php echo $produits['nomp'] ?></h3>
                <div class="price"><?php echo $produits['prixp'] ?>TND</div>

                <a class="btn" href="produit.php?id_produit=<?= $produits['id_produit'] ?>">Check</a>

            </div>

 <?php
}
?> 
        </div>



    </section>

    <!-- menu section ends -->





  



    <!-- footer section starts  -->

    <section class="footer">

        <div class="share">
            <a href="https://www.facebook.com/topnet.officiel" class="fab fa-facebook-f"></a>
            <a href="https://twitter.com/topnet_vip" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/topnet_tn/?hl=fr" class="fab fa-instagram"></a>

        </div>

        <div class="links">
            <a href="#">home</a>
            <a href="#about">about</a>
            <a href="#menu">products</a>
        </div>

        <div class="credit">created by <span>Ayoub Gwadria</span> #ZOOBA3</div>

    </section>

    <!-- footer section ends -->

















    

</body>

</html>