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
    <title>Modifier Produit</title>
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

if(isset( $_GET['id_produit']) AND !empty($_GET['id_produit'])){
    // En recuperer l'id qui envoyer a modifier
    $getId=$_GET['id_produit'];
    

    $recupProduit=$bdd->query('SELECT * FROM produits WHERE id_produit='.$getId);
   

    if($recupProduit-> rowCount()>0){
      $produitInfo=$recupProduit->fetch();

      $nom_prd=$produitInfo['nomp'];
      $prix_prd=$produitInfo['prixp'];
      $descriptiond= $produitInfo['descdet'];
      $description = $produitInfo['descp'];
      $fileType= $produitInfo['typep'];
      $fileName= $produitInfo['imagep'];
      $file=$produitInfo['positionp'];

      move_uploaded_file($file,"files/". $fileName);
      $position="files/". $fileName;
    
      //   Nouvelle donnée asaisie
      if(isset($_POST['envoyer'])){
        $updateProduit=$bdd->prepare('UPDATE produits SET nomp=?, prixp=? , descdet=? , descp=? , imagep=? 
        , typep=? , positionp=?  WHERE id_produit=?');
        $nom_prdSaisie=htmlspecialchars($_POST['nom_prd']);
        $prix_prdSaisie=htmlspecialchars($_POST['prix_prd']);
        $descriptionSaisie1=htmlspecialchars($_POST['description1']);
        $descriptionSaisie=htmlspecialchars($_POST['description']);
        $fileTypeNouv= $_FILES["file"]["type"];
        $fileNameNouv= $_FILES["file"]["name"];
        $fileNouv=$_FILES["file"]["tmp_name"];
        move_uploaded_file($fileNouv,"files/". $fileNameNouv);
        $positionNouv="files/". $fileNameNouv;

        // requête modifier
    
        $updateProduit->execute(array($nom_prdSaisie,$prix_prdSaisie,$descriptionSaisie1,$descriptionSaisie,$fileNameNouv,$fileTypeNouv,$positionNouv,$getId  ));

        header('Location:ajout.php');



      }

    }
}
 
?>

<!-- Modal -->
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Edit Publication</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Product_Name </label>
            <input type="text" name="nom_prd" value="<?= $nom_prd?>" class="form-control">
          </div>  
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Price</label>
            <input type="double" name="prix_prd" value="<?= $prix_prd ?>" class="form-control">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Detailed Description</label>
            <input type="text" name="description1" value="<?= $descriptiond?>" class="form-control">
          </div> 
          <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description"  id="exampleFormControlTextarea1" rows="3"><?= $description  ?></textarea>
         </div>
         <div class="mb-3" >
          <label for="formFile" class="form-label">Image </label>
          <input class="form-control" type="file"  name="file" accept="image/*" id="formFile" >
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="envoyer" class="btn btn-primary" >Send</button>
          </div>
         
    </form>
      </div> 
    </div>
  </div>


    
</body>
</html>