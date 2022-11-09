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
    <title>Add Product</title>
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
//Déchiffrement
$myFiles=$bdd->prepare("SELECT * FROM produits WHERE typep ='image/*'");
$myFiles->execute();

foreach($myFiles as $data){
  $getFiles= "data:" .$data['typep'] . ";base64,". base64_encode($data['positionp']);
}

  if(isset($_POST['envoyer'])){
    if(!empty($_POST['nom_prd'])
    AND !empty($_POST['prix_prd'])
    AND !empty($_POST['description1'])
    AND !empty($_POST['description'])
    ){

      $nom_prd=htmlspecialchars($_POST['nom_prd']);
      $prix_prd=htmlspecialchars($_POST['prix_prd']);
      $description1=htmlspecialchars($_POST['description1']);
      $description=nl2br(htmlspecialchars($_POST['description']));

      $fileType= $_FILES["file"]["type"];
      $fileName= $_FILES["file"]["name"];
      $file=$_FILES["file"]["tmp_name"];

      move_uploaded_file($file,"files/". $fileName);
      $position="files/". $fileName;

      $upload=$bdd->prepare("INSERT INTO produits(nomp,prixp,descdet,descp,imagep,typep,positionp) VALUES (:nomp,:prixp,:descdet,:descp,:imagep,:typep,:positionp)");
      $upload->bindParam("nomp",$nom_prd);
      $upload->bindParam("prixp",$prix_prd);
      $upload->bindParam("descdet",$description1);
      $upload->bindParam("descp",$description);
      $upload->bindParam("imagep", $fileName);
      $upload->bindParam("typep",$fileType);
      $upload->bindParam("positionp",$position);
      if($upload->execute()){
        echo("<script>alert('Produit bien enregistrer')</script>");

      }
      else{
          echo $errorMsg= "echec" ;
      }
  }}
?>
<?php

$allproduit=$bdd->query('SELECT *  FROM produits where id_produit ORDER BY id_produit DESC LIMIT 50');
if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
    $recherche= htmlspecialchars($_GET['recherche']);
    $allproduit=$bdd->query('SELECT *  FROM produits where id_produit AND nomp LIKE "%'.$recherche.'%" ORDER BY id_produit DESC LIMIT 50');
}


?>
<br>
<div class="container">
<form class="d-flex" method="GET">
      <input class="form-control me-2" type="search" name="recherche" placeholder="Search product" aria-label="Search" autocomplete="off">
      <button class="btn btn-outline-success" name="rechercher" type="submit">Search</button>
    </form>
    <section class="afficher_theme">
      </div>

<!-- model -->
<button type="button" class="btn btn-primary ajouter" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Produits</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

     
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Product Name</label>
            <input type="text" name="nom_prd" class="form-control">
          </div>  
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Price</label>
            <input type="double" name="prix_prd" class="form-control">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Detailed Description</label>
            <input type="text" name="description1" class="form-control">
          </div> 
          <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
         </div>
         <div class="mb-3" >
          <label for="formFile" class="form-label">Product image</label>
          <input class="form-control" type="file" name="file" accept="image/*" id="formFile" >
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="envoyer" class="btn btn-primary" >Send</button>
          </div>
         
    </form>
    </div> 
    </div>
  </div>
</div>

<h1 align='center' class="parti" >Product Lists</h1>
    <br><br><br><br>
    <table class="table table-hover">
        <tr>
            <td>Product_Id</td>
            <td>Product_Name</td>
            <td>Product_Price</td>
            <td>Description_Detail</td>
            <td>Description</td>
            <td>Image_Product</td>
        </tr>
  <?php
  if($allproduit-> rowCount()>0){
    while($produit = $allproduit->fetch()){
    ?>
        <tr>
        <td> <?php echo $produit['id_produit'] ?></td> 
        <td> <?php echo $produit['nomp'] ?></td> 
        <td> <?php echo $produit['prixp'] ?></td> 
        <td> <?php echo $produit['descdet'] ?></td> 
        <td> <?php echo $produit['descp'] ?></td> 
        <td> <img src="../Espace Admin/files/<?php echo $produit['imagep']?>" style="width: 90px; height:90px;" ></td> 
        

        <td>  <a class="btn btn-danger" href="ajout.php?supprime=<?= $produit['id_produit'] ?>">Delete</a>
        <a class="btn btn-warning" href="modifierProduit.php?id_produit=<?= $produit['id_produit'] ?>">Edit</a> </td>
      
</tr>
<?php

// supprimer produit
if(isset($_GET['supprime'])AND !empty($_GET['supprime'])){
  $supprime =(int) $_GET['supprime'];

  $req=$bdd->query('DELETE FROM produits WHERE id_produit='.$supprime);
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