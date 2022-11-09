<?php
session_start();
$bdd= new PDO('mysql:host=localhost; dbname=topnet_store;','root','');
//Sécurité... 
if(!$_SESSION['mdp']){
    header('Location: connexion.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Delivery</title>
    <style>
      .lin{
        color: white;
      }
      .lin:hover{
        color: white;
        text-decoration: underline;
      }
    </style>
 
</head>
<body>
<!-- navbar -->
<div class="b-example-divider"></div>

  <header style="background-color: black;" class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li ><a  href="index.php" class="nav-link px-2 link-secondary lin">Admin</a></li>
        </ul>
        <a style="margin-left: 10px ;" type="button" class="btn btn-dark" href="logout.php">Disconnect</a>
      </div>
    </div>
  </header> 
<?php

$allLivrer=$bdd->query('SELECT *  FROM commandes where id_com and confirmer = 1 ORDER  BY id_com DESC LIMIT 50');
if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
    $recherche= htmlspecialchars($_GET['recherche']);
    $allLivrer=$bdd->query('SELECT *  FROM commandes where id_com AND confirmer = 1 and  nom_client LIKE "%'.$recherche.'%" ORDER BY id_com DESC LIMIT 50');
}

?>
<br>
<div class="container">
<form class="d-flex" method="GET">
      <input class="form-control me-2" type="search" name="recherche" placeholder="Search client" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-success" name="rechercher" type="submit">Search</button>
    </form>
    <section class="afficher_theme">
      </div>
<br>

<h1 align='center' class="parti" >Delivery lists</h1>
    <br><br><br><br>
    <table class="table table-hover">
        <tr>
            <td>Order_Id</td>
            <td>Customer_Name</td>
            <td>Email_Client</td>
            <td>Customer_Number </td>
            <td>Customer_Address</td>
        </tr>
   <?php
  if($allLivrer-> rowCount()>0){
    while($livraison = $allLivrer->fetch()){
    ?>
    <tr>
        <td> <?php echo $livraison['id_com'] ?></td> 
        <td> <?php echo $livraison['nom_client'] ?></td> 
        <td> <?php echo $livraison['mail_client'] ?></td> 
        <td> <?php echo $livraison['num_tel_client'] ?></td> 
        <td> <?php echo $livraison['adress_client'] ?></td> 

        <td><a class="btn btn-danger" href="livrer.php?supprime=<?= $livraison['id_com'] ?>">Delete</a></td>

    </tr>
    <?php
    // supprimer une livraison
    if(isset($_GET['supprime'])AND !empty($_GET['supprime'])){
      $supprime =(int) $_GET['supprime'];
  
      $req=$bdd->query('DELETE FROM commandes WHERE id_com='.$supprime);
  }
  ?>
<?php
    }

}else {
           
echo "<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
Rien afficher
</div> " ;


}

?>  

</table>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>